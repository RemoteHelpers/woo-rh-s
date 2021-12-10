<?php
/**
 * Templat part for displaying sidebar in single product page
 */

defined('ABSPATH') || exit;

global $product;

?>

<div class="product-body">
    <section>
        <h3>Hire a <span class="accent-highlight">lead generation specialist</span> to expand the client base</h3>
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
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>

                </iframe>
                <div class="iframe-cover"><i class="fab fa-youtube"></i></div>
            </div>
        <?php } ?>
    </section>
    <section class="portfolios">
        <h3>Work experience</h3>
        <ul class="portfolio-list">
            <?php
            if (have_rows('work_experience')) : ?>

                <?php
                while (have_rows('work_experience')) : the_row(); ?>
                    <li>
                        <ul>
                            <li><?php echo get_sub_field('organization_name') . ' (';
                                echo get_sub_field('work_position'); ?>)
                            </li>
                            <li><?php the_sub_field('years_of_work'); ?></li>
                            <li><?php the_sub_field('short_description'); ?></li>
                        </ul>
                    </li>
                <?php endwhile; ?>

            <?php endif; ?>
        </ul>

        <h3>Education</h3>
        <ul class="portfolio-list">
            <?php
            if (have_rows('education')) : ?>

                <?php
                while (have_rows('education')) : the_row(); ?>
                    <li>
                        <ul>
                            <li><?php echo get_sub_field('institution_name') . ' (';
                                echo get_sub_field('specialization'); ?>)
                            </li>
                            <li><?php the_sub_field('years_of_education'); ?></li>
                            <li><?php the_sub_field('degree'); ?></li>
                        </ul>
                    </li>
                <?php endwhile; ?>

            <?php endif; ?>
        </ul>

        <h3>Portfolio</h3>
        <?php
        if (have_rows('designer_portfolio')) : ?>
        <ul class="portfolio portfolio-thumbnails">
            <?php
            while (have_rows('designer_portfolio')) : the_row(); ?>
                <li>
                    <figure>
                        <img src="<?php the_sub_field('cover_image'); ?>">
                        <figcaption><?php the_sub_field('designer_project_name'); ?></figcaption>
                    </figure>
                </li>
            <?php
            endwhile;
            endif; ?>
        </ul>

        <h4>Optional (developers)</h4>
        <?php
        if (have_rows('developer_portfolio')) : ?>
        <ul class="portfolio portfolio-pills">
            <?php
            while (have_rows('developer_portfolio')) : the_row(); ?>
                <li>
                    <a href="<?php the_sub_field('project_link'); ?>"><?php the_sub_field('project_name'); ?></a>
                </li>
            <?php
            endwhile;
            endif; ?>
        </ul>

        <h4>Optional (video)</h4>
        <?php
        if (have_rows('videograph_portfolio')) : ?>
        <ul class="portfolio portfolio-video">
            <?php
            while (have_rows('videograph_portfolio')) : the_row(); ?>
                <li>
                    <img src="<?php the_sub_field('video_image'); ?>">
                </li>
            <?php
            endwhile;
            endif; ?>
        </ul>
    </section>
</div>
