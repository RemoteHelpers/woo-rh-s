<?php
/**
 * Privacy page
 */

get_header(); ?>

    <div class="privacy">

        <h1>LEGAL AGREEMENTS</h1>

        <div class="privacy-body">
            <ul class="tabs">
                <li class="privacy-tab active" data-tab="terms">TERMS & CONDITIONS</li>
                <li class="privacy-tab" data-tab="privacy">PRIVACY POLICY</li>
                <li class="privacy-tab" data-tab="accessibility">ACCESSIBILITY</li>
            </ul>
            <div class="content shown" data-content="terms">
                <?php echo get_field('terms_tab'); ?>
            </div>
            <div class="content" data-content="privacy">
                <?php echo get_field('privacy_policy'); ?>
            </div>
            <div class="content" data-content="accessibility">
                <?php echo get_field('accessibility'); ?>
            </div>
        </div>
    </div>

<?php get_footer();
