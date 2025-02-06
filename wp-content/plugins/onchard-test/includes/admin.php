<?php
// Add the admin menu
function orchard_admin_menu()
{
    add_menu_page(
        'Orchard Products',  // Page title
        'Orchard Products',  // Menu text
        'manage_options',     // Required permission
        'orchard-products',   // Slug
        'orchard_products_page', // Function that displays the page
        'dashicons-cart',      // Menu icon
        6                     // Menu position
    );
}


add_action('admin_menu', 'orchard_admin_menu');

// Delete product if "Delete" is clicked
if (isset($_GET['delete'])) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'orchard_products';
    $product_id = intval($_GET['delete']);

    $wpdb->delete($table_name, ['product_id' => $product_id]);

    echo '<div class="updated"><p>Product deleted successfully!</p></div>';
}

// Mark a product as "Product of the Day"
if (isset($_GET['feature'])) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'orchard_products';
    $product_id = intval($_GET['feature']);

    // First, remove the "Product of the Day" mark from all products
    $wpdb->update($table_name, ['product_featured' => 0], ['product_featured' => 1]);

    // Now, mark the selected product as "Product of the Day"
    $wpdb->update($table_name, ['product_featured' => 1], ['product_id' => $product_id]);

    echo '<div class="updated"><p>Product set as "Product of the Day" successfully!</p></div>';
}

// Function that renders the admin page
function orchard_products_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'orchard_products';

    // Check if the form was submitted to add a new product
    if (isset($_POST['orchard_add_product'])) {
        $product_name = sanitize_text_field($_POST['product_name']);
        $product_description = sanitize_textarea_field($_POST['product_description']);
        $product_image = esc_url_raw($_POST['product_image']);

        $wpdb->insert($table_name, [
            'product_name' => $product_name,
            'product_description' => $product_description,
            'product_image' => $product_image
        ]);

        echo '<div class="updated"><p>Product added successfully!</p></div>';
    }

    // Retrieve all products from the database
    $products = $wpdb->get_results("SELECT * FROM $table_name");

    ?>

    <div class="wrap">
        <h1>Manage Products</h1>

        <h2>Add New Product</h2>
        <form method="POST">
            <table class="form-table">
                <tr>
                    <th><label for="product_name">Product Name:</label></th>
                    <td><input type="text" name="product_name" required></td>
                </tr>
                <tr>
                    <th><label for="product_description">Product Description:</label></th>
                    <td><textarea name="product_description" required></textarea></td>
                </tr>
                <tr>
                    <th><label for="product_image">Product Image URL:</label></th>
                    <td><input type="text" name="product_image" required></td>
                </tr>
            </table>
            <input type="submit" name="orchard_add_product" class="button button-primary" value="Add Product">
        </form>

        <h2>Existing Products</h2>
        <table class="wp-list-table widefat fixed striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($products) : ?>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?php echo esc_html($product->product_id); ?></td>
                        <td><?php echo esc_html($product->product_name); ?></td>
                        <td><?php echo esc_html($product->product_description); ?></td>
                        <td><img src="<?php echo esc_url($product->product_image); ?>" width="50"></td>
                        <td>
                            <?php if ($product->product_featured == 1) : ?>
                                <strong style="color: green;">✔ Featured</strong>
                            <?php else : ?>
                                <a href="?page=orchard-products&feature=<?php echo esc_attr($product->product_id); ?>" class="button">Set as Product of the Day</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="?page=orchard-products&delete=<?php echo esc_attr($product->product_id); ?>" class="button button-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">No products found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php
}

