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

// getting the categories

$categories = get_categories([
    'taxonomy' => 'category'
]);

// print_r($categories);

foreach ($categories as $cat) {
?>
    <a href="<?php echo get_category_link($cat->cat_ID); ?>"><?php echo $cat->name ?></a>
<?php

}
echo wp_pagenavi();

// displaying custom post type 
?>
<div class="container cpt">
    <h4 style="text-align: center;">Dispalying custom post type</h4>
    <?php
    $wp_args = [
        'post_type' => 'books',
        'post_status' => 'publish'
    ];
    ?>
    <div class="container custom-cpt">
        <?php
        $res = new WP_Query($wp_args);
        while ($res->have_posts()) {
            $res->the_post();
            $imagePath = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
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
        ?>
    </div>


</div>
<div class="container">
    <!-- front form -->
    <?php echo do_shortcode('[custom_front_form]') ?>
</div>

<?php
get_footer();
