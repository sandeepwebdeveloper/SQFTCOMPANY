<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<main class="single-project-page">
    <div class="primary-block">
        <section class="single-project-banner">
            <div class="container-fluid px-120">
                <div class="single-banner-wrapper">
                    <div class="single-banner-block">
                        <div class="row align-items-center bg-light-grey">
                            <div class="col-md-6 order-2 order-xl-1">
                                <?php /*
                                <div class="single-project-logo">
                                    <img src="/wp-content/uploads/2024/07/1989-logo.svg"
                                        alt="<?php the_title(); ?> - logo">
                            </div> */?>
                            <div class="single-header-wrap">
                                <div class="sigle-banner-title d-none d-xl-block">
                                    <h1><?php the_title(); ?></h1>
                                </div>
                                <div class="sigle-banner-content">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 order-1 order-xl-2">
                            <div class="sigle-banner-title d-xl-none">
                                <h1><?php the_title(); ?></h1>
                            </div>
                            <div class="single-banner-image mb-5 mb-xl-0">
                                <?php $thumbnail_url = get_the_post_thumbnail_url(get_the_ID()); ?>
                                <img src="<?php echo $thumbnail_url; ?>" alt="<?php the_title(); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="bg-block"></div>
    </section>
    <section class="content-section__project-gallery">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading px-120">
                        <h3>View
                            <span>Gallery</span>
                        </h3>
                    </div>
                </div>
            </div>
            <?php if (is_singular('property')) : ?>
            <div class="row gallery-wrapper">
                <?php
                        // Fetch the gallery field for the current single property post
                        $gallery = function_exists('get_field') ? get_field('property_gallery') : null;

                        if (is_array($gallery) && !empty($gallery)) :
                            foreach ($gallery as $image) :
                                if (isset($image['url'])) :
                                    ?>
                <div class="gallery-loop">
                    <div class="gallery-grid">
                        <div class="property-cat-img">
                            <a href="<?php echo esc_url($image['url']); ?>">
                                <img class="gallery-image" src="<?php echo esc_url($image['url']); ?>"
                                    alt="<?php echo esc_attr($image['alt'] ?? ''); ?>">
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
    <section class="content-section__site-register">
        <div class="container-fluid px-m-35">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="register-block">
                        <div class="section-heading text-center">
                            <h3>
                                <span>Register for More Information <br class="d-none d-xl-block">on This
                                    Property</span>
                            </h3>
                            <?php /*
                            <p>Sign up now for detailed information on this property and exclusive updates on
                                similar listings. Don’t miss out on your chance to secure your dream home—register
                                today and stay informed about other properties that meet your needs.</p> */?>
                        </div>
                        <?php echo do_shortcode('[mcfi_form]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
</main>
<?php endwhile; // End the loop. ?>
<?php get_footer(); ?>