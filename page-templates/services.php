<?php // Template Name: Services Page
 get_header(); ?>
<section class="content-section__services">
    <div class="container-fluid px-120">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h3>Services
                        <span>Expert Guidance, Reliable Results</span>
                    </h3>
                </div>
            </div>
        </div>
        <?php
            $args = array(
                'post_type'      => 'services',
                'posts_per_page' => -1, // Get all services
                'post_status'    => 'publish',
            );
            $services_query = new WP_Query($args);
            if ($services_query->have_posts()) : ?>
        <div class="row">
            <?php while ($services_query->have_posts()) : $services_query->the_post(); ?>
            <div class="col-md-6 col-xl-3">
                <div class="services-block">
                    <div class="services-block--wrap">
                        <div class="services-block--title">
                            <h3><?php the_title(); ?></h3>
                        </div>
                        <div class="services-block--text">
                            <p><?php the_excerpt(); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php wp_reset_postdata(); ?>
        <?php else : ?>
        <p><?php _e('No services found', 'textdomain'); ?></p>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>