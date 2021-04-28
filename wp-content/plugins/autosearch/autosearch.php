<?php
/*
Plugin Name: Auto search
Version: 1.0
Author: ZingWP-Dev

*/
?>
<?php
if( ! defined( 'ABSPATH' ) ) exit;
define ( 'SEARCH_DIR', plugin_dir_path(__FILE__) );
define ( 'SEARCH_URL', plugin_dir_url(__FILE__) );
/*Gọi danh sách cac function*/
require_once SEARCH_DIR .  "function.php";

function theme_autosearch_scripts() {
	wp_enqueue_style( 'autosearch-style', SEARCH_URL . '/css/autosearch.css' );
}

add_action( 'wp_enqueue_scripts', 'theme_autosearch_scripts' );

?>