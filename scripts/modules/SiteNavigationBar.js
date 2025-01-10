import $ from "jquery";
import { gsap } from "gsap";

class SiteNavigationBar {
    constructor() {
        // Initialize the class by calling events
        this.events();
    }

    events = () => {
        const $menuBtn = $('.menu-btn-wrap');
        const $menuBars = $('.menu-btn-bar');
        const $menuBlock = $('.open-menu-block');
        const $menuWrap = $('.menu-block-wrap');
        const $menuItems = $menuWrap.find('li'); // Find all the menu items

        // Set initial state of the menu block and menu items to be hidden
        gsap.set($menuBlock, { autoAlpha: 0 });
        gsap.set($menuItems, { y: 20, autoAlpha: 0 }); // Hide the menu items below their initial position

        $menuBtn.on('click', () => {
            if ($menuBlock.hasClass('open')) {
                // Close the menu
                gsap.timeline()
                    .to($menuItems, { y: 20, autoAlpha: 0, duration: 0.3, ease: 'power2.inOut', stagger: 0.05 }) // Hide the menu items
                    .to($menuBlock, { autoAlpha: 0, duration: 0.3, ease: 'power2.inOut' }, '<'); // Fade out the background
                $menuBlock.removeClass('open');

                // Animate button back to initial state
                gsap.to($menuBars.eq(0), { rotation: 0, y: 0, transformOrigin: 'center center', duration: 0.3, ease: 'power2.inOut' });
                gsap.to($menuBars.eq(1), { autoAlpha: 1, duration: 0.3, ease: 'power2.inOut' });
                gsap.to($menuBars.eq(2), { rotation: 0, y: 0, transformOrigin: 'center center', duration: 0.3, ease: 'power2.inOut' });
            } else {
                // Open the menu
                $menuBlock.css('display', 'block'); // Ensure the block is visible before animation

                gsap.timeline()
                    .to($menuBlock, { autoAlpha: 1, duration: 0.3, ease: 'power2.inOut' }) // Fade in the background
                    .to($menuItems, { y: 0, autoAlpha: 1, duration: 0.5, ease: 'power2.out', stagger: 0.1 }); // Stagger the menu items coming in
                $menuBlock.addClass('open');

                // Animate button to cross
                gsap.to($menuBars.eq(0), { rotation: 45, y: 10, transformOrigin: 'center center', duration: 0.3, ease: 'power2.inOut' });
                gsap.to($menuBars.eq(1), { autoAlpha: 0, duration: 0.3, ease: 'power2.inOut' });
                gsap.to($menuBars.eq(2), { rotation: -45, y: -10, transformOrigin: 'center center', duration: 0.3, ease: 'power2.inOut' });
            }
        });
    }
}

export default SiteNavigationBar;