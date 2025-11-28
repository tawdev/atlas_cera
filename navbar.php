<!-- ============================================
     NAVBAR - ملف منفصل
     هذا الملف يحتوي على navbar فقط
     ============================================ -->
<nav id="mainNavbar" class="navbar fixed-top">
    <div class="brand">
        <span>Atlas</span><strong>Cera</strong>
    </div>
    <input type="checkbox" id="nav-toggle" class="nav-toggle">
    <label for="nav-toggle" class="nav-toggle-label">
        <span></span>
    </label>
    <div class="nav-overlay"></div>
    
    <!-- Language Switch Toggle -->
    <button class="language-switch" id="langSwitch" aria-label="Changer la langue" type="button">
        <span class="lang-label lang-fr">FR</span>
        <span class="lang-slider"></span>
        <span class="lang-label lang-ar">AR</span>
    </button>
    
    <ul class="nav-links">
        <li><a href="index.php#accueil" data-translate="nav_home">Accueil</a></li>
        <li><a href="index.php#expertises" data-translate="nav_expertises">Expertises</a></li>
        <li><a href="index.php#projetss" data-translate="nav_projects">Projets</a></li>
        <li><a href="index.php#valeurs" data-translate="nav_about">A propos</a></li>
        <li><a href="index.php#gallery" data-translate="nav_gallery">Galerie</a></li>
        <li><a href="index.php#contact" data-translate="nav_contact">Contact</a></li>
    </ul>
</nav>

