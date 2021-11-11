<?php
/**
 * clean functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package clean
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

//creating general info option page
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'General information',
        'menu_title'	=> 'General information',
        'menu_slug' 	=> 'theme-general-info',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));

}

if ( ! function_exists( 'clean_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function clean_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on clean, use a find and replace
		 * to change 'clean' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'clean', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'clean' ),
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
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'clean_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function clean_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'clean_content_width', 640 );
}
add_action( 'after_setup_theme', 'clean_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function clean_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'clean' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'clean' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'clean_widgets_init' );

/**
 * Register filter sidebar.
 */
function filter_sidebar_init() {
    register_sidebar( array(
        'name'          => 'Filter sidebar',
        'id'            => 'filter_sidebar',
        'before_widget' => '<div class="filter-outer">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="filter-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'filter_sidebar_init' );

/**
 * Enqueue scripts and styles.
 */

add_theme_support( 'woocommerce' );


function clean_scripts() {
	wp_enqueue_style( 'clean-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_enqueue_style( 'single-product', get_template_directory_uri() . '/css/single-product.css',false,'1.1','all');
    wp_enqueue_style( 'archive-product', get_template_directory_uri() . '/css/archive-product.css',false,'1.1','all');

    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fontawesome/fontawesome-free-5.15.4-web/css/all.css',false,'1.1','all');

    wp_enqueue_style( 'roboto', 'https://fonts.googleapis.com/css2?family=Roboto',false,'1.1','all');
    wp_enqueue_style( 'montserrat', 'href="https://fonts.googleapis.com/css2?family=Montserrat',false,'1.1','all');


    wp_style_add_data( 'clean-style', 'rtl', 'replace' );

	wp_enqueue_script( 'clean-script', get_template_directory_uri() . '/js/index.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'clean-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

//    add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );
//    function myajax_data(){
//        wp_localize_script( 'clean-script', 'myajax',
//            array(
//                'url' => admin_url('admin-ajax.php')
//            )
//        );
//
//    }

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'clean_scripts' );

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
if (file_exists('scripts.php')){
    require get_template_directory() . 'scripts.php';
}

//require_once(get_template_directory() . 'example.php');

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

//------------------------------------------------------------------------------------------------

/**
 * Function for human-readable output.
 */
function pprint_r($a)
{
    echo "<pre>", htmlspecialchars(print_r($a, true)), "</pre>";
}

// ----------------------------------------------------------------------------------------------

/**
 * Custom layout begins.
 */
add_action('woocommerce_before_single_product_summary', 'rh_add_opening_section', 5);

function rh_add_opening_section() {
    echo '<section class="sidebar-content"><div class="sidebar-head">';
}

/**
 * Remove title.
 */
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

/**
 * Shifts, SKU, current position.
 */
add_action('woocommerce_single_product_summary',function(){
    $position = get_field('current_position');
    echo '<div class="current-position">';
    if ($position) {
        foreach ($position as $pos) {
            echo '<span>' . $pos . ', </span>';
        }
    }
    echo '</div>';

    echo '<div class="id_and_shifts">';
    global $product;
    echo '<div class="id"><span># ' . $product->get_id() . '</span></div>';
    echo '<div class="shifts-wrap" style="background-color: ' . get_field('current_work_status') . '">';
    echo '<i class="' . get_field("shifts") . '"></i>';
    echo '</div>';
    echo '</div>';

//    $sku = $product->get_sku();
//    if ($sku) {
//        echo '<br><small>#' . $sku . '</small><br>';
//    }
});

/**
 * Close sub-header tag, start sub-summary.
 */
add_action('woocommerce_after_single_product_summary', 'rh_add_sub_summary', 3);

function rh_add_sub_summary() {
    echo '</div><div class="sub-summary">';
    $id = get_the_id();
    echo '<div class="skills-and-tools">';
    echo '<span class="skills-and-tools_title">Most used skills and tools:</span>';
    echo '<div class="skills-and-tools_body">';
    echo '<span>' . wc_get_product_tag_list($id, ' ') . '</span>';
    echo '</div>';
    echo '</div>';

//    $interview = get_field('interview_link');
//    if ($interview) {
//        echo '<br><span>Interview(s): </span><a>';
//        foreach ($interview as $int) {
//            echo '<a href="' . $int . '">' . $int . '</a>';
//        }
//    }

//    $excerpt = get_field('excerpt');
//    if ($excerpt) {
//        echo '<br><span>Excerpt: </span>' . $excerpt;
//    }
//
//    $teamleader = get_field('teamleader');
//    if ($teamleader) {
//        echo '<br><span>Teamleader: </span><div style="display:inline-block;width:15px;height:15px;border-radius:15px;background-color:' . $teamleader . '"></div>';
//    }
//    echo '</div>';
}

/**
 * Rearrange price.
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

/**
 * Add to cart button.
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action('woocommerce_after_single_product_summary', 'rh_template_single_add_to_cart', 4);

function rh_template_single_add_to_cart() {
    global $product;
if ( ! $product->is_purchasable() ) {
    return;
}
echo wc_get_stock_html( $product ); // WPCS: XSS ok.
if ( $product->is_in_stock() ) : ?>
    <form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
        <div class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><span class="price-num"><?php echo $product->get_price_html(); ?></span><span class="price-comment">full-time price</span></div>
        <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt">Hire Employee</button>
    </form>
<?php endif;
}

/**
 * Remove meta.
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

/**
 * Remove tabs.
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

add_action('woocommerce_after_single_product_summary', 'rh_add_closing_section', 5);

function rh_add_closing_section() {
    echo '</section>';
}

/**
 * Single product about section.
 */

add_action('woocommerce_after_single_product_summary',function() {
    $about = get_field('about');
    if ($about) {
        echo '<section class="single-product-about">';
        echo '<h4 class="about-subtitle">About:</h4>';

        /**
         * Make embed link from user link.
         */
        $interview = get_field('interview_link');
        if ($interview) {
            preg_match(
                '/[\\?\\&]v=([^\\?\\&]+)/',
                $interview['url'],
                $matches
            );
            $embedLink = 'https://www.youtube.com/embed/' . $matches[1];
            echo '<iframe width="560" height="315" src="' . $embedLink . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        }
        echo $about;
    }

    $experience = get_field('work_experience');
    if($experience) {
        echo '<h4 class="about-subtitle">Work Experience:</h4>';
        echo '<ul class="cv-list">';
        foreach ($experience as $exp) {
            $vals = array_values($exp);
            echo '<li>';
            echo '<ul class="cv-list-inner">';
            echo '<li class="title">' . $vals[0] . '</li>';
            echo '<li class="job">' . $vals[1] . '</li>';
            echo '<li class="years">' . $vals[2] . '</li>';
            echo '<li class="comment">' . $vals[3] . '</li>';
            echo '</ul>';
            echo '</li>';
        }
        echo '</ul>';
    }

    $education = get_field('education');
        if($education) {
            echo '<h4 class="about-subtitle">Education:</h4>';
            echo '<ul class="cv-list">';
            foreach ($education as $ed) {
                $vals = array_values($ed);
                echo '<li>';
                echo '<ul class="cv-list-inner">';
                echo '<li class="title">' . $vals[0] . '</li>';
                echo '<li class="subtitle">' . $vals[1] . '</li>';
                echo '<li class="years">' . $vals[2] . '</li>';
                echo '<li class="degree">' . $vals[3] . '</li>';
                echo '</ul>';
                echo '</li>';
            }
            echo '</ul>';
        }

    $devPortfolio = get_field('developer_portfolio');

    if ($devPortfolio) {
        echo '<h4 class="about-subtitle">Portfolio:</h4>';
        foreach ($devPortfolio as $port) {
            echo '<a href="' . $port['project_link'] . '">' . $port['project_name'] . '</a><br>';
        }
    }
    echo '</section>';
});

//----------------------------------------------------------------------------------------------------------

/**
 * Shop page.
 */
add_action('template_redirect', 'remove_stuff_from_shop' );
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
function rh_open_sidebar_div() { ?>
    <div class="archive-page">
        <div class="archive-sidebar">
<!--            --><?php //dynamic_sidebar( 'filter-sidebar' ); ?>
            <?php echo do_shortcode('[pwf_filter id="323"]') ?>
        </div>
<?php } ?>

<?php
add_action('rh_add_closing_div', 'rh_close_sidebar_div', 10);
function rh_close_sidebar_div() { ?>
    </div>
<?php }

//--------------------

add_action('rh_main_page_filter', 'rh_open_sidebar1_div', 10);
function rh_open_sidebar1_div() { ?>
<div class="main-page">
    <div class="main-sidebar">
        <!--            --><?php //dynamic_sidebar( 'filter-sidebar' ); ?>
        <?php echo do_shortcode('[pwf_filter id="326"]') ?>
    </div>
<?php } ?>

<?php
add_action('rh_main_page_closing_div', 'rh_close_sidebar1_div', 10);
function rh_close_sidebar1_div() { ?>
    </div>
<?php }

