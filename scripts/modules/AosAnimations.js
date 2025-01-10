import $ from 'jquery';
import AOS from 'aos';
class AosAnimations {
    constructor() {
            //this.eventsAnimationOnWindowLoad()
            this.AosAnimationsAction()
        }
        // eventsAnimationOnWindowLoad() {
        //     window.addEventListener("load", () => this.AosAnimationsAction());
        // }
    AosAnimationsAction() {
        AOS.init();

    }
}
export default AosAnimations