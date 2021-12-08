<?php

add_action('woocommerce_before_single_product_summary', 'rh_add_gallery_backdrop', 3);

function rh_add_gallery_backdrop()
{ ?>
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
            remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

            /**
             * Shifts, SKU, current position.
             */
            add_action('woocommerce_single_product_summary', function () {
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
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

        /**
         * Add to cart button.
         */
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
        add_action('woocommerce_after_single_product_summary', 'rh_template_single_add_to_cart', 4);

        function rh_template_single_add_to_cart()
        {
            global $product;
            if (!$product->is_purchasable()) {
                return;
            }
            echo wc_get_stock_html($product); // WPCS: XSS ok.
            if ($product->is_in_stock()) : ?>
                <form class="cart"
                      action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
                      method="post" enctype='multipart/form-data'>
                    <div class="<?php echo esc_attr(apply_filters('woocommerce_product_price_class', 'price')); ?>">
                        <span class="price-num"><?php echo $product->get_price_html(); ?></span><span
                                class="price-comment">full-time price</span></div>
                    <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>"
                            class="single_add_to_cart_button button alt">Hire Employee
                    </button>
                </form>
            <?php endif;
        }

        /**
         * Remove meta.
         */
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

        /**
         * Remove tabs.
         */
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

        add_action('woocommerce_after_single_product_summary', 'rh_add_closing_section', 5);

        function rh_add_closing_section()
        {
            echo '</section>';
        }

        /**
         * Single product about section.
         */
        add_action('woocommerce_after_single_product_summary', 'rh_single_product_content', 10);
        function rh_single_product_content()
        { ?>
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
                                <iframe class="about-video" src="<?php echo $embedLink ?>" title="YouTube video player"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                        <?php }
                        echo $about; ?>
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
                            <?php while (have_rows('developer_portfolio')) : the_row(); ?>
                                <a href="<?php the_sub_field('project_link'); ?>">
                                    <li class="dev-portfolio-pill">
                                        <?php the_sub_field('project_name'); ?>
                                    </li>
                                </a>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif;

                    if (have_rows('designer_portfolio')) :
                        $designer_portfolio = get_field('designer_portfolio');
                        acf_localize_data(array('designerPortfolio' => $designer_portfolio));
                        ?>
                        <ul class="designer-portfolio">
                            <?php while (have_rows('designer_portfolio')) : the_row(); ?>
                                <li class="designer-portfolio-item">
                                    <?php
                                    $image = get_sub_field('cover_image');
                                    ?>
                                    <img src="<?php echo esc_url($image['url']); ?>"
                                         alt="<?php echo esc_attr($image['alt']); ?>"/>
                                    <span><?php the_sub_field('designer_project_name'); ?></span>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif;

                    if (have_rows('videograph_portfolio')) : ?>
                        <ul class="video-portfolio">
                            <?php while (have_rows('videograph_portfolio')) : the_row(); ?>
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
                                            <iframe src="<?php echo $embedLink ?>" title="YouTube video player"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen></iframe>
                                        </div>
                                        <?php the_sub_field('video_name'); ?>
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
        <?php }

        ; ?>
