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

        <?php
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 10,

        );

        $loop = new WP_Query( $args );

        while ( $loop->have_posts() ) : $loop->the_post();?>
            <?php global $product;?>

            <div class="product-card">
                <div class="top-info">
                    <p class ="id-shift" style="background-color: <?php echo get_field('current_work_status')?>"><i class="<?php echo get_field('shifts')?>"></i>#<?php echo $product->get_sku(); ?>
                    </p>
                </div>
                <div class="image-place">
                    <img src="<?php echo wp_get_attachment_url( $product->get_image_id()); ?>" alt="Product image">
                </div>
                <div class="title-skills">
                    <H3><?php echo get_the_title() ?></H3>
                    <p>sdfldksj</p>
                    <p><?php
                        $terms = get_terms( 'product_tag');
                        $term_array = array();
                        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                            foreach ( $terms as $term ) {
                                echo $term->name;
                            }
                        }
                        ?></p>
                </div>


            </div>
        <?php endwhile;

        wp_reset_query();
        ?>


    </div>

</main>


<?php

get_footer();
