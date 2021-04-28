<?php 
/*Đổi tên Post thành comic*/
function change_post_lable_to_comic() {
    global $menu;
    global $submenu;
    $menu[5][0] = ' Quản lý truyện';
    $submenu['edit.php'][5][0] = 'Tất cả chương';
    $submenu['edit.php'][10][0] = 'Thêm chương';
    echo '';
}
function change_post_object_label_to_comic() {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = 'Chương';
        $labels->singular_name = 'Chương';
        $labels->add_new = 'Thêm chương';
        $labels->add_new_item = 'Thêm chương';
        $labels->edit_item = 'Sửa chương';
        $labels->new_item = 'Chương';
        $labels->view_item = 'Xem chương';
        $labels->search_items = 'Tìm chương';
        $labels->not_found = 'Không tìm thấy chương';
        $labels->not_found_in_trash = 'Không tìm thấy chương trong thùng rác';
}
add_action( 'init', 'change_post_object_label_to_comic' );
add_action( 'admin_menu', 'change_post_lable_to_comic' );