<?php get_header(); ?>

<main>
    <?php get_template_part('templates/products'); ?>
    <?php echo do_shortcode('[all_products]'); ?>
</main>

<?php get_footer(); ?>
