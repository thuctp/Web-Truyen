<?php
function danhsach()
{	global $wpdb;
	//$sql="SELECT * FROM ".$wpdb->prefix."thanhvien ";
	$sql="SELECT * FROM ".$wpdb->prefix."users ";
	//$result=$wpdb->get_var($sql);
	//$result=$wpdb->get_var($sql);
	$result=$wpdb->get_results($sql);

	?>
	<div class="wrap">
	<table class="widefat">
		<thead>
			<tr class="tr_list_title">
				<th>ID</th>
				<th>Họ Tên</th>
				<th>Email</th>

				
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
			if($result)
				{

					foreach ($result as $value) {
						?>
						<tr>
							<td><?php echo $value->ID; ?></td>
							<td><?php echo $value->user_login; ?></td>
							<td><?php echo $value->user_email; ?></td>
							<td class="td_list">
							
							</td>
							<td>
								
								<a href="<?php  echo home_url()."/wp-admin/admin.php?page=quan-ly-thanh-vien&id_xemtin=".$value->id;?>">Tin nhắn</a>

							</td>
						</tr>

						<?php
					}
				}
		?>
		</tbody>
	</table>
	<table class="form-table">
		<form action="<?php echo home_url()."/wp-admin/admin.php?page=quan-ly-thanh-vien"; ?>" method="post">
			<tr valign="top">
				<th scope="row">Gửi tin nhắn cho tất cả các thành viên</th>
				<td>
					<textarea name="noidungtinnhan" cols="30" rows="10"></textarea>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"></th>
				<td><input class="button button-primary button-large" type="submit" name="guitinnhan" value="Gửi tin nhắn"></td>
			</tr>

		</form>
		<?php

		if(isset($_POST['guitinnhan']))
		{	
			$noidung=$_POST['noidungtinnhan'];
			if($noidung!='')
			{
				if($result)
				{

					foreach ($result as $value) {

						$insert="INSERT INTO ".$wpdb->prefix."tinnhan(user,noidung,tinhtrang) values('".$value->ID."','".$noidung."','0')";
						$insert_rs=$wpdb->get_var($insert);
						if($insert_rs==null)
						{
							echo "Gửi tin nhắn cho tài khoản thành viên thành công!";
						}

					}
				}
				else
				{
					echo "Không có bất kỳ thành viên nào";
				}
			}
			else
			{
				echo "Tin nhắn không có nội dung";
			}

			
		}

		 ?>
		
		
	</table>
	</div>
	<?php
}
