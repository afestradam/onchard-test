<?php
/**
 * Plugin Name: Orchard Test
 * Plugin URI: https://andrestrada.com
 * Description: Custom plugin for Orchard PHP Developer Test
 * Version: 1.0
 * Author: Andrés Estrada
 * Author URI: https://andrestrada.com
 */

if (!defined('ABSPATH')) {
    exit; // Evita accesos directos
}

// Activar el plugin
function orchard_dev_activate() {

    global $wpdb;
    $table_name = $wpdb->prefix . 'orchard_products';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        product_id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
        product_name VARCHAR(255) NOT NULL,
        product_description TEXT NOT NULL,
        product_image VARCHAR(255) NOT NULL,
        product_featured TINYINT(1) DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (product_id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);

}
register_activation_hook(__FILE__, 'orchard_dev_activate');

// Cargar archivos del plugin
function orchard_dev_init() {
    require_once plugin_dir_path(__FILE__) . 'includes/banner.php';
    require_once plugin_dir_path(__FILE__) . 'includes/product-of-the-day.php';
    require_once plugin_dir_path(__FILE__) . 'includes/admin.php';
    require_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';
}

function orchard_enqueue_styles() {
    wp_enqueue_style('orchard-style', plugin_dir_url(__FILE__) . 'assets/style.css');
}

add_action('plugins_loaded', 'orchard_dev_init');
add_action('wp_enqueue_scripts', 'orchard_enqueue_styles');

