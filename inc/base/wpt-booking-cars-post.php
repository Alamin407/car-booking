<?php
// Register custom post type 'cars' with categories, tags, thumbnails, and status support
function register_car_post_type() {
    $labels = array(
        'name'               => 'Cars',
        'singular_name'      => 'Car',
        'add_new'            => 'Add New Car',
        'add_new_item'       => 'Add New Car',
        'edit_item'          => 'Edit Car',
        'new_item'           => 'New Car',
        'all_items'          => 'All Cars',
        'view_item'          => 'View Car',
        'search_items'       => 'Search Cars',
        'not_found'          => 'No cars found',
        'not_found_in_trash' => 'No cars found in Trash',
        'menu_name'          => 'Cars',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'cars'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 9,
        'menu_icon'          => 'dashicons-car',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments', 'revisions', 'custom-fields', 'post-formats', 'page-attributes'),
        'taxonomies'         => array('category', 'post_tag'),
        'register_meta_box_cb' => 'add_car_status_meta_box', // Register custom meta box callback
    );

    register_post_type('car', $args);
}

add_action('init', 'register_car_post_type');

// Callback to add custom meta box for car status
function add_car_status_meta_box() {
    add_meta_box(
        'car_status_meta_box',
        'Car Status',
        'render_car_status_meta_box',
        'car',
        'side',
        'default'
    );
}

// Callback to render custom meta box for car status
function render_car_status_meta_box($post) {
    $car_status = get_post_meta($post->ID, '_car_status', true);
    ?>
    <label for="car_status">Status:</label>
    <select name="car_status" id="car_status">
        <option value="available" <?php selected($car_status, 'available'); ?>>Available</option>
        <option value="booked" <?php selected($car_status, 'booked'); ?>>Booked</option>
    </select>
    <?php
}

// Save car status when the post is saved
function save_car_status($post_id) {
    if (isset($_POST['car_status'])) {
        update_post_meta($post_id, '_car_status', sanitize_text_field($_POST['car_status']));
    }
}

add_action('save_post_car', 'save_car_status');

// Add status column to admin list table
function add_car_status_column($columns) {
    $columns['car_status'] = 'Status';
    return $columns;
}

add_filter('manage_car_posts_columns', 'add_car_status_column');

// Display status value in the admin list table
function display_car_status_value($column, $post_id) {
    if ($column == 'car_status') {
        $car_status = get_post_meta($post_id, '_car_status', true);
        echo ucfirst($car_status);
    }
}

add_action('manage_car_posts_custom_column', 'display_car_status_value', 10, 2);
