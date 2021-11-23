<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package clean
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'clean'); ?></a>
    <div class="background-header <?php if (is_front_page()) echo 'black-header'; ?>">
        <header id="masthead" class="site-header">
            <div class="site-branding">
                <div class="site-logo">
                    <?php
                    //                    if ( function_exists( 'the_custom_logo' ) ) {
                    //                        the_custom_logo();
                    //                    }
                    //                    $logo_img = '';
                    //                    if( $custom_logo_id = get_theme_mod('dark_logo') ){
                    //                        $logo_img = wp_get_attachment_image( $custom_logo_id, 'full', false, array(
                    //                            'class'    => 'dark_logo',
                    //                            'itemprop' => 'logo',
                    //                        ) );
                    //                    }
                    //                    echo $logo_img;
                    $custom_logo_id = get_theme_mod('dark_logo');
                    //                    $logo_src = wp_get_attachment_image_src($custom_logo_id, 'full');


                    if (is_front_page()) { ?>
                        <img src="<?php echo $custom_logo_id ?>">
                    <?php } else {
                        the_custom_logo();
                    } ?>
                </div>

                <!--                --><?php
                //                the_custom_logo();
                //                if (is_front_page() && is_home()) :
                //                    ?>
                <!--                    <h1 class="site-title"><a href="-->
                <?php //echo esc_url(home_url('/')); ?><!--"-->
                <!--                                              rel="home">-->
                <?php //bloginfo('name'); ?><!--</a></h1>-->
                <!--                --><?php
                //                else :
                //                    ?>
                <!--                    <p class="site-title"><a href="-->
                <?php //echo esc_url(home_url('/')); ?><!--"-->
                <!--                                             rel="home">-->
                <?php //bloginfo('name'); ?><!--</a></p>-->
                <!--                --><?php
                //                endif;
                //                $clean_description = get_bloginfo('description', 'display');
                //                if ($clean_description || is_customize_preview()) :
                //                    ?>
                <!--                    <p class="site-description">-->
                <!--                        -->
                <?php //echo $clean_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                //                        ?><!--</p>-->
                <!--                --><?php //endif; ?>
            </div><!-- .site-branding -->

            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu"
                        aria-expanded="false"><i class="fas fa-bars"></i></button>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-1',
                        'menu' => 'TestMenu',
                        'menu_class' => 'main-menu',
                    )
                );
                ?>
            </nav><!-- #site-navigation -->
        </header>
    </div><!-- #masthead -->
