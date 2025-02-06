<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <?php
            // Check if there are posts
            if (have_posts()) :
                while (have_posts()) : the_post();
                    the_title('<h1>', '</h1>'); // Display the post title
                    the_content(); // Display the post content
                endwhile;
            else :
                echo '<p>No content found.</p>';
            endif;
            ?>
        </div>
        <div class="col-md-4">
            <?php get_sidebar(); // Load the sidebar ?>
        </div>
    </div>
</div>
