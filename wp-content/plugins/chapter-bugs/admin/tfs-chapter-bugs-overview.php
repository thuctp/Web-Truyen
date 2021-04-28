<?php
function overview() {
?>
	<div id="vcx-user-membership-overview" class="wrap">
		<h2><?php _e( 'Tfs Chapter Bugs' ); ?></h2>
		<div id="dashboard-widgets-container">
		    <div id="dashboard-widgets" class="metabox-holder">
				<div id="post-body">
					<div id="dashboard-widgets-main-content">
						<div class="postbox-container" id="main-container" style="width:75%;">
							<?php do_meta_boxes('overview', 'left', ''); ?>
						</div>
			    		<div class="postbox-container" id="side-container" style="width:24%;">
							<?php do_meta_boxes('overview', 'right', ''); ?>
						</div>
					</div>
				</div>
		    </div>
		</div>
	</div>
	<script type="text/javascript">
		jQuery(document).ready( function($) {
			// postboxes setup
			postboxes.add_postbox_toggles();
		});
		//]]>
	</script>
<?php
}

/**
 * Load the meta boxes
 *
 */

add_meta_box('dashboard_overview', __('Quản lý Chapter Bugs!'), 'dashboard_overview', 'overview', 'left', 'core');



function dashboard_overview() {
	echo '<p>';
    echo sprintf(__('Tfs Chapter Bugs '), 'http://www.wpair.net/');
	echo '</p>';
	echo '<p>WP-Zing,</p>';
}




?>