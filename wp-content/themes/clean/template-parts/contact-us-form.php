<?php ?>

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