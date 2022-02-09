<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}

?>
<div class="gallery-backdrop">
    <i class="fas fa-times gallery-close"></i>
    <i class="fas fa-arrow-left gallery-prev"></i>
    <i class="fas fa-arrow-right gallery-next"></i>
    <div class="gallery-container">
        <img class="gallery-image" src="">
    </div>
    <div class="gallery-thumbnails"></div>
</div>

<div class="white-backdrop">

    <<i class="fas fa-times"></i>

    <div class="backdrop-center">

        <div class="popup-calendar">
            <!-- Calendly inline widget begin -->
            <div class="calendly-inline-widget"
                 data-url="https://calendly.com/gagarinbrood/book-a-meeting?primary_color=ff5252"
                 style="min-width:320px;height:650px;"></div>
            <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
            <!-- Calendly inline widget end -->
        </div>

    </div>

</div>

<div class="container">

    <div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

        <?php get_template_part('template-parts/rh/single-product-sidebar'); ?>

        <?php get_template_part('template-parts/rh/single-product-body'); ?>

    </div>

</div>

<div class="rh-related">
    <div class="container">
        <?php

//        getRandomCategory(4);
        getProductsByAcf('current_position', 'Lead generation manager');

        ?>
    </div>
</div>

<!--    --><?php
//        /** Hook: woocommerce_after_single_product_summary.
//         *
//         * @hooked woocommerce_output_product_data_tabs - 10
//         * @hooked woocommerce_upsell_display - 15
//         * @hooked woocommerce_output_related_products - 20
//         */
//        do_action( 'woocommerce_after_single_product_summary' );
//    ?>



<?php //do_action( 'woocommerce_after_single_product' );

// * Hook: woocommerce_before_single_product.
// *
// * @hooked woocommerce_output_all_notices - 10
// */
//do_action( 'woocommerce_before_single_product' );


//     * Hook: woocommerce_before_single_product_summary.
//     *
//     * @hooked woocommerce_show_product_sale_flash - 10
//     * @hooked woocommerce_show_product_images - 20
//     */
//    do_action( 'woocommerce_before_single_product_summary' );


//         * Hook: woocommerce_single_product_summary.
//         *
//         * @hooked woocommerce_template_single_title - 5
//         * @hooked woocommerce_template_single_rating - 10
//         * @hooked woocommerce_template_single_price - 10
//         * @hooked woocommerce_template_single_excerpt - 20
//         * @hooked woocommerce_template_single_add_to_cart - 30
//         * @hooked woocommerce_template_single_meta - 40
//         * @hooked woocommerce_template_single_sharing - 50
//         * @hooked WC_Structured_Data::generate_product_data() - 60
//         */
//        do_action( 'woocommerce_single_product_summary' );


//     * Hook: woocommerce_after_single_product_summary.
//     *
//     * @hooked woocommerce_output_product_data_tabs - 10
//     * @hooked woocommerce_upsell_display - 15
//     * @hooked woocommerce_output_related_products - 20
//     */
//    do_action( 'woocommerce_after_single_product_summary' );
?>
