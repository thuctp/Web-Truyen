<?php

if (!defined('ABSPATH'))
    exit;

// Register Custom Post Type
function cpt_grap_truyen() {

    $labels = array(
        'name' => _x('Grab truyện', 'Post Type General Name', 'text_domain'),
        'singular_name' => _x('Grab truyện', 'Post Type Singular Name', 'text_domain'),
        'menu_name' => __('Grab truyện', 'text_domain'),
        'parent_item_colon' => __('Danh mục cha:', 'text_domain'),
        'all_items' => __('Danh sách Grab', 'text_domain'),
        'view_item' => __('Xem', 'text_domain'),
        'add_new_item' => __('Thêm Grab truyện', 'text_domain'),
        'add_new' => __('Thêm mới', 'text_domain'),
        'edit_item' => __('Sửa', 'text_domain'),
        'update_item' => __('Cập nhật', 'text_domain'),
        'search_items' => __('Tìm kiếm Grap truyện', 'text_domain'),
        'not_found' => __('Không tìm thấy Grab truyện nào', 'text_domain'),
        'not_found_in_trash' => __('Không tìm thấy Grab truyện nào trong thùng rác', 'text_domain'),
    );
    $args = array(
        'label' => __('grap_truyen', 'text_domain'),
        'description' => __('Custom post type Grab truyện', 'text_domain'),
        'labels' => $labels,
        'supports' => array('title'),
        'taxonomies' => array(''),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
        'rewrite' => array('slug' => 'grap-truyen'),
    );
    register_post_type('grap_truyen', $args);
}

// Hook into the 'init' action
add_action('init', 'cpt_grap_truyen', 0);
