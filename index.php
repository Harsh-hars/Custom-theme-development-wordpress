<?php
get_header();
?>
<div class="container post-container">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            $imagePath = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
            // print_r($imagePath);
    ?>
            <a class="post-card" href="<?php the_permalink() ?>">
                <div class="card" style="width: 18rem;">
                    <img src="<?php echo $imagePath[0] ?>" class="card-img-top" alt="Card-Image">
                    <div class="card-body">
                        <h4 class="card-text"><?php the_title(); ?></h4>
                        <p class="card-text"><?php the_content(); ?></p>
                        <p class="card-text"><?php echo get_the_date(); ?></p>
                        <!-- <p class="card-text"><?php the_excerpt(); ?></p> -->
                    </div>
                </div>
            </a>

    <?php

        }
    }

    ?>
</div>

<?php
echo wp_pagenavi();
get_footer();
