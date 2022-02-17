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

///**
// * Hook: woocommerce_before_main_content.
// *
// * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
// * @hooked woocommerce_breadcrumb - 20
// * @hooked WC_Structured_Data::generate_website_data() - 30
// */
//do_action('woocommerce_before_main_content');

?>

<?php // echo get_the_title( get_option( 'woocommerce_shop_page_id' ) ); ?>

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
                <a href="#" class="category__btn">
                    Download presentation
                </a>
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


        <?php 
                $term = get_queried_object();
                $taxonomy = $term->taxonomy;
                $term_id = $term->term_id;  
                if( have_rows('block_content', $taxonomy . '_' . $term_id) ):
                while(have_rows('block_content', $taxonomy . '_' . $term_id)): 
                the_row(); 
            ?> 
            <div class="category__reverce">
            <div class="category__component category">
                <div class="component__block">
                    <div class="component__text">
                        <div class="component__icon">
                            <img src="<?php the_sub_field('component_icon', $taxonomy . '_' . $term_id) ?>" alt="">
                        </div>
                        <div class="component__title"><?php the_sub_field('component_title', $taxonomy . '_' . $term_id) ?></div>
                    </div>
                    <div class="component__subtitle"><?php the_sub_field('component_subtitle', $taxonomy . '_' . $term_id) ?></div>
                    <a href="#" class="component__btn"> <div><?php the_sub_field('component_button', $taxonomy . '_' . $term_id) ?></div></a>
                </div>
                <div class="component__block">
                    <div class="component__slider">
                        <?php 
                            $term = get_queried_object();
                            $taxonomy = $term->taxonomy;
                            $term_id = $term->term_id;  
                            if( have_rows('component_slider', $taxonomy . '_' . $term_id) ):
                            while(have_rows('component_slider', $taxonomy . '_' . $term_id)): 
                            the_row(); 
                        ?> 
                        <div class="component__slide">
                          <img src="<?php the_sub_field('slider_image', $taxonomy . '_' . $term_id) ?>" alt="">
                        </div>
                        <?php endwhile; endif; ?>  
                    </div>
                </div>
            </div> 
             
            <div class="category__related">
                <div class="category__related_title">
                    <?php@media only screen and (max - width: 767px)
                    $term = get_queried_object();
                    $main_text_related = get_field('main_text_related', $term);
                    echo $main_text_related
                    ?>
                </div>
                <div class="category__related_cards">
                    <?php
                    getProductsByAcf("current_position", "Video editor");
                    ?>
                </div>
            </div>
            </div>
        <?php endwhile; endif; ?>  
    </section>
    <div class="content-with-sidebar">
        <div class="sidebar">
            <div class="sticky-filter">
                <?php echo do_shortcode('[pwf_filter id="323"]'); ?>
            </div>
            <div class="btn-container">
                <div class="hide-btn only-desktop">
                    <i class="fa fa-filter"></i>
                </div>
            </div>
        </div>
        <div class="content">
            <?php
            if (woocommerce_product_loop()) {

//                /**
//                 * Hook: woocommerce_before_shop_loop.
//                 *
//                 * @hooked woocommerce_output_all_notices - 10
//                 * @hooked woocommerce_result_count - 20
//                 * @hooked woocommerce_catalog_ordering - 30
//                 */
//                do_action('woocommerce_before_shop_loop');

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

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');

///**
// * Hook: woocommerce_sidebar.
// *
// * @hooked woocommerce_get_sidebar - 10
// */
//do_action('woocommerce_sidebar');


get_footer();
