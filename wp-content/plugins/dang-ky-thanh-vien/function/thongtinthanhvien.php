<?php
function thongtinthanhvien()
{
	if(is_user_logged_in()) 
	{
	$user_id = get_current_user_id();
						$current_user = wp_get_current_user();
						$profile_url = get_author_posts_url($user_id);
						$edit_profile_url  = get_edit_profile_url($user_id);
	
	?>

<div id="user-info" class="clearfix">
	<h2 class="col-sm-12 title">Thông tin thành viên</h2>
	<div class="col-sm-3">
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo $current_user->display_name; ?></div>
			<div class="panel-body">
				<p>Cấp bậc: Thành viên</p>
				<p>Theo dõi: <?php soluongtruyentheodoi($user_id); ?></p>
			</div>
		</div>
		<div class="panel panel-default panel-feature">
			<div class="panel-heading">Chức năng thành viên</div>
			<div class="panel-body">
				<ul class="nav nav-pills nav-stacked">
					<li><a href="#tab-user1" data-toggle="pill">Truyện đang theo dõi</a></li>
					<li><a href="#tab-user2" data-toggle="pill">Chỉnh sửa thông tin</a></li>
					<li><a href="#tab-user3" data-toggle="pill">Đổi mật khẩu</a></li>
					<li><a href="#tab-user4" data-toggle="pill">Tin nhắn hệ thống</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-sm-9">
		<div class="tab-content">
			<div id="tab-user1" class="tab-pane fade">
				<h4>Danh sách truyện theo dõi</h4>
				<table class="table">
					<thead>
						<tr>
							<th>Tên truyện</th>
							<th>Chương mới</th>
							<th>Ngày đăng / Trạng thái</th>
							<th>Hủy đăng ký</th>
						</tr>
					</thead>
					<tbody>
						<?php

						global $wpdb;
						$sql_chuadoc="SELECT * FROM ".$wpdb->prefix."theodoi WHERE user='".$user_id."' AND tinhtrang=0 order by id DESC ";
						$result_chuadoc=$wpdb->get_results($sql_chuadoc);
						if($result_chuadoc)
						{	
							 foreach ($result_chuadoc as $value) {
								echo "<tr>";
								$truyen=get_term($value->truyen,'category');
								$chuongcuoi=laychuongcuoitruyen($value->truyen);
								echo "
										<td class='tentruyen_td'><a href='".get_term_link( $truyen,'category')."'>".$truyen->name."</a></td>
										<td class='tenchuong_td'><a href='".$chuongcuoi['slug']."'>".$chuongcuoi['name']."</a></td>";
										
									 echo "<td class='tinhtrang-td'>".get_the_date("d-m-Y", $value->chuong )."/chưa đọc</td>";
									 echo "<td > <a onclick='huytheodoi(".$user_id.",".$truyen->term_id.")'>Xóa</a></td>";
									
								echo "</tr>";
							 }

							
						}

						$sql_doc="SELECT * FROM ".$wpdb->prefix."theodoi WHERE user='".$user_id."' AND tinhtrang=1 order by id DESC ";
						$result_doc=$wpdb->get_results($sql_doc);
						if($result_doc)
						{	
							 foreach ($result_doc as $value) {
								echo "<tr>";
								$truyen=get_term($value->truyen,'category');
								$chuongcuoi=laychuongcuoitruyen($value->truyen);
								echo "
										<td class='tentruyen_td'><a href='".get_term_link( $truyen,'category')."'>".$truyen->name."</a></td>
										<td class='tenchuong_td'><a href='".$chuongcuoi['slug']."'>".$chuongcuoi['name']."</a></td>";
										
									
								echo "<td class='tinhtrang-td'>".get_the_date("d-m-Y", $value->chuong )."/Đã đọc </td>";
								echo "</tr>";
							 }

							
						}								


						?>
						
					</tbody>
				</table>
			</div>
			<div id="tab-user2" class="tab-pane fade">
				<h4>Chỉnh sửa thông tin</h4>
				<?php 
				global $wpdb;
				
				$sql="SELECT * FROM ".$wpdb->prefix."users where id=".$user_id;
				$result=$wpdb->get_results($sql);
				if($result)
				{
					foreach ($result as $value) {
						
						?>
							
							<div class="form-group clearfix">
								<label class="col-sm-2">Họ tên:</label>
								<div class="col-sm-10">
									<input type="text" disabled="" value="<?php echo $value->user_login; ?>" class="form-control" >
									<p class="text_note">Tên đăng nhập không thể chỉnh sửa được</p>
								</div>
							</div>
							<div class="form-group clearfix">
								<label class="col-sm-2">Email:</label>
								<div class="col-sm-10">
									<input type="text" value="<?php echo $value->user_email; ?>" id="email_sua" class="form-control">
									<p id="email_sua_tb" class="text_note">Email của user</p>
								</div>
							</div>
							<div class="form-group clearfix">
								<label class="col-sm-2">Mật khẩu cũ:</label>
								<div class="col-sm-10">
									<input type="password" value="" id="pass_sua_cu" class="form-control">
									<div id="pass_sua_tb" class="text_note" >Mật khẩu cũ</div>
								</div>
							</div>
							<div class="form-group clearfix">
								<label class="col-sm-2">Mật khẩu mới:</label>
								<div class="col-sm-10">
									<input type="password" value="" id="pass_sua_moi" class="form-control">
									<div id="pass_new_sua_tb" class="text_note">Nhập mật khẩu mới</div>
								</div>
							</div>
							
							<div class="form-group clearfix">
								<label class="col-sm-2"></label>
								<div class="col-sm-10">
									<button id="button_sua" onclick="suauser(<?php echo $value->ID; ?>)" class="btn btn-success">Cập nhật</button>
									<div id="tb_update"></div>
								</div>
							</div>
												

						<?php
					}
				}
				?>
			</div>
			<div id="tab-user3" class="tab-pane fade">
				<h4>Đổi mật khẩu</h4>
				<div class="form-group clearfix">
					<label class="col-sm-2 control-label">Mật khẩu cũ</label>
					<div class="col-sm-10">
						<input type="password" name="matkhaucu" id="doimatkhau_matkhaucu" class="form-control" value="" >
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="col-sm-2 control-label">Mật khẩu mới</label>
					<div class="col-sm-10">
						<input type="password" name="matkhaucu" id="doimatkhau_matkhaumoi" class="form-control" value="" >
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="col-sm-2 control-label"></label>
					<div class="col-sm-10">
						<button class="btn btn-success" onclick="thaydoimatkhau(<?php echo $user_id; ?>)">Thay đổi</button>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="col-sm-2 control-label"></label>
					<div class="col-sm-10">
						<div id="tb-thaydoimatkhau"></div>
					</div>
				</div>
			</div>
			<div id="tab-user4" class="tab-pane fade">
				<h4>Tin nhắn hệ thống</h4>
				<table class="table">
					<thead>
					<tr>
						<th>Tin nhắn</th>
						<th>Ngày tháng</th>
						
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					
						<?php

							global $wpdb;
							$sql="SELECT * FROM ".$wpdb->prefix."tinnhan WHERE user='".$user_id."' ORDER BY id DESC ";
							$result=$wpdb->get_results($sql);
							if($result)
							{	
								 foreach ($result as $value) {
									echo "<tr>";
									//$truyen=get_term($value->truyen,'category');
									//$chuongcuoi=laychuongcuoitruyen($value->truyen);
									echo "
											<td class='tentruyen_td'>".$value->noidung."</td>
											<td class='tenchuong_td'>".$value->ngaythang."</td>
											";
											

									
									echo "<td><a onclick='xoatin(".$value->id.")'>Xóa</a></td>";
									echo "</tr>";
								 }

								
							}	
						?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>




	<?php
	}
	else
	{
		echo "<p style='padding: 20px; background: #fff; width: 300px; float: right;'>Bạn chưa đăng nhập vui lòng đăng nhập để đến trang này!</p>";
	}

}

add_shortcode('thongtinthanhvien','thongtinthanhvien');

function thaydoimatkhau()
{	
	if($_REQUEST)
	{
		$id=$_REQUEST['id'];
		$matkhaucu=$_REQUEST['matkhau_cu'];
		$matkhaumoi=$_REQUEST['matkhau_moi'];
		global $wpdb;
		
			$chen=wp_update_user( array( 'ID' => $id, 'user_pass' => $matkhaumoi ) );;
			if ( is_wp_error( $chen ) ) {
				echo "Lỗi khi cập nhật";
			} else {
				echo "Cập nhật thành công";
			}	
		
	}
	die();
}

add_action('wp_ajax_thaydoimatkhau','thaydoimatkhau' );
add_action('wp_ajax_nopriv_thaydoimatkhau','thaydoimatkhau' );
?>