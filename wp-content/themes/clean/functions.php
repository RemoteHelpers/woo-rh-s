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

//include_once __DIR__ . '/inc/rh-gallery.php';

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
 * Allow to upload SVG-s.
 */
function add_file_types_to_uploads($file_types) {
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    return array_merge($file_types, $new_filetypes );
}

add_filter('upload_mimes', 'add_file_types_to_uploads');

/**
 * Enqueue scripts and styles.
 */

add_theme_support( 'woocommerce' );

/**
 * Disable all Woocommerce (three) stylesheets.
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

function clean_scripts() {
    wp_enqueue_style( 'variables', get_template_directory_uri() . '/css/variables.css',false,'1.1','all');
	wp_enqueue_style( 'clean-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_enqueue_style( 'single-product', get_template_directory_uri() . '/css/single-product.css',false,'1.1','all');
    wp_enqueue_style( 'archive-product', get_template_directory_uri() . '/css/archive-product.css',false,'1.1','all');
    wp_enqueue_style( 'employee-card', get_template_directory_uri() . '/css/employee-card.css',false,'1.1','all');
    wp_enqueue_style( 'slick-styles', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css',false,'1.1','all');
    wp_enqueue_style( 'header-style', get_template_directory_uri() . '/css/header.css',false,'1.1','all');
    wp_enqueue_style( 'footer-style', get_template_directory_uri() . '/css/footer.css',false,'1.1','all');
    wp_enqueue_style( 'home-style', get_template_directory_uri() . '/css/home-style.css',false,'1.1','all');
    wp_enqueue_style( 'form-style', get_template_directory_uri() . '/css/contact.css',false,'1.1','all');
    wp_enqueue_style( 'contacts-style', get_template_directory_uri() . '/css/contacts.css',false,'1.1','all');
    wp_enqueue_style( 'faq-style', get_template_directory_uri() . '/css/faq.css',false,'1.1','all');
    wp_enqueue_style( 'privacy-style', get_template_directory_uri() . '/css/privacy.css',false,'1.1','all');


    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fontawesome/fontawesome-free-5.15.4-web/css/all.css',false,'1.1','all');

    wp_enqueue_style( 'roboto', 'https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap',false,'1.1','all');
    wp_enqueue_style( 'fira-sans', 'https://fonts.googleapis.com/css2?family=Fira+Sans+Extra+Condensed:wght@300&display=swap',false,'1.1','all');
    wp_enqueue_style( 'montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;500;600;700;800;900&display=swap',false,null,'all');


    wp_style_add_data( 'clean-style', 'rtl', 'replace' );

	wp_enqueue_script( 'clean-script', get_template_directory_uri() . '/js/index.js', array('jquery', 'acf-input'), _S_VERSION, true );
	acf_enqueue_script('clean-script');
    wp_enqueue_script( 'clean-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'home-page', get_template_directory_uri() . '/js/home-page.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'slick-script', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), _S_VERSION, true );

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

//----------------------------------------------------------------------------------------------

/**
 * Custom layout begins.
 */
add_action('woocommerce_before_single_product_summary', 'rh_add_gallery_backdrop', 3);

function rh_add_gallery_backdrop() { ?>
    <div class="gallery-backdrop">
        <i class="fas fa-times gallery-close"></i>
        <i class="fas fa-arrow-left gallery-prev"></i>
        <i class="fas fa-arrow-right gallery-next"></i>
        <div class="gallery-container">
            <img class="gallery-image" src="">
        </div>
        <div class="gallery-thumbnails"></div>
    </div>
<?php
}

add_action('woocommerce_before_single_product_summary', 'rh_add_opening_section', 5);

function rh_add_opening_section() { ?>

    <section class="single-product-sidebar">
        <div class="sticky-sidebar">
            <div class="sidebar-head">
                <div class="sidebar-img">

<?php }

add_action('woocommerce_before_single_product_summary', 'rh_close_sidebar_img_div', 30);
function rh_close_sidebar_img_div() { ?>
    </div>
<?php }

/**
 * Remove title.
 */
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

/**
 * Remove breadcrumbs.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action( 'woocommerce_sidebar','woocommerce_get_sidebar', 10);

/**
 * Shifts, SKU, current position.
 */
add_action('woocommerce_single_product_summary', function() {
    $position = get_field('current_position'); ?>
    <div class="current-position">
    <?php if ($position) {
        foreach ($position as $pos) { ?>
            <span><?php echo $pos ?> , </span>
        <?php }
    } ?>
    </div>

    <div class="id-and-shifts">
    <?php global $product; ?>
    <div class="id"><span># <?php echo $product->get_id() ?></span></div>

    <?php $status = get_field_object('current_work_status');
    $value = $status['value'];
    $choice = $status['choices'][$value];
    ?>
    <div class="shifts-wrap" style="background-color: <?php echo $value ?>">
    <i class="<?php the_field("shifts") ?>"></i>
    <span class="availability"><?php echo $choice ?></span>
    </div>
    </div>
<?php }); ?>

<?php
/**
 * Close sub-header tag, start sub-summary.
 */
