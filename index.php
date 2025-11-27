<?php
require_once __DIR__ . '/config.php';

// Simple contact form handler
$alert = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $projectType = trim($_POST['project_type'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!$name || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$message) {
        $alert = [
            'type' => 'error',
            'message' => "Merci de compléter les champs requis et d'indiquer un email valide."
        ];
    } else {
        $stored = false;

        if ($pdo instanceof PDO) {
            try {
                $stmt = $pdo->prepare(
                    'INSERT INTO contact_requests (name, email, phone, project_type, message, created_at)
                     VALUES (:name, :email, :phone, :project_type, :message, NOW())'
                );
                $stmt->execute([
                    ':name' => $name,
                    ':email' => $email,
                    ':phone' => $phone,
                    ':project_type' => $projectType,
                    ':message' => $message,
                ]);
                $stored = true;
            } catch (PDOException $e) {
                error_log('Failed to insert contact request: ' . $e->getMessage());
            }
        }

        $subject = "[Atlas Cera] Nouvelle demande : {$name}";
        $body = "Nom : {$name}\nEmail : {$email}\nTéléphone : {$phone}\nType de projet : {$projectType}\n---\n{$message}";
        $headers = "From: {$name} <{$email}>";

        $mailSent = @mail('contact@atlascera.ma', $subject, $body, $headers);

        if ($stored) {
            $alert = [
                'type' => 'success',
                'message' => "Merci {$name}, votre message a été enregistré" . ($mailSent ? " et envoyé." : ".")
            ];
        } else {
            $alert = [
                'type' => 'error',
                'message' => "Votre message n'a pas pu être enregistré. Merci d'appeler le +212 6 00 00 00 00."
            ];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Atlas Cera - Expert marocain en construction, rénovation et décoration intérieure & extérieure.">
    <title>Atlas Cera | Construction & Décoration au Maroc</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css?v=1">
</head>
<body>
    <!-- Navbar منفصل - خارج hero -->
    <?php include __DIR__ . '/navbar.php'; ?>
    
    <header class="hero" id="accueil">
        <div class="hero-content">
            <p class="eyebrow">Depuis 2001 — Casablanca & Marrakech</p>
            <h1>Construire, rénover et sublimer les espaces de vie marocains.</h1>
            <p class="subtitle">
                Atlas Cera réunit architectes, maîtres d'œuvre et artisans pour livrer des projets clés en main,
                du gros œuvre jusqu'aux finitions décoratives.
            </p>
            <div class="hero-cta">
                <a class="btn primary" href="#contact">Parler de votre projet</a>
                <a class="btn ghost" href="#realisations">Voir nos réalisations</a>
            </div>
            <div class="hero-stats">
                <div>
                    <strong>+350</strong>
                    <span>Chantiers livrés</span>
                </div>
                <div>
                    <strong>23</strong>
                    <span>Ans d'expérience</span>
                </div>
                <div>
                    <strong>98%</strong>
                    <span>Clients satisfaits</span>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="section" id="expertises">
            <div class="section-header">
                <p class="eyebrow">Expertises</p>
                <h2>Des solutions complètes pour vos projets</h2>
                <p>
                    Nos équipes accompagnent promoteurs, hôteliers, institutions et particuliers exigeants
                    à travers tout le Royaume.
                </p>
            </div>
            <div class="grid cards">
                <article class="card card-with-image" style="background-image: linear-gradient(135deg, rgba(8, 10, 19, 0.95), rgba(8, 10, 19, 0.85)), url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=800&q=80'); background-size: cover; background-position: center;">
                    <h3>Construction globale</h3>
                    <p>Gestion intégrale de vos chantiers, du gros œuvre aux VRD, avec un suivi rigoureux et transparent.</p>
                    <ul>
                        <li>Planification & pilotage BIM</li>
                        <li>Structures béton & métal</li>
                        <li>Conformité normes marocaines</li>
                    </ul>
                </article>
                <article class="card card-with-image" style="background-image: linear-gradient(135deg, rgba(8, 10, 19, 0.95), rgba(8, 10, 19, 0.85)), url('https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=800&q=80'); background-size: cover; background-position: center;">
                    <h3>Rénovation haut de gamme</h3>
                    <p>Modernisation des villas, riads, bureaux et hôtels tout en respectant l'âme architecturale.</p>
                    <ul>
                        <li>Diagnostic structurel</li>
                        <li>Optimisation énergétique</li>
                        <li>Réaménagement sur-mesure</li>
                    </ul>
                </article>
                <article class="card card-with-image" style="background-image: linear-gradient(135deg, rgba(8, 10, 19, 0.95), rgba(8, 10, 19, 0.85)), url('https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=800&q=80'); background-size: cover; background-position: center;">
                    <h3>Décoration intérieure & extérieure</h3>
                    <p>Designers, menuisiers et ateliers de finition pour matérialiser votre identité de marque.</p>
                    <ul>
                        <li>Concepts créatifs 3D</li>
                        <li>Matières nobles & artisanat</li>
                        <li>Aménagement paysager</li>
                    </ul>
                </article>
            </div>
        </section>

        <section class="section split" id="valeurs">
            <div class="split-text">
                <p class="eyebrow">Pourquoi Atlas Cera ?</p>
                <h2>Allier excellence technique et signature marocaine</h2>
                <p>
                    Nous croyons que chaque projet mérite une attention artisanale, soutenue par des outils numériques de pointe.
                    Notre approche collaborative associe architectes, décorateurs et artisans marocains certifiés.
                </p>
                <div class="pillars">
                    <div>
                        <strong>Engagement qualité</strong>
                        <p>Contrôles hebdomadaires, reporting photo et garantis décennales.</p>
                    </div>
                    <div>
                        <strong>Respect des délais</strong>
                        <p>Méthodologie Lean Construction et partenaires fidélisés.</p>
                    </div>
                    <div>
                        <strong>Approche durable</strong>
                        <p>Matériaux locaux, gestion des déchets et optimisation énergétique.</p>
                    </div>
                </div>
            </div>
            <div class="split-media">
                <div class="media-card primary" style="background-image: linear-gradient(135deg, rgba(239, 140, 65, 0.85), rgba(34, 23, 18, 0.75)), url('https://images.unsplash.com/photo-1581539250439-c96689b516dd?auto=format&fit=crop&w=800&q=80'); background-size: cover; background-position: center;">
                    <span>Ateliers Atlas</span>
                    <strong>Menuiserie & Zellige</strong>
                    <p>Des finitions inspirées des savoir-faire marocains.</p>
                </div>
                <div class="media-card secondary" style="background-image: linear-gradient(135deg, rgba(61, 80, 255, 0.6), rgba(21, 29, 48, 0.85)), url('https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=80'); background-size: cover; background-position: center;">
                    <span>Hub client</span>
                    <strong>Suivi en ligne</strong>
                    <p>Planning, budgets et livrables accessibles 24/7.</p>
                </div>
            </div>
        </section>

        <section class="section dark" id="realisations">
            <div class="section-header">
                <p class="eyebrow">Réalisations</p>
                <h2>Quelques projets récents</h2>
                <p>Des espaces imaginés et construits avec passion dans tout le Maroc.</p>
            </div>
            <div class="grid projects">
                <article class="project-card">
                    <div class="project-image" style="background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=80');"></div>
                    <div class="project-info">
                        <h3>Villa Aïn Diab</h3>
                        <p>Construction complète d'une villa contemporaine de 1 200 m² avec patio central et piscine miroir.</p>
                        <span>Casablanca • 2024</span>
                    </div>
                </article>
                <article class="project-card">
                    <div class="project-image" style="background-image: url('https://images.unsplash.com/photo-1600607687644-c7171b42498b?auto=format&fit=crop&w=1200&q=80');"></div>
                    <div class="project-info">
                        <h3>Riad Dar Lalla</h3>
                        <p>Rénovation patrimoniale avec intégration domotique et zellige sur mesure.</p>
                        <span>Marrakech • 2023</span>
                    </div>
                </article>
                <article class="project-card">
                    <div class="project-image" style="background-image: url('https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1200&q=80');"></div>
                    <div class="project-info">
                        <h3>Siège Noor Invest</h3>
                        <p>Plateaux de bureaux flexibles, certification HQE et espaces lounges pour les collaborateurs.</p>
                        <span>Rabat • 2022</span>
                    </div>
                </article>
                <article class="project-card">
                    <div class="project-image" style="background-image: url('https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1200&q=80');"></div>
                    <div class="project-info">
                        <h3>Hôtel Royal Agadir</h3>
                        <p>Rénovation complète d'un hôtel 5 étoiles avec spa, restaurants et suites de luxe.</p>
                        <span>Agadir • 2023</span>
                    </div>
                </article>
                <article class="project-card">
                    <div class="project-image" style="background-image: url('https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1200&q=80');"></div>
                    <div class="project-info">
                        <h3>Complexe Résidentiel Atlas</h3>
                        <p>Construction d'un complexe résidentiel de 50 appartements avec espaces communs premium.</p>
                        <span>Tanger • 2024</span>
                    </div>
                </article>
                <article class="project-card">
                    <div class="project-image" style="background-image: url('https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1200&q=80');"></div>
                    <div class="project-info">
                        <h3>Boutique Concept Store</h3>
                        <p>Aménagement et décoration d'un concept store moderne avec matériaux locaux et design contemporain.</p>
                        <span>Casablanca • 2024</span>
                    </div>
                </article>
            </div>
        </section>

        <section class="section process">
            <div class="section-header">
                <p class="eyebrow">Méthodologie</p>
                <h2>Un accompagnement clair en 5 étapes</h2>
            </div>
            <div class="timeline">
                <div class="timeline-item" style="background-image: linear-gradient(135deg, rgba(8, 10, 19, 0.9), rgba(8, 10, 19, 0.8)), url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=600&q=80'); background-size: cover; background-position: center;">
                    <span>01</span>
                    <strong>Immersion</strong>
                    <p>Visite des lieux, étude du cahier des charges et chiffrage transparent.</p>
                </div>
                <div class="timeline-item" style="background-image: linear-gradient(135deg, rgba(8, 10, 19, 0.9), rgba(8, 10, 19, 0.8)), url('https://images.unsplash.com/photo-1558655146-364adaf1fcc9?auto=format&fit=crop&w=600&q=80'); background-size: cover; background-position: center;">
                    <span>02</span>
                    <strong>Design & BIM</strong>
                    <p>Modélisation 3D, choix des matériaux et validation des prototypes.</p>
                </div>
                <div class="timeline-item" style="background-image: linear-gradient(135deg, rgba(8, 10, 19, 0.9), rgba(8, 10, 19, 0.8)), url('https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=600&q=80'); background-size: cover; background-position: center;">
                    <span>03</span>
                    <strong>Préparation</strong>
                    <p>Planning détaillé, sélection des artisans et logistique sur site.</p>
                </div>
                <div class="timeline-item" style="background-image: linear-gradient(135deg, rgba(8, 10, 19, 0.9), rgba(8, 10, 19, 0.8)), url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=600&q=80'); background-size: cover; background-position: center;">
                    <span>04</span>
                    <strong>Exécution</strong>
                    <p>Suivi chantier, contrôles qualité et comptes-rendus hebdomadaires.</p>
                </div>
                <div class="timeline-item" style="background-image: linear-gradient(135deg, rgba(8, 10, 19, 0.9), rgba(8, 10, 19, 0.8)), url('https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=600&q=80'); background-size: cover; background-position: center;">
                    <span>05</span>
                    <strong>Livraison</strong>
                    <p>Réception, garanties, formation des équipes et maintenance.</p>
                </div>
            </div>
        </section>

        <section class="section testimonials">
            <div class="section-header">
                <p class="eyebrow">Ils nous font confiance</p>
                <h2>Témoignages clients</h2>
            </div>
            <div class="grid testimonials-grid">
                <article class="testimonial-card" style="background-image: linear-gradient(135deg, rgba(8, 10, 19, 0.95), rgba(8, 10, 19, 0.85)), url('https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=600&q=80'); background-size: cover; background-position: center;">
                    <p>"Atlas Cera a transformé notre resort en un temps record avec une qualité irréprochable. Communication fluide du début à la fin."</p>
                    <strong>Salma B. — Directrice hôtelière</strong>
                </article>
                <article class="testimonial-card" style="background-image: linear-gradient(135deg, rgba(8, 10, 19, 0.95), rgba(8, 10, 19, 0.85)), url('https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80'); background-size: cover; background-position: center;">
                    <p>"Une équipe passionnée qui propose toujours plusieurs options créatives tout en respectant les budgets."</p>
                    <strong>Youssef R. — Promoteur immobilier</strong>
                </article>
                <article class="testimonial-card" style="background-image: linear-gradient(135deg, rgba(8, 10, 19, 0.95), rgba(8, 10, 19, 0.85)), url('https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=600&q=80'); background-size: cover; background-position: center;">
                    <p>"Nous avons centralisé notre patrimoine de boutiques sous un seul contractant. Atlas Cera maîtrise parfaitement la décoration retail."</p>
                    <strong>Imane K. — Retail Manager</strong>
                </article>
            </div>
        </section>

        <section class="section contact" id="contact">
            <div class="section-header">
                <p class="eyebrow">Contact</p>
                <h2>Parlons de votre projet</h2>
                <p>Nous intervenons partout au Maroc. Réponse sous 48h ouvrées.</p>
            </div>
            <?php if ($alert): ?>
                <div class="alert <?php echo $alert['type']; ?>">
                    <?php echo htmlspecialchars($alert['message'], ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>
            <div class="contact-grid">
                <form method="POST" class="contact-form">
                    <label>Nom complet*
                        <input type="text" name="name" required value="<?php echo htmlspecialchars($name ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    </label>
                    <label>Email professionnel*
                        <input type="email" name="email" required value="<?php echo htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    </label>
                    <label>Téléphone
                        <input type="text" name="phone" value="<?php echo htmlspecialchars($phone ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    </label>
                    <label>Type de projet
                        <select name="project_type">
                            <option value="">Sélectionner</option>
                            <option value="construction" <?php echo (isset($projectType) && $projectType === 'construction') ? 'selected' : ''; ?>>Construction neuve</option>
                            <option value="renovation" <?php echo (isset($projectType) && $projectType === 'renovation') ? 'selected' : ''; ?>>Rénovation complète</option>
                            <option value="decoration" <?php echo (isset($projectType) && $projectType === 'decoration') ? 'selected' : ''; ?>>Décoration & aménagement</option>
                        </select>
                    </label>
                    <label>Message*
                        <textarea name="message" rows="4" required><?php echo htmlspecialchars($message ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                    </label>
                    <button type="submit" class="btn primary">Envoyer</button>
                </form>
                <div class="contact-details">
                    <div>
                        <strong>Bureaux</strong>
                        <p>lot iguider N 48 av allal el fassi <br>Marrakech</p>
                    </div>
                    <div>
                        <strong>Appels</strong>
                        <a href="tel:0524308038">0524308038</a>
                    </div>
                    <div>
                        <strong>Email</strong>
                        <a href="mailto:contact@atlascera.com">contact@atlascera.com</a>
                    </div>
                    <div>
                        <strong>Réseaux</strong>
                        <div class="social-links">
                            <a href="https://www.facebook.com/atlascera" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                                
                            </a>
                            <a href="https://www.instagram.com/atlascera" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                                
                            </a>
                            <a href="https://www.tiktok.com/@atlascera" target="_blank" rel="noopener noreferrer" aria-label="TikTok">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                                </svg>
                                
                            </a>
                            <a href="https://www.youtube.com/@atlascera" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                                
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div>
            <strong>Atlas Cera</strong>
            <p>Construction • Rénovation • Décoration</p>
        </div>
        <div>
            <p>© <?php echo date('Y'); ?> Atlas Cera. Tous droits réservés.</p>
        </div>
        <div>
            <a href="#accueil" class="btn ghost small">Retour en haut</a>
        </div>
    </footer>
    <script>
        // ============================================
        // NAVBAR - Bootstrap-inspired fixed navbar
        // ============================================
        // هذا الكود يضمن أن navbar:
        // 1. ثابت في الأعلى دائماً
        // 2. فوق جميع الأقسام والعناصر
        // 3. مرئي ولا يختفي عند التمرير
        // 4. المحتوى يبدأ من تحته دائماً
        // ============================================
        (function() {
            'use strict';
            
            const navbar = document.getElementById('mainNavbar');
            if (!navbar) return;

            // Bootstrap-style: Add fixed-top and shadow on scroll
            // مع ضمان أن navbar فوق كل العناصر
            window.addEventListener('scroll', function() {
                // التأكد من أن navbar فوق كل العناصر
                ensureNavbarFixed();
                ensureSectionsBelowNavbar();
                
                // تأثير التمرير على الخلفية
                if (window.scrollY > 50) {
                    navbar.classList.add('fixed-top', 'shadow', 'scrolled');
                } else {
                    navbar.classList.remove('shadow');
                    navbar.classList.add('fixed-top', 'scrolled');
                }
            }, { passive: true });

            /**
             * دالة لضمان أن navbar ثابت وفوق جميع العناصر
             * هذه الدالة تطبق styles مباشرة لضمان أن navbar:
             * - position: fixed
             * - z-index: 99999 (أعلى من أي عنصر آخر)
             * - مرئي دائماً
             * 
             * ملاحظة: navbar الآن منفصل في ملف navbar.php خارج hero
             * لذا لا توجد مشكلة stacking context
             */
            function ensureNavbarFixed() {
                navbar.classList.add('fixed-top');
                
                // تطبيق styles مباشرة لضمان أن navbar فوق كل العناصر
                // navbar الآن خارج hero، لذا position: fixed يعمل بشكل مثالي
                navbar.style.position = 'fixed';
                navbar.style.top = '0';
                navbar.style.left = '0';
                navbar.style.right = '0';
                navbar.style.width = '100%';
                
                // z-index عالي جداً (99999) - هذا هو المفتاح الرئيسي
                // يضمن أن navbar دائماً فوق hero, sections, cards, etc
                navbar.style.zIndex = '99999';
                navbar.style.display = 'flex';
                navbar.style.visibility = 'visible';
                navbar.style.opacity = '1';
                
                // منع overflow hidden
                navbar.style.overflow = 'visible';
                
                // فحص إضافي للتأكد من z-index
                // إذا كان z-index أقل من 99999، نصلحه فوراً
                const computedStyle = window.getComputedStyle(navbar);
                const currentZIndex = parseInt(computedStyle.zIndex) || 0;
                if (currentZIndex < 99999) {
                    navbar.style.setProperty('z-index', '99999', 'important');
                }
                
                // فحص position
                if (computedStyle.position !== 'fixed') {
                    navbar.style.setProperty('position', 'fixed', 'important');
                }
            }

            // Adjust content position to be under navbar (Bootstrap style)
            function adjustContentPosition() {
                const navbarHeight = navbar.offsetHeight || 70;
                
                // Apply padding-top to body (Bootstrap approach)
                document.body.style.paddingTop = navbarHeight + 'px';
                
                // Also adjust hero and sections
                const hero = document.querySelector('.hero');
                if (hero) {
                    hero.style.paddingTop = `calc(${navbarHeight}px + 2rem)`;
                    hero.style.scrollMarginTop = `${navbarHeight}px`;
                    // ضمان أن hero لديه z-index منخفض
                    hero.style.zIndex = '1';
                }
                
                const sections = document.querySelectorAll('.section');
                sections.forEach(section => {
                    section.style.paddingTop = `calc(${navbarHeight}px + 3rem)`;
                    section.style.scrollMarginTop = `${navbarHeight}px`;
                    // ضمان أن section لديه z-index منخفض
                    section.style.zIndex = '1';
                });
            }
            
            /**
             * دالة لضمان أن جميع الأقسام لديها z-index منخفض
             * هذه الدالة تفحص جميع الأقسام وتضمن أن z-index أقل من navbar
             * إذا كان أي قسم لديه z-index أعلى من 100، نصلحه إلى 1
             * هذا يضمن أن navbar (z-index: 99999) دائماً فوقها
             * خاصة قسم Expertises (#expertises)
             */
            function ensureSectionsBelowNavbar() {
                // جميع الأقسام يجب أن يكون z-index أقل من navbar
                const allSections = document.querySelectorAll('.hero, .section, main > *, header, section, #expertises, section#expertises');
                allSections.forEach(element => {
                    const computedStyle = window.getComputedStyle(element);
                    const currentZIndex = parseInt(computedStyle.zIndex) || 0;
                    // إذا كان z-index أعلى من 100، أصلحه إلى 1
                    // navbar لديه z-index: 99999، لذا يجب أن يكون أعلى
                    if (currentZIndex > 100) {
                        element.style.zIndex = '1';
                        element.style.setProperty('z-index', '1', 'important');
                    }
                    // منع overflow hidden الذي قد يخفي navbar
                    if (computedStyle.overflow === 'hidden') {
                        element.style.overflow = 'visible';
                    }
                });
            }

            // Initialize
            ensureNavbarFixed();
            adjustContentPosition();
            ensureSectionsBelowNavbar();

            // مراقبة مستمرة لضمان أن navbar فوق كل العناصر
            // خاصة في قسم Expertises
            setInterval(function() {
                ensureNavbarFixed();
                ensureSectionsBelowNavbar();
                
                // فحص خاص لقسم Expertises
                const expertisesSection = document.getElementById('expertises');
                if (expertisesSection) {
                    const sectionStyle = window.getComputedStyle(expertisesSection);
                    // ضمان أن z-index منخفض
                    if (parseInt(sectionStyle.zIndex) > 100) {
                        expertisesSection.style.setProperty('z-index', '1', 'important');
                    }
                    // ضمان أن overflow visible
                    if (sectionStyle.overflow === 'hidden') {
                        expertisesSection.style.setProperty('overflow', 'visible', 'important');
                    }
                    // إزالة isolation
                    if (sectionStyle.isolation !== 'auto') {
                        expertisesSection.style.setProperty('isolation', 'auto', 'important');
                    }
                }
                
                // فحص hero - إزالة أي شيء قد يخفي navbar
                const hero = document.querySelector('.hero');
                if (hero) {
                    const heroStyle = window.getComputedStyle(hero);
                    // إزالة isolation
                    if (heroStyle.isolation !== 'auto') {
                        hero.style.setProperty('isolation', 'auto', 'important');
                    }
                    // ضمان overflow visible
                    if (heroStyle.overflow === 'hidden') {
                        hero.style.setProperty('overflow', 'visible', 'important');
                    }
                    // إزالة transform و filter
                    if (heroStyle.transform !== 'none') {
                        hero.style.setProperty('transform', 'none', 'important');
                    }
                    if (heroStyle.filter !== 'none') {
                        hero.style.setProperty('filter', 'none', 'important');
                    }
                }
            }, 100); // فحص كل 100ms بدلاً من 200ms

            // Handle resize
            window.addEventListener('resize', function() {
                ensureNavbarFixed();
                adjustContentPosition();
                ensureSectionsBelowNavbar();
            });

            // Handle load
            window.addEventListener('load', function() {
                ensureNavbarFixed();
                adjustContentPosition();
                ensureSectionsBelowNavbar();
            });

            // Handle DOMContentLoaded
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    ensureNavbarFixed();
                    adjustContentPosition();
                    ensureSectionsBelowNavbar();
                });
            } else {
                ensureNavbarFixed();
                adjustContentPosition();
                ensureSectionsBelowNavbar();
            }

            // Smooth scroll navigation (Bootstrap style)
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    const href = this.getAttribute('href');
                    if (href && href !== '#') {
                        e.preventDefault();
                        const target = document.querySelector(href);
                        if (target) {
                            const navbarHeight = navbar.offsetHeight || 70;
                            const targetRect = target.getBoundingClientRect();
                            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                            const offsetTop = targetRect.top + scrollTop - navbarHeight;
                            
                            window.scrollTo({
                                top: Math.max(0, offsetTop),
                                behavior: 'smooth'
                            });
                            
                            // Close mobile menu
                            const navToggle = document.getElementById('nav-toggle');
                            if (navToggle && navToggle.checked) {
                                navToggle.checked = false;
                                document.body.style.overflow = '';
                            }
                        }
                    }
                });
            });

            // Mobile menu management
            const navToggle = document.getElementById('nav-toggle');
            const overlay = document.querySelector('.nav-overlay');
            
            if (navToggle) {
                navToggle.addEventListener('change', function() {
                    document.body.style.overflow = this.checked ? 'hidden' : '';
                });
            }
            
            if (overlay) {
                overlay.addEventListener('click', function() {
                    if (navToggle) {
                        navToggle.checked = false;
                        document.body.style.overflow = '';
                    }
                });
            }
            
            document.querySelectorAll('.nav-links a').forEach(link => {
                link.addEventListener('click', function() {
                    if (navToggle && navToggle.checked) {
                        navToggle.checked = false;
                        document.body.style.overflow = '';
                    }
                });
            });

        })();
    </script>
</body>
</html>

