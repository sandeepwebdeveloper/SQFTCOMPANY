<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<main class="single-project-page">
    <div class="primary-block">
        <section class="single-project-banner">
            <div class="container-fluid px-120 px-m-0">
                <div class="single-banner-wrapper">
                    <div class="single-banner-block">
                        <div class="row lign-items-center">
                            <div class="col-md-10 order-2 order-xl-1">
                                <div class="sigle-banner-title px-m-35">
                                    <h1>
                                        <?php the_title(); 
                                            $city_terms = get_the_terms(get_the_ID(), 'cities');
                                            $city = $city_terms && !is_wp_error($city_terms) ? $city_terms[0]->name : 'City not specified';
                                        ?>
                                        <?php $project_sub_title = get_field('project_sub_title') ?? ' '; 
                                        $location = get_field('project_location') ?? 'Mississauga, Ontario'; 
                                        ?>
                                        <?php if($project_sub_title){ ?>
                                        <h2>
                                            <?php echo $project_sub_title; ?>

                                        </h2>
                                        <?php } ?>
                                        <div class="location-text">
                                            <span>
                                                <img src="/wp-content/uploads/2025/01/location.svg"
                                                    alt="Location <?php echo $city; ?>">
                                            </span>
                                            <span><?php echo $location .', '.$city; ?></span>
                                        </div>

                                    </h1>
                                </div>
                            </div>
                            <div class="col-md-2 order-2 order-xl-2">
                                <div class="register-action">
                                    <a class="btn btn-primary" href="#register">Register Now</a>
                                </div>
                            </div>
                            <div class="col-xl-12 order-1 order-xl-3">
                                <div class="single-banner-image mb-4 mb-xl-0">
                                    <?php $thumbnail_url = get_the_post_thumbnail_url(get_the_ID()); ?>
                                    <img src="<?php echo $thumbnail_url; ?>" alt="<?php the_title(); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="property-cover d-none d-xl-block">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="single-header-wrap">
                                        <div class="sigle-banner-content">
                                            <?php the_content(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="property-wrap">
                                        <div class="property-content">
                                            <ul>
                                                <li>
                                                    <span class="property-attr-title">Location</span>
                                                    <span class="property-attr-data">
                                                        <?php echo $location = get_field('project_location') ?? 'Mississauga, Ontario'; ?>,
                                                        <?php echo $city; ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="property-attr-title">Price</span>
                                                    <span class="property-attr-data">
                                                        <?php $project_price = get_field('project_price') ?? 'Mississauga, Ontario'; ?>
                                                        <?php echo $project_price; ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="property-attr-title">Building Type</span>
                                                    <span class="property-attr-data">
                                                        <?php $Building_type = get_field('Building_type') ?? 'Mississauga, Ontario'; ?>
                                                        <?php echo $Building_type; ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="property-attr-title">Building Size</span>
                                                    <span class="property-attr-data">
                                                        <?php $Building_Size = get_field('Building_Size') ?? 'Mississauga, Ontario'; ?>
                                                        <?php echo $Building_Size; ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="property-attr-title">Avilable Unit</span>
                                                    <span class="property-attr-data">
                                                        <?php $project_available_unit = get_field('project_available_unit') ?? 'Mississauga, Ontario'; ?>
                                                        <?php echo $project_available_unit; ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="property-attr-title">Estimated Occupancy</span>
                                                    <span class="property-attr-data">
                                                        <?php $project_occupancy = get_field('project_occupancy') ?? 'Mississauga, Ontario'; ?>
                                                        <?php echo $project_occupancy; ?>
                                                    </span>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-block"></div>
        </section>
        <div class="d-none d-xl-block">
            <?php echo get_template_part('/template-parts/project-gallery'); ?>
        </div>
        <section id="register" class="content-section__site-register">
            <div class="container-fluid px-m-35">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="register-block">
                            <div class="section-heading text-center">
                                <h3>
                                    <span>Register for More Information </span>
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
        <div class="d-xl-none">
            <?php echo get_template_part('/template-parts/project-gallery'); ?>
        </div>
    </div>
</main>
<?php endwhile; // End the loop. ?>
<?php get_footer(); ?>