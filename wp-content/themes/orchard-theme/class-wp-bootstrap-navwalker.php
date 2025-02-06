<?php
class WP_Bootstrap_Navwalker extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= '<ul class="dropdown-menu">';
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));

        if (in_array('menu-item-has-children', $classes)) {
            $output .= '<li class="nav-item dropdown ' . esc_attr($class_names) . '">';
            $output .= '<a href="' . esc_url($item->url) . '" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">' . esc_html($item->title) . '</a>';
        } else {
            $output .= '<li class="nav-item ' . esc_attr($class_names) . '">';
            $output .= '<a href="' . esc_url($item->url) . '" class="nav-link">' . esc_html($item->title) . '</a>';
        }
    }
}
?>
