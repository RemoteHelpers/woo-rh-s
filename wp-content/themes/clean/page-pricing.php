<?php
/**
 * Pricing page
 */

get_header(); ?>

    <div class="pricing">

        <section class="padding-3">

            <div class="pricing-switch">
                <span class="active" data-switch="fullTime">FULL TIME EMPLOYEES</span>
                <input class="switch" data-switch="fullTime" type="checkbox">
                <span data-switch="partTime">PART TIME EMPLOYEES</span>
            </div>
            <div class="switch-desc active" data-desc="fullTime">
                <p>Full-time employees work 8 hours per day (40 hours per week) in
                    the client’s time zone. The price depends on the specific type of work and the kind of provided
                    services.</p>
                <div class="pricing-cards">
                    <?php
                    if (have_rows('employee_group_card')) :
                        while (have_rows('employee_group_card')) : the_row(); ?>
                            <div class="card">
                                <h3><?php the_sub_field('employee_group_name'); ?></h3>
                                <ul class="card-props">
                                    <li class="card-price">
                                        <sup>€</sup><?php the_sub_field('employee_group_full-time_price'); ?>
                                    </li>
                                    <?php
                                    $skills_field = get_sub_field('employee_group_skills');
                                    $skills_array = explode(';', $skills_field);
                                    foreach ($skills_array as $skill) : ?>
                                        <li><?php echo $skill; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php
                        endwhile;
                    endif;
                    ?>
                </div>
            </div>
            <div class="switch-desc" data-desc="partTime">
                <p>Part-time employees work 4 hours per day (20 hours per week) in the
                    client’s time zone. The price depends on the specific type of work and the kind of provided
                    services.</p>
                <div class="pricing-cards">
                    <?php
                    if (have_rows('employee_group_card')) :
                        while (have_rows('employee_group_card')) : the_row(); ?>
                            <div class="card">
                                <h3><?php the_sub_field('employee_group_name'); ?></h3>
                                <ul class="card-props">
                                    <li class="card-price">
                                        <sup>€</sup><?php the_sub_field('employee_group_part-time_price'); ?>
                                    </li>
                                    <?php
                                    $skills_field = get_sub_field('employee_group_skills');
                                    $skills_array = explode(';', $skills_field);
                                    foreach ($skills_array as $skill) : ?>
                                        <li><?php echo $skill; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php
                        endwhile;
                    endif;
                    ?>
                </div>
            </div>
        </section>

        <section class="padding-3">

            <h2>Special offers</h2>
            <div class="offer-cards">
                <div class="card">
                    <h3>Content + Designer</h3>
                    <ul class="card-body">
                        <li><span class="price">€1000</span><br/>
                            month
                        </li>
                        <li>4 h/day<br/>2 h/specialist</li>
                    </ul>
                    <button>Get Started</button>
                </div>
                <div class="card center">
                    <h3>Designer + Frontend Developer</h3>
                    <ul class="card-body">
                        <li><span class="price">€1100</span><br/>
                            month
                        </li>
                        <li>4 h/day<br/>2 h/specialist</li>
                    </ul>
                    <button>Get Started</button>
                </div>
                <div class="card">
                    <h3>Content + Designer + Video Editor
                    </h3>
                    <ul class="card-body">
                        <li><span class="price">€1300</span><br/>
                            month
                        </li>
                        <li>4 h/day<br/>2 h/specialist</li>
                    </ul>
                    <button>Get Started</button>
                </div>
            </div>
        </section>

        <section class="padding-3">

            <div class="table-wrap">
                <table>
                    <tr>
                        <th class="table-header">Content</th>
                        <th>Content + Designer</th>
                        <th>Designer + Frontend Developer</th>
                        <th>Content + Designer + Video Editor</th>
                    </tr>
                    <tr>
                        <td>Copywriting</td>
                        <td class="plus">+</td>
                        <td class="minus">-</td>
                        <td class="plus">+</td>
                    </tr>
                    <tr>
                        <td>Content posting</td>
                        <td class="plus">+</td>
                        <td class="minus">-</td>
                        <td class="plus">+</td>
                    </tr>
                    <tr>
                        <td>SMM management</td>
                        <td class="plus">+</td>
                        <td class="minus">-</td>
                        <td class="plus">+</td>
                    </tr>
                    <tr>
                        <td>Logo creation</td>
                        <td class="plus">+</td>
                        <td class="plus">+</td>
                        <td class="plus">+</td>
                    </tr>
                    <tr>
                        <td>Website/app layout design</td>
                        <td class="plus">+</td>
                        <td class="plus">+</td>
                        <td class="plus">+</td>
                    </tr>
                    <tr>
                        <td>Creatives development</td>
                        <td class="plus">+</td>
                        <td class="plus">+</td>
                        <td class="plus">+</td>
                    </tr>
                    <tr>
                        <td>Website/app interface development</td>
                        <td class="minus">-</td>
                        <td class="plus">+</td>
                        <td class="minus">-</td>
                    </tr>
                    <tr>
                        <td>Optimizing the user expirience</td>
                        <td class="minus">-</td>
                        <td class="plus">+</td>
                        <td class="minus">-</td>
                    </tr>
                    <tr>
                        <td>Testing & debugging</td>
                        <td class="minus">-</td>
                        <td class="plus">+</td>
                        <td class="minus">-</td>
                    </tr>
                    <tr>
                        <td>Promo video creation</td>
                        <td class="minus">-</td>
                        <td class="minus">-</td>
                        <td class="plus">+</td>
                    </tr>
                    <tr>
                        <td>Video edting</td>
                        <td class="minus">-</td>
                        <td class="minus">-</td>
                        <td class="plus">+</td>
                    </tr>
                    <tr>
                        <td>Animation & visual effects creation</td>
                        <td class="minus">-</td>
                        <td class="minus">-</td>
                        <td class="plus">+</td>
                    </tr>
                </table>
            </div>
        </section>

    </div>

<?php get_footer();