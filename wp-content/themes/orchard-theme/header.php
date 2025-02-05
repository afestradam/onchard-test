<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>


<header>

    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light navbar-transparent fixed-top">
        <div class="container-fluid navbar-container">
            <?php
            $logo_url = get_theme_mod('orchard_logo');

            // Si no hay un logo personalizado, usar una imagen por defecto (ajústala a una que sí exista)
            if (!$logo_url || empty($logo_url)) {
                $logo_url = get_template_directory_uri() . '/assets/images/default-logo.png'; // Cambia a una imagen real en tu tema
            }

            // Extraer el nombre del archivo para usarlo como `alt`
            $logo_name = pathinfo($logo_url, PATHINFO_FILENAME); // Obtiene solo el nombre sin la extensión
            $alt_text = ucwords(str_replace('-', ' ', $logo_name)); // Convierte guiones en espacios y capitaliza palabras
            ?>
            <a class="navbar-brand" href="<?php echo home_url(); ?>">
                <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($alt_text); ?>">
            </a>

            <ul class="nav navbar-items justify-content-end">
                <li class="nav-item navbar-items-menu">
                    <a class="navbar-menu" href="javascript: menuPanelMobile()">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-label="Toggle navigation">
                            <i id="main-navbar-i" class="fas fa-bars navbar-transparent-i"></i>
                        </button>
                    </a>
                </li>
            </ul>
            <div class="options collapse navbar-collapse justify-content-end">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'menu_class' => 'nav justify-content-end',
                    'container' => 'ul',
                    'id' => 'navbar-list-items'
                ));
                ?>
            </div>
        </div>
    </nav>
    <div id="navbar-panel" class="navbar-panel-mobile shadow">
        <div class="navbar-panel-head d-flex justify-content-end">
            <a href="javascript: menuPanelMobile();">
                <i class="fas fa-times fa-2x"></i>
            </a>
        </div>
        <div class="navbar-panel-items" id="navbar-panel-items">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'main-menu',
                'menu_class' => 'nav justify-content-end',
                'container' => 'ul',
                'id' => 'navbar-list-items'
            ));
            ?>
        </div>
        <div class="contact-content-web">
            <div class="contact-content-web-content">
                <div class="row" id="contact_info">
                </div>
            </div>
        </div>
    </div>

    <?php
    // Incluir el banner desde el plugin
    if (function_exists('orchard_display_banner')) {
        orchard_display_banner();
    }
    ?>
</header>
