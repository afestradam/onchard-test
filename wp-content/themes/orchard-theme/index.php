<?php get_header(); ?>

<main>
    <div class="content">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                the_title('<h1>', '</h1>');
                the_content();
            endwhile;
        else :
            echo '<p>No content found.</p>';
        endif;
        ?>
    </div>
    <?php echo do_shortcode('[product_of_the_day]'); // Muestra el Producto del Día ?>
</main>

<?php get_footer(); ?>
