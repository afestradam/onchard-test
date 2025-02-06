<?php

require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

// Enable Menus in WordPress
function orchard_register_menus()
{
    register_nav_menus(array(
        'main-menu' => __('Main Menu', 'orchard-theme'),
    ));
}

add_action('after_setup_theme', 'orchard_register_menus');

// Enable Support for Featured Images
add_theme_support('post-thumbnails');

// Load Bootstrap and Theme CSS
function orchard_enqueue_styles()
{
    // Load Bootstrap from CDN (you can change to a local version if preferred)
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', [], '5.3.2');
    // Load Theme CSS
    wp_enqueue_style('orchard-style', get_template_directory_uri() . '/assets/css/styles.css');
}

function orchard_customize_register($wp_customize) {
    // Sección de Identidad del Sitio (donde está el título y logo)
    $wp_customize->add_setting('orchard_logo', array(
        'default' => '', // Puedes poner una imagen por defecto si quieres
        'transport' => 'refresh',
    ));

    // Control para subir el logo
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'orchard_logo', array(
        'label' => __('Logo del Sitio', 'orchard-theme'),
        'section' => 'title_tagline', // Sección donde aparece el logo en el personalizador
        'settings' => 'orchard_logo',
    )));
}

function orchard_enqueue_scripts() {
    // Add Bootstrap JS (if not already included)
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.2', true);
    // Add custom dropdown script
    // wp_enqueue_script('orchard-dropdown-script', get_template_directory_uri() . '/assets/js/custom-dropdown.js', array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'orchard_enqueue_styles');
add_action('customize_register', 'orchard_customize_register');
add_action('wp_enqueue_scripts', 'orchard_enqueue_scripts');

?>
