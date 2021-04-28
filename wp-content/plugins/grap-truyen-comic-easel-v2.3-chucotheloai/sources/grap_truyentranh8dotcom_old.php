<?php 
if( ! defined( 'ABSPATH' ) ) exit;

function grap_truyentranh8dotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen) {
	?>
	<div class="postbox"> <?php

		if(empty($truyen_co_nhieu_chap)):
			//get_single_content($link_truyen, $html_noi_dung_truyen);
		//elseif(!empty($truyen_co_nhieu_chap) && ($loai_truyen == "4")):
			elseif(!empty($truyen_co_nhieu_chap) ):
			
			get_chaps_truyentranh8dotcom($link_truyen, $ten_truyen);
		
		endif; ?>

	</div>
	<?php
}

function get_chaps_truyentranh8dotcom($link_truyen, $ten_truyen){

	$array_ten_chap = check_chap_exists($ten_truyen);

	//$html = file_get_html($link_truyen);
	//$chaps = $html->find("#ChapList ul a");
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $link_truyen);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	$html = str_get_html($data);
	
	//$html = file_get_html($link_truyen);
	$chapsx = $html->find("#ChapList", 0);
	$chaps = $chapsx->find("ul a");
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
			$chapurl = $chap->href;
			$chaptitle = $chap->find("h2 strong", 0)->plaintext;

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
function get_single_content_truyentranh8dotcom($link_chap) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $link_chap);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$string = curl_exec($ch);
	curl_close($ch);
	$content 	= "";
	//$string 	= file_get_contents($link_chap);
	preg_match_all('/lstImages.push\(\"(.*?)\"\);/',$string, $display);

	for($i = 0; $i < count($display[1]); $i++):
		$content .= '<p><img src="'.$display[1][$i].'" /></p>';
	endfor;

	echo '<h2 class="grap-title">Kiểm tra nội dung</h2>';
	return "<div class='grab-content-chap'>" . $content . "</div>";
}

?>