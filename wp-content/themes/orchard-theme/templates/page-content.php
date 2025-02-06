<div class="page-content">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            echo '<h1>' . get_the_title() . '</h1>';
            the_content();
        endwhile;
    else :
        echo '<p>No content found.</p>';
    endif;
    ?>
</div>