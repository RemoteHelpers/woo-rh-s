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

$skill_count = 0;

?>

<article class="card" id="card">
    <a href="<?php echo get_post_permalink() ?>">
        <header class="card_top">
            <?php if ($product->is_on_sale()) : ?>
                <div style="background-color: <?php echo get_field('current_work_status') ?>">

                    <?php echo apply_filters('woocommerce_sale_flash', '<span class="onsale">' . esc_html__('%', 'woocommerce') . '</span>', $post, $product); ?>

                </div>
            <?php
            endif;
            ?>
            <!--            <div class="woocommerce-product-rating">-->
            <!--                --><?php
            //
            //                ?>
            <!--            </div>-->

        </header>
        <div class="card_content">
            <img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>"
                 alt="Person image">
            <div class="product__id">
                <span class="product__id_name">ID: <?php echo $product->get_id(); ?></span>
                <span class="tooltip product__id_time" data-title="Employee Work Shift"><i
                            class="<?php echo get_field('shifts') ?>"> </i></span>
            </div>

            <?php the_title('<h3 class="product__first_name" >', '</h3>'); ?>

            <div class="product__position"><?php the_field('current_position') ?></div>
            <div class="skill-items" id="skillCount">

                <?php $skill_count = wc_get_product_tag_list($product->get_id(), ';');
                $skill_array = explode(';', $skill_count);

                $card_width = 200;
                $card_padding = 16;
                $padding = 16;
                $gap = 8;
                $lower_char = 5;
                $upper_char = 8;

                $row_width = $card_width - ($card_padding * 2);
                $skill_length = 0;
                $hidden_skills = $skill_array;

                foreach ($skill_array as $key => $skill) {
                    if ($skill_length > ($row_width * 2)) {
                        break;
                    }

                    $stripped = strip_tags($skill);
                    $lowercase = mb_strtolower($stripped);
                    $uppercase_chars = strlen($lowercase) - similar_text($stripped, $lowercase);
                    $lowercase_chars = strlen($stripped) - $uppercase_chars;

                    $length = ($uppercase_chars * $upper_char) + ($lowercase_chars * $lower_char) + ($padding * 2) + $gap;

                    echo $skill;

                    $skill_length += $length;
                    unset($hidden_skills[$key]);
                }
                ?>

                <?php
                $hidden_skills_count = count($hidden_skills);

                if (!empty($hidden_skills_count)) : ?>
                    <span class="count">+<?php echo $hidden_skills_count; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <footer class="card_bottom">
            <a href="<?php echo get_post_permalink() ?>">View Profile</a>
        </footer>
    </a>
</article>


<?php

?>
