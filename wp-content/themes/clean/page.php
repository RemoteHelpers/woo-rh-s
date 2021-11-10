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
    <main>

        <?php do_action('rh_main_page_filter'); ?>
        <div class="wrapper">

            <section class="card-section">
                <!--                --><?php
                //                    $args = array(
                //                        'post_type' => 'product',
                //                        'posts_per_page' => 10,
                //                    );
                //
                //                    $loop = new WP_Query($args);
                //
                //                    while ($loop->have_posts()) : $loop->the_post(); ?>
                <!---->
                <!--                        --><?php //wc_get_template_part( 'content', 'product' );?>
                <!---->
                <!--                    --><?php //endwhile;
                //
                //                    wp_reset_query();
                //                ?>
                <?php


                woocommerce_product_loop_start();
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 10,
                );
                $loop = new WP_Query($args);

                if ($loop->have_posts()) {

                    while ($loop -> have_posts()) : $loop->the_post(); {
                        the_post();

                        /**
                         * Hook: woocommerce_shop_loop.
                         */
                        do_action('woocommerce_shop_loop');

                        wc_get_template_part('content', 'product');

                    }
                    endwhile;
                    wp_reset_query();
                }


                woocommerce_product_loop_end();
                ?>
            </section>
        </div>
        <?php do_action('rh_main_page_closing_div'); ?>
    </main>


<?php

get_footer();
