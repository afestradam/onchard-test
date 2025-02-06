<?php
function orchard_get_banner_image()
{

    // Get the ID of the menu assigned to "Main Menu"
    $menu_name = 'main-menu';
    $menu_locations = get_nav_menu_locations();
    $menu_id = isset($menu_locations[$menu_name]) ? $menu_locations[$menu_name] : false;

    // If no menu is assigned, exit with an error
    if (!$menu_id) {
        error_log('Error: Menu ID not found.');
        return '';
    }

    // Get menu items
    $menu_items = wp_get_nav_menu_items($menu_id);
    if (!$menu_items) {
        error_log('Error: No menu items found.');
        return '';
    }

    // Create a structure to map banners
    $menu_structure = [];
    $default_banner = ''; // Will be set with the "Home" image

    foreach ($menu_items as $item) {
        // Get the slug correctly
        $item_url = $item->url;
        $parsed_url = parse_url($item_url);
        $slug = isset($parsed_url['path']) ? trim($parsed_url['path'], '/') : '';

        // Handle cases where the slug is empty or incorrect
        if (empty($slug) || $slug === 'orchard-test') {
            $slug = sanitize_title($item->title); // Use the title as a fallback
        }

        // Get the custom image from ACF (if available)
        $custom_banner = get_field('banner_image', $item->ID);

        // If the item is called "Home," use it as the default
        if (strtolower($item->title) === 'home' && !empty($custom_banner)) {
            $default_banner = $custom_banner;
        }

        // Store information in the menu structure
        $menu_structure[$item->ID] = [
            'slug'   => $slug,
            'parent' => $item->menu_item_parent,
            'banner' => !empty($custom_banner) ? $custom_banner : '' // Store only if an image exists
        ];
    }

    // If no "Home" banner is found, set a generic image
    if (empty($default_banner)) {
        $default_banner = 'https://via.placeholder.com/1200x400?text=Default+Banner';
    }

    // Get the slug of the current page
    global $post;
    $current_slug = ($post) ? get_post_field('post_name', $post->ID) : '';

    // If no slug is detected, return the "Home" banner
    if (empty($current_slug)) {
        error_log('No slug detected. Using Home banner.');
        return $default_banner;
    }

    // Search if the current slug is in the menu
    $found_item = null;
    foreach ($menu_structure as $item_id => $item) {
        if ($item['slug'] === $current_slug) {
            $found_item = $item;
            break;
        }
    }

    // If the item is found, use its banner or its parent’s banner
    if ($found_item) {
        $parent_id = $found_item['parent'];

        // If the item has a parent with a banner, use it
        if ($parent_id != 0 && isset($menu_structure[$parent_id]) && !empty($menu_structure[$parent_id]['banner'])) {
            $banner_image = $menu_structure[$parent_id]['banner'];
        } else {
            $banner_image = !empty($found_item['banner']) ? $found_item['banner'] : $default_banner;
        }
    } else {
        $banner_image = $default_banner;
    }

    error_log('Menu Structure: ' . json_encode($menu_structure)); // Debugging
    error_log('Final selected banner: ' . $banner_image);
    return $banner_image;
}


// Display the banner on the page
function orchard_display_banner()
{
    $banner_image = orchard_get_banner_image();

    $banner_images = is_array($banner_image) ? $banner_image : [$banner_image];
    include get_template_directory() . '/templates/carousel.php';

}
