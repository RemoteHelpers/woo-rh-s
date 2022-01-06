<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package clean
 */

get_header();
$circle_bg = get_field('circle_background');
//pprint_r($circle_bg['circle_number']);
acf_localize_data(array('circleQuantity' => $circle_bg));
?>

    <main class="home-page">

        <!--==============
        // Hero section
        //==============-->

        <section class="hero-section" id="set-call">

            <img class="hero-image" src="<?php the_field('home_page_hero_background_image'); ?>">

            <video class="hero-video" autoplay muted loop id="backgroundVideo">
                <source src="http://new.rh-s.com/wp-content/uploads/2022/01/Offices_Tour_Remote_helpers_small_size.mp4"
                        type="video/mp4">
            </video>

            <div class="hero-cta">

                <h1><?php echo get_field('home_page_hero_heading') ?></h1>

                <div class="cta-scroller-container">
                    <h2 class="cta-subtitle">Full-time virtual <span class="scroller">Designers</span></h2>
                </div>

                <div class="cta-footer">
                    <p class="only-mobile">Give us a call</p>

                    <div class="cta-btn-container">
                        <button class="rh-button set-up-call" href="#"><i class="far fa-hand-spock"></i>Set up call
                        </button>
                        <button class="rh-button contact-us" href="#"><i class="far fa-envelope"></i>Contact us</button>
                    </div>

                    <p class="only-mobile">Nothing understood?</p>
                    <p class="only-mobile">Let's clarify</p>
                </div>

                <p class="cta-motto">No taxes, no fees, no virus, no risk!</p>
            </div>

        </section>

        <!--==================
        // Employee counter
        //==================-->

        <section class="employee-counter">
            <div>
                <div class="counter-numbers"
                     data-target="<?php echo get_field('home_page_employee_counter'); ?>"><?php echo get_field('home_page_employee_counter'); ?>
                    +
                </div>
                <div class="counter-text">Remote Employees</div>
            </div>
            <div>
                <div class="counter-numbers"
                     data-target="<?php echo get_field('home_page_employee_cities'); ?>"><?php echo get_field('home_page_employee_cities'); ?>
                    +
                </div>
                <div class="counter-text">Cities of employees placement</div>
            </div>
            <div>
                <div class="counter-numbers"
                     data-target="<?php echo get_field('home_page_years_in_business'); ?>"><?php echo get_field('home_page_years_in_business'); ?>
                    +
                </div>
                <div class="counter-text">Years in business</div>
            </div>
            <div>
                <div class="counter-numbers"
                     data-target="<?php echo get_field('home_page_companies_we_work_with'); ?>"><?php echo get_field('home_page_companies_we_work_with'); ?>
                    +
                </div>
                <div class="counter-text">Companies we work with</div>
            </div>
        </section>

        <div class="container">

            <!--=====================
            // Company description
            //=====================-->

            <section class="padding-3 short-description">
                <p><?php echo get_field('home_page_short_company_description') ?></p>
            </section>

            <!--======================
            // Special offer banner
            //======================-->

            <section class="padding-3 special-offer"
                     style="background-image: url('<?php the_field('home_page_special_offer_bg') ?>')">

                <div class="sale-desc">
                    <h2>Christmas Sale!</h2>
                    <p>up to 5-20% OFF</p>
                    <p>Special Offer</p>
                </div>

                <span class="divider"></span>

                <div class="sale-counter">
                    <p>Off ends:</p>
                    <div class="sale-counter-date"></div>
                    <button href="#" class="rh-button sale-link">Watch here!</button>
                </div>

            </section>

            <!--================
            // Employee-cards
            //================-->

            <section class="padding-3">

                <div class="section-title-box" id="all-cvs">
                    <h2 class="section-title">Available Virtual Assistants for Immediate Start</h2>
                    <span class="section-subtitle">Find video interviews inside the CVs to save your time!</span>
                </div>

                <ul class="category-pills">
                    <?php
                    $categories = get_categories([
                        'taxonomy' => 'product_cat',
                    ]);
                    foreach ($categories as $cat) {
                        if (0 == $cat->parent) { ?>
                            <li>
                                <a href="<?php echo get_category_link($cat->cat_ID); ?>">
                                    <?php echo $cat->name; ?>
                                </a>
                            </li>

                        <?php }
                    }
                    ?>
                </ul>

                <!-- the cards loop -->
                <div class="card-container padding-3">
                    <canvas class="canvas-bg"></canvas>
                    <?php

                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 10
                        //'product_cat'    => 'Development'
                    );

                    woocommerce_product_loop_start();

                    $loop = new WP_Query($args);

                    while ($loop->have_posts()) : $loop->the_post();
                        do_action('woocommerce_shop_loop');

                        wc_get_template_part('content', 'product');
                    endwhile;

                    wp_reset_query();

                    woocommerce_product_loop_end(); ?>

                </div>


                <button class="rh-button margin-auto">See All CV's</button>

            </section>

            <!--===============
            // Hiring process
            //===============-->

            <section class="padding-3">

                <div class="section-title-box">
                    <h2 class="section-title">Simple process of hiring Dedicated Employees</h2>
                </div>

                <ul class="hiring-process padding-3">
                    <?php
                    if (have_rows('home_page_hiring_steps')) :
                        $counter = 1;
                        while (have_rows('home_page_hiring_steps')) : the_row(); ?>
                            <li>
                                <div class="icon-circle">
                                    <div>Step <?php echo $counter; ?></div>
                                    <i class="<?php the_sub_field('hiring_icon') ?>"></i>
                                </div>
                                <?php
                                $hiring_url = get_sub_field('hiring_url');
                                if ($hiring_url) {
                                    ?>
                                    <a href="<?php the_sub_field('hiring_url') ?>"><?php the_sub_field('hiring_title'); ?></a>
                                <?php } else { ?>
                                    <span><?php the_sub_field('hiring_title'); ?></span>
                                <?php } ?>
                                <p><?php the_sub_field('hiring_description'); ?></p>
                            </li>
                            <?php $counter++; ?>
                        <?php
                        endwhile;
                    endif
                    ?>
                </ul>

            </section>

        </div>

        <!--==================
        // Affiliate section
        //==================-->

        <section class="padding-3 bg-white">

            <div class="container">

                <div class="section-title-box">
                    <h2 class="section-title">Become our company’s affiliate partner</h2>
                </div>

                <p class="font-1-18 text-center"><?php the_field('home_page_affiliate_description'); ?></p>

                <button class="rh-button margin-auto"><i class="far fa-handshake" aria-hidden="true"></i>Affiliate page
                </button>

            </div>

        </section>

        <!--============
        // Our clients
        //============-->

        <section class="padding-3">

            <div class="section-title-box">
                <h2 class="section-title">Our clients</h2>
            </div>

            <ul class="clients-slider">
                <?php
                $logos = get_field('home_page_clients');
                foreach ($logos as $logo) { ?>
                    <li>
                        <img src="<?php echo esc_url($logo['sizes']['medium']); ?>" alt="company-logo">
                    </li>
                    <?php
                }
                ?>
            </ul>

        </section>

        <!--=============
        // Testimonials
        //=============-->

        <div class="container">

            <section class="padding-3">

                <div class="section-title-box">
                    <h2 class="section-title">Testimonials</h2>
                </div>

                <ul class="testimonials-slider">

                    <?php
                    if (have_rows('home_page_client_reviews')) :
                        while (have_rows('home_page_client_reviews')) : the_row(); ?>
                            <li>
                                <?php the_sub_field('client_message'); ?>
                                <div class="testimonial-footer">
                                    <img src="<?php the_sub_field('client_image'); ?>">
                                    <div class="footer-text">
                                        <p class="client-name"><?php the_sub_field('client_name'); ?></p>
                                        <p class="client-position"><?php the_sub_field('client_pos'); ?></p>
                                    </div>
                                </div>
                            </li>
                        <?php
                        endwhile;
                    endif;
                    ?>

                </ul>

            </section>

        </div>

        <!--=============
        // Contact form
        //=============-->

        <section class="padding-4r">

            <?php get_template_part('/template-parts/contact-us-form') ?>

        </section>

    </main>

<?php

get_footer();