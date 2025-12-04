<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/translations.php';

// مسح مجلد gallery وجلب جميع الصور
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
                // قبول فقط ملفات الصور
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $galleryImages[] = [
                        'path' => 'gallery/' . $file,
                        'name' => $file
                    ];
                }
            }
        }
    }
    // ترتيب الصور حسب الاسم
    usort($galleryImages, function($a, $b) {
        return strcmp($a['name'], $b['name']);
    });
}
?>
<!DOCTYPE html>
<html lang="<?php echo getLangAttr(); ?>" dir="<?php echo getDir(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo t('meta_gallery_description'); ?>">
    <title><?php echo t('meta_gallery_title'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@300;400;500;600&family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css?v=1">
    <script src="assets/js/scroll-to-top.js" defer></script>
    <style>
        /* ============================================
           GALLERY PAGE STYLES - Galerie Photos
           ============================================ */
        .gallery-page {
            padding-top: calc(80px + 2rem);
            min-height: 100vh;
            background: var(--bg);
        }
        
        .gallery-page-header {
            text-align: center;
            padding: 3rem 4vw 2rem;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .gallery-page-header .eyebrow {
            text-transform: uppercase;
            letter-spacing: 4px;
            font-size: 0.85rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }
        
        .gallery-page-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 1rem;
        }
        
        .gallery-page-header p {
            color: var(--text-muted);
            font-size: 1.1rem;
        }
        
        .gallery-page-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem 4vw 5rem;
        }
        
        .gallery-page-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            width: 100%;
        }
        
        .gallery-page-item {
            position: relative;
            aspect-ratio: 4/3;
            border-radius: 0.75rem;
            overflow: hidden;
            background: var(--bg-soft);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }
        
        .gallery-page-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(239, 140, 65, 0.4);
            z-index: 5;
        }
        
        .gallery-page-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
            transition: transform 0.4s ease;
        }
        
        .gallery-page-item:hover img {
            transform: scale(1.05);
        }
        
        .gallery-page-empty {
            text-align: center;
            padding: 5rem 2rem;
            color: var(--text-muted);
        }
        
        .gallery-page-empty h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--text);
        }
        
        /* Lightbox Modal */
        .gallery-lightbox {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.95);
            z-index: 100000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .gallery-lightbox.active {
            display: flex;
            opacity: 1;
        }
        
        .gallery-lightbox-content {
            position: relative;
            max-width: 90vw;
            max-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .gallery-lightbox-content img {
            max-width: 100%;
            max-height: 90vh;
            object-fit: contain;
            border-radius: 0.5rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.8);
        }
        
        .gallery-lightbox-close {
            position: absolute;
            top: 2rem;
            right: 2rem;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #fff;
            z-index: 100001;
        }
        
        .gallery-lightbox-close:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(90deg);
        }
        
        .gallery-lightbox-close svg {
            width: 24px;
            height: 24px;
            stroke: currentColor;
        }
        
        .gallery-lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #fff;
            z-index: 100001;
        }
        
        .gallery-lightbox-nav:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-50%) scale(1.1);
        }
        
        .gallery-lightbox-nav svg {
            width: 24px;
            height: 24px;
            stroke: currentColor;
        }
        
        .gallery-lightbox-prev {
            left: 2rem;
        }
        
        .gallery-lightbox-next {
            right: 2rem;
        }
        
        .gallery-lightbox-counter {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 999px;
            font-size: 0.9rem;
            font-weight: 500;
            z-index: 100001;
        }
        
        /* Responsive Gallery Page */
        @media (max-width: 1024px) {
            .gallery-page-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 1.25rem;
            }
        }
        
        @media (max-width: 768px) {
            .gallery-page-header h1 {
                font-size: 2rem;
            }
            
            .gallery-page-container {
                padding: 1rem 2rem 3rem;
            }
            
            .gallery-page-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
            
            .gallery-lightbox-close,
            .gallery-lightbox-nav {
                width: 44px;
                height: 44px;
            }
            
            .gallery-lightbox-prev {
                left: 1rem;
            }
            
            .gallery-lightbox-next {
                right: 1rem;
            }
        }
        
        @media (max-width: 480px) {
            .gallery-page-grid {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }
            
            .gallery-lightbox-close {
                top: 1rem;
                right: 1rem;
                width: 40px;
                height: 40px;
            }
            
            .gallery-lightbox-nav {
                width: 40px;
                height: 40px;
            }
            
            .gallery-lightbox-prev {
                left: 0.5rem;
            }
            
            .gallery-lightbox-next {
                right: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include __DIR__ . '/navbar.php'; ?>
    
    <div class="gallery-page">
        <div class="gallery-page-header">
            <p class="eyebrow"><?php echo t('gallery_eyebrow'); ?></p>
            <h1><?php echo t('gallery_page_title'); ?></h1>
            <p><?php echo t('gallery_desc'); ?></p>
        </div>
        
        <div class="gallery-page-container">
            <?php if (!empty($galleryImages)): ?>
            <div class="gallery-page-grid">
                <?php foreach ($galleryImages as $index => $image): ?>
                    <div class="gallery-page-item" data-index="<?php echo $index; ?>">
                        <img src="<?php echo htmlspecialchars($image['path'], ENT_QUOTES, 'UTF-8'); ?>" 
                             alt="Galerie Atlas Cera - Image <?php echo $index + 1; ?> - <?php echo htmlspecialchars($image['name'], ENT_QUOTES, 'UTF-8'); ?>"
                             data-src="<?php echo htmlspecialchars($image['path'], ENT_QUOTES, 'UTF-8'); ?>"
                             loading="<?php echo $index < 6 ? 'eager' : 'lazy'; ?>">
                    </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
                <div class="gallery-page-empty">
                    <h2><?php echo t('gallery_page_empty_title'); ?></h2>
                    <p><?php echo t('gallery_page_empty_desc'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Lightbox Modal -->
    <div class="gallery-lightbox" id="galleryLightbox">
        <button class="gallery-lightbox-close" id="galleryLightboxClose" aria-label="<?php echo t('gallery_close'); ?>">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
        <button class="gallery-lightbox-nav gallery-lightbox-prev" id="galleryLightboxPrev" aria-label="<?php echo t('gallery_prev'); ?>">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </button>
        <button class="gallery-lightbox-nav gallery-lightbox-next" id="galleryLightboxNext" aria-label="<?php echo t('gallery_next'); ?>">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        </button>
        <div class="gallery-lightbox-content">
            <img id="galleryLightboxImage" src="" alt="Lightbox Image">
            <div class="gallery-lightbox-counter">
                <span id="galleryLightboxCurrent">1</span> / <span id="galleryLightboxTotal"><?php echo count($galleryImages); ?></span>
            </div>
        </div>
    </div>
    
    <!-- Bouton Retour en haut -->
    <?php include __DIR__ . '/scroll-to-top-button.php'; ?>
    
    <script>
        // ============================================
        // NAVBAR - Navbar fixe
        // ============================================
        (function() {
            'use strict';
            
            const navbar = document.getElementById('mainNavbar');
            if (!navbar) return;

            window.addEventListener('scroll', function() {
                ensureNavbarFixed();
                
                if (window.scrollY > 50) {
                    navbar.classList.add('fixed-top', 'shadow', 'scrolled');
                } else {
                    navbar.classList.remove('shadow');
                    navbar.classList.add('fixed-top', 'scrolled');
                }
            }, { passive: true });

            function ensureNavbarFixed() {
                navbar.classList.add('fixed-top');
                navbar.style.position = 'fixed';
                navbar.style.top = '0';
                navbar.style.left = '0';
                navbar.style.right = '0';
                navbar.style.width = '100%';
                navbar.style.zIndex = '99999';
                navbar.style.display = 'flex';
                navbar.style.visibility = 'visible';
                navbar.style.opacity = '1';
                navbar.style.overflow = 'visible';
                
                const computedStyle = window.getComputedStyle(navbar);
                const currentZIndex = parseInt(computedStyle.zIndex) || 0;
                if (currentZIndex < 99999) {
                    navbar.style.setProperty('z-index', '99999', 'important');
                }
                
                if (computedStyle.position !== 'fixed') {
                    navbar.style.setProperty('position', 'fixed', 'important');
                }
            }

            function adjustContentPosition() {
                const navbarHeight = navbar.offsetHeight || 70;
                document.body.style.paddingTop = navbarHeight + 'px';
            }

            ensureNavbarFixed();
            adjustContentPosition();

            window.addEventListener('resize', function() {
                ensureNavbarFixed();
                adjustContentPosition();
            });

            window.addEventListener('load', function() {
                ensureNavbarFixed();
                adjustContentPosition();
            });

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    ensureNavbarFixed();
                    adjustContentPosition();
                });
            } else {
                ensureNavbarFixed();
                adjustContentPosition();
            }

            // Mobile menu - no burger menu, always visible

        })();
        
        // ============================================
        // Scroll to Top Button - Géré par scroll-to-top.js
        // ============================================

        // ============================================
        // GALLERY LIGHTBOX - Galerie avec Lightbox
        // ============================================
        (function() {
            'use strict';
            
            const galleryItems = document.querySelectorAll('.gallery-page-item');
            const lightbox = document.getElementById('galleryLightbox');
            const lightboxImage = document.getElementById('galleryLightboxImage');
            const lightboxClose = document.getElementById('galleryLightboxClose');
            const lightboxPrev = document.getElementById('galleryLightboxPrev');
            const lightboxNext = document.getElementById('galleryLightboxNext');
            const lightboxCurrent = document.getElementById('galleryLightboxCurrent');
            const lightboxTotal = document.getElementById('galleryLightboxTotal');
            
            if (!galleryItems.length || !lightbox) return;
            
            let currentIndex = 0;
            const images = Array.from(galleryItems).map(item => {
                const img = item.querySelector('img');
                return img ? img.getAttribute('data-src') || img.src : '';
            }).filter(src => src);
            
            // Initialiser le compteur total
            if (lightboxTotal) {
                lightboxTotal.textContent = images.length;
            }
            
            // Ouvrir Lightbox au clic sur une image
            galleryItems.forEach((item, index) => {
                item.addEventListener('click', function() {
                    currentIndex = index;
                    openLightbox(currentIndex);
                });
            });
            
            // Fermer Lightbox
            if (lightboxClose) {
                lightboxClose.addEventListener('click', closeLightbox);
            }
            
            if (lightbox) {
                lightbox.addEventListener('click', function(e) {
                    if (e.target === lightbox) {
                        closeLightbox();
                    }
                });
            }
            
            // Navigation entre les images
            if (lightboxPrev) {
                lightboxPrev.addEventListener('click', function(e) {
                    e.stopPropagation();
                    prevImage();
                });
            }
            
            if (lightboxNext) {
                lightboxNext.addEventListener('click', function(e) {
                    e.stopPropagation();
                    nextImage();
                });
            }
            
            // Navigation clavier
            document.addEventListener('keydown', function(e) {
                if (!lightbox || !lightbox.classList.contains('active')) return;
                
                if (e.key === 'Escape') {
                    closeLightbox();
                } else if (e.key === 'ArrowLeft') {
                    prevImage();
                } else if (e.key === 'ArrowRight') {
                    nextImage();
                }
            });
            
            function openLightbox(index) {
                if (index < 0 || index >= images.length) return;
                
                currentIndex = index;
                
                if (lightboxImage && images[index]) {
                    lightboxImage.src = images[index];
                }
                
                if (lightboxCurrent) {
                    lightboxCurrent.textContent = index + 1;
                }
                
                if (lightbox) {
                    lightbox.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            }
            
            function closeLightbox() {
                if (lightbox) {
                    lightbox.classList.remove('active');
                    document.body.style.overflow = '';
                }
            }
            
            function nextImage() {
                const nextIndex = (currentIndex + 1) % images.length;
                openLightbox(nextIndex);
            }
            
            function prevImage() {
                const prevIndex = (currentIndex - 1 + images.length) % images.length;
                openLightbox(prevIndex);
            }
        })();
    </script>
</body>
</html>

