<?php
// Evitar accesos directos
if (!defined('ABSPATH')) {
    exit;
}

// Función para obtener el producto del día
function orchard_product_of_the_day() {
    global $wpdb;

    // Obtener un producto aleatorio de la base de datos
    $table_name = $wpdb->prefix . 'orchard_products';
    $product = $wpdb->get_row("SELECT * FROM $table_name ORDER BY RAND() LIMIT 1");

    // Verificar si se encontró un producto
    if ($product) {
        ob_start(); // Iniciar buffer de salida
        ?>
        <div class="product-card">
            <div class="title">
                <h3><?php echo esc_html($product->product_name); ?></h3>
            </div>
            <div class="image">
                <img src="<?php echo esc_url($product->product_image); ?>" alt="<?php echo esc_attr($product->product_name); ?>">
            </div>
            <div class="description">
                <p><?php echo esc_html($product->product_description); ?></p>
            </div>
        </div>
        <?php
        return ob_get_clean(); // Devolver el contenido generado
    } else {
        return '<p>No hay productos disponibles.</p>';
    }
}
?>
