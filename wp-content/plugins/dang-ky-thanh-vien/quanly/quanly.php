<?php
add_action('admin_menu', 'quanlythanhvien');
function quanlythanhvien()
{
	 add_menu_page('Quản lý thành viên', 'Quản lý thành viên', 'manage_options', 'quan-ly-thanh-vien', 'ham_quan_ly_thanh_vien');
}
function ham_quan_ly_thanh_vien()
{
	echo "<h2> Trang quản lý thành viên</h2>";
	echo "<hr>";
	//include "list_thanhvien.php";
	if($_GET['id_sua'])
	{
		suauser($_GET['id_sua']);
	}
	elseif($_GET['id_guitin'])
	{
			guitin_per($_GET['id_guitin']);
	}
	elseif($_GET['id_xemtin'])
	{
		list_tinnhan($_GET['id_xemtin']);
	}
	else
	{
		danhsach();
	}
	

}

function guitin_per($id)
{
	?>
	<div>
		<textarea id="tinnhan-per" cols="50" rows="5"></textarea>
		<button onclick="guitinnhan(<?php echo $id; ?>)"> Gửi tin nhắn</button>
	</div>
	<script type="text/javascript">
	function guitinnhan(id)
	{
	var tinnhan=document.getElementById('tinnhan-per').value;
	if(tinnhan.length<=10)
	{
		alert('Nội dung tin nhắn phải dài hơn 10 ký tự');
		return false;
	}
	jQuery.ajax({
				url:THANHVIEN_AJ.ajaxurl,
				
				data: {
					'action':'guitin_per_send',
					'id':id,
					'noidung':tinnhan
					
				},
				success:function(data) {
					
				
							alert(data);
							window.location.href='<?php echo home_url()."/wp-admin/admin.php?page=quan-ly-thanh-vien&id_xemtin=".$id; ?>';
						
						

					
					
				},
				error: function(errorThrown){
					console.log(errorThrown);
					alert("Loi"+errorThrown);
				}
			});
}
	</script>

	<?php
}

function guitin_per_send()
{
	if($_REQUEST)
	{	
		$id=$_REQUEST['id'];
		$noidung=$_REQUEST['noidung'];
		global $wpdb;
						$insert="INSERT INTO ".$wpdb->prefix."tinnhan(user,noidung,tinhtrang) values('".$id."','".$noidung."','0')";
						$insert_rs=$wpdb->get_var($insert);
						if($insert_rs==null)
						{
							echo "Gửi tin nhắn cho tài khoản thành viên thành công!";
						}
						else
						{
							echo "Thất bại trong việc gửi tin nhắn";
						}
	}
	die();
}
add_action('wp_ajax_guitin_per_send','guitin_per_send');

function list_tinnhan($id)
{
	?>
	<div class="listtin-admin">
	<div class="title_danhsachtheodoi">Tin nhắn hệ thống</div>
				<table>
					<tr><td><a href="<?php  echo home_url()."/wp-admin/admin.php?page=quan-ly-thanh-vien&id_guitin=".$id;?>">Gửi tin nhắn</a></td></tr>
					<tr>
						<th>Tin nhắn</th>
						<th>Ngày tháng</th>
						
						<th>Action</th>
					</tr>
					
					<?php

								global $wpdb;
								$sql="SELECT * FROM ".$wpdb->prefix."tinnhan WHERE user='".$id."' ORDER BY id DESC ";
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
				</table>
	</div>
	<?php
}