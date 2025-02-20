<section class="content-section__project-gallery">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="gallery-heading px-120">
                    <h3>View Gallery</h3>
                </div>
            </div>
        </div>
        <?php if (is_singular('property')) : ?>
        <div class="row gallery-wrapper">
            <div class="swiper gallery-swiper">
                <div class="swiper-wrapper">
                    <?php
                        // Fetch the gallery field for the current single property post
                        $gallery = function_exists('get_field') ? get_field('property_gallery') : null;

                        if (is_array($gallery) && !empty($gallery)) :
                            foreach ($gallery as $image) :
                                if (isset($image['url'])) :
                                    ?>
                    <div class="swiper-slide">
                        <div class="gallery-inner">
                            <div class="gallery-cover">
                                <a href="<?php echo esc_url($image['url']); ?>">
                                    <picture>
                                        <source srcset="<?php echo esc_url($image['sizes']['gallery-desktop-size']); ?>"
                                            media="(min-width: 1200px)">
                                        <source srcset="<?php echo esc_url($image['sizes']['gallery-tablet-size']); ?>"
                                            media="(min-width: 768px)">
                                        <img class="gallery-slide-image"
                                            src="<?php echo esc_url($image['sizes']['gallery-mobile-size']); ?>"
                                            alt="<?php the_title(); ?>">
                                    </picture>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                                endif;
                            endforeach;
                        endif;
                        ?>

                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
        <button id="load-more-btn" class="load-more" style="display:none;">Load More Images</button>
        <div class="popup-gallery-overlay">
            <div class="popup-gallery-content">
                <span class="popup-close">&times;</span>
                <span class="popup-arrow popup-arrow-left">&#8249;</span>
                <span class="popup-arrow popup-arrow-right">&#8250;</span>
                <img id="popup-gallery-image" src="" alt="">
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>