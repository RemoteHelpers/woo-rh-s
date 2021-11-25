<?php
/**
 * The template for displaying contacts page
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="contacts-page">
                <h1>We'd Love to hear From You</h1>
                <p class="subheader">Get in touch with us to discuss all the questions</p>
                <div class="contacts-body">
                    <div class="book-meeting">
                        <div class="book-inner">
                            <h2>Please book an online meeting here</h2>
                            <div class="calendar-placeholder"></div>
                        </div>
                    </div>
                    <div class="global-contacts">
                        <h2>Global contacts</h2>
                        <ul class="social-grid">
                            <?php
                            if (have_rows('soc_media', 'option')):
                                while (have_rows('soc_media', 'option')) : the_row();
                                    ?>
                                    <li>
                                        <a href="<?php the_sub_field('contact_link'); ?>">
                                            <i class="<?php the_sub_field('icon'); ?>"></i>
                                        </a>
                                        <span class="social-name"><?php the_sub_field('contact_name'); ?></span>
                                        <span class="social-info"><?php the_sub_field('contact_info'); ?></span>

                                    </li>
                                <?php
                                endwhile;
                            else :
                                ?>
                                <h3>There are no contacts</h3>
                            <?php
                            endif;
                            ?>
                        </ul>
                        <hr>
                        <ul class="departments">
                            <?php
                            if (have_rows('departments', 'option')):
                                while (have_rows('departments', 'option')) : the_row();
                                    ?>
                                    <li>
                                        <div class="title-box">
                                            <span class="department-title">
                                                <i class="fa fa-circle"></i>
                                                <?php the_sub_field('department_name'); ?>
                                            </span>
                                        </div>
                                        <div class="info-box">
                                            <span class="department-email"><?php the_sub_field('email'); ?></span>
                                            <a class="department-pill" href="<?php the_sub_field('contact_url'); ?>">
                                                <i class="<?php the_sub_field('contact_icon'); ?>"></i>
                                                <span><?php the_sub_field('contact_name'); ?></span>
                                            </a>
                                        </div>
                                    </li>
                                <?php
                                endwhile;
                            else :
                                ?>
                                <h3>There are no departments</h3>
                            <?php
                            endif;
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </main>

    </div>

<?php get_footer();