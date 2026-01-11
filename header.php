<?php wp_head(); ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">

        <a class="navbar-brand" href="<?php echo home_url('/'); ?>">
            <img src="<?php echo get_header_image(); ?>" alt="LOGO" height="100" width="200">
        </a>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <?php
        wp_nav_menu(array(
            'theme_location'  => 'primary-menu',
            'container'       => 'div',
            'container_class' => 'collapse navbar-collapse',
            'container_id'    => 'mainNav',
            'menu_class'      => 'navbar-nav ms-auto',
            'fallback_cb'     => false,
        ));
        ?>

    </div>
</nav>