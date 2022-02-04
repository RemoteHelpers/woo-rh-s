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

<li>
    <div class="card" id="card">
        <header>
            <div style="background-color: <?php echo get_field('current_work_status') ?>">
                <i class="<?php echo get_field('shifts') ?>"></i>
                <span>#<?php echo $product->get_sku(); ?></span>
            </div>
        </header>
        <main>
            <img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>"
                 alt="Product image">
            <?php $name = get_field('last_name') ?>
            <H3><?php the_field('first_name'); ?> <?php echo $name[0]?>.</H3>
            <div><?php the_field('current_position') ?></div>
            <!--//TODO: change h5 to div and insert blocks-->
            <hr>
            <div class="skill-items" id="skillCount">
                <?php echo wc_get_product_tag_list($product->get_id(), ' ') ?>
                <!--                <a href="">CSS</a>-->
            </div>
        </main>
        <footer>
            <a href="<?php echo get_post_permalink() ?>">Watch Employee cv</a>
            <!--FIXME: add link to post-->
        </footer>
    </div>
</li>


