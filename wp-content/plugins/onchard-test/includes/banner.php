<?php
function orchard_get_banner_image()
{

    // Obtener el ID del menú asignado a "Main Menu"
    $menu_name = 'main-menu';
    $menu_locations = get_nav_menu_locations();
    $menu_id = isset($menu_locations[$menu_name]) ? $menu_locations[$menu_name] : false;

    // Si no hay menú asignado, salir con error
    if (!$menu_id) {
        error_log('Error: No se encontró el ID del menú.');
        return '';
    }

    // Obtener los ítems del menú
    $menu_items = wp_get_nav_menu_items($menu_id);
    if (!$menu_items) {
        error_log('Error: No se encontraron elementos en el menú.');
        return '';
    }

    // Crear estructura para mapear los banners
    $menu_structure = [];
    $default_banner = ''; // Se llenará con la imagen de "Inicio"

    foreach ($menu_items as $item) {
        // Obtener el slug correctamente
        $item_url = $item->url;
        $parsed_url = parse_url($item_url);
        $slug = isset($parsed_url['path']) ? trim($parsed_url['path'], '/') : '';

        // Manejar casos donde el slug está vacío o es incorrecto
        if (empty($slug) || $slug === 'onchard-test') {
            $slug = sanitize_title($item->title); // Usar el título como fallback
        }

        // Obtener la imagen personalizada desde ACF (Si existe)
        $custom_banner = get_field('banner_image', $item->ID);

        // Si el ítem se llama "Inicio", lo usamos como default
        if (strtolower($item->title) === 'inicio' && !empty($custom_banner)) {
            $default_banner = $custom_banner;
        }

        // Guardar información en la estructura del menú
        $menu_structure[$item->ID] = [
            'slug'   => $slug,
            'parent' => $item->menu_item_parent,
            'banner' => !empty($custom_banner) ? $custom_banner : '' // Solo guardar si tiene imagen
        ];
    }

    // Si no encontramos un banner de "Inicio", poner una imagen genérica
    if (empty($default_banner)) {
        $default_banner = 'https://via.placeholder.com/1200x400?text=Default+Banner';
    }

    // Obtener el slug de la página actual
    global $post;
    $current_slug = ($post) ? get_post_field('post_name', $post->ID) : '';

    // Si no se detecta un slug, devolver el banner de "Inicio"
    if (empty($current_slug)) {
        error_log('No se detectó un slug. Usando banner de Inicio.');
        return $default_banner;
    }

    // Buscar si el slug actual está en el menú
    $found_item = null;
    foreach ($menu_structure as $item_id => $item) {
        if ($item['slug'] === $current_slug) {
            $found_item = $item;
            break;
        }
    }

    // Si encontramos el ítem, usamos su banner o el de su padre
    if ($found_item) {
        $parent_id = $found_item['parent'];

        // Si el ítem tiene un padre con banner, lo usamos
        if ($parent_id != 0 && isset($menu_structure[$parent_id]) && !empty($menu_structure[$parent_id]['banner'])) {
            $banner_image = $menu_structure[$parent_id]['banner'];
        } else {
            $banner_image = !empty($found_item['banner']) ? $found_item['banner'] : $default_banner;
        }
    } else {
        $banner_image = $default_banner;
    }

    error_log('Menu Structure: ' . json_encode($menu_structure)); // Para depuración
    error_log('Banner final seleccionado: ' . $banner_image);
    return $banner_image;

}

// Mostrar el banner en la página
function orchard_display_banner()
{
    $banner_image = orchard_get_banner_image();

    $banner_images = is_array($banner_image) ? $banner_image : [$banner_image];
    include get_template_directory() . '/templates/carousel.php';

    //$timestamp = time(); // Forzar actualización
    //echo '<div class="banner" style="background-image: url(' . esc_url($banner_image) . '?v=' . $timestamp . '); height: 400px;"></div>';
}
