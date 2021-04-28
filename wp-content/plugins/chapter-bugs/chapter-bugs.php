<?php 
/*
Plugin Name: Chapter Bugs
Plugin URI: http://www.themeforseo.com/
Description: Manage chapter bugs
Author: the Vietconex team
Version: 1.0
Author URI: http://www.vietconex.com/
Text Domain: chapter-bugs
*/

class Tfs_Chapter_Bugs_Loader {
	var $tfscb_chapter_bugs;
	function Tfs_Chapter_Bugs_Loader() {	
		//allow redirection, even if my theme starts to send output to the browser
		add_action( 'init', array( $this, 'do_output_buffer' ) );
		// Get some constants first
		$this->define_constant();
		$this->define_tables();
		$this->load_dependencies();
		$this->plugin_name = basename( dirname( __FILE__ ) ) . '/' . basename( __FILE__ );		
		// Init options & tables during activation & deregister init option
		register_activation_hook( $this->plugin_name, array( $this, 'activate' ) );
		// Register a uninstall hook to remove all tables & option automatic
		register_deactivation_hook( $this->plugin_name, array( $this, 'deactivate' ) );
		
		add_action( 'admin_menu', array( $this, 'tfs_add_bubble') );
		
	}
	
	function tfs_add_bubble() {
	  	global $tfscb_db, $menu;
	  	$in_progress = $tfscb_db->get_status_in_progress();
	  	$pend_count = count($in_progress);
	    foreach ( $menu as $key => $value ) {
			if ( $menu[$key][2] == 'overview' ) {
				$menu[$key][0] .= " <span class='update-plugins count-$pend_count'><span class='plugin-count'>" . $pend_count . '</span></span>';
				return;
		    }
	  	}
	}

	function define_constant() {	
		$direc = wp_upload_dir();		
		// required for Windows & XAMPP
		define( 'TFSCB_WINABSPATH', str_replace( "\\", "/", ABSPATH ) );			
		// define URL
		define( 'TFSCB_FOLDER', basename( dirname( __FILE__ ) ) );
		define( 'TFSCB_URLPATH', trailingslashit( plugins_url( TFSCB_FOLDER ) ) );	
	}

	function define_tables() {
		global $wpdb;
		// add database pointer
		$wpdb->tfscb 		= $wpdb->prefix . 'tfs_chapter_bugs';		
	}

	function load_dependencies() {
		// Load global libraries wordpress
		require_once( ABSPATH . 'wp-includes/class-phpass.php' );		
		// Load global libraries plugin Chapter bugs
		require_once( dirname( __FILE__ ) . '/inc/class-tfs-chapter-bugs-db.php' );		
		require_once( dirname( __FILE__ ) . '/inc/tfs-chapter-bugs-functions.php' );			
		// Load global templates
		require_once (dirname (__FILE__) . '/templates/class-chapter-bugs.php');	
		if ( is_admin() ) {
			require_once( dirname( __FILE__ ) . '/admin/class-tfs-chapter-bugs-admin.php' );
			$this->tfscb_admin = new Tfs_Chapter_Bugs_Admin();
		}
	}

	function activate() {
		global $wpdb;	
		include_once( dirname( __FILE__ ) . '/admin/tfs-chapter-bugs-setup.php' );
		install();
	}

	function deactivate() {
		global $wpdb;
		include_once( dirname ( __FILE__ ) . '/admin/tfs-chapter-bugs-setup.php' );
		uninstall();
	}

	function do_output_buffer() {
		ob_start();
	}
}

global $tfscb;
$tfscb = new Tfs_Chapter_Bugs_Loader();

function baoloitruyen_chapbugs()
{
	if($_REQUEST)
	{
		$link_loi=$_REQUEST['linkloi'];
		$nguoibao=$_REQUEST['nguoibao'];
		$lydo=$_REQUEST['lydo'];
		$baoloi=new Chapter_Bugs($nguoibao,$link_loi,$lydo);
		echo "Cảm ơn bạn đã thông báo lỗi!";
	
	}
	die();

}
add_action( 'wp_ajax_baoloitruyen_chapbugs', 'baoloitruyen_chapbugs' );
add_action( 'wp_ajax_nopriv_baoloitruyen_chapbugs', 'baoloitruyen_chapbugs' );
?>