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

                        <div class="card">
                            <header>
                                <div style="background-color: <?php echo get_field('current_work_status') ?>">
                                    <i class="<?php echo get_field('shifts') ?>"></i>
                                    <span>#<?php echo $product->get_sku(); ?></span>
                                </div>
                            </header>
                            <main>
                                <img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>"
                                     alt="Product image">
                                <H3><?php echo get_the_title() ?></H3>
                                <div><?php the_field('current_position') ?></div>
                                <!--//TODO: change h5 to div and insert blocks-->
                                <hr>
                                <div class="skill-items">
                                    <?php echo wc_get_product_tag_list($product->get_id(), ' ') ?>
                                    <!--                <a href="">CSS</a>-->
                                </div>
                            </main>
                            <footer>
                                <a href="<?php echo get_post_permalink() ?>">Watch Employee cv</a>
                                <!--FIXME: add link to post-->
                            </footer>
                        </div>

                    <?php endwhile;

                    wp_reset_query();
                ?>
            </section>
        </div>

    </main>


<?php

get_footer();
