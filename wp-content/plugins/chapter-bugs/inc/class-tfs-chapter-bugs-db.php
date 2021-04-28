<?php
if ( !class_exists('Tfs_Chapter_Bugs_Db') ) :
/**
 * Database Class
 * 
 * @package Vcx User Membership
 * @version 1.0
 */
class Tfs_Chapter_Bugs_Db {
    
    /**
     * Holds the list of all untag me
     *
     * @since 1.1.0
     * @access public
     * @var object|array
     */
    var $item = false;
	
    /**
     * The array for the pagination
     *
     * @since 1.1.0
     * @access public
     * @var array
     */
    var $paged = false;


    /**
     * Init the Database Abstraction layer for NextGEN Gallery
     * 
     */ 
    function __construct() {
        global $wpdb;
        $this->item    = array();
        $this->paged     = array();        
        register_shutdown_function(array(&$this, '__destruct'));        
    }
    
    /**
     * PHP5 style destructor and will run when database object is destroyed.
     *
     * @return bool Always true
     */
    function __destruct() {
        return true;
    }
	
    /**
     * Get untag ue by id
     * 
     */
    function get_chapter_bugs_by_id( $id ) {
        global $wpdb;        
        $result = $wpdb->get_results("SELECT * FROM $wpdb->tfscb WHERE id = '$id'");        
        return $result[0];
    }

    /**
     * Get untag ue by user id
     * 
     */
    function get_chapter_bugs_by_user_id( $user_id ) {
        global $wpdb;        
        $result = $wpdb->get_results( "SELECT * FROM $wpdb->tfscb WHERE user_id = '$user_id'" );        
        return $result;
    }

    /**
     * Get status 'In Progress' chapter bugs
     * 
     */
    function get_status_in_progress() {
        global $wpdb;        
        $result = $wpdb->get_results( "SELECT * FROM $wpdb->tfscb WHERE status = 0" );        
        return $result;
    }

    /**
     * Insert an untag me in the database
     * 
     * @return the ID of the inserted untag me
     */
    function insert_chapter_bugs( $user_id, $error_link, $comment) {
        global $wpdb;  
        $result = $wpdb->insert( $wpdb->tfscb, array( 'user_id' => $user_id, 'error_link' => $error_link, 'comment' => $comment) );
        return $result;
    }

    /**
     * Update status untag me
     */
    function update_status_chapter_bugs( $id, $status) {    
        global $wpdb;        
        $wpdb->query( "UPDATE $wpdb->tfscb SET status = '$status' WHERE id = $id" );        
        return true;
    }

    /**
     * Update untag me
     */
    function update_chapter_bugs( $id, $url_link, $username, $password, $notes, $current_time ) {    
        global $wpdb;        
        $wpdb->query( "UPDATE $wpdb->vcxum SET url_link = '$url_link', username = '$username', password = '$password', note = '$notes', date_modified = '$current_time' WHERE id = $id" );        
        return true;
    }
	
    /**
    * Delete an untag me entry from the database
    * @param integer $id is the untag me ID
    */
    function delete_chapter_bugs( $id ) {
        global $wpdb;        
        // Delete the untag me
        $result = $wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->tfscb WHERE id = %d", $id ) ); 
        return $result;
    }

    /**
     * Get all the untag me
     */
    function find_all_item( $order_by = 'id', $order_dir = 'DESC', $limit = 0, $start = 0 ){      
        global $wpdb;        
        $order_dir = ( $order_dir == 'ASC' ) ? 'ASC' : 'DESC';
        $limit_by  = ( $limit > 0 ) ? 'LIMIT ' . intval( $start ) . ',' . intval( $limit ) : '';
        $this->item = $wpdb->get_results( "SELECT SQL_CALC_FOUND_ROWS * FROM $wpdb->tfscb ORDER BY {$order_by} {$order_dir} {$limit_by}", OBJECT_K );
        // Count the number of galleries and calculate the pagination
        if ( $limit > 0 ) {
            $this->paged['total_objects'] = intval ( $wpdb->get_var( "SELECT FOUND_ROWS()" ) );
            $this->paged['objects_per_page'] = max ( count( $this->item ), $limit );
            $this->paged['max_objects_per_page'] = ( $limit > 0 ) ? ceil( $this->paged['total_objects'] / intval( $limit ) ) : 1;
        }        
        if ( !$this->item )
            return array();          
        return $this->item;
    }

    function find_all_chapter_bugs_search( $like, $order_by = 'id', $order_dir = 'ASC', $limit = 0, $start = 0 ) {      
        global $wpdb; 
        $order_dir = ( $order_dir == 'DESC') ? 'DESC' : 'ASC';
        $limit_by  = ( $limit > 0 ) ? 'LIMIT ' . intval($start) . ',' . intval($limit) : '';
        $this->chapter_bugs = $wpdb->get_results( "SELECT SQL_CALC_FOUND_ROWS * FROM $wpdb->tfscb WHERE username LIKE '%$like%' ORDER BY {$order_by} {$order_dir} {$limit_by}", OBJECT_K );
        // Count the number of galleries and calculate the pagination
        if ($limit > 0) {
            $this->paged['total_objects'] = intval ( $wpdb->get_var( "SELECT FOUND_ROWS()" ) );
            $this->paged['objects_per_page'] = max ( count( $this->chapter_bugs ), $limit );
            $this->paged['max_objects_per_page'] = ( $limit > 0 ) ? ceil( $this->paged['total_objects'] / intval($limit)) : 1;
        }        
        if ( !$this->chapter_bugs )
            return array();            
        return $this->chapter_bugs;
    }
	
}
endif;

if ( ! isset($GLOBALS['tfscb_db']) ) {
    unset($GLOBALS['tfscb_db']);
    $GLOBALS['tfscb_db'] = new Tfs_Chapter_Bugs_Db() ;
}
?>
