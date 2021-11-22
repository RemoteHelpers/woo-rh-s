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

    <main class="home-page">
        <section class="first-section">
            <video autoplay muted loop id="backgroundVideo">
                <source src="https://new.rh-s.com/wp-content/uploads/2021/11/Offices-Tour-Remote-helpers-short.mp4"
                        type="video/mp4">
            </video>
            <H1><?php echo get_field('first_section_heading') ?></H1>
            <div class="slider-text-cont">
                <H2>Full-time virtual </H2>
                <div class="scroller">
                    <div class="inner">
                        <p>Designers</p>
                        <p>Developers</p>
                        <p>Managers</p>
                        <p>Employees</p>
                        <p>Assistance</p>
                    </div>
                </div>
            </div>
            <div class="first-button-cont">
                <a class="set-up-call" href="#"><i class="far fa-hand-spock"></i>Set up call</a>
                <a class="contact-us" href="#"><i class="far fa-envelope"></i>Contact us</a>
            </div>
            <p class="no-taxes">No taxes, no fees, no virus, no risk!</p>

        </section>
        <section class="employee-counter">
            <div>
                <div class="counter-numb"><?php echo get_field('remote_employees_counter')?>+</div>
                <div class="counter-text">Remote Employees</div>
            </div>
            <div>
                <div class="counter-numb"><?php echo get_field('employees_placement')?>+</div>
                <div class="counter-text">Cities of employees placement</div>
            </div>
            <div>
                <div class="counter-numb"><?php echo get_field('years_in_business')?>+</div>
                <div class="counter-text">Years in business</div>
            </div>
            <div>
                <div class="counter-numb"><?php echo get_field('companies_work_with')?>+</div>
                <div class="counter-text">Companies we work with</div>
            </div>

        </section>
    </main>

<?php
get_footer();