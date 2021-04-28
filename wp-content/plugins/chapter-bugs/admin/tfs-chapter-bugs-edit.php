<?php
function chapter_bugs_edit() {
	global $tfscb_db;
	$id = $_GET['id'];
	$chapter_bugs = $tfscb_db->get_chapter_bugs_by_id( $id );	
	$user_info = get_userdata( $chapter_bugs->user_id );
	if ( isset( $_POST['edit-chapter-bugs'] ) ) {			
		$status = $_POST['status'];
		$current_time = current_time( 'mysql' );
		$tfscb_db->update_status_chapter_bugs( $id, $status);
		header('location: admin.php?page=chapter-bugs');
	}
?>
	<div class="wrap">
		<h2><?php _e('Edit Chapter Bugs') ?></h2>
		<div id="dashboard-widgets-container">
		    <div id="dashboard-widgets" class="metabox-holder">
				<div id="post-body">
					<div id="dashboard-widgets-main-content">
						<p><?php _e('Edit a chapter bugs.');?></p>
						<form id="edit-chapter-bugs" name="edit-chapter-bugs" method="post" action="" accept-charset="utf-8" enctype="multipart/form-data">						
							<table class="form-table">
								<tbody>
									<tr class="form-field">
										<th scope="row"><label for="user_login">User Id</label></th>
										<td><?php echo $chapter_bugs->user_id;?></td>
									</tr>
									<tr class="form-field">
										<th scope="row"><label for="user_login">Error Link</label></th>
										<td><?php echo $chapter_bugs->error_link;?></td>
									</tr>
									<tr class="form-field">
										<th scope="row"><label for="user_login">Comment</label></th>
										<td><?php echo $chapter_bugs->comment;?></td>
									</tr>									
									<tr class="form-field">
										<th scope="row"><label for="user_login">Status</label></th>
										<td>
											<select name="status">
												<option value="0" <?php if ($chapter_bugs->status == 0) { ?>selected="selected"<?php } ?>>In Progress</option>
												<option value="1" <?php if ($chapter_bugs->status == 1) { ?>selected="selected"<?php } ?>>Completed</option>
											</select>
										</td>
											
									</tr>
								</tbody>							
							</table>
							<p class="submit"><input type="submit" value="Edit Chapter Bugs" class="btn-edit-chapter-bugs" name="edit-chapter-bugs"></p>
						</form>
						
					</div>
				</div>
		    </div>
		</div>
	</div>
<?php
}
?>