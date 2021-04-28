<?php
if ( !class_exists('Tfs_Chapter_Bugs_Admin') ) :
/**
 * Admin Class
 * 
 * @package Tfs Chapter Bugs
 * @version 1.0
 */

class Tfs_Chapter_Bugs_Admin {

	// constructor
	function Tfs_Chapter_Bugs_Admin() {		
		// Add the admin menu
		add_action( 'admin_menu', array( $this, 'add_menu' ) );		
		// Add the script and style files
		add_action( 'admin_print_styles', array( $this, 'load_styles' ) );
		add_action( 'admin_footer', array( $this, 'load_scripts' ) );
	}



	// integrate the menu
	function add_menu() {
		// Add a new top-level menu (ill-advised):
		add_menu_page( 'Chapter Bugs', 'Chapter Bugs', 'add_users', 'overview', array( $this, 'show_menu' ), plugins_url( 'chapter-bugs/images/icon.png' ) );
		// Add a submenu to the custom top-level menu:
		add_submenu_page( 'overview', 'Overview', 'Overview', 'manage_options', 'overview', array( $this, 'show_menu' ) );
		add_submenu_page( 'overview', 'Chapter Bugs', 'Chapter Bugs', 'manage_options', 'chapter-bugs', array( $this, 'show_menu' ) );
	}

	// load the script for the defined page and load only this code	
	function show_menu() {
		global $tfscb;		
		switch ( $_GET['page'] ) {			
			case "chapter-bugs":
				include_once( dirname( __FILE__ ) . '/class-tfs-chapter-bugs-item.php' );
				$tfscb->tfscb_chapter_bugs = new Tfs_Chapter_Bugs_Item();
				$tfscb->tfscb_chapter_bugs->controller();
				break;			
			default:
				include_once( dirname( __FILE__ ) . '/tfs-chapter-bugs-overview.php' );
				overview();
				break;
		}
	}
	
	function load_styles() {
        // load styles custom for plugin
        wp_enqueue_style( 'styles', TFSCB_URLPATH . 'css/styles.css' );		
		// no need to go on if it's not a plugin page
		if( !isset($_GET['page']) )
			return;		
	}
	
	function load_scripts() {
		// no need to go on if it's not a plugin page
		if( !isset($_GET['page']) )
			return;			
		switch ($_GET['page']) {
			case "overview" :
				wp_enqueue_script( 'postbox' );
				add_thickbox();
			break;
			case "chapter-bugs" :
				wp_enqueue_script( 'tfs-chapter-bugs-min', TFSCB_URLPATH . 'js/jquery-1.8.3.js' );
			break;
		}		
	}
}
endif;
?>