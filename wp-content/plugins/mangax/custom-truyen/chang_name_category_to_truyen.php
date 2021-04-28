<?php
function change_post_menu_label_category() {
  global $menu;
  global $submenu;
  

  $submenu['edit.php'][15][0] = 'Truyện'; // Change name for categories
  $submenu['edit.php'][16][0] = 'Tag truyện'; // Change name for tags
  echo '';
}
add_action( 'admin_menu', 'change_post_menu_label_category' );

function change_tax_object_label_category() {
  global $wp_taxonomies;
  $labels = &$wp_taxonomies['category']->labels;
  $labels->name = __('Truyện', 'theme_namespace');
  $labels->singular_name = __('Truyện', 'theme_namespace');
  $labels->search_items = __('Truyện', 'theme_namespace');
  $labels->all_items = __('Tất cả các truyện', 'theme_namespace');
  $labels->parent_item = __('Truyện cha', 'theme_namespace');
  $labels->parent_item_colon = __('Truyện cha:', 'theme_namespace');
  $labels->edit_item = __('Sửa truyện', 'theme_namespace');
  $labels->view_item = __('Xem truyện', 'theme_namespace');
  $labels->update_item = __('Cập nhật truyện', 'theme_namespace');
  $labels->add_new_item = __('Thêm truyện', 'theme_namespace');
  $labels->new_item_name = __('Truyện', 'theme_namespace');
}
add_action( 'init', 'change_tax_object_label_category' );




