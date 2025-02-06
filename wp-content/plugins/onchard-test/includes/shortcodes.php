<?php
// Evitar accesos directos
if (!defined('ABSPATH')) {
    exit;
}

// Registrar todos los shortcodes del plugin
function orchard_register_shortcodes() {
    add_shortcode('product_of_the_day', 'orchard_product_of_the_day');
}
add_action('init', 'orchard_register_shortcodes');
?>
