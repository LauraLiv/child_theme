<?php
function my_theme_enqueue_styles() {
    $parent_style = 'parent-style';
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array($parent_style),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function custom_woocommerce_product_query( $query ) {
    if ( ! is_admin() && is_shop() && $query->is_main_query() ) {
        $query->set( 'orderby', 'date' );
        $query->set( 'order', 'ASC' ); // ASC for oldest to newest, DESC for newest to oldest
    }
}
add_action( 'pre_get_posts', 'custom_woocommerce_product_query' );

add_action('pre_get_posts', 'custom_category_product_query');

function custom_category_product_query($query) {
    // Check if it's not admin, and it's a main query, and it's a category page
    if (!is_admin() && $query->is_main_query() && is_category()) {
        $query->set('orderby', 'date');
        $query->set('order', 'ASC'); // ASC for oldest to newest, DESC for newest to oldest
    }
}


?>



