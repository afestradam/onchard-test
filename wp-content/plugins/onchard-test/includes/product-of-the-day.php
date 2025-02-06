<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Function to get the product of the day
function orchard_product_of_the_day()
{
    global $wpdb;

    // Retrieve a random product from the database
    $table_name = $wpdb->prefix . 'orchard_products';
    $product = $wpdb->get_row("SELECT * FROM $table_name ORDER BY RAND() LIMIT 1");

    // Check if a product was found
    if ($product) {
        ob_start(); // Start output buffering
        ?>
        <div class="product-card">
            <div class="image">
                <img src="<?php echo esc_url($product->product_image); ?>"
                     alt="<?php echo esc_attr($product->product_name); ?>">
            </div>
            <div class="content">
                <div class="title">
                    <h3><?php echo esc_html($product->product_name); ?></h3>
                </div>
                <div class="description">
                    <p>
                        <?php
                        echo wp_trim_words(esc_html($product->product_description), 7, '...');
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean(); // Return the generated content
    } else {
        return '<p>No products available.</p>';
    }
}

?>
