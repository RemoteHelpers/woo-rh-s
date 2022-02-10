<?php
/**
 * clean functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package clean
 */


/**
 * Includes.
 */


if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

//creating general info option page
if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'General information',
        'menu_title' => 'General information',
        'menu_slug' => 'theme-general-info',
        'capability' => 'edit_posts',
        'redirect' => false
    ));

}

if (!function_exists('clean_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function clean_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on clean, use a find and replace
         * to change 'clean' to the name of your theme in all the template files.
         */
        load_theme_textdomain('clean', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'menu-1' => esc_html__('Primary', 'clean'),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters(
                'clean_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height' => 250,
                'width' => 250,
                'flex-width' => true,
                'flex-height' => true,
            )
        );
    }
endif;
add_action('after_setup_theme', 'clean_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function clean_content_width()
{
    $GLOBALS['content_width'] = apply_filters('clean_content_width', 640);
}

add_action('after_setup_theme', 'clean_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function clean_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'clean'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'clean'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
}

add_action('widgets_init', 'clean_widgets_init');

/**
 * Register filter sidebar.
 */
function filter_sidebar_init()
{
    register_sidebar(array(
        'name' => 'Filter sidebar',
        'id' => 'filter_sidebar',
        'before_widget' => '<div class="filter-outer">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="filter-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'filter_sidebar_init');


/**
 * Allow to upload SVG-s.
 */
function add_file_types_to_uploads($file_types)
{
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    return array_merge($file_types, $new_filetypes);
}

add_filter('upload_mimes', 'add_file_types_to_uploads');


/**
 * Enqueue scripts and styles.
 */

add_theme_support('woocommerce');

/**
 * Disable all Woocommerce (three) stylesheets.
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

function clean_scripts()
{
    wp_enqueue_style('variables', get_template_directory_uri() . '/css/variables.css', false, '1.1', 'all');
    wp_enqueue_style('clean-style', get_stylesheet_uri(), array(), _S_VERSION);

    wp_enqueue_style('archive-product', get_template_directory_uri() . '/css/archive-product.css', false, '1.1', 'all');
    wp_enqueue_style('employee-card', get_template_directory_uri() . '/css/employee-card.css', false, '1.1', 'all');
    wp_enqueue_style('slick-styles', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', false, '1.1', 'all');
    wp_enqueue_style('header-style', get_template_directory_uri() . '/css/header.css', false, '1.1', 'all');
    wp_enqueue_style('mini-cart-style', get_template_directory_uri() . '/css/mini-cart.css', false, '1.1', 'all');
    wp_enqueue_style('footer-style', get_template_directory_uri() . '/css/footer.css', false, '1.1', 'all');

    if (is_front_page()) {
        wp_enqueue_style('home-style', get_template_directory_uri() . '/css/home-style.css', false, '1.1', 'all');
        wp_enqueue_style('contact-form-component', get_template_directory_uri() . '/css/contact-form-component.css', false, '1.1', 'all');
        wp_enqueue_style('slick-styles', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', false, '1.1', 'all');
        wp_enqueue_script('slick-script', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), _S_VERSION, true);
    }

    if (is_product()) {
        wp_enqueue_style('single-product', get_template_directory_uri() . '/css/single-product.css', false, '1.1', 'all');
        wp_enqueue_style('roboto', 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap', false, '1.1', 'all');
        wp_enqueue_style('roboto-condensed', get_template_directory_uri() . 'https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap>', false, '1.1', 'all');
        wp_enqueue_style('slick-styles', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', false, '1.1', 'all');
//        overriding the woocommerce single-product.js file
        global $wp_scripts;
        $wp_scripts->registered['wc-single-product']->src = get_template_directory_uri() . '/woocommerce/js/single-product.min.js';
    }

    wp_enqueue_style('form-style', get_template_directory_uri() . '/css/contact.css', false, '1.1', 'all');

    if (is_page('contacts')) {
        wp_enqueue_style('contacts-style', get_template_directory_uri() . '/css/contacts.css', false, '1.1', 'all');
    }

    if (is_page('faq')) {
        wp_enqueue_style('faq-style', get_template_directory_uri() . '/css/faq.css', false, '1.1', 'all');
    }

    if (is_page('privacy-policy')) {
        wp_enqueue_style('privacy-style', get_template_directory_uri() . '/css/privacy.css', false, '1.1', 'all');
    }

    if (is_page('pricing')) {
        wp_enqueue_style('pricing-style', get_template_directory_uri() . '/css/pricing.css', false, '1.1', 'all');
    }

    if (is_page('affiliate-page')) {
        wp_enqueue_style('affiliate-page-style', get_template_directory_uri() . '/css/affiliate-page.css', false, '1.1', 'all');
        wp_enqueue_style('contact-form-component', get_template_directory_uri() . '/css/contact-form-component.css', false, '1.1', 'all');
    }


    if (is_page('about-us')) {
        wp_enqueue_style('about-us-style', get_template_directory_uri() . '/css/about-us.css', false, '1.1', 'all');
        wp_enqueue_style('contact-form-component', get_template_directory_uri() . '/css/contact-form-component.css', false, '1.1', 'all');
        wp_enqueue_style('slick-styles', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', false, '1.1', 'all');
        wp_enqueue_script('slick-script', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), _S_VERSION, true);
    }

    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/fontawesome/fontawesome-free-5.15.4-web/css/all.css', false, '1.1', 'all');

    wp_enqueue_style('roboto', 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap', false, '1.1', 'all');
    wp_enqueue_style('fira-sans', 'https://fonts.googleapis.com/css2?family=Fira+Sans+Extra+Condensed:wght@300&display=swap', false, '1.1', 'all');
    wp_enqueue_style('montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;500;600;700;800;900&display=swap', false, null, 'all');


    wp_style_add_data('clean-style', 'rtl', 'replace');


    wp_enqueue_script('clean-script', get_template_directory_uri() . '/js/index.js', array('jquery', 'acf-input'), _S_VERSION, true);
    acf_enqueue_script('clean-script');
    wp_enqueue_script('clean-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

    wp_enqueue_script('home-page', get_template_directory_uri() . '/js/home-page.js', array(), _S_VERSION, true);
    wp_enqueue_script('slick-script', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), _S_VERSION, true);

//    add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );
//    function myajax_data(){
//        wp_localize_script( 'clean-script', 'myajax',
//            array(
//                'url' => admin_url('admin-ajax.php')
//            )
//        );
//
//    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'clean_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Implement the Custom script feature.
 */
if (file_exists('scripts.php')) {
    require get_template_directory() . 'scripts.php';
}

//require_once(get_template_directory() . 'example.php');

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Function for human-readable output.
 */
function pprint_r($a)
{
    echo "<pre>", htmlspecialchars(print_r($a, true)), "</pre>";
}

/**
 * Function for changing woocommerce loop open/close tags.
 */
function woocommerce_product_loop_start()
{
    echo '<div class="products employees">';
}

function woocommerce_product_loop_end()
{
    echo '</div>';
}


add_action('woocommerce_sale_flash', 'pancode_echo_sale_percent');


/**
 * Echo discount percent badge html.
 *
 * @param string $html Default sale html.
 *
 * @return string
 */
function pancode_echo_sale_percent($html)
{
    global $product;

    /**
     * @var WC_Product $product
     */

    $regular_max = 0;
    $sale_min = 0;
    $discount = 0;

    if ('variable' === $product->get_type()) {
        $prices = $product->get_variation_prices();
        $regular_max = max($prices['regular_price']);
        $sale_min = min($prices['sale_price']);
    } else {
        $regular_max = $product->get_regular_price();
        $sale_min = $product->get_sale_price();
    }

    if (!$regular_max && $product instanceof WC_Product_Bundle) {
        $bndl_price_data = $product->get_bundle_price_data();
        $regular_max = max($bndl_price_data['regular_prices']);
        $sale_min = max($bndl_price_data['prices']);
    }


    if (floatval($regular_max)) {
        $discount = round(100 * ($regular_max - $sale_min) / $regular_max);
    }


    return '<span class="onsale">-&nbsp;' . esc_html($discount) . '%</span>';

}

/**
 * Single-page layout.
 */


require_once('inc/rh-single-page.php');


/**
 * Shop page layout.
 */
add_action('template_redirect', 'remove_stuff_from_shop');
function remove_stuff_from_shop()
{
    if (is_shop()) {

        /**
         * Remove breadcrumbs.
         */
        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

        /**
         * Remove title.
         */
        add_filter('woocommerce_show_page_title', '__return_false');

        /**
         * Remove result_count, catalog_ordering.
         */
        remove_all_actions('woocommerce_before_shop_loop');

        add_filter('wc_add_to_cart_message_html', '__return_false');

        /**
         * Remove sidebar.
         */
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    }
}

/**
 * Archive layout.
 */
add_action('rh_archive_filter', 'rh_open_sidebar_div', 10);
function rh_open_sidebar_div()
{ ?>
<div class="archive-page">
    <div class="archive-sidebar">

        <!--            --><?php //dynamic_sidebar( 'filter-sidebar' );
        ?>

        <?php echo do_shortcode('[pwf_filter id="323"]') ?>
    </div>
    <?php } ?>

    <?php
    add_action('rh_add_closing_div', 'rh_close_sidebar_div', 10);
    function rh_close_sidebar_div()
    { ?>
</div>
<?php }

//--------------------

add_action('rh_main_page_filter', 'rh_open_sidebar1_div', 10);

function rh_open_sidebar1_div()
{ ?>

<div class="main-page">
    <div class="main-sidebar">
        <!--            --><?php //dynamic_sidebar( 'filter-sidebar' );
        ?>
        <?php echo do_shortcode('[pwf_filter id="326"]') ?>
    </div>
    <?php } ?>

    <?php
    add_action('rh_main_page_closing_div', 'rh_close_sidebar1_div', 10);
    function rh_close_sidebar1_div()
    { ?>
</div>
<?php } ?>

<?php

/**
 * Function to draw stars from numbers.
 */
function inactiveStar(): string
{
    return '<i class="fas fa-star"></i>';
}

function activeStar(): string
{
    return '<i class="fas fa-star score"></i>';
}

function printStars($quantity, $max): string
{
    $activeStars = $quantity;
    $inactiveStars = $max - $quantity;
    $stars = '';

    while ($activeStars > 0) {
        $stars .= activeStar();
        $activeStars--;
    }
    while ($inactiveStars > 0) {
        $stars .= inactiveStar();
        $inactiveStars--;
    }
    return $stars;
}

?>

<?php
function drawCards($query)
{
    ?>

    <?php if ($query->have_posts()): ?>
    <div class="rh-query-results">
        <?php while ($query->have_posts()) : $query->the_post();
            global $product ?>
            <?php get_template_part('/woocommerce/content-product'); ?>
        <?php endwhile; ?>
    </div>
<?php else : ?>

    <h3>No products in category :(</h3>

<?php endif;
} ?>

<?php
//------------- Related Cards

function getProductsByAcf($key, $value)
{
    $args = array(
        'numberposts' => -1,
        'post_type' => 'product',
        'meta_query' => [[
            'key' => $key,
            'value' => $value
        ]],
    );

    $the_query = new WP_Query($args);

    drawCards($the_query);

} ?>

<?php
function getRandomCategory($number)
{

    $field = get_field_object('field_61766d92e2c3f');
    $choices = $field['choices'];
    $positionArr = [];

    foreach ($choices as $c) {
        $positionArr[] = $c;
    }

    $random = array_rand($positionArr, 1);

    $random_pos = $positionArr[$random];

    $args = array(
        'numberposts' => $number,
        'post_type' => 'product',
        'meta_query' => [[
            'key' => 'current_position',
            'value' => $random_pos
        ]],
    );

    $the_query = new WP_Query($args);

    ?>
    <h3>Showing cards from category: <?php echo $random_pos; ?></h3>
    <?php

    drawCards($the_query);

} ?>


<?php
//-----------------------------------

/**
 * Remove fields from checkout page.
 */
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');
function custom_override_checkout_fields($fields)
{
    unset($fields['billing']['billing_phone']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);

    return $fields;
}

?>

<?php

/**
 * Redirect at add to cart.
 */
//function rh_redirect_to_checkout() {
//    $url = wc_get_checkout_url();
//    return $url;
//}
//add_filter('woocommerce_add_to_cart_redirect', 'rh_redirect_to_checkout');
?>

<?php

/**
 * Add cart icon to top meny.
 */
//function rh_add_cart_icon_to_top_menu($items, $args)
//{
//    if (WC()->cart->get_cart_contents_count() === 0) {
//        $items .= '<li class="menu-cart-list-item"><div class="menu-cart-btn-empty" id="menu-cart-btn"><i class="fas fa-shopping-cart"></i></div></li>';
//    } else {
//        $items .= '<li class="menu-cart-list-item"><div class="menu-cart-btn-full" id="menu-cart-btn"><i class="fas fa-shopping-cart"></i></div></li>';
//    }
//    return $items;
//}
//
//add_filter('wp_nav_menu_items', 'rh_add_cart_icon_to_top_menu', 10, 2);
?>

<?php
//add_filter('wc_add_to_cart_message_html', function($message){
//    $no_tags = strip_tags($message);
//    return str_replace('View cart', '', $no_tags);
//});

?>