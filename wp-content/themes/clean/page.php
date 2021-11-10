<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package clean
 */

get_header();
?>
    <main>

        <?php do_action('rh_archive_filter'); ?>
        <div class="wrapper">

            <section class="card-section">
                <?php
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 10,
                    );

                    $loop = new WP_Query($args);

                    while ($loop->have_posts()) : $loop->the_post(); ?>
                        <?php global $product; ?>

                        <?php wc_get_template_part( 'content', 'product' );?>

                    <?php endwhile;

                    wp_reset_query();
                ?>
            </section>
        </div>

    </main>


<?php

get_footer();
