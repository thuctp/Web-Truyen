<?php 
if( ! defined( 'ABSPATH' ) ) exit;

function grap_truyenvietdotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen) {
	?>
	<div class="postbox"> <?php

		if(empty($truyen_co_nhieu_chap)):
			//get_single_content($link_truyen, $html_noi_dung_truyen);
		//elseif(!empty($truyen_co_nhieu_chap) && ($loai_truyen == "5")):
			elseif(!empty($truyen_co_nhieu_chap)):
			
			get_list_truyenvietdotcom($link_truyen, $ten_truyen);
		
		endif; ?>

	</div>
	<?php
}

/*==========  Lấy danh sách chap của truyện  ==========*/
function get_list_truyenvietdotcom($link_truyen, $ten_truyen) {

		$array_ten_chap = check_chap_exists($ten_truyen);
		$html = file_get_html($link_truyen);
				
		//$array_chap = $html->find($html_chap_truyen);
		$navend = $html->find('.pagination-end a', 0);
		$navend = $navend->href;
		$navend = substr($navend, strpos($navend,"=") + 1);
		
		$chaptitle = get_titlechap_truyenvietdotcom($link_truyen);
		$tt = $chaptitle;
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
			if ((int)$navend >= 1):
				
			for($i=$navend; $i > 0 ; $i--){
				$chaptitle = get_titlechap_truyenvietdotcom($link_truyen.'?start='.$i);
				$chapurl = $link_truyen.'?start='.$i;
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
								<?php echo $link_truyen.'?start='.$i; ?>
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
			endif;
			$has_chap = get_page_by_title($tt, OBJECT, 'chap_truyen');
				?>
				<tr>
						<td>
							<input type="checkbox" 
							value="<?php echo $link_truyen; ?>" 
							data-link="<?php echo $link_truyen ?>" 
							data-title="<?php echo $tt; ?>" 
							<?php if ($has_chap != null ) echo "disabled"; ?> 
							<?php if ($has_chap != null ) echo "class='grab-not-select'" ?> />
						</td>
						<td><?php echo get_titlechap_truyenvietdotcom($link_truyen); ?></td>
						<td>
							<a>
								<?php echo $link_truyen;?>
							</a>
						</td>
						<td>
							<input type="button" data-link="<?php echo $link_truyen ?>" 
							data-title="<?php echo $tt; ?>" 
							class="button-primary click-to" 
							<?php if ($has_chap != null ) echo "disabled" ?> 
							value="<?php if ($has_chap != null ) echo "Đã lấy"; else echo "Lấy"; ?>" />
						</td>
					</tr>
				</tbody>
			</table>
		<?php
}

function get_titlechap_truyenvietdotcom($link_truyen) {
	$html = file_get_html($link_truyen);
	$title = $html->find(".item-page div strong", 0)->plaintext;
	if(trim($title) != ""){
		return $html->find(".item-page div strong", 0)->plaintext;
	}
	return "Trang ".substr($link_truyen, strpos($link_truyen,"=") + 1).": Không lấy được tên chap này";
}

/*==========  Lấy nội dung trang single  ==========*/
function get_single_content_truyenvietdotcom($link_chap) {

	$content 	= "";
	$html 	= file_get_html($link_chap);
	$content = $html->find("#main .item-page", 0);
	$content = preg_replace("/\<h1\>(.*?)\<\/h1\>/", "", $content);
	$content = preg_replace("/\<h2\>(.*?)\<\/h2\>/", "", $content);
	$content = preg_replace("/\<strong\>(.*?)\<\/strong\>/", "", $content);
	$content = preg_replace("/\<form(.*?)\<\/form\>/", "", $content);
	$content = preg_replace("/\<span class\=\"content_rating\"\>(.*?)\<\/span\>/", "", $content);
	$content = preg_replace("/\<div class\=\"pagenavcounter\"\>(.*?)\<\/div\>/", "", $content);
	$content = preg_replace("/\<div class\=\"pagination\"\>(.*?)\<\/div\>/", "", $content);
	$content = preg_replace("/\<ul class\=\"pagenav\"\>(.*?)\<\/ul\>/", "", $content);
	$content = preg_replace("/\<div class\=\"richsnippetsvote\"\>(.*?)\<\/div\>/", "", $content);
	$content = preg_replace("/\<div itemscope(.*?)\<\/div\>/", "", $content);
	$content = str_replace('<div class="richsnippetsvote">',"",$content);
	
	//echo '<h2 class="grap-title">Kiểm tra nội dung</h2>';
	return "<div class='grab-content-chap'>" . $content . "</div>";
}

?>