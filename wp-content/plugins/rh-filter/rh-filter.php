<?php
/*
Plugin Name: Собственный плагин фильтра
Description: Пробуем не использовать сторонние фильтры. При активации создает на транице /shop фильтр в левой колонке.
Version: 1.0
*/

/**
 * Enque script(index.js).
 */
add_action( 'wp_enqueue_scripts', 'rh_filter_scripts' );
function rh_filter_scripts() {
    wp_enqueue_script( 'rh-filter',  plugin_dir_url( __FILE__ ) . '/scripts/index.js', array('jquery'), null, false );
}

/**
 * Filter markup.
 */
add_action('rh_archive_filter', 'rh_add_filter', 10);
function rh_add_filter() { ?>
<div class="archive-page">
    <div class="archive-filter">
        <h2>Фильтр:</h2>
        <form>
            <input type="checkbox" id="checkbox1" name="checkbox1" value="#2ecc71">
            <label for="checkbox1">Available</label><br>
            <input type="checkbox" id="checkbox2" name="checkbox2" value="#f1c40f">
            <label for="checkbox2">Part-Time</label><br>
            <input type="checkbox" id="checkbox3" name="checkbox3" value="#e74c3c">
            <label for="checkbox3">Busy</label><br>
        </form>
    </div>
<?php } ?>

<?php
add_action('rh_add_closing_div', 'rh_close_filter_div', 10);
function rh_close_filter_div() { ?>
    </div>
<?php }

/**
* Back-end logic.
*/
add_action('wp_ajax_shop_filter', 'shop_filter');
add_action( 'wp_ajax_nopriv_shop_filter', 'shop_filter' );

function shop_filter() {
$rh_filter = $_POST['filter'];

$params = array(
'post_type' => array('product', 'product_variation'),
'meta_query' => array(
array(
'key' => 'current_work_status',
'value' => $rh_filter,
)
)
);

$query = new WP_Query( $params );

if($query->have_posts()) {
echo '<div class="rh-filter-res">';
    while ($query->have_posts()) : $query->the_post();
    $img = get_the_post_thumbnail();
    echo $img;
    endwhile;
    wp_reset_postdata();
    echo '</div>';
}
wp_die();
}
?>
