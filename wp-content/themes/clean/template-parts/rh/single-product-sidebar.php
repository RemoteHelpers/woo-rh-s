<?php
/**
 * Templat part for displaying sidebar in single product page
 */

defined('ABSPATH') || exit;

global $product;

?>

<div class="product-sidebar">

    <!--    <div class="circles">-->
    <!--        <div class="circle1"></div>-->
    <!--        <div class="circle2"></div>-->
    <!--        <div class="circle3"></div>-->
    <!--    </div>-->
    <!--    --><?php //woocommerce_mini_cart( [ 'list_class' => 'my-css-class' ] ); ?>
    <div class="sticky-sidebar">
        <div class="breadcrumb-container">
            <div class="breadcrumb-arrow-left"><i class="fas fa-chevron-left"></i></div>
            <div class="breadcrumb-window">
                <?php
                /**
                 * Hook: rh_before_product_meta
                 *
                 * @hooked woocommerce_breadcrumb - 20
                 */
                do_action('rh_before_product_meta');
                ?>
            </div>
            <div class="breadcrumb-arrow-right"><i class="fas fa-chevron-right"></i></div>
        </div>

        <div class="product-meta">
            <div class="avatar">
                <?php echo $product->get_image(); ?>
                <div class="plaque">
                    <span>ID: <?php echo $product->get_id(); ?></span>
                    <i class="<?php the_field('shifts'); ?>"></i>
                </div>
            </div>
            <div class="summary">
                <div class="summary-info">
                    <div class="name-and-position">
                        <h3><?php echo $product->get_name(); ?></h3>
                        <p><?php the_field('current_position'); ?></p>
                    </div>
                    <div class="summary-rating-info">
                        <?php
                        $average_rating = $product->get_average_rating();
                        $rating = round($average_rating);
                        echo printStars($rating, 5);
                        ?>
                        <p><?php echo $product->get_rating_count(); ?> customer <a href="#reviews"
                            ">reviews</a>
                        </p>
                    </div>
                </div>
                <div class="summary-links">
                    <a href="#"><i class="fas fa-share-alt"></i>Share CV</a>
                    <a href="#"><i class="fas fa-file-download"></i>Download PDF</a>
                </div>
            </div>
        </div>

        <div class="product-skillset">
            <h4>Professional <span class="accent-highlight">skillset</span></h4>
            <div class="skillset-grid">
                <?php
                $id = $product->get_id();
                echo wc_get_product_tag_list($id, " "); ?>
            </div>
        </div>

        <div class="product-price-and-buttons">
            <?php
            if (!$product->is_purchasable()) {
                return;
            }
            //    echo wc_get_stock_html($product); // WPCS: XSS ok.
            if ($product->is_in_stock()) : ?>
                <form class="cart"
                      action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
                      method="post" enctype='multipart/form-data'>
                    <div class="<?php echo esc_attr(apply_filters('woocommerce_product_price_class', 'price')); ?>">
                        <span class="price-num"><?php echo $product->get_price_html(); ?></span>
                        <span class="price-comment">/month</span>
                    </div>
                    <div class="cart-btn-group">
                        <button class="setup-interview">Setup an interview</button>
                        <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>"
                                class="single_add_to_cart_button button alt">Hire Immediately!
                        </button>
                    </div>
                </form>
            <?php endif;
            ?>
        </div>

    </div>

</div>

