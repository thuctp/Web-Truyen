<?php 
if( ! defined( 'ABSPATH' ) ) exit;

function grap_mangaseedotco($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen) {
	?>
	<div class="postbox"> <?php

		if(empty($truyen_co_nhieu_chap)):
			//get_single_content($link_truyen, $html_noi_dung_truyen);
		elseif(!empty($truyen_co_nhieu_chap)):
			
			get_chaps_mangaseedotco($link_truyen, $ten_truyen);
		
		endif; ?>

	</div>
	<?php
}

function get_chaps_mangaseedotco($link_truyen, $ten_truyen){

	$array_ten_chap = check_chap_exists($ten_truyen);
	
	

	$html = file_get_html($link_truyen);
	//echo  get_single_content_mangaseedotco('http://mangasee.co/manga/?series=OnePiece&chapter=11');
		
	print_r(get_info_mangaseedotco($link_truyen));
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
					<?php foreach ($html->find(".chapter_link") as  $value) {

						$chaptitle	=trim($value->innertext);
						$chapurl1	=$value->href;
						$chapurl2	=substr($chapurl1,2);
						$chapurl	=substr($chapurl2,0,-15);
						$chapurl 	="http://mangasee.co".$chapurl;
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
					} ?>
					</tbody>
				</table>
			
	<?php
}

/*==========  Lấy nội dung trang single  ==========*/
function get_single_content_mangaseedotco($link_chap) {

	$content 	= "";
	$html = file_get_html( $link_chap);
	//foreach ($html->find('img') as  $value) {
	// 	$content=$content."".str_replace('style="max-width:98%;"','',$value);
	// } 
	foreach ($html->find('img') as  $value) {
	 	$content=$content."<img src='".$value->src."'>";
	 } 

	
	$content = str_replace($html->find("#fb-root", 0),"",$content);
	$content 	=str_replace($html->find(".navbar", 0),"",$content);
	$content = str_replace($html->find(".container", 0),"",$content);
	$content = str_replace($html->find(".container", 1),"",$content);
	$content = str_replace($html->find(".container", 2),"",$content);
	$content = str_replace($html->find(".container", 3),"",$content);
	foreach ($html->find(".navbar-form") as $key ){
		$content 	=str_replace($key,"",$content);
	}
	foreach ($html->find(".collapse") as $key) {
		$content = str_replace($key,"",$content);
		
	}
	foreach ($html->find(".ads") as $key) {
		$content = str_replace($key,"",$content);
		
	}
	$content = str_replace($html->find(".navbar-header", 0),"",$content);
	$content = str_replace($html->find(".collapse", 1),"",$content);
	
	
	$content = str_replace($html->find(".pull-right", 0),"",$content);
	$content = str_replace($html->find(".well", 0),"",$content);
	$content = str_replace($html->find(".fb-like", 0),"",$content);
	$content = str_replace($html->find(".g-plusone", 0),"",$content);
	$content = str_replace($html->find(".ads", 0),"",$content);
	

	return "<div class='grab-content-chap'>" . $content. "</div>";
}




function getimage_mangaseedotco($link_webtruyen)
{

	$html = file_get_html($link_webtruyen);

	foreach($html->find('.container .well .col-md-3 img') as $element) 
	{
   	  $noidung=$element->src;
	}

	$noidung=str_replace('..','http://mangasee.co',$noidung);
	
	return $noidung;

}

function get_info_mangaseedotco($link_webtruyen)
{

	$html = file_get_html($link_webtruyen);
	$noidung=array();
	
	
	$author=$html->find('.container .well .col-md-9 .row',1)->plaintext;
	$category=$html->find('.container .well .col-md-9 .row',4)->plaintext;
	$description=$html->find('.container .well .col-md-9 .row',5)->plaintext;
	$noidung['author']=str_replace('Author:','',$author);
	$noidung['category']=str_replace('Genre:','',$category);
	$noidung['description']=trim(str_replace('Description:','',$description));
	return $noidung;

}



?>