import $ from 'jquery';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin';
// import Scrollbar from "smooth-scrollbar";
// import SmoothScroll from "smooth-scroll";
import 'jquery-ui-bundle';
import 'jquery-ui-bundle/jquery-ui.css';

import AOS from 'aos';
gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

class GSAPScripts {
    constructor() {
        this.PageSmoothScrolling();
        this.eventsOnWindowLoad();
    }
    eventsOnWindowLoad() {
        window.addEventListener('load', () => this.OnHoverChangeImages());
    }
    PageSmoothScrolling() {
        // Write here
    }
    MainNavigationFunction() {
        this.mainNavLinks.forEach((link) => {
            link.addEventListener('mouseleave', (e) => {
                link.classList.add('animate-out');
                setTimeout(() => {
                    link.classList.remove('animate-out');
                }, 300);
            });
        });
    }
    //Parallax Effect on Images
    ParrallaxEffectSiteWide() {
        gsap.utils.toArray('.with-parralax').forEach((section) => {
            const parrimage = section.querySelector('img');
            gsap.to(parrimage, {
                yPercent: 20,
                ease: 'none',
                scrollTrigger: {
                    trigger: section,
                    start: 'top bottom',
                    scrub: 4
                }
            });
        });
    }
    FixedNavigation() {
        const getVh = () => {
            const vh = Math.max(
                document.documentElement.clientHeight || 0,
                window.innerHeight || 0
            );
            return vh;
        };
        gsap.utils.toArray('.content-block').forEach((stage, index) => {
            const navLinks = gsap.utils.toArray('.fix-navigation li a');
            ScrollTrigger.create({
                trigger: stage,
                start: 'top center',
                end: () => `+=${stage.clientHeight + getVh() / 30}`,
                toggleClass: {
                    targets: navLinks[index],
                    className: 'active'
                }
                //markers: true
            });
        });
    }

    HashtagScrolling() {
        const hash = window.location.hash;
        console.log('Hash Value: ' + hash);
        if (hash) {
            const target = document.getElementById(hash.substring(1));
            if (target) {
                BodyScrollbar.scrollIntoView(target, {
                    damping: 0.07,
                    offsetTop: BodyScrollbar.containerEl.scrollTop + 200
                });
            }
        }
    }
    OnHoverChangeImages() {
        gsap.set('#img2ND', { autoAlpha: 1 });

        var $button = $('.cards__title'),
            $page = $('.pageAttr'),
            $click = $('.click');

        $button.on('click', function (e) {
            var $thisPage = $(this).attr('id');
            //alert($thisPage)
            var $thisClick = $thisPage + 'Click';

            gsap.to($thisPage, 1, { autoAlpha: 1 });
            gsap.to($page.not($thisPage), 0.5, { autoAlpha: 0 }); // faster

            gsap.to($thisClick, 0.4, { autoAlpha: 0 });
        });
    }
}
export default GSAPScripts;
