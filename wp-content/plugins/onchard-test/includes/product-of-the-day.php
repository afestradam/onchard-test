<?php
function orchard_product_of_the_day()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'orchard_products';

    $product = $wpdb->get_row("SELECT * FROM $table_name WHERE featured = 1 ORDER BY RAND() LIMIT 1");

    if (!$product) {
        return '<p>No featured products available.</p>';
    }

    return '<div class="product-of-the-day">
    <img src="' . esc_url($product->image_url) . '" alt="' . esc_attr($product->name) . '">
    <h2>' . esc_html($product->name) . '</h2>
    <p>' . esc_html($product->summary) . '</p>
    <a href="#" class="btn">View Product</a>
    </div>';
}

add_shortcode('product_of_the_day', 'orchard_product_of_the_day');
