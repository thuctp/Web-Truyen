<?php
if ( !class_exists('Chapter_Bugs') ) :
/**
 * Untag Me Class
 * 
 * @package Vcx User Membership
 * @version 1.0
 */
class Chapter_Bugs {

	var $id 			= false;	
	var $user_id 		= false;
	var $error_link     = '';
	var $comment		= '';	
	
	// initiate the manage page
	function Chapter_Bugs( $user_id, $error_link, $comment ) {
		global $wpdb, $tfscb, $tfscb_db;
		$this->user_id = $user_id;		
		$this->error_link = $error_link;
		$this->comment  = $comment;	
		$tfscb_db->insert_chapter_bugs( $user_id, $error_link, $comment);	
	}

	function controller() {	
		global $wpdb, $tfscb, $tfscb_db;
		$tfscb_db->insert_chapter_bugs( $user_id, $error_link, $comment);
	}

}
endif;
?>