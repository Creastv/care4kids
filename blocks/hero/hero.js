// Parallax effect for hero block using GSAP
(function() {
    'use strict';
    
    function initParallax() {
        const heroSections = document.querySelectorAll('.hero');
        
        if (heroSections.length === 0) return;
        
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
            if (trigger.vars && trigger.vars.id && trigger.vars.id.startsWith('hero-')) {
                trigger.kill();
            }
        }
        
        // Refresh ScrollTrigger first to ensure DOM is ready
        ScrollTrigger.refresh();
        
        // Get all sections directly to ensure uniqueness
        const sections = document.querySelectorAll('.hero');
        const sectionsArray = Array.from(sections);
        
        // Each section gets its own completely independent parallax effect
        for (let index = 0; index < sectionsArray.length; index++) {
            const section = sectionsArray[index];
            
            const innerElement = section.querySelector('.hero__inner');
            const svgsElement = section.querySelector('.hero__svgs');
            const contureElement = section.querySelector('.hero__conture');
            const bgImageElement = section.querySelector('.hero__bg img');
            const leftColumn = section.querySelector('.hero__type__left');
            const rightColumn = section.querySelector('.hero__type__right');
            
            // Typewriting effect for each column independently
            function initColumnTypewriting(column, columnId) {
                if (!column) return;
                
                const typeElements = column.querySelectorAll('.hero__type');
                if (typeElements.length === 0) return;
                
                const MIN_VISIBLE = 3; // Minimum 3 texts visible at once
                const DISPLAY_TIME = 8000; // Time to show text before deleting (ms)
                
                // Store original texts
                const texts = [];
                typeElements.forEach(function(typeElement) {
                    const text = typeElement.textContent.trim();
                    texts.push(text);
                    typeElement.textContent = '';
                    gsap.set(typeElement, { opacity: 0, display: 'none' });
                });
                
                // Track which slots are animating
                const slots = Array(MIN_VISIBLE).fill(null).map(function() {
                    return { 
                        isAnimating: false, 
                        element: null,
                        textIndex: -1
                    };
                });
                
                // Shuffle array function
                function shuffleArray(array) {
                    const shuffled = array.slice();
                    for (let i = shuffled.length - 1; i > 0; i--) {
                        const j = Math.floor(Math.random() * (i + 1));
                        const temp = shuffled[i];
                        shuffled[i] = shuffled[j];
                        shuffled[j] = temp;
                    }
                    return shuffled;
                }
                
                let availableIndices = shuffleArray(Array.from({ length: texts.length }, function(_, i) { return i; }));
                let usedIndices = 0;
                
                function getNextTextIndex() {
                    // If all texts have been used, reshuffle and start over
                    if (usedIndices >= availableIndices.length) {
                        availableIndices = shuffleArray(Array.from({ length: texts.length }, function(_, i) { return i; }));
                        usedIndices = 0;
                    }
                    const index = availableIndices[usedIndices];
                    usedIndices++;
                    return index;
                }
                
                function typeTextInSlot(slotIndex) {
                    const slot = slots[slotIndex];
                    if (slot.isAnimating) return;
                    
                    const textIndex = getNextTextIndex();
                    
                    slot.isAnimating = true;
                    const typeElement = typeElements[textIndex];
                    const text = texts[textIndex];
                    const chars = text.split('');
                    
                    slot.element = typeElement;
                    slot.textIndex = textIndex;
                    
                    // Clear and prepare element
                    typeElement.textContent = '';
                    typeElement.style.display = 'block';
                    typeElement.style.visibility = 'visible';
                    
                    // Create spans for each character
                    chars.forEach(function(char) {
                        const charSpan = document.createElement('span');
                        charSpan.textContent = char === ' ' ? '\u00A0' : char;
                        charSpan.style.opacity = '0';
                        typeElement.appendChild(charSpan);
                    });
                    
                    const charSpans = typeElement.querySelectorAll('span');
                    gsap.set(typeElement, { opacity: 1 });
                    
                    // Measure the final width
                    typeElement.style.visibility = 'hidden';
                    typeElement.style.display = 'inline-block';
                    const finalWidth = typeElement.offsetWidth;
                    typeElement.style.visibility = 'visible';
                    
                    // Animate background expanding with the text using clip-path
                    // Left column expands from right to left, right column from left to right
                    const isLeftColumn = columnId === 'left';
                    gsap.set(typeElement, { 
                        clipPath: isLeftColumn ? 'inset(0 0 0 100%)' : 'inset(0 100% 0 0)'
                    });
                    
                    // Calculate total animation duration
                    const totalTypingDuration = chars.length * 0.04 + 0.15;
                    
                    // Typewriting animation
                    const typeTimeline = gsap.timeline({
                        onComplete: function() {
                            // Wait before fading out
                            setTimeout(function() {
                                // Fade out entire text slowly (no reverse typewriting)
                                gsap.to(typeElement, {
                                    opacity: 0,
                                    clipPath: isLeftColumn ? 'inset(0 0 0 100%)' : 'inset(0 100% 0 0)',
                                    duration: 1.5,
                                    ease: 'power2.inOut',
                                    onComplete: function() {
                                        typeElement.style.visibility = 'hidden';
                                        gsap.set(typeElement, { clipPath: 'inset(0 0% 0 0%)' });
                                        slot.isAnimating = false;
                                        slot.element = null;
                                        slot.textIndex = -1;
                                        
                                        // Continue with next animation (infinite loop)
                                        setTimeout(function() {
                                            typeTextInSlot(slotIndex);
                                        }, 200);
                                    }
                                });
                            }, DISPLAY_TIME);
                        }
                    });
                    
                    // First: Expand background
                    const backgroundDuration = 0.5;
                    typeTimeline.to(typeElement, {
                        clipPath: 'inset(0 0% 0 0%)',
                        duration: backgroundDuration,
                        ease: 'power2.out'
                    }, 0);
                    
                    // Then: Type each character after background is shown
                    charSpans.forEach(function(charSpan, charIndex) {
                        typeTimeline.to(charSpan, {
                            opacity: 1,
                            duration: 0.1,
                            ease: 'power1.inOut'
                        }, backgroundDuration + (charIndex * 0.04));
                    });
                }
                
                // Start animations for all slots when section is visible
                ScrollTrigger.create({
                    trigger: section,
                    start: 'top 80%',
                    once: true,
                    onEnter: function() {
                        // Start each slot with a bigger delay between them to prevent simultaneous typing
                        slots.forEach(function(slot, slotIndex) {
                            setTimeout(function() {
                                typeTextInSlot(slotIndex);
                            }, slotIndex * 2000); // Stagger start by 2000ms (2 seconds)
                        });
                    },
                    id: 'hero-typewriting-' + columnId + '-' + index
                });
            }
            
            // Initialize both columns
            initColumnTypewriting(leftColumn, 'left');
            initColumnTypewriting(rightColumn, 'right');
            
            // Zoom in effect for hero__inner
            if (innerElement) {
                // Reset scale first to prevent accumulation
                gsap.set(innerElement, { scale: 1 });
                
                // Zoom in effect
                gsap.fromTo(innerElement, {
                    scale: 1
                }, {
                    scale: 0.9,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: section,
                        start: 'top bottom',
                        end: 'bottom top',
                        scrub: 2,
                        invalidateOnRefresh: true,
                        id: 'hero-inner-zoom-' + index,
                        // markers: true // Set to true for debugging
                    }
                });
            }
            
            // Parallax for hero__svgs
            if (svgsElement) {
                // Reset position first to prevent accumulation
                gsap.set(svgsElement, { y: 0 });
                
                // Parallax for svgs container
                gsap.fromTo(svgsElement, {
                    y: 0
                }, {
                    y: -150,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: section,
                        start: 'top bottom',
                        end: 'bottom top',
                        scrub: 2,
                        invalidateOnRefresh: true,
                        id: 'hero-svgs-' + index,
                        // markers: true // Set to true for debugging
                    }
                });
                
                // Individual floating animations for each SVG
                const svgElements = svgsElement.querySelectorAll('svg');
                
                // Kill any existing floating animations first
                svgElements.forEach(function(svg) {
                    gsap.killTweensOf(svg);
                });
                
                // Different floating configurations for each SVG (subtle movements)
                const floatingConfigs = [
                    { 
                        y: 8, 
                        x: 3, 
                        rotation: 1.5, 
                        duration: 2.8, 
                        ease: 'sine.inOut',
                        delay: 0 
                    },      // SVG 1 - delikatny ruch w górę i w prawo z rotacją
                    { 
                        y: -6, 
                        x: -2, 
                        rotation: -1, 
                        duration: 3.2, 
                        ease: 'power1.inOut',
                        delay: 0.3 
                    },      // SVG 2 - ruch w dół i w lewo, wolniejszy
                    { 
                        y: 10, 
                        x: 0, 
                        rotation: 0, 
                        duration: 2.5, 
                        ease: 'sine.inOut',
                        delay: 0.6 
                    },      // SVG 3 - tylko ruch w górę, bez rotacji
                    { 
                        y: -8, 
                        x: 4, 
                        rotation: 0.8, 
                        duration: 3.5, 
                        ease: 'power2.inOut',
                        delay: 0.9 
                    },      // SVG 4 - najwolniejszy, ruch w dół i w prawo
                    { 
                        y: 7, 
                        x: -3, 
                        rotation: -1.2, 
                        duration: 2.6, 
                        ease: 'sine.inOut',
                        delay: 1.2 
                    }       // SVG 5 - ruch w górę i w lewo z rotacją
                ];
                
                svgElements.forEach(function(svg, svgIndex) {
                    const config = floatingConfigs[svgIndex] || floatingConfigs[0];
                    
                    // Reset position
                    gsap.set(svg, { y: 0, x: 0, rotation: 0 });
                    
                    // Individual floating animation for each SVG
                    gsap.to(svg, {
                        y: config.y,
                        x: config.x,
                        rotation: config.rotation,
                        duration: config.duration,
                        ease: config.ease,
                        repeat: -1,
                        yoyo: true,
                        delay: config.delay,
                        id: 'hero-svg-float-' + index + '-' + svgIndex
                    });
                });
            }
            
            // Parallax for hero__conture
            if (contureElement) {
                // Kill any existing floating animations first
                gsap.killTweensOf(contureElement, 'x,rotation');
                
                // Reset position first to prevent accumulation
                gsap.set(contureElement, { y: 0, scale: 1, x: 0, rotation: 0 });
                
                // Floating animation for conture (subtle movement)
                gsap.to(contureElement, {
                    x: 10,
                    rotation: 0.5,
                    duration: 4.0,
                    ease: 'sine.inOut',
                    repeat: -1,
                    yoyo: true,
                    delay: 0.5,
                    id: 'hero-conture-float-' + index
                });
                
                // Parallax for conture - moves slower (deeper layer)
                gsap.fromTo(contureElement, {
                    y: 0,
                    scale: 1,
                }, {
                    y: 130,
                    scale: 1.2,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: section,
                        start: 'top bottom',
                        end: 'bottom top',
                        scrub: 8,
                        invalidateOnRefresh: true,
                        id: 'hero-conture-' + index,
                        // markers: true // Set to true for debugging
                    }
                });
            }
            
            // Parallax for hero__bg img
            if (bgImageElement) {
                // Reset position first to prevent accumulation
                gsap.set(bgImageElement, { y: 0, scale: 1 });
                
                // Parallax for background image
                gsap.fromTo(bgImageElement, {
                    y: 0,
                    scale: 1
                }, {
                    y: 60,
                    scale: 1.2,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: section,
                        start: 'top bottom',
                        end: 'bottom top',
                        scrub: 3,
                        invalidateOnRefresh: true,
                        id: 'hero-bg-img-' + index,
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

