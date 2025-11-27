// Parallax effect for ornament block using GSAP
(function() {
    'use strict';
    
    function initParallax() {
        const ornamentSections = document.querySelectorAll('.b-ornament');
        
        if (ornamentSections.length === 0) return;
        
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
            if (trigger.vars && trigger.vars.id && trigger.vars.id.startsWith('ornament-')) {
                trigger.kill();
            }
        }
        
        // Refresh ScrollTrigger first to ensure DOM is ready
        ScrollTrigger.refresh();
        
        // Get all sections directly to ensure uniqueness
        const sections = document.querySelectorAll('.b-ornament');
        const sectionsArray = Array.from(sections);
        
        // Each section gets its own completely independent parallax effect
        for (let index = 0; index < sectionsArray.length; index++) {
            const section = sectionsArray[index];
            
            const svgWrapper = section.querySelector('.b-ornament__svg-wrapper');
            
            // Parallax for SVG wrapper
            if (svgWrapper) {
                // Reset position first to prevent accumulation
                gsap.set(svgWrapper, { y: 0 });
                
                // Parallax for ornament - moves slower (deeper layer)
                gsap.fromTo(svgWrapper, {
                    y: 0
                }, {
                    y: 250,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: section,
                        start: 'top bottom',
                        end: 'bottom top',
                        scrub: 2,
                        invalidateOnRefresh: true,
                        id: 'ornament-' + index,
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

