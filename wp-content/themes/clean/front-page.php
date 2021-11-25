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
?>

    <main class="home-page">
        <section class="first-section">
            <video autoplay muted loop id="backgroundVideo">
                <source src="https://new.rh-s.com/wp-content/uploads/2021/11/Offices-Tour-Remote-helpers-short.mp4"
                        type="video/mp4">
            </video>
            <H1><?php echo get_field('first_section_heading') ?></H1>
            <div class="slider-text-cont">
                <H2>Full-time virtual </H2>
                <div class="scroller">
                    <div class="inner">
                        <p>Designers</p>
                        <p>Developers</p>
                        <p>Managers</p>
                        <p>Employees</p>
                        <p>Assistance</p>
                    </div>
                </div>
            </div>
            <div class="first-button-cont">
                <a class="set-up-call" href="#"><i class="far fa-hand-spock"></i>Set up call</a>
                <a class="contact-us" href="#"><i class="far fa-envelope"></i>Contact us</a>
            </div>
            <p class="no-taxes">No taxes, no fees, no virus, no risk!</p>

        </section>
        <section class="employee-counter">
            <div>
                <div class="counter-numb"
                     data-target="<?php echo get_field('remote_employees_counter') ?>"><?php echo get_field('remote_employees_counter') ?>
                    +
                </div>
                <div class="counter-text">Remote Employees</div>
            </div>
            <div>
                <div class="counter-numb"
                     data-target="<?php echo get_field('employees_placement') ?>"><?php echo get_field('employees_placement') ?>
                    +
                </div>
                <div class="counter-text">Cities of employees placement</div>
            </div>
            <div>
                <div class="counter-numb"
                     data-target="<?php echo get_field('years_in_business') ?>"><?php echo get_field('years_in_business') ?>
                    +
                </div>
                <div class="counter-text">Years in business</div>
            </div>
            <div>
                <div class="counter-numb"
                     data-target="<?php echo get_field('companies_work_with') ?>"><?php echo get_field('companies_work_with') ?>
                    +
                </div>
                <div class="counter-text">Companies we work with</div>
            </div>
        </section>
        <section class="short-description">
            <p><?php echo get_field('short_description') ?></p>
        </section>

        <section class="special-offer">
            <div class="sale-descr">
                <H1>Christmas Sale!</H1>
                <p>5-20% OFF</p>
                <p>Special Offer</p>
            </div>
            <span class="divider"></span>
            <div class="sale-counter">
                <p>Off ends:</p>
                <div class="sale-counter-date"></div>
                <a href="#" class="sale-link">Watch here!</a>
            </div>
        </section>
        <section class="employees-card">
            <?php

            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 10
                //'product_cat'    => 'Development'
            );

            woocommerce_product_loop_start();

            $loop = new WP_Query($args);

            while ($loop->have_posts()) : $loop->the_post();
                //the_post();
                global $product;
                /**
                 * Hook: woocommerce_shop_loop.
                 */
                do_action('woocommerce_shop_loop');

                wc_get_template_part('content', 'product');
            endwhile;

            wp_reset_query();

            woocommerce_product_loop_end(); ?>
        </section>
        <section class="price-cards">

            <H1>Full-Time Remote Employees <span>Prices</span></H1>

            <?php if (have_rows('pricing_cards_home')): while (have_rows('pricing_cards_home')) : the_row(); ?>

                <div class="pricing-card-home">
                    <section class="pricing-card-header">
                        <H3><?php the_sub_field('category_name'); ?></H3>

                    </section>
                    <main>
                        <span class="card-price"><span class=""><sup>€</sup></span><span><?php the_sub_field('price_card_home'); ?></span></span>
                        <div class="card-positions"><?php if (have_rows('positions_card_repeater')): while (have_rows('positions_card_repeater')) : the_row(); ?>
                            <span><?php the_sub_field('position_pricing_cards');?></span>
                            <?php endwhile; endif; ?>
                        </div>

                    </main>
                    <section class="pricing-card-footer">
                        <span class="work-hours"><?php the_sub_field('hours_cards_home'); ?></span>

                    </section>
                </div>

            <?php endwhile; endif; ?>

        </section>

    </main>


<?php
get_footer();