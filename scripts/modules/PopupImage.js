import $ from 'jquery';
import magnificPopup from 'magnific-popup';
class PopupImage {
    constructor() {
        this.Zoombutton = document.querySelectorAll('.zoom-in')
            // this.ZoomOut = document.querySelector('.zoom-out')
            // this.elem = document.getElementById('panzoom')
        this.MegniFierSelector()
            ///this.OnClickChangeImages()
    }
    MegniFierSelector() {
        $(this.Zoombutton).magnificPopup({
            type: 'image',
            zoom: true

        });
    }
}
export default PopupImage