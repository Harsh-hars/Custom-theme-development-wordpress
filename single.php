<?php get_header();
the_post();
?>

<div class="container">
    <div class="img-cont">
        <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded']); ?>
    </div>
    <div class="meta">
        <h5 class="uppercase"> By: <?php the_author(); ?> | <?php echo get_the_date(); ?></h5>
    </div>
    <h4><?php the_title(); ?></h4>
    <p><?php the_content(); ?></p>
    <div class="cat-tags">
        <strong>Categories: </strong> <?php the_category(', ') ?> <br />
        <strong>Tags: </strong> <?php the_tags(', ') ?>
    </div>
    <!-- comment display -->
    <?php
    // bring simple form
    //  comment_form(); 
    ?>

    <?php
    // bring both lists and comments
    // comments_template();

    dynamic_sidebar('side-bar');
    // echo wp_title();  
    echo bloginfo('description');
    ?>
</div>

<?php get_footer(); ?>