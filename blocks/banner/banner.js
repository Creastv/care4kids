// Parallax effect for banner block using GSAP
(function() {
    'use strict';
    
    function initParallax() {
        const bannerSections = document.querySelectorAll('.b-banner');
        
        if (bannerSections.length === 0) return;
        
        // Check if GSAP is loaded
        if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
            // Retry after a short delay if GSAP is still loading
            setTimeout(initParallax, 100);
            return;
        }
        
        // Register ScrollTrigger plugin
        gsap.registerPlugin(ScrollTrigger);
        
        // Kill any existing triggers with our IDs to prevent duplicates
        const allTriggers = ScrollTrigger.getAll();
        for (let i = 0; i < allTriggers.length; i++) {
            const trigger = allTriggers[i];
            if (trigger.vars && trigger.vars.id && trigger.vars.id.startsWith('banner-')) {
                trigger.kill();
            }
        }
        
        // Refresh ScrollTrigger first to ensure DOM is ready
        ScrollTrigger.refresh();
        
        // Get all sections directly to ensure uniqueness
        const sections = document.querySelectorAll('.b-banner');
        const sectionsArray = Array.from(sections);
        
        // Each section gets its own completely independent parallax effect
        for (let index = 0; index < sectionsArray.length; index++) {
            const section = sectionsArray[index];
            
            const imageElement = section.querySelector('.b-banner__image-img');
            const ornamentElement = section.querySelector('.b-banner__ornament');
            
            // Parallax for image
            if (imageElement) {
                // Reset position first to prevent accumulation
                gsap.set(imageElement, { y: 0 });
                
                // Parallax for image
                gsap.fromTo(imageElement, {
                    y: 0
                }, {
                    y: -100,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: section,
                        start: ' +80% top',
                        end: 'bottom top',
                        scrub: 2,
                        invalidateOnRefresh: true,
                        id: 'banner-image-' + index,
                        // markers: true // Set to true for debugging
                    }
                });
            }
            
            // Parallax for ornament
            if (ornamentElement) {
                // Reset position first to prevent accumulation
                gsap.set(ornamentElement, { y: 0 });
                
                // Parallax for ornament - moves slower (deeper layer)
                gsap.fromTo(ornamentElement, {
                    y: 0
                }, {
                    y: 150,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: section,
                        start: ' +80% top',
                        end: 'bottom top',
                        scrub: 5,
                        invalidateOnRefresh: true,
                        id: 'banner-ornament-' + index,
                        // markers: true // Set to true for debugging
                    }
                });
            }
        }
        
        // Refresh ScrollTrigger after all instances are created
        setTimeout(function() {
            ScrollTrigger.refresh();
        }, 300);
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initParallax);
    } else {
        initParallax();
    }
    
    // Refresh on window resize
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            if (typeof ScrollTrigger !== 'undefined') {
                ScrollTrigger.refresh();
            }
        }, 250);
    });
})();

