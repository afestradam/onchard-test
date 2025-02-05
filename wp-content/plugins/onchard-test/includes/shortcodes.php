<?php

function orchard_display_featured_product() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'orchard_products';

    $product = $wpdb->get_row("SELECT * FROM $table_name WHERE product_featured = 1 LIMIT 1");

    if (!$product) {
        return '<p>No featured product available.</p>';
    }

    return '
        <div class="featured-product">
            <img src="' . esc_url($product->product_image) . '" width="200">
            <h2>' . esc_html($product->product_name) . '</h2>
            <p>' . esc_html($product->product_description) . '</p>
        </div>';
}

add_shortcode('product_of_the_day', 'orchard_display_featured_product');
