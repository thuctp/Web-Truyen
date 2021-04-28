<?php 
if( ! defined( 'ABSPATH' ) ) exit;

function grap_doctruyen360dotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen) {
	?>
	<div class="postbox"> <?php

		if($truyen_co_nhieu_chap == 0):
			get_chaps_truyen_ngan_doctruyen360dotcom($link_truyen, $ten_truyen);
		elseif($truyen_co_nhieu_chap == 1):
			get_chaps_doctruyen360dotcom($link_truyen, $ten_truyen);
		endif; ?>
	</div>
	<?php
}

function get_chaps_doctruyen360dotcom($link_truyen, $ten_truyen){

	$array_ten_chap = check_chap_exists($ten_truyen);
	
	
	$html = file_get_html($link_truyen);
	$con = $html->find('div[class="entry"]',0);

	?>
	<h2 class="grap-title">Danh sách chap nguồn 360</h2>
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
	$img_link=$con->find('img',0)->src;
	foreach($con->find('li') as $em){
		$chapurl = $em->find('a',0)->href;
		$chaptitle = $em->find('a',0)->plaintext;
		
			
		$has_chap 	= in_array($chaptitle, $array_ten_chap);
		?>
			<tr <?php if ($has_chap == true ) echo "class='grab-tr-disable'" ?> id="<?php echo sanitize_title($chaptitle); ?>">
				<td>
					<input type="checkbox" 
					value="<?php echo $chapurl; ?>" 
					data-link="<?php echo $chapurl ?>" 
					data-img="<?php echo $img_link; ?>"
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
					data-img="<?php echo $img_link; ?>"
					class="button-primary click-to" 
					<?php if ($has_chap == true ) echo "disabled" ?> 
					value="<?php if ($has_chap == true ) echo "Đã lấy"; else echo "Lấy"; ?>" />
				</td>
			</tr>
		<?php
	}
}

function get_chaps_truyen_ngan_doctruyen360dotcom($link_truyen, $ten_truyen){

	$array_ten_chap = check_chap_exists($ten_truyen);
	
	?>
	<h2 class="grap-title">Truyện ngắn</h2>
	<table class="widefat" id="grap-result">
		<thead>
			<th>Tên</th>
			<th>Link</th>
			<th>Lấy nội dung</th>
		</thead>
		<tbody>
	<?php
		
		$html = file_get_html($link_truyen);
		$eml = $html->find('div[id="main"]',0);
		$chaptitle = $eml->find('.metainfo h1',0)->plaintext;
		$chapurl = $link_truyen;
			
		$has_chap 	= in_array($chaptitle, $array_ten_chap);
		?>
			<tr <?php if ($has_chap == true ) echo "class='grab-tr-disable'" ?> id="<?php echo sanitize_title($chaptitle); ?>">
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


/*==========  Lấy nội dung trang single  ==========*/
function get_single_content_doctruyen360dotcom($link_chap) {
	
	$noidung 	= "";
	$html = file_get_html($link_chap);
	$noidung = $html->find('div[class="dtct1072"]',0)->innertext;
	$noidung = explode('<div class="fb-like"', $noidung);
	$noidung =  $noidung[0];
	return "<div class='grab-content-chap'>" . $noidung . "</div>";
}
/*==========  Lấy nội dung truyện không chap  ==========*/


?>