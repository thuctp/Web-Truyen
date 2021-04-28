<?php 
if( ! defined( 'ABSPATH' ) ) exit;

function grap_thuquantruyendotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen) {
	?>
	<div class="postbox"> <?php

		if(empty($truyen_co_nhieu_chap)):
			//get_single_content($link_truyen, $html_noi_dung_truyen);
		elseif(!empty($truyen_co_nhieu_chap)):
			
			get_chaps_thuquantruyendotcom($link_truyen, $ten_truyen);
		
		endif; ?>

	</div>
	<?php
}

function get_chaps_thuquantruyendotcom($link_truyen, $ten_truyen){

	$array_ten_chap = check_chap_exists($ten_truyen);
	//echo get_single_content_thuquantruyendotcom('http://thuquantruyen.com/doc-truyen/ben-nhau-dai-lau/chuong-2-1041');
	
	

	$html = file_get_html($link_truyen);
	//echo  get_single_content_mangaseedotco('http://mangasee.co/manga/?series=OnePiece&chapter=11');
		
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
					$list_dns=array();
					foreach ($html->find("#thechapters li a") as  $value) {

						$chaptitle	="Chap ".trim($value->innertext);
						$chapurl1	=$value->href;
						$chapurl 	="http://thuquantruyen.com/".$chapurl1;
						$array_chap=array();
						$array_chap['title']=$chaptitle;
						$array_chap['url']=$chapurl;
						
						$list_dns[]=$array_chap;
						}
						krsort($list_dns);
					foreach($list_dns as $chap)
					{
						$chaptitle	=$chap['title'];
						
						$chapurl 	=$chap['url'];
						
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
}

/*==========  Lấy nội dung trang single  ==========*/
function get_single_content_thuquantruyendotcom($link_chap) {

	$content 	= "";
	
	$html = file_get_html( $link_chap);
	
	$content=$html->find('main .container .row .single-post .support-read',0)->innertext;
	
	return "<div class='grab-content-chap'>" . $content. "</div>";
}








?>