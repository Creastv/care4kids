// Parallax effect for img-section block using GSAP
(function() {
    'use strict';
    
    function initParallax() {
        const imageContainers = document.querySelectorAll('.b-img-section__images');
        
        if (imageContainers.length === 0) return;
        
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
            if (trigger.vars && trigger.vars.id && trigger.vars.id.startsWith('img-section-')) {
                trigger.kill();
            }
        }
        
        // Refresh ScrollTrigger first to ensure DOM is ready
        ScrollTrigger.refresh();
        
        // Get all sections directly to ensure uniqueness
        const sections = document.querySelectorAll('.b-img-section');
        const sectionsArray = Array.from(sections);
        
        // Each section gets its own completely independent parallax effect
        for (let index = 0; index < sectionsArray.length; index++) {
            const section = sectionsArray[index];
            const imagesContainer = section.querySelector('.b-img-section__images');
            
            if (!imagesContainer) continue;
            
            const bgElement = imagesContainer.querySelector('.b-img-section__bg');
            const frontElement = imagesContainer.querySelector('.b-img-section__front');
            
            // Each element gets its own independent parallax effect
            // Background image parallax
            if (bgElement) {
                // Reset position first to prevent accumulation
                gsap.set(bgElement, { y: 0 });
                
                // Parallax for background image - moves slower (deeper layer)
                gsap.fromTo(bgElement, {
                    y: 0
                }, {
                    y: -50,
                    // ease: 'none',
                    scrollTrigger: {
                        trigger: section,
                        start: ' bottom',
                        end: 'top',
                        scrub: 15,
                        invalidateOnRefresh: true,
                        id: 'img-section-bg-' + index,
                        // markers: true // Set to true for debugging
                    }
                });
            }
            
            // Front image parallax
            if (frontElement) {
                // Reset position first to prevent accumulation
                gsap.set(frontElement, { y: 0 });
                
                // Parallax for front image - moves faster (closer layer)
                gsap.fromTo(frontElement, {
                    y: 0
                }, {
                    y: 80,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: section,
                        start: ' bottom',
                        end: '200px',
                        scrub: 1,
                        invalidateOnRefresh: true,
                        id: 'img-section-front-' + index,
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

