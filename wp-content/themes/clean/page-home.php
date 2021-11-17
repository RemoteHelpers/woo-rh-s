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
            <div class="video-container">
                <video autoplay muted loop id="backgroundVideo">
                    <source src="https://new.rh-s.com/wp-content/uploads/2021/11/Offices-Tour-Remote-helpers-short.mp4"
                            type="video/mp4">
                </video>
            </div>
        </section>
    </main>

<?php
get_footer();