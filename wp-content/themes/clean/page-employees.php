<?php
/**
 * The template for displaying employees page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package clean
 */

get_header();
?>


    <div class="section-title-box">
        <h1 class="section-title text-center">Find and Hire Remote Employee Here!</h1>
        <p class="section-subtitle">Watch Video Interviews with Candidates inside each Profile</p>
    </div>

    <div class="content-with-sidebar">
        <div class="sidebar">
            <?php echo do_shortcode('[pwf_filter id="323"]'); ?>
        </div>
        <div class="content ass">
            <?php
            if (woocommerce_product_loop()) {

                /**
                 * Hook: woocommerce_before_shop_loop.
                 *
                 * @hooked woocommerce_output_all_notices - 10
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                do_action('woocommerce_before_shop_loop');

                ?>

                <?php
                woocommerce_product_loop_start();

                if (wc_get_loop_prop('total')) {
                    while (have_posts()) {
                        the_post();

                        /**
                         * Hook: woocommerce_shop_loop.
                         */
                        do_action('woocommerce_shop_loop');

                        wc_get_template_part('content', 'product');

                    }
                }

                woocommerce_product_loop_end();

                /**
                 * Hook: woocommerce_after_shop_loop.
                 *
                 * @hooked woocommerce_.archive-pagepagination - 10
                 */
                do_action('woocommerce_after_shop_loop');
            } else {
                /**
                 * Hook: woocommerce_no_products_found.
                 *
                 * @hooked wc_no_products_found - 10
                 */
                do_action('woocommerce_no_products_found');
            }
            ?>

        </div>
    </div>


<?php

get_footer();
