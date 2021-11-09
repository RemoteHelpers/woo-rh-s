<?php
/*
Plugin Name: Собственный плагин фильтра
Description: Пробуем не использовать сторонние фильтры. При активации создает на транице /shop фильтр в левой колонке.
Version: 1.0
*/

function rh_filter_scripts() {
    wp_enqueue_script( 'rh-filter',  plugin_dir_url( __FILE__ ) . '/scripts/index.js', array('jquery'), null, false );
}
add_action( 'wp_enqueue_scripts', 'rh_filter_scripts' );

add_action('rh_archive_filter', 'rh_add_filter', 10);
function rh_add_filter() { ?>
<div class="archive-page">
    <div class="archive-filter">
        <h2>Фильтр:</h2>
        <form>
            <input type="checkbox" id="checkbox1" name="checkbox1" value="Available">
            <label for="checkbox1">Available</label><br>
            <input type="checkbox" id="checkbox2" name="checkbox2" value="Part-Time">
            <label for="checkbox2">Part-Time</label><br>
            <input type="checkbox" id="checkbox3" name="checkbox3" value="Busy">
            <label for="checkbox3">Busy</label><br>
        </form>
    </div>
<?php } ?>

<?php
add_action('rh_add_closing_div', 'rh_close_filter_div', 10);
function rh_close_filter_div() { ?>
    </div>
<?php } ?>