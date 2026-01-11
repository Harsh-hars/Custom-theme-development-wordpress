<?php wp_footer(); ?>

<div class="container-fluid footer-cont">
    <div class="container">
        <footer class="py-3">
            <?php
            wp_nav_menu(array(
                'theme_location'  => 'primary-menu',
                'container'       => 'div',
                'container_class' => 'footer-menu',
                'menu_class'      => 'navbar-nav',
                'link_after'      => ' <span class="separator">|</span>',
                'fallback_cb'     => false,
            ));
            ?>
            <hr style="color: white;">
            <p class="text-center text-muted copyright">© <?php echo date('Y') ?> , All right reserved</p>
        </footer>
    </div>
</div>