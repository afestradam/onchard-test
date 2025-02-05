<?php
// Habilitar Menús
function orchard_register_menus() {
    register_nav_menus(array(
        'main-menu' => __('Main Menu', 'orchard-theme'),
    ));
}
add_action('after_setup_theme', 'orchard_register_menus');

// Habilitar Soporte para Imágenes Destacadas
add_theme_support('post-thumbnails');

// Cargar CSS del Tema
if (!function_exists('orchard_enqueue_styles')) {
    function orchard_enqueue_styles() {
        wp_enqueue_style('orchard-style', get_template_directory_uri() . '/assets/css/styles.css');
    }
    add_action('wp_enqueue_scripts', 'orchard_enqueue_styles');
}

add_action('wp_enqueue_scripts', 'orchard_enqueue_styles');
?>
