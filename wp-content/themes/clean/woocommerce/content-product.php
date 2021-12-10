<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
?>
<?php
    add_action("related_cards", "cards", 20 );
    function cards () { ?>

<li>
    <div class="card" id="card">
        <a href="<?php echo get_post_permalink() ?>">
        <header>
            <?php if ( $product->is_on_sale() ) : ?>
                <div style="background-color: <?php echo get_field('current_work_status') ?>">


                    <?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( '%', 'woocommerce' ) . '</span>', $post, $product ); ?>


                </div>
            <?php
            endif;
            ?>
            <div class="woocommerce-product-rating">
                <?php

                ?>
            </div>

        </header>
        <main>
            <img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>"
                 alt="Product image">
            <div class="product__id">
                <div class="product__id_name">ID: <?php echo $product->get_sku(); ?></div>
                <div class="product__id_time"><span class="tooltip" data-title="Employee Work Shift"><i class="<?php echo get_field('shifts') ?>" > </i></span>

                </div>
            </div>

            <?php the_title( '<h3 class="product__first_name" >', '</h3>' ); ?>

            <div class="product__position"><?php the_field('current_position') ?></div>
            <!--//TODO: change h5 to div and insert blocks-->
            <div class="skill-items">
                <?php echo wc_get_product_tag_list($product->get_id(), ' ') ?>
                <!--                <a href="">CSS</a>-->
            </div>
        </main>
        <footer>
            <a href="<?php echo get_post_permalink() ?>">View Profile</a>
            <!--FIXME: add link to post-->
        </footer>
        </a>
    </div>
</li>

<?php } ?>

