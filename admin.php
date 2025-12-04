<?php
session_start();
require_once __DIR__ . '/config.php';

if (!$pdo instanceof PDO) {
    http_response_code(500);
    echo 'La connexion à la base de données est indisponible.';
    exit;
}

$error = null;

if (isset($_GET['logout'])) {
    unset($_SESSION['atlas_admin']);
    header('Location: admin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    $usernameInput = trim($_POST['username']);
    if (hash_equals($adminUsername, $usernameInput) && hash_equals($adminPassword, $_POST['password'])) {
        $_SESSION['atlas_admin'] = true;
        header('Location: admin.php');
        exit;
    }
    $error = 'Identifiants incorrects.';
}

$isAuthenticated = !empty($_SESSION['atlas_admin']);
$requests = [];

if ($isAuthenticated) {
    $stmt = $pdo->query('SELECT id, name, email, phone, project_type, message, created_at FROM contact_requests ORDER BY created_at DESC');
    $requests = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Atlas Cera</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        :root {
            --primary: #ef8c41;
            --primary-dark: #c46b28;
            --bg-dark: #080b11;
            --bg-soft: #0f141d;
            --text: #e5e7eb;
            --text-muted: #9ca3af;
            --border: rgba(255, 255, 255, 0.1);
            --error: #ff6b6b;
            --success: #51cf66;
        }
        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            min-height: 100vh;
            background: radial-gradient(circle at top, #111827, #05070b 55%);
            color: var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            line-height: 1.6;
        }
        .login-container {
            width: 100%;
            max-width: 420px;
        }
        .panel {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        }
        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .login-header h1 {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #ffb76b, #ef8c41);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .login-header p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }
        .login-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .form-group label {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .form-group input {
            width: 100%;
            padding: 0.9rem 1.2rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border);
            border-radius: 12px;
            color: var(--text);
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.3s ease;
        }
        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 3px rgba(239, 140, 65, 0.1);
        }
        .form-group input::placeholder {
            color: var(--text-muted);
        }
        .login-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #ffb76b, #ef8c41);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(239, 140, 65, 0.3);
            margin-top: 0.5rem;
        }
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(239, 140, 65, 0.4);
        }
        .login-btn:active {
            transform: translateY(0);
        }
        .alert {
            padding: 1rem 1.2rem;
            border-radius: 12px;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            border: 1px solid;
        }
        .alert.error {
            background: rgba(255, 107, 107, 0.1);
            color: var(--error);
            border-color: rgba(255, 107, 107, 0.3);
        }
        .alert.success {
            background: rgba(81, 207, 102, 0.1);
            color: var(--success);
            border-color: rgba(81, 207, 102, 0.3);
        }
        /* Dashboard styles */
        .dashboard-panel {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
            width: min(1200px, 100%);
        }
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border);
        }
        .top-bar h1 {
            font-size: 1.75rem;
            font-weight: 600;
            background: linear-gradient(135deg, #ffb76b, #ef8c41);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .logout-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            padding: 0.6rem 1.2rem;
            border: 1px solid var(--border);
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .logout-link:hover {
            background: rgba(239, 140, 65, 0.1);
            border-color: var(--primary);
        }
        .table-wrapper {
            max-height: 65vh;
            overflow: auto;
            border-radius: 16px;
            border: 1px solid var(--border);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }
        th, td {
            padding: 1rem 1.2rem;
            text-align: left;
            vertical-align: top;
        }
        th {
            background: rgba(255, 255, 255, 0.05);
            font-weight: 600;
            color: var(--text);
            position: sticky;
            top: 0;
            z-index: 10;
        }
        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.2s ease;
        }
        tbody tr:hover {
            background: rgba(255, 255, 255, 0.03);
        }
        tbody tr:last-child {
            border-bottom: none;
        }
        td a {
            color: var(--primary);
            text-decoration: none;
        }
        td a:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .panel, .dashboard-panel {
                padding: 2rem 1.5rem;
            }
            .login-header h1 {
                font-size: 1.5rem;
            }
            table {
                font-size: 0.85rem;
            }
            th, td {
                padding: 0.8rem 0.6rem;
            }
        }
    </style>
</head>
<body>
    <?php if (!$isAuthenticated): ?>
        <div class="login-container">
            <div class="panel">
                <div class="login-header">
                    <h1>Administration</h1>
                    <p>Connectez-vous pour accéder au tableau de bord</p>
                </div>
                <?php if ($error): ?>
                    <div class="alert error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
                <?php endif; ?>
                <form method="POST" class="login-form">
                    <div class="form-group">
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" id="username" name="username" placeholder="Entrez votre nom d'utilisateur" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                    </div>
                    <button type="submit" class="login-btn">Se connecter</button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="dashboard-panel">
            <div class="top-bar">
                <h1>Demandes de contact</h1>
                <a href="?logout=1" class="logout-link">Se déconnecter</a>
            </div>
            <?php if (empty($requests)): ?>
                <div class="alert success">Aucune demande enregistrée pour le moment.</div>
            <?php else: ?>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Type</th>
                                <th>Message</th>
                                <th>Reçu le</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($requests as $req): ?>
                                <tr>
                                    <td><?php echo (int)$req['id']; ?></td>
                                    <td><?php echo htmlspecialchars($req['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><a href="mailto:<?php echo htmlspecialchars($req['email'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($req['email'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                                    <td><?php echo htmlspecialchars($req['phone'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($req['project_type'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo nl2br(htmlspecialchars($req['message'], ENT_QUOTES, 'UTF-8')); ?></td>
                                    <td><?php echo htmlspecialchars($req['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</body>
</html>

