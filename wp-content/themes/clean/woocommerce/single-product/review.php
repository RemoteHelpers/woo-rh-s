<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $comment;
$verified = wc_review_is_from_verified_owner($comment->comment_ID);
$rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));

?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

    <div id="comment-<?php comment_ID(); ?>" class="comment_container">

        <div class="comment-info">

            <?php
            /**
             * The woocommerce_review_before hook
             *
             * @hooked woocommerce_review_display_gravatar - 10
             */
            do_action('woocommerce_review_before', $comment);

            ?>

            <div class="meta-and-rating">
                <?php
                if ('0' === $comment->comment_approved) { ?>
                    <p class="meta">
                        <em class="woocommerce-review__awaiting-approval">
                            <?php esc_html_e('Your review is awaiting approval', 'woocommerce'); ?>
                        </em>
                    </p>
                <?php } else { ?>

                    <span class="author">
                        <strong class="woo-review-author"><?php comment_author(); ?> </strong>
                        <?php

                        if ('yes' === get_option('woocommerce_review_rating_verification_label') && $verified) {
                            echo '<em class="woocommerce-review__verified verified">(' . esc_attr__('verified owner', 'woocommerce') . ')</em> ';
                        }

                        if ($rating && wc_review_ratings_enabled()) { ?>
                            <!--    echo wc_get_rating_html( $rating ); // WPCS: XSS ok.-->
                            <div class="rating">
                                <?php echo printStars($rating, 5); ?>
                            </div>
                        <?php } ?>

                    </span>

                    <time class="woo-review-date"
                          datetime="<?php echo esc_attr(get_comment_date('c')); ?>"><?php echo esc_html(get_comment_date(wc_date_format())); ?>
                    </time>

                    <?php
                }
                ?>

            </div>
        </div>
        <div class="comment-text">

            <?php

            do_action('woocommerce_review_before_comment_text', $comment);

            /**
             * The woocommerce_review_comment_text hook
             *
             * @hooked woocommerce_review_display_comment_text - 10
             */
            do_action('woocommerce_review_comment_text', $comment);

            do_action('woocommerce_review_after_comment_text', $comment);
            ?>

        </div>
    </div>
