<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    the_title('<h1>', '</h1>');
                    the_content();
                endwhile;
            else :
                echo '<p>No se encontró contenido.</p>';
            endif;
            ?>
        </div>
        <div class="col-md-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>
