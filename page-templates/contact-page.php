<?php // Template Name: Contact Page
 get_header(); ?>
<section class="content-section__contact-page">
    <div class="container-fluid ps-c-120 pe-0">
        <div class="row align-items-center">
            <div class="col-md-4 order-2 order-xl-1">
                <div class="contact-page-text">
                    <h1>
                        <span>SQFT Company</span>
                        Connect with Us <br />for Exclusive Opportunities
                    </h1>
                    <div class="contact-message">
                        <p>We’d love to hear from you! Whether you’re looking for your dream home, want to learn more
                            about
                            our projects, or need expert advice on real estate investments, our team is here to help.
                        </p>
                        <div class="contact-action">
                            <p>
                                <span>Email: <a href="mailto:tarun@sqftcompany.com">tarun@sqftcompany.com</a></span>
                                <span>Phone: <a href="tel:437-453-9555">437-453-9555</a></span>
                            </p>
                            <?php do_action( 'add_social_media' ); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 order-1 order-xl-2">
                <div class="contact-image">
                    <img src="/wp-content/uploads/2025/01/benno-klandt-Qr5pi1_GlvY-unsplash-scaled.jpg"
                        alt="Contact Us">
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>