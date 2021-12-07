<?php
/**
 * Affiliate page
 */

get_header();

function get_head_of_sales($var)
{
    return $var['person_job_position'] === 'Head of sales department';
}

function get_head_of_finances($var)
{
    return $var['person_job_position'] === 'Head of finance department';
}

function get_hr($var)
{
    return $var['person_job_position'] === 'HR';
}

$rows = get_field('personal_contacts', 'option');

$sales = array_filter($rows, 'get_head_of_sales');
$finance = array_filter($rows, 'get_head_of_finances');
$hr = array_filter($rows, 'get_hr');


//$query_images_args = array(
//    'post_type'      => 'attachment',
//    'post_mime_type' => array('image/jpeg', 'image/png'),
//    'post_status'    => 'inherit',
//    'post_parent'    => 589,
//    'posts_per_page' => -1,
//);
//
//$query_images = new WP_Query( $query_images_args );
//
//$images = array();
//foreach ( $query_images->posts as $image ) {
//    $images[] = wp_get_attachment_url( $image->ID );
//}

?>

    <div class="about-us-page">
        <h1 class="logo-img"><?php echo wp_get_attachment_image('418'); ?></h1>
        <section>
            <h2>Company Founders</h2>
            <p> Our company was founded in 2018 to create working places for Ukrainian specialists on a remote basis.
                We’re grateful to our employees and clients for their cooperation. It’s a big pleasure to work with such
                good people.</p>
            <div class="split-two">
                <div class="staff-card">
                    <h3>Niko Kar</h3>
                    <span class="position">CEO</span>
                    <p class="quote">You may never have hired a remote team. However, to achieve amazing results,
                        sometimes you have to leave your comfort zone.</p>
                </div>
                <div class="staff-card">
                    <h3>Stanislav Dembovski</h3>
                    <span class="position">Co-Founder</span>
                    <p class="quote">Remote team is a new way for saving time, improving your business, and getting
                        successful results.</p>
                </div>
            </div>
        </section>

        <section>
            <h2>Managing Team</h2>
            <p>Hi, let us introduce you to a small part of the large Remote Helpers mechanism. We are very proud of the
                team we have created. It is a collaboration of talented people with multiple skills and experience. All
                of our guys are very different and unique in their own ways.</p>
            <div class="split-three">
                <div class="staff-card manager-card">
                    <h3><?php echo $sales[key($sales)]['person_name']; ?></h3>
                    <p><span class="position">Head of sales department</span></p>
                    <i class="fas fa-quote-left"></i>
                    <p class="quote">Every day we communicate with business owners from all over the world. We meet
                        different people, characters, and cultures. So the language barrier is the least of your
                        worries.
                    </p>
                    <ul>
                        <li><a href="<?php echo $sales[key($sales)]['person_contact_link']; ?>"><i class="
                        <?php echo $sales[key($sales)]['person_contact_icon']; ?>"></i></a></li>
                        <li><a href="<?php echo $sales[key($sales)]['person_email']; ?>"><i class="fas fa-envelope"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="staff-card manager-card">
                    <h3><?php echo $finance[key($finance)]['person_name']; ?></h3>
                    <p><span class="position">Head of finance department</span></p>
                    <i class="fas fa-quote-left"></i>
                    <p class="quote">Without a clear understanding of your goals, it is impossible to know if you have
                        achieved them over time. All you need to succeed is to have a goal, and we will help you reach
                        it.
                    </p>
                    <ul>
                        <li><a href="<?php echo $finance[key($finance)]['person_contact_link']; ?>"><i class="
                        <?php echo $finance[key($finance)]['person_contact_icon']; ?>"></i></a></li>
                        <li><a href="<?php echo $finance[key($finance)]['person_email']; ?>"><i
                                        class="fas fa-envelope"></i></a></li>
                    </ul>
                </div>
                <div class="staff-card manager-card">
                    <h3><?php echo $hr[key($hr)]['person_name']; ?></h3>
                    <p><span class="position">HR</span></p>
                    <i class="fas fa-quote-left"></i>
                    <p class="quote">Our staff is constantly growing. Every day I’m interviewing more than 20
                        candidates, and I can assure you that we choose only the best and worthy ones, without missing a
                        single talent. You should see it yourself.
                    </p>
                    <ul>
                        <li><a href="<?php echo $hr[key($hr)]['person_contact_link']; ?>"><i class="
                        <?php echo $hr[key($hr)]['person_contact_icon']; ?>"></i></a></li>
                        <li><a href="<?php echo $hr[key($hr)]['person_email']; ?>"><i class="fas fa-envelope"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section>
            <h2>About Us</h2>
            <p>Our mission is to provide working places in conflict-affected areas of Eastern Ukraine. We’re a
                goal-oriented company that builds long-term relationships with our clients. All the candidates were
                tested by us for 2 months.</p>
            <p>“People are obligated to work from one of our five offices to maintain a positive work environment and
                allow us to control a work process”</p>
            <h3>SAVE AND SAFE</h3>
            <p>“See how much you’ll save if you use our services. Working with us also helps you protect your
                health.”</p>
            <div class="split-two">
                <div class="split-inner-text">
                    <h3>Remote Helpers</h3>
                    <ul>
                        <li>Choose a candidate – <strong style="color: var(--rh-green-color)">Free</strong></li>
                        <li>Set a call – <strong style="color: var(--rh-green-color)">Free</strong></li>
                        <li>Hold an interview – <strong style="color: var(--rh-green-color)">Free</strong></li>
                        <li style="text-decoration: underline"><strong>Here we go!</strong></li>
                    </ul>
                </div>
                <img src="<?php the_field('about_us_picture-1') ?>">
            </div>
        </section>

        <section>
            <h2>Some Photos from our office life</h2>

            <?php
            $gallery = get_field('about_us_gallery');
            $size = 'full';
            if ($gallery) : ?>
                <div class="gallery-viewport">
                    <?php
                    foreach ($gallery as $image) : ?>
                        <img src="<?php echo $image['url'] ?>">
                    <?php endforeach; ?>
                </div>
                <div class="about-gallery">
                    <?php
                    foreach ($gallery as $image) : ?>
                        <img src="<?php echo $image['url'] ?>">
                    <?php endforeach; ?>
                </div>
                <div class="gallery-gallery-mobile">
                    <?php
                    foreach ($gallery as $image) : ?>
                        <img src="<?php echo $image['url'] ?>">
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>

        <section>
            <?php get_template_part('template-parts/contact-us-form'); ?>
        </section>

    </div>
<?php
get_footer();
