<?php

/**
 * Add breadcrumbs
 */
add_action('rh_before_product_body', 'woocommerce_breadcrumb', 20);
add_action('rh_before_product_meta', 'woocommerce_breadcrumb', 20);

/**
 * Change breadcrumb looks
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'rh_woocommerce_breadcrumbs' );
function rh_woocommerce_breadcrumbs() {
    return array(
        'delimiter' => ' > ',
        'wrap_before' => '<nav class="woocommerce-breadcrumb">',
        'wrap_after' => '</nav>',
        'before' => ' ',
        'after' => '',
        'home' => _x( ' ', 'breadcrumb', 'woocommerce' ),
    );
}

/**
 * Remove "cookies" field from comments form.
 */
remove_action( 'set_comment_cookies', 'wp_set_comment_cookies' );

/**
 * Remove tabs.
 */
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);