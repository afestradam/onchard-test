<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Register all plugin shortcodes
function orchard_register_shortcodes()
{
    add_shortcode('product_of_the_day', 'orchard_product_of_the_day');
    add_shortcode('all_products', 'orchard_all_products');

}

add_action('init', 'orchard_register_shortcodes');
?>
