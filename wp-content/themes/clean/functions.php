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
 * Enqueue scripts and styles.
 */

add_theme_support( 'woocommerce' );


function clean_scripts() {
	wp_enqueue_style( 'clean-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_enqueue_style( 'single-product', get_template_directory_uri() . '/css/single-product.css',false,'1.1','all');

    wp_style_add_data( 'clean-style', 'rtl', 'replace' );

	wp_enqueue_script( 'clean-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// ------------------------------------------------------------------------

add_action('woocommerce_before_single_product_summary', 'rh_add_opening_section', 5);
add_action('woocommerce_after_single_product_summary', 'rh_add_closing_section', 5);

function rh_add_opening_section() {
    echo '<section class="sidebar-content">';
}

function rh_add_closing_section() {
    echo '</section>';
}

add_action('woocommerce_after_single_product_summary', 'rh_add_sub_summary', 3);

function rh_add_sub_summary() {
    echo '<div class="sub-summary">';
    $id = get_the_id();
    printf('<br><span>Most used skills and tools: '); echo wc_get_product_tag_list($id, ' '); printf('</span>');

    $interview = get_field('interview_link');
    if ($interview) {
        printf('<br><span>Interview(s): </span><a>');
        foreach ($interview as $int) {
            printf('<a href="echo $int;">'); echo $int; printf('</a>');
        }
    }

    $excerpt = get_field('excerpt');
    if ($excerpt) {
        printf('<br><span>Excerpt: </span>'); echo $excerpt;
    }

    printf('<br><span>Current work status: </span><div style="display:inline-block;border-radius:15px;width:15px;height:15px;background-color:'); echo get_field('current_work_status') . '"></div>';

    $teamleader = get_field('teamleader');
    if ($teamleader) {
        printf('<br><span>Teamleader: </span><div style="display:inline-block;width:15px;height:15px;border-radius:15px;background-color:'); echo $teamleader . '"></div>';
    }
    echo '</div>';
}

/**
 * Function for human-readable output.
 */
function pprint_r($a)
{
    echo "<pre>", htmlspecialchars(print_r($a, true)), "</pre>";
}

/**
 * Remove title.
 */
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

/**
 * Replace summary.
 */
add_action('woocommerce_single_product_summary',function(){
    printf('<i style="font-size:22px" class="'); echo get_field('shifts'); printf('"></i><br>');

    global $product;
    $sku = $product->get_sku();
    if ($sku) {
        printf('<br><small>#');
        echo $sku; printf('</small><br>');
    }

//    printf('<h1>'); echo get_field('first_name');
//    printf('&nbsp;'); echo get_field('last_name'); printf('</h1>');
//
//    printf('<h2>$'); echo $product->get_price(); printf('</h2>');

    $position = get_field('current_position');
    if ($position) {
        foreach ($position as $pos) {
            printf('<span>'); echo $pos; printf(', </span>');
        }
    }
});

/**
 * Remove price.
 */
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

/**
 * Remove input field from add to cart button.
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
         <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
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

/**
 * Replace after summary.
 */

add_action('woocommerce_after_single_product_summary',function() {
    $about = get_field('about');
    if ($about) {
        printf('<section class="single-product-about"><span style="font-size:18px;font-weight:600;">About: </span>'); echo $about;
    }

    $education = get_field('education');
        if($education) {
            printf('<span style="font-size:18px;font-weight:600;">Education: </span>');
            foreach ($education as $edu) {
                $vals = array_values($edu);
                printf('<br><span>');
                echo $vals[0];
                printf('</span>');
                printf('<br><span>');
                echo $vals[1];
                printf('</span>');
                printf('<br><span>');
                echo $vals[2];
                printf('</span>');
                printf('<br><span>');
                echo $vals[3];
                printf('</span><br>');
            }
        }

    $experience = get_field('work_experience');
    if($experience) {
        printf('<br><br><span style="font-size:18px;font-weight:600;">Work Experience: </span>');
        foreach ($experience as $exp) {
            $vals = array_values($exp);
            printf('<br><span>');
            echo $vals[0];
            printf('</span>');
            printf('<br><span>');
            echo $vals[1];
            printf('</span>');
            printf('<br><span>');
            echo $vals[2];
            printf('</span>');
            printf('<br><span>');
            echo $vals[3];
            printf('</span><br>');
        }
    }

    $devPortfolio = get_field('developer_portfolio');

    if ($devPortfolio) {
        printf('<br><span style="font-size:18px;font-weight:600;">Portfolio: </span><br>');
        foreach ($devPortfolio as $port) {
            printf('<a href="');
            echo $port['project_link'];
            printf('">');
            echo $port['project_name'];
            printf('</a><br>');
        }
    }
    printf('</section>');
});
