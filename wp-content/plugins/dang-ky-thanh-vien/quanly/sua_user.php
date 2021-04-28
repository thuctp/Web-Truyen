<?php 
function suauser($id)
{
	
	global $wpdb;
	
	$sql="SELECT * FROM ".$wpdb->prefix."thanhvien where id=".$id;
	$result=$wpdb->get_results($sql);
	if($result)
	{
		foreach ($result as $value) {
			
			?>
			<table class="table">
				<tr>
					<td colspan="2" class="title_sua">
						Sửa User
					</td>
				</tr>
				<tr>
					<td>Họ tên:</td>
					<td>
						<input type="text" disabled="" value="<?php echo $value->name; ?>" class="input_text" ><br>
						<span class="text_note">Tên đăng nhập không thể chỉnh sửa được</span>
					</td>
				</tr>
				<tr>
					<td>Email:</td>
					<td>
						<input type="text" value="<?php echo $value->email; ?>" id="email_sua" class="input_text"><div id="email_sua_tb" class="text_note">Email của user</div>
					
					</td>
				</tr>
				<tr>
					<td>Mật khẩu cũ:</td>
					<td>
						<input type="password" value="" id="pass_sua_cu" class="input_text"><div id="pass_sua_tb" class="text_note" >Mật khẩu cũ</div>
						
					</td>
				</tr>
				<tr>
					<td>Mật khẩu mới:</td>
					<td>
						<input type="password" value="" id="pass_sua_moi" class="input_text"><div id="pass_new_sua_tb" class="text_note">Nhập mật khẩu mới</div>
						
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<button id="button_sua" onclick="suauser(<?php echo $value->id; ?>)">Cập nhật</button>
						<div id="tb_update"></div>
					</td>
				</tr>
				
			</table>
			

			<?php
		}
	}
}