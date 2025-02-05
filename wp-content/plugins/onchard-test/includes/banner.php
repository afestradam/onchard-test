<?php
function orchard_get_banner_image()
{
    // URL base del plugin para cargar imágenes
    $plugin_url = plugin_dir_url(__FILE__);

    // Imagen por defecto
    $banner_image = $plugin_url . 'media/banner-default.png';

    // Obtener el slug de la página actual en WordPress
    global $post;
    $current_slug = ($post) ? get_post_field('post_name', $post->ID) : '';

    // Si no se detecta un slug, usar la imagen por defecto
    if (empty($current_slug)) {
        error_log('No se detectó un slug. Usando banner por defecto.');
        return $banner_image;
    }

    error_log('Slug actual detectado: ' . $current_slug);

    // Asignar imagen según el slug de la página actual
    if ($current_slug === 'root-a' || $current_slug === 'sub-1') {
        $banner_image = $plugin_url . 'media/banner-a.png';
    } elseif ($current_slug === 'root-b' || $current_slug === 'sub-2' || $current_slug === 'sub-3') {
        $banner_image = $plugin_url . 'media/banner-b.png';
    }

    error_log('Banner final seleccionado: ' . $banner_image);
    return $banner_image;
}

// Mostrar el banner en la página
function orchard_display_banner()
{
    $banner_image = orchard_get_banner_image();
    $timestamp = time(); // Forzar actualización
    echo '<div class="banner" style="background-image: url(' . esc_url($banner_image) . '?v=' . $timestamp . '); height: 400px;"></div>';
}
