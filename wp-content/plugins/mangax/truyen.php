<?php
/*
Plugin Name: Mangax
Version: 1.0
Author: ZingWP-Dev

*/
?>
<?php
if( ! defined( 'ABSPATH' ) ) exit;
define ( 'COMIC_DIR', plugin_dir_path(__FILE__) );
define ( 'COMIC_URL', plugin_dir_url(__FILE__) );


require_once COMIC_DIR .  "acfpro/acf.php";

/*Thêm taxanomy thể loại truyện*/
require_once COMIC_DIR .  "custom-truyen/taxonomy-theloai.php";

/*Thêm taxanomy tác giả truyện*/
require_once COMIC_DIR .  "custom-truyen/taxonomy-tacgia.php";

/*Thêm taxanomy nhóm dịch truyện*/
require_once COMIC_DIR .  "custom-truyen/taxonomy-nhomdich.php";

/*Đổi tên Post thành chương*/
require_once COMIC_DIR .  "custom-truyen/chang_name_post_to_comic.php";
/*Đổi tên category mặc định thành truyện*/

require_once COMIC_DIR .  "custom-truyen/chang_name_category_to_truyen.php";

/*Save các meta thể loại và tác giả trong truyện*/
require_once COMIC_DIR .  "custom-truyen/save_meta_taxonomy.php";

/*Thêm cột tác giả và thể loại vào danh sách các truyện*/
require_once COMIC_DIR .  "custom-truyen/add_colum_tacgia_theloai.php";

/*Trang thái của truyện*/
require_once COMIC_DIR .  "custom-truyen/trang-thai.php";

/*Lượt xem của truyện*/
require_once COMIC_DIR .  "custom-truyen/luotxem.php";

/*Thêm ảnh đại diện*/
require_once COMIC_DIR .  "custom-truyen/add_img_truyen.php";

/*Nguồn của truyện*/
require_once COMIC_DIR .  "custom-truyen/nguon.php";
/*Khai báo các widget*/
require_once COMIC_DIR .  "widget.php";

/*Gọi widget*/
require_once COMIC_DIR .  "widget/truyenmoidang.php";
require_once COMIC_DIR .  "widget/truyenhot.php";
require_once COMIC_DIR .  "widget/truyenrandom.php";
require_once COMIC_DIR .  "widget/chucai.php";
require_once COMIC_DIR .  "widget/theloai.php";
require_once COMIC_DIR .  "widget/filter.php";

/*Trang cài đặt khác*/
require_once COMIC_DIR .  "setting-page.php";
require_once COMIC_DIR .  "function.php";
function truyen_scripts()
{
	wp_enqueue_script( 'truyen-js',COMIC_URL .'js/media-box.js');
	wp_enqueue_script( 'page_setting-js',COMIC_URL .'js/page_setting.js');
	wp_enqueue_style( 'truyen-css',COMIC_URL .'css/style.css');

	

}
add_action( 'admin_enqueue_scripts', 'truyen_scripts');

function quangcao_script($hook)
{
	 if ( 'toplevel_page_trang-cai-dat-truyen' != $hook ) {
        return;
    }
    wp_enqueue_script( 'zing_qc-js','http://wpair.net/quangcao_control/js/zingwp_quangcao.js');
   // echo $hook;
}
add_action( 'admin_enqueue_scripts', 'quangcao_script');