add_action('woocommerce_after_single_product_summary', 'rh_add_sub_summary', 3);
function rh_add_sub_summary() { ?>
    </div>
    <div class="sidebar-summary">
    <div class="skills-and-tools">
    <span class="skills-and-tools_title">Most used skills and tools:</span>
    <ul class="skills-and-tools_body">
    <?php
    global $product;
    $id = $product->get_id();
    $skill_string = wc_get_product_tag_list($id, '|');
    $skills = explode('|', $skill_string);
    foreach ($skills as $skill) {
        echo '<li>' . $skill . '</li>';
    }
    ?>
    </ul>
    </div>
    </div>
<?php } ?>

<?php
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
add_action('woocommerce_after_single_product_summary', 'rh_single_product_content', 10);
function rh_single_product_content() { ?>
    <section class="single-product-content">
    <?php
    $about = get_field('about');
    if ($about) : ?>
        <?php woocommerce_breadcrumb(); ?>

        <div class="content-section">
        <h4 class="content-subtitle">About:</h4>

        <?php
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
            $embedLink = 'https://www.youtube.com/embed/' . $matches[1]; ?>
            <div class="iframe-container">
            <iframe class="about-video" src="<?php echo $embedLink ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        <?php }
        echo $about;?>
        </div>
    <?php endif; ?>

    <?php if (have_rows('work_experience')) : ?>
        <div class="content-section">
        <h4 class="content-subtitle">Work Experience:</h4>
        <ul class="cv-list">
        <?php while (have_rows('work_experience')) : the_row(); ?>
            <li>
            <ul class="cv-list-inner">
                <li class="title"><?php echo get_sub_field('organization_name'); ?></li>
                <li class="job"><?php echo get_sub_field('work_position'); ?></li>
                <li class="years"><?php echo get_sub_field('years_of_work'); ?></li>
                <li class="comment"><?php echo get_sub_field('short_description'); ?></li>
            </ul>
            </li>
        <?php endwhile; ?>
        </ul>
        </div>
    <?php endif; ?>

    <?php if (have_rows('education')) : ?>
        <div class="content-section">
        <h4 class="content-subtitle">Education:</h4>
        <ul class="cv-list">
        <?php while (have_rows('education')) : the_row(); ?>
            <li>
            <ul class="cv-list-inner">
                <li class="title"><?php echo get_sub_field('institution_name'); ?></li>
                <li class="subtitle"><?php echo get_sub_field('specialization'); ?></li>
                <li class="years"><?php echo get_sub_field('years_of_education'); ?></li>
                <li class="degree"><?php echo get_sub_field('degree'); ?></li>
            </ul>
            </li>
        <?php endwhile; ?>
        </ul>
        </div>
    <?php endif; ?>

    <?php
        $devPortfolio = get_field('developer_portfolio');
        $designerPortfolio = get_field('designer_portfolio');
        $videoPortfolio = get_field('videograph_portfolio');
        ?>
        <div class="content-section">
        <h4 class="content-subtitle">Portfolio:</h4>
        <?php
        if (have_rows('developer_portfolio')) : ?>
            <ul class="dev-portfolio">
            <?php while (have_rows('developer_portfolio')) : the_row();?>
                    <a href="<?php the_sub_field('project_link');?>">
                    <li class="dev-portfolio-pill">
                    <?php the_sub_field('project_name');?>
                    </li>
                    </a>
            <?php endwhile; ?>
            </ul>
        <?php endif;

        if (have_rows('designer_portfolio')) :
            $designer_portfolio = get_field('designer_portfolio');
            acf_localize_data(array('designerPortfolio'=>$designer_portfolio));
            ?>
            <ul class="designer-portfolio">
            <?php while (have_rows('designer_portfolio')) : the_row();?>
                    <li class="designer-portfolio-item">
                    <?php
                    $image = get_sub_field('cover_image');
                    ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <span><?php the_sub_field('designer_project_name'); ?></span>
                    </li>
            <?php endwhile; ?>
            </ul>
        <?php endif;

        if (have_rows('videograph_portfolio')) : ?>
            <ul class="video-portfolio">
            <?php while (have_rows('videograph_portfolio')) : the_row();?>
                    <?php $vid_link = get_sub_field('video_link'); ?>
                    <a href="<?php the_sub_field('video_link'); ?>">
                        <li class="video-portfolio-vid">
                        <?php
                        /**
                         * Make embed link from user link.
                         */

                        preg_match('/[\\?\\&]v=([^\\?\\&]+)/',
                            $vid_link,
                            $matches_);

                        $embedLink = 'https://www.youtube.com/embed/' . $matches[1]; ?>
                            <div class="iframe-container">
                            <iframe src="<?php echo $embedLink ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        <?php the_sub_field('video_name');?>
                        </li>
                    </a>
            <?php endwhile; ?>
            </ul>
        <?php endif;
        ?>
        </div>
        <h4 class="content-subtitle">Comments:</h4>
        <?php comments_template(); ?>
        </section>
    <?php };

//-------------------------------------------------------------------------------------------------------------


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

        add_filter( 'wc_add_to_cart_message_html', '__return_false' );

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




