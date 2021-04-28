<?php 
function form_dangnhap($linkdangky,$link_reset)
{
	
	?>

	<div id="modal-login-register" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="row">
						<div class="col-sm-6">
							
							<?php form_dangky(); ?>
							
						</div>
						<div class="col-sm-6">
							<div class="form-login clearfix">
								<h4 class="title">Đăng Nhập </h4>
								<div class="content">
									
									<?php 
									if(is_user_logged_in()) { 	
										$user_id = get_current_user_id();
										$current_user = wp_get_current_user();
										$profile_url = get_author_posts_url($user_id);
										$edit_profile_url  = get_edit_profile_url($user_id); ?>
											<div class="regted">
											Bạn đã đăng nhập với tên nick <a href="<?php echo $profile_url ?>">	<?php echo $current_user->display_name; ?></a> 
											Bạn có muốn <a href="<?php echo esc_url(wp_logout_url($current_url)); ?>">Thoát</a> không ?
											</div>
									<?php 
									} else { ?>
									
										<?php wp_login_form(); ?>
									
									<?php 
									} 
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
}