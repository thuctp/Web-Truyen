<?php 
if( ! defined( 'ABSPATH' ) ) exit;

function grap_santruyendotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen) {
	?>
	<div class="postbox"> <?php

		if(empty($truyen_co_nhieu_chap)):
			//get_single_content($link_truyen, $html_noi_dung_truyen);
		elseif(!empty($truyen_co_nhieu_chap)):
			
			get_chaps_santruyendotcom($link_truyen, $ten_truyen);
		
		endif; ?>

	</div>
	<?php
}

function get_chaps_santruyendotcom($link_truyen, $ten_truyen){

	$array_ten_chap = check_chap_exists($ten_truyen);
	//echo get_single_content_santruyendotcom('http://santruyen.com/hoc-vien-thien-tai-chuong-68-duyen-phan-Y2RpZ2Vi.html');
	
	
	$list_chap=curl_get_contents($link_truyen);
	$list_chap_arr=explode('<div class="list-chap" id="_pchapter">',$list_chap);
	$str="";
	$list_chap=str_replace($list_chap_arr[0],'',$list_chap);
	$list_chap_arr=explode('<div class="clr"></div>',$list_chap);
	$list_chap=$list_chap_arr[0];
	$list_chap=str_replace('<div class="list-chap" id="_pchapter"><ul>','',$list_chap);
	$list_chap=str_replace('</ul>','',$list_chap);
	
	$danhsachchuong_arr=explode('<p>',$list_chap);
	
	//print_r($danhsachchuong_arr);
	$sl_chap=count($danhsachchuong_arr);
	
		
		?>
		
		<h2 class="grap-title">Danh sách chap</h2>
				<table class="widefat" id="grap-result">
					<thead>
						<th width="10px">
						<a onclick="checkByParent(true); jQuery('.grap-multi-btn').css('display','inherit'); return false;">Check</a>
						<br/>
						<a onclick="checkByParent(false); jQuery('.grap-multi-btn').css('display','none'); return false;">UnCheck</a>
						</th>
						<th>Chap</th>
						<th>Link</th>
						<th>Lấy nội dung</th>
					</thead>
					<tbody>
					<?php 
					for($i=$sl_chap-1;$i>=1;$i--)
						{
							
							$str_chuong=str_replace('<p></p>','',$danhsachchuong_arr[$i]);
							$str_chuong=explode('href',$str_chuong);
							$str_chuong=$str_chuong[1];
							$str_chuong=explode('">',$str_chuong);
							$chapurl=str_replace('="','',$str_chuong[0]);
							$ten_chuong=explode(":",$str_chuong[1]);
							$chaptitle=$ten_chuong[0];
							
						
						$has_chap 	= in_array($chaptitle, $array_ten_chap);
					?>


						<tr <?php if ($has_chap == true ) echo "class='grab-tr-disable'" ?> id="<?php echo sanitize_title($chaptitle); ?>">
							<td>
								<input type="checkbox" 
								value="<?php echo $chapurl; ?>" 
								data-link="<?php echo $chapurl ?>" 
							
								data-title="<?php echo $chaptitle; ?>" 
								<?php if ($has_chap == true ) echo "disabled"; ?> 
								<?php if ($has_chap == true ) echo "class='grab-not-select'" ?> />
							</td>
							<td><?php echo $chaptitle; ?></td>
							<td>
								<a>
									<?php echo $chapurl; ?>
								</a>
							</td>
							<td>
								<input type="button" data-link="<?php echo $chapurl ?>" 
								data-title="<?php echo $chaptitle; ?>" 
								
								class="button-primary click-to" 
								<?php if ($has_chap == true ) echo "disabled" ?> 
								value="<?php if ($has_chap == true ) echo "Đã lấy"; else echo "Lấy"; ?>" />
							</td>
						</tr>
						<?php
					} ?>
					</tbody>
				</table>
			
	<?php
	
	
	
	
	//echo $list_chap;
	

}

/*==========  Lấy nội dung trang single  ==========*/
function get_single_content_santruyendotcom($link_chap) {

	$content 	= "";
	
	$content=curl_get_contents($link_chap);
	
	$array_content=explode('<div class="contents-comic">',$content);
	
	$content=$array_content[1];
	
	$array_content_2=explode('</div>',$content);
	
	$content=$array_content_2[0];
	
	
	
	return "<div class='grab-content-chap'>" . $content. "</div>";
}









?>