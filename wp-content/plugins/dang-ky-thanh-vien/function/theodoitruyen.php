<?php
function theodoitruyen($cat,$link_thongtin="")
{
	if( is_user_logged_in() ) :
	$userid = get_current_user_id();
	?>
		<span class="btn btn-warning">
			<i class="fa fa-star"></i>
			<?php if(check_theodoi($cat,$userid)==0){
				?>
				<span id="dangkytheodoi"> Theo dõi</span>
				<input type="hidden" id="idtruyen" value="<?php echo $cat; ?>">
				<input type="hidden" id="userid" value="<?php echo $userid; ?>">
				<script type="text/javascript">
					jQuery('#dangkytheodoi').click(function(){
						jQuery('#dangkytheodoi').html('<span id="loaddangtheodoi">Đang load....</span>');
						var idtruyen=document.getElementById('idtruyen').value;
						var iduser=document.getElementById('userid').value;
										jQuery.ajax({
												url:"<?php echo home_url()."/wp-admin/admin-ajax.php" ?>",
												
												data: {
													'action':'dangkytheodoi',
													'idtruyen':idtruyen,
													'iduser':iduser
													
													
												},
												success:function(data) {
													
													
													
													if(data==1)
													{
														
														//jQuery('.theodoitruyen').html('<span id="dangtheodoi"> Đang theo dõi</span>');
														
														jQuery('#follow-comic').text( parseInt( $('#follow-comic').text() ) + 1 );
														load_soluong_theodoi(iduser);
													}
													else
													{
														alert('Có lỗi trong quá trình đăng ký theo dõi!'+data);
													}
													
													
												},
												error: function(errorThrown){
													console.log(errorThrown);
													alert("Loi"+errorThrown);
												}
											});

					});
					
					function load_soluong_theodoi(iduser)
					{
						jQuery.ajax({
												url:"<?php echo home_url()."/wp-admin/admin-ajax.php" ?>",
												
												data: {
													'action':'soluongthedoi_ajax',
													
													'iduser':iduser
													
													
												},
												success:function(data) {
													
														//document.getElementById('sl-theodoi-ajax').innerHTML=data;
														load_danhsach_theodoi(iduser);
													
													
													
												},
												error: function(errorThrown){
													console.log(errorThrown);
													alert("Loi"+errorThrown);
												}
											});
					
					
					}
					function load_danhsach_theodoi(iduser)
					{
						jQuery.ajax({
												url:"<?php echo home_url()."/wp-admin/admin-ajax.php" ?>",
												
												data: {
													'action':'danhsachtheodoi_ajax',
													
													'iduser':iduser,
													'linkthongtin':"<?php echo $link_thongtin; ?>"
													
													
												},
												success:function(data) {
													//$('#topHolderBox .follow').attr('data-content', data);
													$('.user-menu .userinfo').attr('data-content', data);
													jQuery('#dangkytheodoi').html('<span id="dangtheodoi" onclick="huytheodoi(<?php echo $userid;?>,<?php echo $cat ?>)" > Đang theo dõi truyện</span>');
													
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
				else
				{
					?>
					<span id="dangtheodoi" onclick="huytheodoi(<?php echo $userid;?>,<?php echo $cat ?>)"> Đang theo dõi</span>
					<?php

					} ?>
			
			
			
		</span>
		

	<?php else : ?>
	
	<span class="btn btn-warning"><i class="fa fa-star"></i> <span id="dkdetheodoi" onclick="return alert('Bạn chưa đăng nhập!');">Theo dõi</span></span>
	
	<?php
	endif;
	
}

function dangkytheodoi()
{	global $wpdb;
	if($_REQUEST)
	{
		$idtruyen=$_REQUEST['idtruyen'];
		$idchuong=0;
		query_posts('post_type=post&cat='.$idtruyen.'&showposts=1' );
		while (have_posts()):the_post();
			$idchuong=get_the_ID();
		endwhile; wp_reset_query();
		$iduser=$_REQUEST['iduser'];
		$sql="INSERT INTO ".$wpdb->prefix."theodoi (user,truyen,chuong) VALUES ('".$iduser."','".$idtruyen."','".$idchuong."')";
		$result=$wpdb->get_var($sql);
		if($result==null)
		{
			echo "1";
		}	
		else
		{
			echo "0";
		}


	}
	die();

}
add_action('wp_ajax_dangkytheodoi','dangkytheodoi');
add_action('wp_ajax_nopriv_dangkytheodoi','dangkytheodoi');


function check_theodoi($cat,$user)
{		global $wpdb;
		$sql="SELECT * FROM ".$wpdb->prefix."theodoi WHERE user='".$user."' AND truyen='".$cat."'";
		$result=$wpdb->get_results($sql);
		if($result)
		{	
			return "1";
		}	
		else
		{
			
			return "0";
		}
}

function danhsachtheodoi($user)
{
	global $wpdb;
		$sql="SELECT * FROM ".$wpdb->prefix."theodoi WHERE user='".$user."'  AND tinhtrang=0 order by id DESC limit 0,10";
		$result=$wpdb->get_results($sql);
		$return;
		if($result)
		{	$return .= "<table class='table'><thead><tr><td>Tên</td><td>Chương</td></tr></thead><tbody>";
			 foreach ($result as $value) {
			 	$truyen=get_term($value->truyen,'category');
			 	$chuongcuoi=laychuongcuoitruyen($value->truyen);
			 	$return .= "<tr>
							<td class='one'><a href='".get_term_link( $truyen,'category')."'>".$truyen->name."</a></td>
							<td class='two'><a href='".$chuongcuoi['slug']."'>".$chuongcuoi['name']."</a></td></tr>";
			 }

			$return .= "</tbody></table>";
		}	
		else
		{
			
			$return .= "<p>Bạn không có theo dõi nào</p>";

		}
	return $return;
}

function danhsachtheodoi_ajax()
{	if($_REQUEST)
	{	$user=$_REQUEST['iduser'];
		$link_thongtin=$_REQUEST['linkthongtin'];
		global $wpdb;
		$sql="SELECT * FROM ".$wpdb->prefix."theodoi WHERE user='".$user."'  AND tinhtrang=0 order by id DESC limit 0,10";
		$result=$wpdb->get_results($sql);
		if($result)
		{	$current_user = wp_get_current_user();
		
			
			$sl_tinnhan=sl_tinnhan($user_id);

			?>
			<ul class="nav nav-pills nav-justified">
				<li class="active"><a data-toggle="pill" href="#tab-config">Cấu hình chung</a></li>
				<li><a data-toggle="pill" href="#tab-follow">Truyện theo dõi</a></li>
			</ul>
			<div class="tab-content">
				<div id="tab-config" class="tab-pane fade in active text-center clearfix">
					<a class="message icon" href="<?php echo $link_thongtin; ?>#info" title="Thông báo">
						<i class="fa fa-envelope-o"></i>
						<sup><?php echo $sl_tinnhan; ?></sup>
					</a>
					<a class="username icon" href="<?php echo $link_thongtin; ?>#user" title="Thông tin người dùng">
						<i class="fa fa-user"></i>
						<?php echo $current_user->display_name; ?>
					</a>
					<a class="change-password icon" href="<?php echo $link_thongtin; ?>#password" title="Đổi mật khẩu">
						<i class="fa fa-edit"></i>
					</a>
					<a class="logout icon"	href="<?php echo wp_logout_url( home_url() ); ?>"title="Thoát">
						<i class="fa fa-power-off"></i>
					</a>
				</div>
				<div id="tab-follow" class="tab-pane fade">
					<?php echo "<table class='table'><thead><tr><td>Tên</td><td>Chương</td></tr></thead><tbody>";
							 foreach ($result as $value) {
								$truyen=get_term($value->truyen,'category');
								$chuongcuoi=laychuongcuoitruyen($value->truyen);
								echo "<tr>
										<td class='one'><a href='".get_term_link( $truyen,'category')."'>".$truyen->name."</a></td>
										<td class='two'><a href='".$chuongcuoi['slug']."'>".$chuongcuoi['name']."</a></td></tr>";
							 }

							echo "</tbody></table>";
							?>
				</div>
			</div>
						<?php
			
		}	
		else
		{
			
			echo "<p>Bạn không có theo dõi nào</p>";

		}
	}
	die();

}
add_action('wp_ajax_danhsachtheodoi_ajax','danhsachtheodoi_ajax');
add_action('wp_ajax_nopriv_danhsachtheodoi_ajax','danhsachtheodoi_ajax');


function laychuongcuoitruyen($idtruyen)
{
	$arg=array(
		'post_type' 		=>'post',
		'cat'				=>$idtruyen,
		'posts_per_page'	=>1,
		
		);
	$truyenmoi=new WP_Query($arg);
	$chuong=array();
	while ($truyenmoi->have_posts()):$truyenmoi->the_post();
	$chuong['slug']	=get_the_permalink($post->ID);
	$chuong['name']	=get_the_title($post->ID);
	$chuong['id']	=$post->ID;
	$chuong['time']	=thoigiandangbai();
		
	endwhile;	
	wp_reset_postdata();
	return $chuong;
	
}



function soluongtruyentheodoi($user)
{
	global $wpdb;
		$sql="SELECT count(id) as SL FROM ".$wpdb->prefix."theodoi WHERE user='".$user."'  AND tinhtrang=0 ";
		$result=$wpdb->get_results($sql);
		if($result)
		{	
			foreach ($result as $value) 
			{
			 	echo $value->SL;
			 } 
			}
		else
		{
			
			echo '';
		}
}
function soluongthedoi_ajax()
{
	if($_REQUEST)
	{	$user=$_REQUEST['iduser'];
		global $wpdb;
		$sql="SELECT count(id) as SL FROM ".$wpdb->prefix."theodoi WHERE user='".$user."'  AND tinhtrang=0 ";
		$result=$wpdb->get_results($sql);
		if($result)
		{	
			foreach ($result as $value) 
			{
			 	echo $value->SL;
			 } 
			}
		else
		{
			
			echo '';
		}
	}

	die();
}

add_action('wp_ajax_soluongthedoi_ajax','soluongthedoi_ajax');
add_action('wp_ajax_nopriv_soluongthedoi_ajax','soluongthedoi_ajax');


function countUserFollowComic($truyen_id)
{
	global $wpdb;
		$sql="SELECT count(distinct user) as SL FROM ".$wpdb->prefix."theodoi WHERE truyen='".$truyen_id."' ";
		$result=$wpdb->get_results($sql);
		if($result)
		{	
			foreach ($result as $value) 
			{
			 	echo $value->SL;
			 } 
			}
		else
		{
			
			echo '0';
		}
}


function checkdoctruyen($idchuong)
{	echo $idchuong;
	global $wpdb;
		
			 	$update="UPDATE ".$wpdb->prefix."theodoi SET tinhtrang=1 WHERE chuong=".$idchuong;
			 	$wpdb->get_var($update);
			

		
}
function huytheodoi()
{
	if($_REQUEST)
	{	
		$user=$_REQUEST['iduser'];
		$idtruyen=$_REQUEST['idtruyen'];
		global $wpdb;
		
		$del="DELETE FROM ".$wpdb->prefix."theodoi WHERE user='".$user."'  AND truyen='".$idtruyen."' ";
		$result=$wpdb->get_var($del);
		if($result)
		{	
			echo "Thất bại";
		}
		else
		{
			
			echo 'Xóa thành công';
		}
	}

	die();
}

add_action('wp_ajax_huytheodoi','huytheodoi');
add_action('wp_ajax_nopriv_huytheodoi','huytheodoi');

