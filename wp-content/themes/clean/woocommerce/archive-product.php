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

get_header('shop');

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
        <section class="category">
            <div class="category__section header_block">
                <div class="category__block category__text">
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
                    <div class="category__btn">
                        Download presentation
                    </div>
                </div>
                <div class="category__block category__video">
                    <iframe src="
                    <?php
                    $term = get_queried_object();
                    $heading_video = get_field('heading_video', $term);
                    echo $heading_video
                    ?>
                    ">
                    </iframe>

                </div>
            </div>
            <div class="category__main_text">
                <?php
                $term = get_queried_object();
                $main_text = get_field('main_text', $term);
                echo $main_text
                ?>
            </div>
            <div class="category__section first__block">
                <div class="category__block category__text">
                    <div class="text__title">
                        <img src="<?php
                        $term = get_queried_object();
                        $block_image = get_field('block_image', $term);
                        echo $block_image
                        ?>" alt="">
                        <p>
                            <?php
                            $term = get_queried_object();
                            $block_title = get_field('block_title', $term);
                            echo $block_title
                            ?>
                        </p>
                    </div>
                    <div class="text__subtitle">
                        <?php
                        $term = get_queried_object();
                        $block_subtitle = get_field('block_subtitle', $term);
                        echo $block_subtitle
                        ?>
                    </div>
                    <div class="text__btn_grey">Choose available {Employee}</div>
                </div>
                <div class="category__block category__slider_block">
                    <div class="category__slider">
                        <img src="<?php
                        $term = get_queried_object();
                        $img_slider = get_field('img_slider', $term);
                        echo $img_slider
                        ?>" alt="">
                    </div>
                </div>

            </div>
            <div class="category__section first__block reverce__block">
                <div class="category__block category__text">
                    <div class="text__title">
                        <img src="<?php
                        $term = get_queried_object();
                        $block_image_copy = get_field('block_image_copy', $term);
                        echo $block_image_copy
                        ?>" alt="">
                        <p>
                            <?php
                            $term = get_queried_object();
                            $block_title_copy = get_field('block_title_copy', $term);
                            echo $block_title_copy
                            ?>
                        </p>
                    </div>
                    <div class="text__subtitle">
                        <?php
                        $term = get_queried_object();
                        $block_subtitle_copy = get_field('block_subtitle_copy', $term);
                        echo $block_subtitle_copy
                        ?>
                    </div>
                    <div class="text__btn_red">Choose available {Employee}</div>
                </div>
                <div class="category__block category__slider_block">
                    <div class="category__slider">
                        <?php
                        $term = get_queried_object();
                        $img_slider_copy = get_field('img_slider_copy', $term);

                        echo '<img src="'.$img_slider_copy.'">';
                        ?>
                    </div>
                </div>

            </div>
            <div class="category__related">
                <div class="category__related_title">
                    <?php
                    $term = get_queried_object();
                    $main_text_related = get_field('main_text_related', $term);
                    echo $main_text_related
                    ?>
                </div>
                <div class="category__related_cards">
                    <?php
                      echo getProductsByAcf("Analyst");
                    ?>
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
    <script>
        jQuery(document).ready(function(){
            jQuery('.category__slider').slick({
                dots: true,
                arrows: true,
            });
        });
    </script>


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
