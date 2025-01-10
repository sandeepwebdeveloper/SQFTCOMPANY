import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

class ImageParallax {
    constructor() {
        this.initParallax();
        this.initScaleAnimation();
        this.initHeadingAnimation();
    }

    initParallax() {
        // Parallax effect for the image on scroll
        gsap.to('.parallax-image', {
            yPercent: -20, // Adjust to control how much the image moves
            ease: 'none',
            scrollTrigger: {
                trigger: '.swiper-slide', // Target the swiper slide section
                start: 'top bottom', // Start when the top of the slide hits the bottom of the viewport
                end: 'bottom top', // End when the bottom of the slide hits the top of the viewport
                scrub: true // Smooth parallax effect on scroll
            }
        });
    }

    initScaleAnimation() {
        // Scale animation for the image on page load
        gsap.fromTo(
            '.parallax-image',
            { scale: 1.3 }, // Start at 1.3 scale
            {
                scale: 1, // Animate to 1 scale
                duration: 10, // Animation duration
                ease: 'power2.out' // Smooth easing effect
            }
        );
    }

    initHeadingAnimation() {
        // Animate the headings from bottom to top on page load
        gsap.fromTo(
            '.slide-heading h1 span strong',
            { y: '100%' }, // Start below the visible area
            {
                y: '0%', // Move to normal position
                duration: 1.5, // Animation duration
                ease: 'power2.out', // Smooth easing effect
                stagger: 0.3, // Delay between lines
                delay: 0.5 // Start slightly after the page loads
            }
        );
    }
}

// Initialize the animations on DOMContentLoaded
document.addEventListener('DOMContentLoaded', () => {
    new ImageParallax();
});

export default ImageParallax;
