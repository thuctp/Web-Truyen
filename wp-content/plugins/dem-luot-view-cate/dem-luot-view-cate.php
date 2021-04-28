<?php /*
Plugin Name: Count view
Version: 1.0
Author: ZingWP-Bachnguyen91
*/

if( ! defined( 'ABSPATH' ) ) exit;
define ( 'WP_LUOTVIEW_DIR', plugin_dir_path(__FILE__) );
define ( 'WP_LUOTVIEW_URL', plugin_dir_url(__FILE__) );
function tao_bang_dem_luot_view()
{
	
	$sql=	"CREATE TABLE  wp_luotview_popular (
			  postid bigint(20) NOT NULL,
			  day datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
			  last_viewed datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
			  pageviews bigint(20) DEFAULT '1',
			  PRIMARY KEY (postid)
			)";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
register_activation_hook( __FILE__, 'tao_bang_dem_luot_view' );

function tao_bang_demtong_luot_view()
{

	$sql= "CREATE TABLE  wp_luotview_sumpopular (
			 ID bigint(20) NOT NULL AUTO_INCREMENT,
			  postid bigint(20) NOT NULL,
			  pageviews bigint(20) NOT NULL DEFAULT '1',
			  pageview_day bigint(20) NOT NULL DEFAULT '1',
			   pageview_week bigint(20) NOT NULL DEFAULT '1',
			  
			  view_date date NOT NULL DEFAULT '0000-00-00',
			  last_viewed datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
			  PRIMARY KEY (ID),
			  UNIQUE KEY ID_date (postid,view_date),
			  KEY postid (postid),
			  KEY view_date (view_date),
			  KEY last_viewed (last_viewed)
			)";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
register_activation_hook( __FILE__, 'tao_bang_demtong_luot_view' );

function delete_tao_bang_dem_luot_view(){
	
	global $wpdb;	
	 
	require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
	$sql = "DROP TABLE wp_luotview_popular";
	
	
	$wpdb->query($sql);
}
//register_deactivation_hook (__FILE__, 'delete_tao_bang_dem_luot_view');

function delete_tao_bang_demtong_luot_view(){
	
	global $wpdb;	
	 
	require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
	
	$sql= "DROP TABLE wp_luotview_sumpopular";
	
	$wpdb->query($sql);
}
//register_deactivation_hook (__FILE__, 'delete_tao_bang_demtong_luot_view');
include "function.php";

?>