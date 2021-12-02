<?php
/**
 * Affiliate page
 */

get_header();

$affiliate_img = get_field('affiliate_images');

?>

    <div class="affiliate-page">
        <section class="hero">
            <h1>Join our <span class="bold-text">affiliate marketing program</span> and start <span class="bold-text">getting incomes</span>
            </h1>
            <?php

            if ($affiliate_img) : ?>
                <img src="<?php echo $affiliate_img['hero_image']['url']; ?>">
            <?php endif; ?>
            <div class="text">
                <p>Our company is looking for <strong>affiliate partners</strong> to join the <strong>affiliate
                        program</strong>. Promote our employees’
                    services and <strong>get a commission</strong> for each lead.</p>
                <button class="rh-button"><i class="far fa-hand-spock"></i>Set up call</button>
            </div>
        </section>

        <section class="affiliate-marketing">
            <h2>Check out the <span class="bold-text">affiliate marketing</span> partnership offer description</h2>
            <div class="affiliate-cards">

                <?php if (have_rows('affiliate_card')) :
                    while (have_rows('affiliate_card')) : the_row();
                        ?>
                        <div class="card">
                            <div class="header">
                                <span>Model: <?php the_sub_field('model'); ?></span>
                            </div>
                            <h3>Withhold period:
                                <span>30 days after conversion</span>
                            </h3>
                            <?php
                            if ($affiliate_img) : ?>
                                <img src="<?php echo $affiliate_img['card_images']['card_map']['url']; ?>">
                            <?php endif; ?>
                            <ul>
                                <li><strong>Forbidden: </strong><?php the_sub_field('forbidden'); ?></li>
                                <li><strong>Category: </strong><?php the_sub_field('category'); ?></li>
                                <li class="age">
                                    <div>
                                        <?php
                                        if ($affiliate_img) : ?>
                                            <img src="<?php echo $affiliate_img['card_images']['card_man']['url']; ?>">
                                        <?php endif; ?>
                                        <span><strong>From </strong><?php the_sub_field('age_from'); ?></span>
                                    </div>
                                    <div>
                                        <?php
                                        if ($affiliate_img) : ?>
                                            <img src="<?php echo $affiliate_img['card_images']['card_woman']['url']; ?>">
                                        <?php endif; ?>
                                        <span><strong>To </strong><?php the_sub_field('age_to'); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <strong>Interests: </strong><?php the_sub_field('interests'); ?>
                                </li>
                                <li>
                                    <strong>Conversion: </strong><?php the_sub_field('conversion'); ?>
                                </li>
                            </ul>
                        </div>
                    <?php
                    endwhile;
                endif;
                ?>

            </div>
        </section>

        <section class="learn-more">
            <h2>Learn more about our company
                and the offer for <span class="bold-text">affiliate partners</span></h2>
            <div class="split">
                <?php
                if ($affiliate_img) : ?>
                    <img src="<?php echo $affiliate_img['affiliate_partners_image']['url']; ?>">
                <?php endif; ?>
                <p><span class="remote-helpers">RemoteHelpers -</span>
                    is a Ukrainian <strong>outstaffing company</strong>. We provide <strong>hiring services</strong> to <strong>international partners</strong> that are
                    looking for remote IT and Marketing specialists. Our employees help companies to manage their social
                    networks, <strong>run advertising campaigns, create content, design websites</strong>, etc. Our primary purpose is to
                    <strong>generate leads</strong> and <strong>increase sales revenue</strong> with the help of <strong>affiliate marketing services</strong>.</p>
            </div>
        </section>

        <section>
            <h2>Contact us</h2>
            <div class="contact-form">
                <div class="social">
                    <h3>Contact us</h3>
                    <ul>
                        <?php
                        if (have_rows('soc_media', 'option')):
                            while (have_rows('soc_media', 'option')) : the_row();
                                ?>
                                <li>
                                    <a href="<?php the_sub_field('contact_link'); ?>">
                                        <i class="<?php the_sub_field('icon'); ?>"></i>

                                    <span class="social-info"><?php the_sub_field('contact_info'); ?></span>
                                    </a>
                                </li>
                            <?php
                            endwhile;
                        endif;
                        ?>
                    </ul>
                </div>
                <div class="form-wrap">
                    <h3>Leave a message</h3>
                    <form>
                        <input type="text" name="name" placeholder="Name">
                        <input type="text" name="phone" placeholder="Phone">
                        <input type="text" name="email" placeholder="Email">
                        <textarea type="text" name="message" placeholder="Message" rows="3"></textarea>
                        <input class="rh-button" type="submit" name="submit" value="Send">
                    </form>
                </div>
                <div class="cta">
                    <h3>We’d Love to Hear from You!</h3>
                    <span>Reach out to us with your query or concern</span>
                </div>

            </div>
        </section>

    </div>

<?php get_footer();
