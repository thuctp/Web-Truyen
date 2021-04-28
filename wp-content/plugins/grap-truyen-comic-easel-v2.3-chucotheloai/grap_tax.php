<?php

if (!defined('ABSPATH'))
    exit;

class setup_tax {

    function __construct() {
        add_action('init', array($this, 'tax_loai_truyen'));
        add_action('init', array($this, 'register_new_terms'));
    }

    /* ==========  Register Loai truyen taxonomy ========== */

    function tax_loai_truyen() {

        $labels = array(
            'name' => _x('Loại truyện', 'Taxonomy General Name', 'text_domain'),
            'singular_name' => _x('Loại truyện', 'Taxonomy Singular Name', 'text_domain'),
            'menu_name' => __('Loại truyện', 'text_domain'),
            'all_items' => __('Tất cả Loại truyện', 'text_domain'),
            'parent_item' => __('Danh mục cha', 'text_domain'),
            'parent_item_colon' => __('Danh mục cha:', 'text_domain'),
            'new_item_name' => __('Tên Loại truyện mới', 'text_domain'),
            'add_new_item' => __('Thêm mới Loại truyện', 'text_domain'),
            'edit_item' => __('Sửa Loại truyện', 'text_domain'),
            'update_item' => __('Cập nhật Loại truyện', 'text_domain'),
            'separate_items_with_commas' => __('Cách mỗi Loại truyện bằng dấu phẩy', 'text_domain'),
            'search_items' => __('Tìm Loại truyện', 'text_domain'),
            'add_or_remove_items' => __('Thêm hoặc xóa Loại truyện', 'text_domain'),
            'choose_from_most_used' => __('Chọn Loại truyện được sử dụng nhiều', 'text_domain'),
            'not_found' => __('Không tìm thấy Loại truyện', 'text_domain'),
        );
        $args = array(
            'labels' => $labels,
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => true,
            'query_var' => true,
        );
        register_taxonomy('loai-truyen', array(), $args);
    }

    function register_new_terms() {
        $taxonomy = 'loai-truyen';
        $terms = array(
            '0' => array(
                'name' => 'Truyện tranh',
                'slug' => 'truyen-tranh',
                'description' => 'Truyện tranh',
            ),
            '1' => array(
                'name' => 'Truyện chữ',
                'slug' => 'truyen-chu',
                'description' => 'Truyện chữ',
            ),
        );

        foreach ($terms as $term_key => $term) {
            wp_insert_term(
                    $term['name'], $taxonomy, array(
                'description' => $term['description'],
                'slug' => $term['slug'],
                    )
            );
        }
    }

}

$taotax = new setup_tax();
