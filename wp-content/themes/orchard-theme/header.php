<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>


<header>

    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light navbar-transparent">
        <div class="container-fluid navbar-container">
            <?php
            $logo_url = get_theme_mod('orchard_logo');

            // If no custom logo is set, use a default image
            if (!$logo_url || empty($logo_url)) {
                $logo_url = get_template_directory_uri() . '/assets/images/default-logo.png';
            }

            // Extract the file name to use as the `alt` attribute
            $logo_name = pathinfo($logo_url, PATHINFO_FILENAME);
            $alt_text = ucwords(str_replace('-', ' ', $logo_name));
            ?>
            <a class="navbar-brand" href="<?php echo home_url(); ?>">
                <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($alt_text); ?>">
            </a>

            <!-- Hamburger Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="options collapse navbar-collapse justify-content-end" id="navbarNav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'menu_class' => 'navbar-nav',
                    'container' => false,
                    'walker' => new WP_Bootstrap_Navwalker()
                ));
                ?>
            </div>
        </div>
    </nav>

    <?php
    // Include the banner from the plugin
    if (function_exists('orchard_display_banner')) {
        orchard_display_banner();
    }
    ?>
</header>

