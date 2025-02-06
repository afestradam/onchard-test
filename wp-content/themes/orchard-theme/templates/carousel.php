<?php
// If `$banner_images` is not defined, use an empty array
if (!isset($banner_images) || empty($banner_images)) {
    $banner_images = [get_template_directory_uri() . '/assets/images/default-banner.jpg'];
}
?>

<div id="orchardCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php foreach ($banner_images as $index => $image_url) : ?>
            <div class="carousel-item <?php echo ($index === 0) ? 'active' : ''; ?>">
                <img src="<?php echo esc_url($image_url); ?>" class="d-block w-100" alt="Banner Image <?php echo $index + 1; ?>">
            </div>
        <?php endforeach; ?>
    </div>
</div>
