<?php
function untag_me_edit( $id, $user_id, $base_page, $account_page, $plan_page ) {
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
		$vcxum_db->update_untag_me( $id, $url_link, $username, $password, $notes, $current_time );
	}
	$untag_me = $vcxum_db->get_untag_me_by_id( $id );
	$untag_me_list = $vcxum_db->get_untag_me_by_user_id( $user_id );
	$count_uml = count( $untag_me_list );
	$vcxum_source_plan = get_option( 'vcxum_source_' . strtolower( S2MEMBER_CURRENT_USER_ACCESS_LABEL ) );
	$remaining_um = $vcxum_source_plan - $count_uml;
?>
	<div class="box-untag">
		<span class="text-untag">You have <?php echo $remaining_um; ?> removals remaining!</span>
		<div class="back-ac right">
			<a href="<?php echo $account_page; ?>">&lt; Back to Account</a>
		</div>
		<div class="text-content-untag">
			<p>Please supply link to image, username and password for site if applicable, and any notes about the removal. A credit will be removed and we wilil notify you of the progress.</p>
		</div>
		<div class="form-content-untag">
			<div class="form-untag left">
				<form method="POST" action="" accept-charset="utf-8">
					<p><input type="text" name="url_link" value="<?php echo $untag_me->url_link; ?>" /></p>					
					<p><input type="text" name="username" value="<?php echo $untag_me->username; ?>" /></p>					
					<p><input type="text" name="password" value="<?php echo $untag_me->password; ?>" /></p>					
					<p><textarea name="notes"><?php echo $untag_me->note; ?></textarea></p>					
					<p><input type="submit" name="submit-untag-me" value="Update Untag Me!"/></p>
				</form>
			</div>
			<div class="upgrade right">
				<span class="count"><?php echo $remaining_um; ?></span>
				<p>removals remaining</p>
				<a class="upgrade-sb" href="<?php echo $plan_page; ?>"><?php _e( 'Upgrade' ); ?></a>
			</div>
		</div>
		<div class="cur_progress">
			<h2 class="title_happy_untagees">Current Progress</h2>
			<?php						
				foreach ( $untag_me_list as $key => $value ) {
			?>
					<div class="<?php if ( $value->status == 0 ) { echo 'progress'; } else { echo 'completed';}?>">
						<label><?php if ( $value->status == 0 ) { echo 'In Progress'; } else { echo 'Completed'; }?></label>
						<span><?php echo $value->url_link; ?></span>
						<p><?php echo $value->note; ?></p>
						<?php if ( $value->status == 0 ) { ?>
							<a href="<?php echo $base_page . '&amp;mode=edit_untag_me&amp;id=' . $value->id; ?>" class="input"><?php _e( 'Edit' ); ?></a>
						<?php } ?>
					</div>
			<?php
				}
			?>					
		</div>
		<div class="back-ac left">
			<a href="<?php echo $account_page; ?>">&lt; Back to Account</a>
		</div>
	</div>
<?php } ?>