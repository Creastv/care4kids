// Parallax effect for title-fu block using GSAP
(function() {
    'use strict';
    
    function initParallax() {
        const titleFuSections = document.querySelectorAll('.b-title-fu');
        
        if (titleFuSections.length === 0) return;
        
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
            if (trigger.vars && trigger.vars.id && trigger.vars.id.startsWith('title-fu-')) {
                trigger.kill();
            }
        }
        
        // Refresh ScrollTrigger first to ensure DOM is ready
        ScrollTrigger.refresh();
        
        // Get all sections directly to ensure uniqueness
        const sections = document.querySelectorAll('.b-title-fu');
        const sectionsArray = Array.from(sections);
        
        // Each section gets its own completely independent parallax effect
        for (let index = 0; index < sectionsArray.length; index++) {
            const section = sectionsArray[index];
            
            // Parallax for image
            const imageElement = section.querySelector('.b-title-fu__image img');
            if (imageElement) {
                // Reset position first to prevent accumulation
                gsap.set(imageElement, { y: 0 });
                
                // Parallax for image - returns to original position (y: 0) at center of page
                const imageTimeline = gsap.timeline({
                    scrollTrigger: {
                        trigger: section,
                        start: 'top bottom',
                        end: 'bottom top',
                        scrub: 2,
                        invalidateOnRefresh: true,
                        id: 'title-fu-image-' + index,
                        // markers: true // Set to true for debugging
                    }
                });
                
                // Animation: starts at -50, reaches 0 at center (50% progress), continues to 50
                imageTimeline
                    .fromTo(imageElement, {
                        y:0
                    }, {
                        y: 30,
                        ease: 'none',
                        duration: 1
                    })
                    .to(imageElement, {
                        y: 0,
                        ease: 'none',
                        duration: 1
                    });
            }
            
            // Parallax for all SVG elements - same effect for all
            const svgElements = section.querySelectorAll('.b-title-fu__svgs svg');
            if (svgElements.length > 0) {
                svgElements.forEach((svg, svgIndex) => {
                    // Reset position first to prevent accumulation
                    gsap.set(svg, { y: 0, rotation: 0 });
                    
                    // Parallax for SVG - moves down on scroll with slight rotation
                    gsap.fromTo(svg, {
                        y: 0,
                        rotation: 0
                    }, {
                        y: 80,
                        rotation: 5,
                        ease: 'none',
                        scrollTrigger: {
                            trigger: section,
                            start: 'top bottom',
                            end: 'bottom top',
                            scrub: 5,
                            invalidateOnRefresh: true,
                            id: 'title-fu-svg-' + index + '-' + svgIndex,
                            // markers: true // Set to true for debugging
                        }
                    });
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

