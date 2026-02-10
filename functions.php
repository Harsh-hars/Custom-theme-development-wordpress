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
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true,
        'menu_icon'     => 'dashicons-book',
        'has_archive' => true,
        'rewrite' => [
            'slug' => 'books',
            'with_front' => false,
        ],
    ];

    register_post_type('books', $args);
}


add_action('init', 'register_cpt_books');


// front form upload
add_shortcode('custom_front_form', 'front_form');

function front_form()
{
    ob_start();
?>
    <form id="front_form" method="post" enctype="multipart/form-data">
        <p>
            <input type="text" name="emp_name" placeholder="Employee name">
        </p>
        <p>
            <input type="email" name="emp_email" placeholder="Employee email">
        </p>
        <p>
            <input type="text" name="emp_salary" placeholder="employee salary">
        </p>
        <p>
            <input type="file" name="emp_file">
        </p>
        <p>
            <input type="hidden" name="action" value="save_emp_details">
        </p>
        <p>
            <button type="submit">Submit</button>
        </p>
        <p>
        <div class="loader" style="display:none;">Submitting...</div>
        </p>
        <p>
        <div class="res"></div>
        </p>
    </form>
    <style>
        .loader {
            margin: 10px 0;
            font-size: 14px;
            color: #0073aa;
        }

        .loader::after {
            content: '';
            width: 18px;
            height: 18px;
            border: 3px solid #ccc;
            border-top: 3px solid #0073aa;
            border-radius: 50%;
            display: inline-block;
            margin-left: 8px;
            animation: spin 0.8s linear infinite;
            vertical-align: middle;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
    <script>
        jQuery(document).ready(function($) {

            $('#front_form').on('submit', function(e) {
                e.preventDefault();

                let form = this;
                let formdata = new FormData(form);

                $('.loader').show();
                $('.res').html('');

                $.ajax({
                    url: "<?php echo admin_url('admin-ajax.php'); ?>",
                    method: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,

                    success: function(res) {
                        $('.res').html(res);
                        form.reset();
                    },

                    error: function() {
                        $('.res').html('<span style="color:red;">Something went wrong</span>');
                    },

                    complete: function() {
                        $('.loader').hide();
                    }
                });
            });

        });
    </script>

<?php
    return ob_get_clean();
}

// ajax action

add_action('wp_ajax_save_emp_details', 'save_emp_details'); // for logged in users
add_action('wp_ajax_nopriv_save_emp_details', 'save_emp_details');

function save_emp_details()
{
    $title = $_POST['emp_name'];
    $email = $_POST['emp_email'];
    $salary = $_POST['emp_salary'];
    $post_id = wp_insert_post(
        [
            'post_title' => $title,
            'post_type' => 'post',
            'post_status' => 'draft'
        ]
    );
    update_post_meta($post_id, 'emp_email', $email);
    update_post_meta($post_id, 'emp_salary', $salary);
    if ($_FILES['emp_file']['name']) {
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        $file = media_handle_upload('emp_file', $post_id);
        if (!is_wp_error($file)) {
            update_post_meta($post_id, 'emp_file', $file);
        }
    }

    echo 'form suubmitted successfully';
    wp_die();
}
