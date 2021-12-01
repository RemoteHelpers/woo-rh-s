<?php
/**
 * Pricing page
 */

get_header(); ?>

    <div class="pricing">

        <section class="swappable-elements-container">
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
                    <div class="card">
                        <h3>Assistants</h3>
                        <ul class="card-props">
                            <li class="card-price">
                                <sup>€</sup>800
                            </li>
                            <li>Lead generation</li>
                            <li>Personal assistants</li>
                            <li>Customer support</li>
                            <li>Recruiter</li>
                        </ul>
                    </div>
                    <div class="card">
                        <h3>Marketers</h3>
                        <ul class="card-props">
                            <li class="card-price">
                                <sup>€</sup>1000
                            </li>
                            <li>SEO/PPC/SMM</li>
                            <li>Content manager</li>
                            <li>Copywriter</li>
                            <li>Media buyer</li>
                        </ul>
                    </div>
                    <div class="card">
                        <h3>Designers</h3>
                        <ul class="card-props">
                            <li class="card-price">
                                <sup>€</sup>1200
                            </li>
                            <li>Web designer</li>
                            <li>Illustrator</li>
                            <li>Video editor</li>
                            <li>Graphic designer</li>
                        </ul>
                    </div>
                    <div class="card">
                        <h3>Developers</h3>
                        <ul class="card-props">
                            <li class="card-price">
                                <sup>€</sup>1400
                            </li>
                            <li>Front-end</li>
                            <li>Back-end</li>
                            <li>Full-stack</li>
                            <li>QA</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="switch-desc" data-desc="partTime">
                <p>Part-time employees work 4 hours per day (20 hours per week) in the
                    client’s time zone. The price depends on the specific type of work and the kind of provided
                    services.</p>
                <div class="pricing-cards">
                    <div class="card">
                        <h3>Assistants</h3>
                        <ul class="card-props">
                            <li class="card-price">
                                <sup>€</sup>500
                            </li>
                            <li>Lead generation</li>
                            <li>Personal assistants</li>
                            <li>Customer support</li>
                            <li>Recruiter</li>
                        </ul>
                    </div>
                    <div class="card">
                        <h3>Marketers</h3>
                        <ul class="card-props">
                            <li class="card-price">
                                <sup>€</sup>700
                            </li>
                            <li>SEO/PPC/SMM</li>
                            <li>Content manager</li>
                            <li>Copywriter</li>
                            <li>Media buyer</li>
                        </ul>
                    </div>
                    <div class="card">
                        <h3>Designers</h3>
                        <ul class="card-props">
                            <li class="card-price">
                                <sup>€</sup>900
                            </li>
                            <li>Web designer</li>
                            <li>Illustrator</li>
                            <li>Video editor</li>
                            <li>Graphic designer</li>
                        </ul>
                    </div>
                    <div class="card">
                        <h3>Developers</h3>
                        <ul class="card-props">
                            <li class="card-price">
                                <sup>€</sup>1100
                            </li>
                            <li>Front-end</li>
                            <li>Back-end</li>
                            <li>Full-stack</li>
                            <li>QA</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section>
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

        <section>
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