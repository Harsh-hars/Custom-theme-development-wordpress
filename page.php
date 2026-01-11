<?php
the_post();
// call the header to display
get_header();

?>
<div class="container">
    <h4><?php the_title(); ?></h4>
    <?php the_content(); ?>
    <?php
    the_post_thumbnail(array(400, 400));

    $imagePath = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
    // echo $imagePath[0];

 
    ?>
</div>

<?php
// call footer to the display
get_footer();
