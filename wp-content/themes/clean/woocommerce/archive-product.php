<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header();

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');

?>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>
    <div class="wrapper">
<!--        <header class="woocommerce-products-header">-->
<!--            --><?php //if (apply_filters('woocommerce_show_page_title', true)) : ?>
<!--                <h1 class="woocommerce-products-header__title page-title">--><?php //woocommerce_page_title(); ?><!--</h1>-->
<!--            --><?php //endif; ?>
<!---->
<!--            --><?php
//            /**
//             * Hook: woocommerce_archive_description.
//             *
//             * @hooked woocommerce_taxonomy_archive_description - 10
//             * @hooked woocommerce_product_archive_description - 10
//             */
//            do_action('woocommerce_archive_description');
//            ?>
<!---->
<!--        </header>-->
        <section class="category">
            <div class="main__category">
                <div class="category__hero">
                    <div class="category__text">
                        <div class="category__title">
                            <?php
                            $term = get_queried_object();
                            $heading = get_field('heading', $term);
                            echo $heading
                            ?>
                        </div>
                        <div class="category__subtitle">
                            <?php
                            $term = get_queried_object();
                            $description = get_field('description', $term);
                            echo $description
                            ?>
                        </div>
                        <a href="#contact-form" class="category__btn">Contact Us</a>
                    </div>
                    <div class="category__video"><iframe  src="<?php
                        $term = get_queried_object();
                        $heading_video = get_field('heading_video', $term);
                        echo $heading_video
                        ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                </div>
                <div class="category__candidate">
                    <div class="candidate__title"><span style="color: #ff5252;">Choose</span> your candidate skills!</div>
                    <div class="candidate__subtitle">
                        <?php
                        $term = get_queried_object();
                        $cards_heading = get_field('cards_heading', $term);
                        echo $cards_heading
                        ?>
                    </div>
                </div>

            </div>

        </section>
        <?php do_action('rh_archive_filter'); ?>

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

        <section class="card-section">
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

            do_action('rh_add_closing_div');
            ?>
        </section>
        <div class="category__candidate">
            <div class="candidate__title">
                <?php
                $term = get_queried_object();
                $position_heading = get_field('position_heading', $term);
                echo $position_heading
                ?>
            </div>
            <div class="candidate__subtitle">
                <?php
                $term = get_queried_object();
                $position_small_description = get_field('position_small_description', $term);
                echo $position_small_description
                ?>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $('.candidate__servises_block').slick({
                    mobileFirst: true,
                    responsive: [
                        {
                            breakpoint: 1100,
                            settings: 'unslick'
                        }
                    ]
                });
            });
        </script>
        <div class="canditate__servises">
            <div class="candidate__servises_block">
                <?php
                // name of repeater field
                $repeater = 'positions';

                // get taxonomy id
                $taxonomy_id = get_queried_object_id();

                // get repeater data from term meta
                $post_meta = get_term_meta($taxonomy_id, $repeater, true);

                // count items in repeater
                $count = intval(get_term_meta($taxonomy_id, $repeater, true));

                // loop + apply filter the_content to preserve html formatting
                for ($i=0; $i<$count; $i++) {
                    echo '<div class="candidate__servises_content">';
                    echo '<div class="candidate__servises_icon">';
                    echo apply_filters('the_content', get_term_meta($taxonomy_id, $repeater.'_'.$i.'_'.'icon', true));
                    echo '</div>';
                    echo '<div class="candidate__servises_title">';
                    echo apply_filters('the_content', get_term_meta($taxonomy_id, $repeater.'_'.$i.'_'.'title_rep', true));
                    echo '</div>';
                    echo '<div class="candidate__servises_subtitle">';
                    echo apply_filters('the_content', get_term_meta($taxonomy_id, $repeater.'_'.$i.'_'.'description_repeater', true));
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
            <div class="category__candidate">
                <div class="candidate__title">
                    <?php
                    $term = get_queried_object();
                    $position_heading = get_field('title_portfolio', $term);
                    echo $position_heading
                    ?>
                </div>
                <div class="candidate__subtitle">
                    <?php
                    $term = get_queried_object();
                    $position_small_description = get_field('description_portfio_txt', $term);
                    echo $position_small_description
                    ?>
                </div>
            </div>
        </div>
        <section class="form">
            <div class="contact__form">
                <div class="form__text">
                    <div class="form__title">Set a call with us</div>
                    <div class="form__subtitle">In order to book a meeting please choose on the calendar and leave  your contact details. Looking forward to speak to you!</div>
                </div>
                <div class="form__cf7">
                    <?php
                       echo do_shortcode('[contact-form-7 id="411" title="Contact form 1"]')
                    ?>
                </div>
            </div>
        </section>
    </div>


<?php

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action('woocommerce_sidebar');

get_footer('shop');
