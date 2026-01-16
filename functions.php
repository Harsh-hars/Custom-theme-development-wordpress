<?php

// Menu registration
function register_menu()
{
    register_nav_menus(array(
        'primary-menu' => __('primary Menu', 'custom-theme')
    ));
}
add_action('after_setup_theme', 'register_menu');

// Enqueue Bootstrap assets
function enqueue_bootstrap()
{
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array(), null, true);
}

add_action('wp_enqueue_scripts', 'enqueue_bootstrap');

// Enqueue style.css file 
function mytheme_enqueue_styles()
{
    wp_enqueue_style(
        'mytheme-style',
        get_stylesheet_uri()
    );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_styles');

// Add featured image
add_theme_support('post-thumbnails');

// Add custom header image
add_theme_support('custom-header');

// get_template_directory() -> return server path file system

// get_template_directory_uri() -> public url

// Add excerpt for the posts
add_post_type_support('post', 'excerpt');

// adding dynamic widget ready sidebar
register_sidebar([
    "name" => "Sidebar",
    "id" => "side-bar"
]);


// Adding Custom post type

function register_cpt_books()
{
    $labels = [
        'name' => 'Books',
        'singular_name' => 'Book',
    ];
    $args = [
        'labels' => $labels,
        'public' => true,
        'support' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true,
        'menu_icon'     => 'dashicons-book'
    ];

    register_post_type('Books', $args);
}

add_action('init', 'register_cpt_books');
