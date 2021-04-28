<?php
/*
Plugin Name: Category Rating
Version: 1.0
Author: ZingWP-Bachnguyen91

*/
?>
<?php
if( ! defined( 'ABSPATH' ) ) exit;
define ( 'WP_CATERATING_DIR', plugin_dir_path(__FILE__) );
define ( 'WP_CATERATING_URL', plugin_dir_url(__FILE__) );
function create_table_wp_cate_rating()
{
	
	$sql=	"CREATE TABLE  wp_cate_ratings (
			 rating_id int(11) NOT NULL AUTO_INCREMENT,
			  rating_cateid int(11) NOT NULL,
			  rating_catetitle text,
			  rating_rating int(2) NOT NULL,
			  rating_timestamp varchar(15) DEFAULT NULL,
			  rating_ip varchar(40) DEFAULT NULL,
			  rating_host varchar(200) DEFAULT NULL,
			  rating_username varchar(50) DEFAULT NULL,
			  rating_userid int(10) DEFAULT NULL,
			  PRIMARY KEY (rating_id)
			)";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

register_activation_hook( __FILE__, 'create_table_wp_cate_rating' );


/*Gọi các hàm JS và CSS*/
function wp_category_rating_scripts()
{
	wp_enqueue_script( 'wp-category-js',WP_CATERATING_URL .'js/custom.js');
	//wp_enqueue_script( 'page_setting-js',COMIC_URL .'js/page_setting.js');
	wp_enqueue_style( 'wp-category-css',WP_CATERATING_URL .'css/style.css');
	$localize = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	);
	wp_localize_script('wp-category-js', 'WP_CATE_RATING_AJ', $localize);
	wp_localize_script('wp-category-js', 'WP_CATE_RATING_HOME', home_url());
	

}
add_action( 'admin_enqueue_scripts', 'wp_category_rating_scripts');
add_action( 'wp_enqueue_scripts', 'wp_category_rating_scripts', 15 );



function setting_category_rating_scripts()
{
	wp_enqueue_script( 'wp-category-pagesetting-js',WP_CATERATING_URL .'js/settingcaterating.js');
	
	
	

}
add_action( 'admin_enqueue_scripts', 'setting_category_rating_scripts');

/*Gọi hàm hiện thị đánh giá*/
require_once WP_CATERATING_DIR .  "functions/function.php";
/*Gọi trang cài đặt*/
require_once WP_CATERATING_DIR .  "wp-rating-cate-page-setting.php";

