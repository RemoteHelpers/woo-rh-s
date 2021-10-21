<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package clean
 */

?>

<footer id="colophon" class="site-footer">
    <div class="footer-logo"><?php the_custom_logo() ?></div>
    <div class="bottom-menu">
        <div class="menu"><?php wp_nav_menu(
                array(
                    'theme_location' => 'menu-1',
                    'menu' => 'Footer menu',
                    'menu_class' => 'footer-menu',
                )
            ) ?>
        </div>
        <div class="privacy-policy">
            <p>Remote Helpers 2018-<?php echo date("Y"); ?>
                © All rights reserved</p>
            <a href="<?php echo get_permalink(3) ?>" class="privacy-page">Privacy Policy</a>
        </div>
    </div>


    <div class="footer-icon">
           <?php if(have_rows('social_media'))
               echo "1"
               ?>
    </div>

</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>


<?php //if (have_rows('social_media')): while (have_rows('social_media')) : the_row();?>
<!--    <a href='--><?php //echo get_sub_field('social_net_url') ?><!--' class="icon-link"><i-->
<!--                class='--><?php //echo get_sub_field('icon') ?><!--'></i></a>-->
<?php //endwhile; endif; ?>