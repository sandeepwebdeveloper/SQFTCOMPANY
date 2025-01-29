<?php // Template Name: Home Page ?>
<?php get_header(); ?>
<section class="content-section__home-banner">
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-xl-12">
                <div class="swiper-container full-slider">
                    <div class="swiper-wrapper ">
                        <div class="swiper-slide">
                            <div class="slider-inner">
                                <div class="slider-img">
                                    <img src="/wp-content/uploads/2025/01/alex-shutin-uhn-U0sSxFQ-unsplash.jpg" alt=""
                                        class="parallax-image">
                                </div>
                                <div class="slide-content">
                                    <div class="container-fluid px-120">
                                        <div class="slide-heading">
                                            <h1>
                                                <span>
                                                    <strong>Experience the Future</strong>
                                                </span>
                                                <span>
                                                    <strong>of Urban Living.</strong>
                                                </span>
                                            </h1>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="slide-action">
        <span class="scroll-text">scroll down</span>
        <span class="hscroll-line"></span>
    </div>
    <?php /*
                                            <a href="#listing">
                                                <span>View Project
                                                    <img src="/wp-content/uploads/2024/07/long-arrow-white-right.svg"
                                                        alt="view project arrow">
                                                </span>
                                            </a> */?>
</section>

<section id="listing" class="content-section__home-projects global-section">
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
                            // Fetch the city category (assuming the taxonomy is 'city')
                            $city_terms = get_the_terms(get_the_ID(), 'city');
                            $city = $city_terms && !is_wp_error($city_terms) ? $city_terms[0]->name : 'City not specified';
                            ?>
                    <div class="col-md-6 col-xl-3">
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
                                    <a href="<?= esc_url(get_permalink()) ?>">View Project <span><img
                                                src="/wp-content/uploads/2024/07/right-arrow.svg" alt=""></span></a>
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
<section class="content-section__property-by-city">
    <div class="bg-red-overlay"></div>
    <div class="container-fluid zIndex-3 px-m-35">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading section-heading--white px-120 px-m-0">
                    <h3>Explore
                        <span>Properties by City</span>
                    </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="city-list px-120 px-m-0">
                    <ul>
                        <li><span>1.</span> Toronto </li>
                        <li><span>2.</span> Mississauga</li>
                        <li><span>3.</span> Brampton</li>
                        <li><span>4.</span> Hamilton</li>
                        <li><span>5.</span> London</li>
                        <li><span>6.</span> Markham</li>
                        <li><span>7.</span> Vaughan</li>
                        <li><span>8.</span> Kitchener</li>
                        <li><span>9.</span> Windsor</li>
                        <li><span>10.</span> Richmond Hill</li>
                        <li><span>11.</span> Oakville</li>
                        <li><span>12.</span> Burlington</li>
                        <li><span>13.</span> St. Catharines</li>
                        <li><span>14.</span> Guelph</li>
                        <li><span>15.</span> Barrie</li>
                        <li><span>16.</span> Cambridge</li>
                        <li><span>17.</span> Kingston</li>
                        <li><span>18.</span> Whitby</li>
                        <li><span>19.</span> Thunder Bay</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
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