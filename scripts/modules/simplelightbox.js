import SimpleLightbox from 'simplelightbox';
import 'simplelightbox/dist/simple-lightbox.min.css'; // CSS for SimpleLightbox

class SimpleLightboxClass {
    constructor() {
        this.initGalleryPopup();
    }

    initGalleryPopup() {
        // Initialize SimpleLightbox for images with the class 'gallery-image'
        var lightbox = new SimpleLightbox(
            '.gallery-wrapper .gallery-swiper .swiper-wrapper a',
            {
                captionsData: 'alt',
                showCounter: true,
                navText: ['←', '→'], // Custom navigation icons if needed
                animationSpeed: 400
            }
        );

        // Reinitialize SimpleLightbox when Swiper slide changes (if loop is true)
        var swiper = document.querySelector('.gallery-swiper').swiper;
        swiper.on('slideChange', () => {
            // Destroy and reinitialize SimpleLightbox every time the slide changes
            lightbox.destroy();
            this.initGalleryPopup();
        });
    }
}

export default SimpleLightboxClass;
