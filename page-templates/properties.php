<?php // Template Name: Properties
 get_header(); ?>

<section id="listing" class="content-section__home-projects">
    <div class="container-fluid px-120">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h3>Upcoming Projects
                        <span>Pre-Construction</span>
                    </h3>
                </div>
            </div>
        </div>
        <div class="project-block">
            <div class="project-block-container">
                <div class="row">
                    <?php
                        // Define the query arguments
                        $args = [
                            'post_type' => 'property', // Your custom post type
                            'posts_per_page' => -1,    // Fetch all posts (you can limit this if you want)
                        ];

                        // Create a new query
                        $properties_query = new WP_Query($args);

                        // Start the Loop
                        if ($properties_query->have_posts()) :
                        while ($properties_query->have_posts()) : $properties_query->the_post();
                            // Fetch custom fields using ACF
                            $project_price = get_field('project_price') ?? 'Price not available';
                            $location = get_field('project_location') ?? 'Mississauga, Ontario';

                            // Fetch the status category (assuming the taxonomy is 'status')
                            $status_terms = get_the_terms(get_the_ID(), 'property-status');
                            $status = $status_terms && !is_wp_error($status_terms) ? $status_terms[0]->name : 'Status not available';
                            ?>
                            <div class="col-md-3">
                                <div class="project-block-grid">
                                    <div class="project-block-wrap">
                                        <div class="project-block-img">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('full', ['alt' => get_the_title()]); ?>
                                            <?php endif; ?>
                                            <div class="project-block-status">
                                                <span><?= esc_html($status) ?></span>
                                            </div>
                                        </div>
                                        <div class="project-block-title">
                                            <h3><?= esc_html(get_the_title()) ?></h3>
                                        </div>
                                        <div class="project-block-location">
                                            <span><?= esc_html($location) ?></span>
                                        </div>
                                        <div class="project-block-price">
                                            <span><?= esc_html($project_price) ?></span>
                                        </div>
                                        <div class="project-block-action">
                                            <a href="<?= esc_url(get_permalink()) ?>">View Project <span><img src="/wp-content/uploads/2024/07/right-arrow.svg" alt=""></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        endwhile;
                        wp_reset_postdata(); // Reset the query to avoid conflicts
                    else :
                        echo '<p>No properties found.</p>';
                    endif;
                    ?>
                </div>

            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>