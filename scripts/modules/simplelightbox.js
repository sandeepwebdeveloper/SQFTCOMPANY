import SimpleLightbox from 'simplelightbox';
import 'simplelightbox/dist/simple-lightbox.min.css'; // CSS for SimpleLightbox

class SimpleLightboxClass {
    constructor() {
        this.initGalleryPopup();
    }

    initGalleryPopup() {
        // Initialize SimpleLightbox for images with the class 'gallery-image'
        var lightbox = new SimpleLightbox('.gallery-wrapper a', {
            captionsData: 'alt',
            captionDelay: 250,
            showCounter: true,
            navText: ['←', '→'], // Custom navigation icons if needed
            animationSpeed: 400
        });
    }
}

export default SimpleLightboxClass;
