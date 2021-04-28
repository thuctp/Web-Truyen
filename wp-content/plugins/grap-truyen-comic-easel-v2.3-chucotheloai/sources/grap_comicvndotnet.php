<?php 
if( ! defined( 'ABSPATH' ) ) exit;

function grap_comicvndotnet($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen) {
	?>
	<div class="postbox"> <?php

		if(empty($truyen_co_nhieu_chap)):
			//get_single_content($link_truyen, $html_noi_dung_truyen);
		//elseif(!empty($truyen_co_nhieu_chap) && ($loai_truyen == "4")):
			elseif(!empty($truyen_co_nhieu_chap)):
			
			get_chaps_comicvndotnet($link_truyen, $ten_truyen);
		
		endif; ?>

	</div>
	<?php
}

function get_chaps_comicvndotnet($link_truyen, $ten_truyen){

	$array_ten_chap = check_chap_exists($ten_truyen);

	$html = file_get_html($link_truyen);
	$chaps = $html->find(".list-chapter tr td a");
	if(count($chaps) > 0){
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
		foreach($chaps as $chap){
			$chapurl = "http://comicvn.net".$chap->href;
			$chaptitle = $chap->plaintext;

			$has_chap = in_array($chaptitle, $array_ten_chap);
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
		}
	}
}

/*==========  Lấy nội dung trang single  ==========*/
function get_single_content_comicvndotnet($link_chap) {
	$content 	= "";
	$html = file_get_html($link_chap);
	$content = $html->find("#txtarea", 0)->innertext;
	return "<div class='grab-content-chap'>" . htmlspecialchars_decode($content) . "</div>";
}


function getimage_comicvndotnet($linktruyen)
{

	$html = file_get_html($linktruyen);

	foreach($html->find('.infoleft img') as $element) 
	{
   	  $noidung=$element->src;
	}

	
	return $noidung;

}
?>