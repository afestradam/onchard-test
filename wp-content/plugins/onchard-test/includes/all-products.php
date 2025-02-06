<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Función para obtener todos los productos, excluyendo el destacado
function orchard_all_products()
{
    // Function to retrieve all products, excluding the featured one
    function orchard_all_products()
    {
        global $wpdb;

        // Product table name
        $table_name = $wpdb->prefix . 'orchard_products';

        // Retrieve all products where `product_featured` is 0 (Not featured)
        $products = $wpdb->get_results("SELECT * FROM $table_name WHERE product_featured = 0");

        // Check if there are products
        if ($products) {
            ob_start(); // Start output buffering
            ?>
            <div class="container mt-5">
                <div class="products-container-title">
                    <h2 class="text-left mb-4">All services</h2>
                </div>
                <div class="products-container">
                    <?php foreach ($products as $product) : ?>
                        <div class="products-card">
                            <div class="image">
                                <img src="<?php echo esc_url($product->product_image); ?>" class="card-img-top"
                                     alt="<?php echo esc_attr($product->product_name); ?>">
                            </div>
                            <div class="card-body">
                                <h6 class="card-title"><?php echo esc_html($product->product_name); ?></h6>
                                <p class="card-text">
                                    <?php
                                    echo wp_trim_words(esc_html($product->product_description), 5, '...');
                                    ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
            return ob_get_clean(); // Return the generated content
        } else {
            return '<p class="text-center">No services available.</p>';
        }
    }
}

?>
