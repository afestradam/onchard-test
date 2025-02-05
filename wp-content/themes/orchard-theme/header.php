<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header>
    <nav class="main-navigation">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'main-menu',
            'menu_class' => 'menu',
            'container' => 'ul',
        ));
        ?>
    </nav>

    <?php
    // Incluir el banner desde el plugin
    if (function_exists('orchard_display_banner')) {
        orchard_display_banner();
    }
    ?>
</header>
