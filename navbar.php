<?php
require_once __DIR__ . '/translations.php';
$currentLang = getCurrentLang();
?>
<!-- ============================================
     NAVBAR - نظام جديد ونظيف
     ============================================ -->
<nav class="main-navbar" id="mainNavbar">
    <div class="navbar-container">
        <!-- Logo / Brand -->
        <a class="navbar-brand" href="index.php#accueil">
            <img src="logo/logo.jpg" alt="logo" class="img-fluid" style="max-height:50px;">
        </a>
        
        <!-- Mobile Menu Toggle Button -->
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu" aria-expanded="false">
            <span class="menu-icon">
                <span class="icon-line"></span>
                <span class="icon-line"></span>
                <span class="icon-line"></span>
            </span>
        </button>
        
        <!-- Navigation Menu -->
        <div class="navbar-menu" id="navbarMenu">
            <ul class="menu-list">
                <li><a href="index.php#accueil" class="menu-link"><?php echo t('nav_home'); ?></a></li>
                <li><a href="index.php#expertises" class="menu-link"><?php echo t('nav_expertises'); ?></a></li>
                <li><a href="index.php#projetss" class="menu-link"><?php echo t('nav_projects'); ?></a></li>
                <li><a href="index.php#valeurs" class="menu-link"><?php echo t('nav_about'); ?></a></li>
                <li><a href="index.php#gallery" class="menu-link"><?php echo t('nav_gallery'); ?></a></li>
                <li><a href="index.php#contact" class="menu-link"><?php echo t('nav_contact'); ?></a></li>
                <li class="menu-item-lang">
                    <a href="language.php?lang=<?php echo $currentLang === 'ar' ? 'fr' : 'ar'; ?>" class="menu-link lang-link" title="<?php echo $currentLang === 'ar' ? 'Français' : 'العربية'; ?>">
                        <?php echo $currentLang === 'ar' ? 'FR' : 'AR'; ?>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Mobile Menu Overlay -->
        <div class="menu-overlay" id="menuOverlay"></div>
    </div>
</nav>
