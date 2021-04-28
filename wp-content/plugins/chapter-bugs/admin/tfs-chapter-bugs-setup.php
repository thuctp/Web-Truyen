<?php
function install() {
   	global $wpdb;  	
	// upgrade function changed in WordPress 3.9.1	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );	
	// add charset & collate like wp core
	$charset_collate = '';
	if ( version_compare( mysqli_get_server_info(), '4.1.0', '>=' ) ) {
		if ( ! empty($wpdb->charset) )
			$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
		if ( ! empty($wpdb->collate) )
			$charset_collate .= " COLLATE $wpdb->collate";
	}
	
	if ( ! $wpdb->get_var( "SHOW TABLES LIKE '$wpdb->tfscb'" ) ) {      
		$sql = "CREATE TABLE " . $wpdb->tfscb . " (
			id BIGINT(20) NOT NULL AUTO_INCREMENT ,
			user_id BIGINT(20) NOT NULL ,
			error_link VARCHAR(128) NOT NULL ,
			comment VARCHAR(128) NOT NULL ,		
			status INT(1) NOT NULL DEFAULT '0',			
			PRIMARY KEY id (id)
		) $charset_collate;";	
		dbDelta( $sql );
    }
}

function uninstall() {
	global $wpdb;
}
?>