// Parallax effect for image block using GSAP
(function() {
    'use strict';
    
    function initParallax() {
        const imageSections = document.querySelectorAll('.b-image');
        
        if (imageSections.length === 0) return;
        
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
            if (trigger.vars && trigger.vars.id && trigger.vars.id.startsWith('image-')) {
                trigger.kill();
            }
        }
        
        // Refresh ScrollTrigger first to ensure DOM is ready
        ScrollTrigger.refresh();
        
        // Get all sections directly to ensure uniqueness
        const sections = document.querySelectorAll('.b-image');
        const sectionsArray = Array.from(sections);
        
        // Each section gets its own completely independent parallax effect
        for (let index = 0; index < sectionsArray.length; index++) {
            const section = sectionsArray[index];
            
            const imageElement = section.querySelector('.b-image__img');
            
            // Parallax for image
            if (imageElement) {
                // Reset position first to prevent accumulation
                gsap.set(imageElement, { y: 0 });
                
                // Parallax for image - centered at middle of viewport
                // When section enters from bottom: image moves up (-150px)
                // When section center is at viewport center: image at original position (0px)
                // When section exits to top: image moves down (150px)
                // GSAP automatically interpolates, so at 50% progress y will be 0
                gsap.fromTo(imageElement, {
                    y: -50
                }, {
                    y: 50,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: section,
                        start: 'top bottom',
                        end: 'bottom top',
                        scrub: 1,
                        invalidateOnRefresh: true,
                        id: 'image-parallax-' + index,
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

