/**
 * ============================================
 * NAVBAR - JavaScript جديد ونظيف
 * نظام بسيط وفعال لإدارة القائمة
 * ============================================
 */

(function() {
    'use strict';
    
    // ============================================
    // العناصر (Elements)
    // ============================================
    const navbar = document.getElementById('mainNavbar');
    const menuToggle = document.getElementById('menuToggle');
    const navbarMenu = document.getElementById('navbarMenu');
    const menuOverlay = document.getElementById('menuOverlay');
    const menuLinks = navbarMenu ? navbarMenu.querySelectorAll('.menu-link') : [];
    const body = document.body;
    
    // ============================================
    // التحقق من وجود العناصر
    // ============================================
    if (!navbar || !menuToggle || !navbarMenu || !menuOverlay) {
        console.warn('Navbar elements not found');
        return;
    }
    
    // ============================================
    // وظائف فتح/إغلاق القائمة
    // ============================================
    
    /**
     * فتح القائمة
     */
    function openMenu() {
        // إضافة class "active" للعناصر
        menuToggle.classList.add('active');
        menuToggle.setAttribute('aria-expanded', 'true');
        navbarMenu.classList.add('active');
        menuOverlay.classList.add('active');
        
        // إضافة class "menu-open" للـ body لمنع التمرير
        body.classList.add('menu-open');
    }
    
    /**
     * إغلاق القائمة
     */
    function closeMenu() {
        // إزالة class "active" من العناصر
        menuToggle.classList.remove('active');
        menuToggle.setAttribute('aria-expanded', 'false');
        navbarMenu.classList.remove('active');
        menuOverlay.classList.remove('active');
        
        // إزالة class "menu-open" من body
        body.classList.remove('menu-open');
    }
    
    /**
     * تبديل القائمة (فتح/إغلاق)
     */
    function toggleMenu() {
        if (navbarMenu.classList.contains('active')) {
            closeMenu();
        } else {
            openMenu();
        }
    }
    
    // ============================================
    // Event Listeners
    // ============================================
    
    // عند النقر على زر القائمة
    menuToggle.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        toggleMenu();
    });
    
    // عند النقر على overlay (الخلفية)
    menuOverlay.addEventListener('click', function() {
        closeMenu();
    });
    
    // عند النقر على أي رابط في القائمة
    menuLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            // إغلاق القائمة بعد تأخير قصير للسماح بالتنقل
            setTimeout(closeMenu, 300);
        });
    });
    
    // عند الضغط على مفتاح Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && navbarMenu.classList.contains('active')) {
            closeMenu();
        }
    });
    
    // عند تغيير حجم النافذة (إغلاق القائمة عند التوسيع)
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            if (window.innerWidth > 900 && navbarMenu.classList.contains('active')) {
                closeMenu();
            }
        }, 250);
    });
    
    // ============================================
    // Navbar Scroll Effect
    // ============================================
    let lastScroll = 0;
    
    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
        
        lastScroll = currentScroll;
    }, { passive: true });
    
})();

