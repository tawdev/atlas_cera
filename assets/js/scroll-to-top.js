/**
 * ============================================
 * Scroll to Top Button - Bouton Retour en haut
 * ============================================
 * Ce fichier gère l'affichage et le comportement du bouton
 * "retour en haut de page" sur toutes les pages du site.
 * 
 * Fonctionnalités:
 * - Affiche le bouton dès le moindre scroll (même 1px)
 * - Scroll smooth vers le haut au clic
 * - Z-index élevé (999999) pour rester au-dessus de tout
 * - Toujours visible après n'importe quel scroll
 * - Vérification périodique pour maintenir la visibilité
 * ============================================
 */

(function() {
    'use strict';
    
    function initScrollToTop() {
        const scrollToTopBtn = document.getElementById('scrollToTop');
        if (!scrollToTopBtn) return;
        
        function getScrollPosition() {
            return window.pageYOffset || 
                   document.documentElement.scrollTop || 
                   document.body.scrollTop || 
                   window.scrollY || 
                   0;
        }
        
        function toggleScrollButton() {
            const scrollY = getScrollPosition();
            
            if (scrollY > 0) {
                scrollToTopBtn.classList.add('show');
                scrollToTopBtn.style.setProperty('opacity', '1', 'important');
                scrollToTopBtn.style.setProperty('visibility', 'visible', 'important');
                scrollToTopBtn.style.setProperty('pointer-events', 'auto', 'important');
                scrollToTopBtn.style.setProperty('z-index', '999999', 'important');
                scrollToTopBtn.style.setProperty('display', 'flex', 'important');
                scrollToTopBtn.style.setProperty('position', 'fixed', 'important');
            } else {
                scrollToTopBtn.classList.remove('show');
                scrollToTopBtn.style.setProperty('opacity', '0', 'important');
                scrollToTopBtn.style.setProperty('visibility', 'hidden', 'important');
                scrollToTopBtn.style.setProperty('pointer-events', 'none', 'important');
            }
        }
        
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
        
        // Event listeners
        window.addEventListener('scroll', toggleScrollButton, { passive: true });
        document.addEventListener('scroll', toggleScrollButton, { passive: true });
        
        scrollToTopBtn.addEventListener('click', scrollToTop);
        
        // Vérification initiale
        toggleScrollButton();
        
        // Vérification après le chargement de la page
        window.addEventListener('load', function() {
            toggleScrollButton();
        });
        
        // Vérification périodique pour maintenir la visibilité
        setInterval(function() {
            const scrollY = getScrollPosition();
            if (scrollY > 0) {
                scrollToTopBtn.style.setProperty('opacity', '1', 'important');
                scrollToTopBtn.style.setProperty('visibility', 'visible', 'important');
                scrollToTopBtn.style.setProperty('display', 'flex', 'important');
                scrollToTopBtn.style.setProperty('z-index', '999999', 'important');
                scrollToTopBtn.style.setProperty('position', 'fixed', 'important');
                scrollToTopBtn.style.setProperty('pointer-events', 'auto', 'important');
            }
        }, 500);
    }
    
    // Initialisation
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initScrollToTop);
    } else {
        initScrollToTop();
    }
    
    window.addEventListener('load', initScrollToTop);
    
})();

