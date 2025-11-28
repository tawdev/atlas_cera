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
                'message' => "Votre message n'a pas pu être enregistré. Merci d'appeler le 0524308038."
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
    <script src="assets/js/scroll-to-top.js" defer></script>
    <script src="assets/js/translations.js" defer></script>
</head>
<body>
    <!-- Navbar منفصل - خارج hero -->
    <?php include __DIR__ . '/navbar.php'; ?>
    
    <header class="hero" id="accueil">
        <div class="hero-content">
            <p class="eyebrow" data-translate="hero_eyebrow">Depuis 2001 — Marrakech</p>
            <h1 data-translate="hero_title">Atlas <span class="hero-brand">Cera</span> : bâtir, rénover, sublimer.</h1>
            
            <div class="hero-cta">
                <a class="btn primary" href="#contact" data-translate="hero_cta_primary">Parler de votre projet</a>
                <a class="btn ghost" href="#projetss" data-translate="hero_cta_secondary">Voir nos projets</a>
            </div>
        </div>
    </header>

    <main>
        <section class="section" id="expertises">
            <div class="section-header">
                <p class="eyebrow" data-translate="expertises_eyebrow">Expertises</p>
                <h2 data-translate="expertises_title">Des solutions complètes pour vos projets</h2>
                <p data-translate="expertises_subtitle">
                    Nos équipes accompagnent promoteurs, hôteliers, institutions et particuliers exigeants
                    à travers tout le Royaume.
                </p>
            </div>
            <div class="grid cards">
                <article class="card card-with-image" style="background-image: linear-gradient(135deg, rgba(8, 10, 19, 0.95), rgba(8, 10, 19, 0.85)), url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=800&q=80'); background-size: cover; background-position: center;">
                    <h3 data-translate="expertise_construction_title">Construction globale</h3>
                    <p data-translate="expertise_construction_desc">Gestion intégrale de vos chantiers, du gros œuvre aux VRD, avec un suivi rigoureux et transparent.</p>
                    <ul>
                        <li data-translate="expertise_construction_item1">Planification & pilotage BIM</li>
                        <li data-translate="expertise_construction_item2">Structures béton & métal</li>
                        <li data-translate="expertise_construction_item3">Conformité normes marocaines</li>
                    </ul>
                </article>
                <article class="card card-with-image" style="background-image: linear-gradient(135deg, rgba(8, 10, 19, 0.95), rgba(8, 10, 19, 0.85)), url('https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=800&q=80'); background-size: cover; background-position: center;">
                    <h3 data-translate="expertise_renovation_title">Rénovation haut de gamme</h3>
                    <p data-translate="expertise_renovation_desc">Modernisation des villas, riads, bureaux et hôtels tout en respectant l'âme architecturale.</p>
                    <ul>
                        <li data-translate="expertise_renovation_item1">Diagnostic structurel</li>
                        <li data-translate="expertise_renovation_item2">Optimisation énergétique</li>
                        <li data-translate="expertise_renovation_item3">Réaménagement sur-mesure</li>
                    </ul>
                </article>
                <article class="card card-with-image" style="background-image: linear-gradient(135deg, rgba(8, 10, 19, 0.95), rgba(8, 10, 19, 0.85)), url('https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=800&q=80'); background-size: cover; background-position: center;">
                    <h3 data-translate="expertise_decoration_title">Décoration intérieure & extérieure</h3>
                    <p data-translate="expertise_decoration_desc">Designers, menuisiers et ateliers de finition pour matérialiser votre identité de marque.</p>
                    <ul>
                        <li data-translate="expertise_decoration_item1">Concepts créatifs 3D</li>
                        <li data-translate="expertise_decoration_item2">Matières nobles & artisanat</li>
                        <li data-translate="expertise_decoration_item3">Aménagement paysager</li>
                    </ul>
                </article>
            </div>
        </section>

        <section class="section split" id="valeurs">
            <div class="split-text">
                <p class="eyebrow" data-translate="about_eyebrow">Pourquoi Atlas Cera ?</p>
                <h2 data-translate="about_title">Allier excellence technique et signature marocaine</h2>
                <p data-translate="about_subtitle">
                    Nous croyons que chaque projet mérite une attention artisanale, soutenue par des outils numériques de pointe.
                    Notre approche collaborative associe architectes, décorateurs et artisans marocains certifiés.
                </p>
                <div class="pillars">
                    <div>
                        <strong data-translate="about_pillar1_title">Engagement qualité</strong>
                        <p data-translate="about_pillar1_desc">Contrôles hebdomadaires, reporting photo et garantis décennales.</p>
                    </div>
                    <div>
                        <strong data-translate="about_pillar2_title">Respect des délais</strong>
                        <p data-translate="about_pillar2_desc">Méthodologie Lean Construction et partenaires fidélisés.</p>
                    </div>
                    <div>
                        <strong data-translate="about_pillar3_title">Approche durable</strong>
                        <p data-translate="about_pillar3_desc">Matériaux locaux, gestion des déchets et optimisation énergétique.</p>
                    </div>
                </div>
            </div>
            <div class="split-media">
                <!-- Gallery Grid for Construction Images -->
                <div class="image-gallery">
                    <div class="gallery-item gallery-item-large" style="background-image: url('https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=1200&q=80');">
                        <div class="gallery-overlay">
                            <span class="gallery-badge">Expertise</span>
                            <strong>Installation précise</strong>
                            <p>Nos artisans maîtrisent les techniques de pose les plus avancées</p>
                        </div>
                    </div>
                    <div class="gallery-item" style="background-image: url('assets/images/outiles.jpg');">
                        <div class="gallery-overlay">
                            <span class="gallery-badge">Qualité</span>
                            <strong>Outils professionnels</strong>
                        </div>
                    </div>
                    <div class="gallery-item" style="background-image: url('assets/images/laser.jpg');">
                        <div class="gallery-overlay">
                            <span class="gallery-badge">Précision</span>
                            <strong>Niveau laser</strong>
                        </div>
                    </div>
                    <div class="gallery-item gallery-item-wide" style="background-image: url('https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1200&q=80');">
                        <div class="gallery-overlay">
                            <span class="gallery-badge">Excellence</span>
                            <strong>Finitions parfaites</strong>
                            <p>Chaque détail compte pour un résultat impeccable</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        // Lire les images du dossier gallery
        $galleryDir = __DIR__ . '/gallery';
        $galleryImages = [];
        
        if (is_dir($galleryDir)) {
            $files = scandir($galleryDir);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $filePath = $galleryDir . '/' . $file;
                    $fileInfo = pathinfo($filePath);
                    if (isset($fileInfo['extension'])) {
                        $ext = strtolower($fileInfo['extension']);
                        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                            $galleryImages[] = 'gallery/' . $file;
                        }
                    }
                }
            }
            usort($galleryImages, function($a, $b) {
                return strcmp($a, $b);
            });
        }
        ?>

        

        <section class="section dark" id="projetss">
            <div class="section-header">
                <p class="eyebrow" data-translate="projects_eyebrow">Réalisations</p>
                <h2 data-translate="projects_title">Quelques projets récents</h2>
                <p data-translate="projects_subtitle">Des espaces imaginés et construits avec passion dans tout le Maroc.</p>
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
                    <div class="project-image" style="background-image: url('assets/images/Riad Sidrat.jpeg');"></div>
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
        <section class="section" id="gallery">
            <div class="section-header">
                <p class="eyebrow" data-translate="gallery_eyebrow">Galerie Photos</p>
                <h2 data-translate="gallery_title">Nos Réalisations en Images</h2>
                <p data-translate="gallery_subtitle">Découvrez nos projets de construction, rénovation et décoration à travers le Maroc</p>
            </div>
            
            <?php if (!empty($galleryImages)): ?>
            <div class="modern-gallery-container">
                <div class="modern-gallery-grid" id="modernGallery">
                    <?php foreach ($galleryImages as $index => $image): ?>
                        <div class="modern-gallery-item" data-index="<?php echo $index; ?>">
                            <img src="<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>" 
                                 alt="Galerie Atlas Cera - Image <?php echo $index + 1; ?>"
                                 data-src="<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>"
                                 loading="<?php echo $index < 8 ? 'eager' : 'lazy'; ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Lightbox Modal -->
            <div class="lightbox-modal" id="lightboxModal">
                <button class="lightbox-close" id="lightboxClose" aria-label="Fermer">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <button class="lightbox-nav lightbox-prev" id="lightboxPrev" aria-label="Image précédente">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
                <button class="lightbox-nav lightbox-next" id="lightboxNext" aria-label="Image suivante">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>
                <div class="lightbox-content">
                    <img id="lightboxImage" src="" alt="Lightbox Image">
                    <div class="lightbox-counter">
                        <span id="lightboxCurrent">1</span> / <span id="lightboxTotal"><?php echo count($galleryImages); ?></span>
                    </div>
                </div>
            </div>
            <?php else: ?>
                <div class="gallery-empty">
                    <p data-translate="gallery_empty">Aucune image disponible pour le moment.</p>
                </div>
            <?php endif; ?>
        </section>
        <section class="section process">
            <div class="section-header">
                <p class="eyebrow" data-translate="process_eyebrow">Méthodologie</p>
                <h2 data-translate="process_title">Un accompagnement clair en 5 étapes</h2>
            </div>
            <div class="timeline">
                <div class="timeline-item" style="background-image: linear-gradient(135deg, rgba(8, 10, 19, 0.9), rgba(8, 10, 19, 0.8)), url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=600&q=80'); background-size: cover; background-position: center;">
                    <span>01</span>
                    <strong data-translate="process_step1_title">Immersion</strong>
                    <p data-translate="process_step1_desc">Visite des lieux, étude du cahier des charges et chiffrage transparent.</p>
                </div>
                <div class="timeline-item" style="background-image: linear-gradient(135deg, rgba(8, 10, 19, 0.9), rgba(8, 10, 19, 0.8)), url('https://images.unsplash.com/photo-1558655146-364adaf1fcc9?auto=format&fit=crop&w=600&q=80'); background-size: cover; background-position: center;">
                    <span>02</span>
                    <strong data-translate="process_step2_title">Design & BIM</strong>
                    <p data-translate="process_step2_desc">Modélisation 3D, choix des matériaux et validation des prototypes.</p>
                </div>
                <div class="timeline-item" style="background-image: linear-gradient(135deg, rgba(8, 10, 19, 0.9), rgba(8, 10, 19, 0.8)), url('https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=600&q=80'); background-size: cover; background-position: center;">
                    <span>03</span>
                    <strong data-translate="process_step3_title">Préparation</strong>
                    <p data-translate="process_step3_desc">Planning détaillé, sélection des artisans et logistique sur site.</p>
                </div>
                <div class="timeline-item" style="background-image: linear-gradient(135deg, rgba(8, 10, 19, 0.9), rgba(8, 10, 19, 0.8)), url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=600&q=80'); background-size: cover; background-position: center;">
                    <span>04</span>
                    <strong data-translate="process_step4_title">Exécution</strong>
                    <p data-translate="process_step4_desc">Suivi chantier, contrôles qualité et comptes-rendus hebdomadaires.</p>
                </div>
                <div class="timeline-item" style="background-image: linear-gradient(135deg, rgba(8, 10, 19, 0.9), rgba(8, 10, 19, 0.8)), url('https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=600&q=80'); background-size: cover; background-position: center;">
                    <span>05</span>
                    <strong data-translate="process_step5_title">Livraison</strong>
                    <p data-translate="process_step5_desc">Réception, garanties, formation des équipes et maintenance.</p>
                </div>
            </div>
        </section>

        <section class="section testimonials">
            <div class="section-header">
                <p class="eyebrow" data-translate="testimonials_eyebrow">Ils nous font confiance</p>
                <h2 data-translate="testimonials_title">Témoignages clients</h2>
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
                <p class="eyebrow" data-translate="contact_eyebrow">Contact</p>
                <h2 data-translate="contact_title">Parlons de votre projet</h2>
                <p data-translate="contact_subtitle">Nous intervenons partout au Maroc. Réponse sous 48h ouvrées.</p>
            </div>
            <?php if ($alert): ?>
                <div class="alert-card-container">
                    <div class="alert-card <?php echo $alert['type']; ?>">
                        <div class="alert-icon">
                            <?php if ($alert['type'] === 'success'): ?>
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                            <?php else: ?>
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                            <?php endif; ?>
                        </div>
                        <div class="alert-content">
                            <h3><?php echo $alert['type'] === 'success' ? 'Message envoyé avec succès !' : 'Erreur'; ?></h3>
                            <p><?php echo htmlspecialchars($alert['message'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="contact-grid">
                <form method="POST" class="contact-form" id="contactForm">
                    <label><span data-translate="contact_form_name">Nom complet*</span>
                        <input type="text" name="name" required value="<?php echo (isset($alert) && $alert['type'] === 'success') ? '' : htmlspecialchars($name ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    </label>
                    <label><span data-translate="contact_form_email">Email professionnel*</span>
                        <input type="email" name="email" required value="<?php echo (isset($alert) && $alert['type'] === 'success') ? '' : htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    </label>
                    <label><span data-translate="contact_form_phone">Téléphone</span>
                        <input type="text" name="phone" value="<?php echo (isset($alert) && $alert['type'] === 'success') ? '' : htmlspecialchars($phone ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    </label>
                    <label><span data-translate="contact_form_project_type">Type de projet</span>
                        <select name="project_type">
                            <option value="" data-translate-option="contact_form_select">Sélectionner</option>
                            <option value="construction" <?php echo (isset($alert) && $alert['type'] === 'success') ? '' : ((isset($projectType) && $projectType === 'construction') ? 'selected' : ''); ?> data-translate-option="contact_form_project_construction">Construction neuve</option>
                            <option value="renovation" <?php echo (isset($alert) && $alert['type'] === 'success') ? '' : ((isset($projectType) && $projectType === 'renovation') ? 'selected' : ''); ?> data-translate-option="contact_form_project_renovation">Rénovation complète</option>
                            <option value="decoration" <?php echo (isset($alert) && $alert['type'] === 'success') ? '' : ((isset($projectType) && $projectType === 'decoration') ? 'selected' : ''); ?> data-translate-option="contact_form_project_decoration">Décoration & aménagement</option>
                        </select>
                    </label>
                    <label><span data-translate="contact_form_message">Message*</span>
                        <textarea name="message" rows="4" required><?php echo (isset($alert) && $alert['type'] === 'success') ? '' : htmlspecialchars($message ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                    </label>
                    <button type="submit" class="btn primary" data-translate="contact_form_submit">Envoyer</button>
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
            <p data-translate="footer_text">Construction • Rénovation • Décoration</p>
        </div>
       
    </footer>
    
    <!-- Bouton Retour en haut -->
    <?php include __DIR__ . '/scroll-to-top-button.php'; ?>
    
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
                        // Extract hash from href (handle both index.php#gallery and #gallery)
                        const hash = href.includes('#') ? href.split('#')[1] : null;
                        if (hash) {
                            e.preventDefault();
                            const target = document.getElementById(hash);
                            if (target) {
                                const navbarHeight = navbar.offsetHeight || 70;
                                const targetRect = target.getBoundingClientRect();
                                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                                const offsetTop = targetRect.top + scrollTop - navbarHeight - 20;
                                
                                window.scrollTo({
                                    top: Math.max(0, offsetTop),
                                    behavior: 'smooth'
                                });
                                
                                // Update URL without reload
                                history.pushState(null, null, '#' + hash);
                                
                                // Close mobile menu
                                const navToggle = document.getElementById('nav-toggle');
                                if (navToggle && navToggle.checked) {
                                    navToggle.checked = false;
                                    document.body.style.overflow = '';
                                }
                            }
                        }
                    }
                });
            });
            
            // Handle hash on page load
            if (window.location.hash) {
                setTimeout(() => {
                    const hash = window.location.hash.substring(1);
                    const target = document.getElementById(hash);
                    if (target) {
                        const navbarHeight = navbar.offsetHeight || 70;
                        const targetRect = target.getBoundingClientRect();
                        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                        const offsetTop = targetRect.top + scrollTop - navbarHeight - 20;
                        
                        window.scrollTo({
                            top: Math.max(0, offsetTop),
                            behavior: 'smooth'
                        });
                    }
                }, 100);
            }

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
        
        // ============================================
        // Scroll to Top Button - Géré par scroll-to-top.js
        // ============================================

        // Gallery Slider
        (function() {
            'use strict';
            
            const slider = document.getElementById('gallerySlider');
            const prevBtn = document.getElementById('galleryPrev');
            const nextBtn = document.getElementById('galleryNext');
            const dots = document.querySelectorAll('.gallery-dot');
            const slides = document.querySelectorAll('.gallery-slide');
            const currentSlideSpan = document.getElementById('currentSlide');
            const totalSlidesSpan = document.getElementById('totalSlides');
            
            if (!slider || !slides.length) return;
            
            let currentIndex = 0;
            let autoplayInterval = null;
            const autoplayDelay = 5000; // 5 secondes
            
            // Initialiser le compteur
            if (totalSlidesSpan) {
                totalSlidesSpan.textContent = slides.length;
            }
            
            function showSlide(index) {
                // Retirer active de toutes les slides
                slides.forEach((slide, i) => {
                    slide.classList.remove('active', 'prev');
                    if (i < index) {
                        slide.classList.add('prev');
                    }
                });
                
                // Ajouter active à la slide courante
                if (slides[index]) {
                    slides[index].classList.add('active');
                }
                
                // Mettre à jour les dots
                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === index);
                });
                
                // Mettre à jour le compteur
                if (currentSlideSpan) {
                    currentSlideSpan.textContent = index + 1;
                }
                
                currentIndex = index;
            }
            
            function nextSlide() {
                const nextIndex = (currentIndex + 1) % slides.length;
                showSlide(nextIndex);
            }
            
            function prevSlide() {
                const prevIndex = (currentIndex - 1 + slides.length) % slides.length;
                showSlide(prevIndex);
            }
            
            function goToSlide(index) {
                if (index >= 0 && index < slides.length) {
                    showSlide(index);
                }
            }
            
            function startAutoplay() {
                stopAutoplay();
                autoplayInterval = setInterval(nextSlide, autoplayDelay);
            }
            
            function stopAutoplay() {
                if (autoplayInterval) {
                    clearInterval(autoplayInterval);
                    autoplayInterval = null;
                }
            }
            
            // Event listeners
            if (nextBtn) {
                nextBtn.addEventListener('click', function() {
                    nextSlide();
                    startAutoplay();
                });
            }
            
            if (prevBtn) {
                prevBtn.addEventListener('click', function() {
                    prevSlide();
                    startAutoplay();
                });
            }
            
            dots.forEach((dot, index) => {
                dot.addEventListener('click', function() {
                    goToSlide(index);
                    startAutoplay();
                });
            });
            
            // Navigation clavier
            document.addEventListener('keydown', function(e) {
                const gallerySection = document.getElementById('gallery');
                if (!gallerySection) return;
                
                const rect = gallerySection.getBoundingClientRect();
                const isVisible = rect.top < window.innerHeight && rect.bottom > 0;
                
                if (!isVisible) return;
                
                if (e.key === 'ArrowLeft') {
                    prevSlide();
                    startAutoplay();
                } else if (e.key === 'ArrowRight') {
                    nextSlide();
                    startAutoplay();
                }
            });
            
            // Pause autoplay au survol
            if (slider) {
                slider.addEventListener('mouseenter', stopAutoplay);
                slider.addEventListener('mouseleave', startAutoplay);
            }
            
            // Touch events pour mobile
            let touchStartX = 0;
            let touchEndX = 0;
            
            if (slider) {
                slider.addEventListener('touchstart', function(e) {
                    touchStartX = e.changedTouches[0].screenX;
                    stopAutoplay();
                }, { passive: true });
                
                slider.addEventListener('touchend', function(e) {
                    touchEndX = e.changedTouches[0].screenX;
                    handleSwipe();
                    startAutoplay();
                }, { passive: true });
            }
            
            function handleSwipe() {
                const swipeThreshold = 50;
                const diff = touchStartX - touchEndX;
                
                if (Math.abs(diff) > swipeThreshold) {
                    if (diff > 0) {
                        nextSlide();
                    } else {
                        prevSlide();
                    }
                }
            }
            
            // Démarrer l'autoplay
            startAutoplay();
            
            // Initialiser la première slide
            showSlide(0);
        })();
        
        // ============================================
        // CONTACT FORM - Vider le formulaire et rester sur la section contact
        // ============================================
        (function() {
            'use strict';
            
            const contactForm = document.getElementById('contactForm');
            const contactSection = document.getElementById('contact');
            const alertCard = document.querySelector('.alert-card');
            
            if (!contactForm) return;
            
            // Fonction pour scroller vers la section contact
            function scrollToContactSection() {
                if (!contactSection) return;
                
                setTimeout(function() {
                    const navbar = document.getElementById('mainNavbar');
                    const navbarHeight = navbar ? navbar.offsetHeight : 70;
                    const sectionTop = contactSection.getBoundingClientRect().top + window.pageYOffset;
                    const scrollPosition = sectionTop - navbarHeight - 20;
                    
                    window.scrollTo({
                        top: Math.max(0, scrollPosition),
                        behavior: 'smooth'
                    });
                }, 200);
            }
            
            // Si une alerte existe, scroller vers la section contact
            if (alertCard && contactSection) {
                // Scroller vers la section contact
                scrollToContactSection();
                
                // Si c'est une alerte de succès, vider le formulaire
                if (alertCard.classList.contains('success')) {
                    // Vider tous les champs du formulaire
                    contactForm.reset();
                    
                    // S'assurer que tous les champs sont bien vidés
                    const inputs = contactForm.querySelectorAll('input[type="text"], input[type="email"], textarea');
                    inputs.forEach(input => {
                        input.value = '';
                    });
                    
                    // Réinitialiser le select à la première option
                    const select = contactForm.querySelector('select[name="project_type"]');
                    if (select) {
                        select.selectedIndex = 0;
                    }
                }
                
                // Faire disparaître la carte après 3 secondes
                setTimeout(function() {
                    const alertContainer = alertCard.closest('.alert-card-container');
                    if (alertContainer) {
                        alertContainer.style.opacity = '0';
                        alertContainer.style.transform = 'translateY(-20px)';
                        alertContainer.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
                        
                        // Supprimer complètement l'élément après l'animation
                        setTimeout(function() {
                            if (alertContainer.parentNode) {
                                alertContainer.parentNode.removeChild(alertContainer);
                            }
                        }, 500);
                    }
                }, 3000); // 3 secondes
            }
            
            // Écouter la soumission du formulaire
            contactForm.addEventListener('submit', function(e) {
                // Ne pas empêcher la soumission normale
                // Le scroll vers la section contact sera géré après le rechargement de la page
            });
            
            // Si on arrive sur la page après une soumission (détection via hash ou referrer)
            if (window.location.hash === '#contact') {
                scrollToContactSection();
            }
            
            // Détecter si on vient d'une soumission de formulaire
            if (document.referrer && document.referrer.includes(window.location.hostname)) {
                // Vérifier si on a un formulaire soumis récemment
                const formSubmitted = sessionStorage.getItem('formSubmitted');
                if (formSubmitted === 'true') {
                    sessionStorage.removeItem('formSubmitted');
                    scrollToContactSection();
                }
            }
        })();
        
        // ============================================
        // GALLERY LIGHTBOX - Galerie avec Lightbox
        // ============================================
        (function() {
            'use strict';

            const gallery = document.getElementById('modernGallery');
            const lightboxModal = document.getElementById('lightboxModal');
            const lightboxImage = document.getElementById('lightboxImage');
            const lightboxClose = document.getElementById('lightboxClose');
            const lightboxPrev = document.getElementById('lightboxPrev');
            const lightboxNext = document.getElementById('lightboxNext');
            const lightboxCurrent = document.getElementById('lightboxCurrent');
            const lightboxTotal = document.getElementById('lightboxTotal');
            const galleryItems = document.querySelectorAll('.modern-gallery-item');

            if (!gallery || !lightboxModal || !galleryItems.length) return;

            let currentLightboxIndex = 0;
            const totalImages = galleryItems.length;

            if (lightboxTotal) {
                lightboxTotal.textContent = totalImages;
            }

            function openLightbox(index) {
                currentLightboxIndex = index;
                updateLightboxImage();
                lightboxModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeLightbox() {
                lightboxModal.classList.remove('active');
                document.body.style.overflow = '';
            }

            function updateLightboxImage() {
                const item = galleryItems[currentLightboxIndex];
                if (item) {
                    const imgSrc = item.querySelector('img').getAttribute('data-src');
                    lightboxImage.src = imgSrc;
                    if (lightboxCurrent) {
                        lightboxCurrent.textContent = currentLightboxIndex + 1;
                    }
                }
            }

            function navigateLightbox(direction) {
                currentLightboxIndex += direction;
                if (currentLightboxIndex < 0) {
                    currentLightboxIndex = totalImages - 1;
                } else if (currentLightboxIndex >= totalImages) {
                    currentLightboxIndex = 0;
                }
                updateLightboxImage();
            }

            // Event Listeners
            galleryItems.forEach((item, index) => {
                item.addEventListener('click', () => openLightbox(index));
            });

            if (lightboxClose) {
                lightboxClose.addEventListener('click', closeLightbox);
            }
            if (lightboxPrev) {
                lightboxPrev.addEventListener('click', () => navigateLightbox(-1));
            }
            if (lightboxNext) {
                lightboxNext.addEventListener('click', () => navigateLightbox(1));
            }

            // Close on overlay click
            if (lightboxModal) {
                lightboxModal.addEventListener('click', (e) => {
                    if (e.target === lightboxModal || e.target.classList.contains('lightbox-content')) {
                        closeLightbox();
                    }
                });
            }

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (lightboxModal && lightboxModal.classList.contains('active')) {
                    if (e.key === 'Escape') {
                        closeLightbox();
                    } else if (e.key === 'ArrowLeft') {
                        navigateLightbox(-1);
                    } else if (e.key === 'ArrowRight') {
                        navigateLightbox(1);
                    }
                }
            });
        })();
    </script>
</body>
</html>

