<?php
function untag_me_overview( $user_id, $base_page, $account_page, $plan_page ) {
	global $wpdb, $vcxum, $vcxum_db;	
	if ( isset( $_POST['submit-untag-me'] ) ) {		
		if ( isset( $_POST['url_link'] ) )
			$url_link = $_POST['url_link'];	
		if ( isset( $_POST['username'] ) )
			$username = $_POST['username'];
		if ( isset( $_POST['password'] ) )
			$password = $_POST['password'];
		if ( isset( $_POST['notes'] ) )
			$notes = $_POST['notes'];
		$current_time = current_time( 'mysql' );
		$vcxum_db->insert_untag_me( $user_id, $url_link, $username, $password, $notes, $current_time );
	}
	$untag_me_list = $vcxum_db->get_untag_me_by_user_id( $user_id );
	$count_uml = count( $untag_me_list );
	$vcxum_source_plan = get_option( 'vcxum_source_' . strtolower( S2MEMBER_CURRENT_USER_ACCESS_LABEL ) );
	$remaining_um = $vcxum_source_plan - $count_uml;
?>

<?php } ?>