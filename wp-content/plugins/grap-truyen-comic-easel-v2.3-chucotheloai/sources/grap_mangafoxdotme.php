<?php 
if( ! defined( 'ABSPATH' ) ) exit;

function grap_mangafoxdotme($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen) {
	?>
	<div class="postbox"> <?php

		
			get_chaps_mangafoxdotme($link_truyen, $ten_truyen);
		
		 ?>

	</div>
	<?php
}

function get_chaps_mangafoxdotme($link_truyen, $ten_truyen){

	$array_ten_chap = check_chap_exists($ten_truyen);
	
	

	$html = file_get_html($link_truyen);
	echo  "nôi dung".get_single_content_mangafoxdotme('http://mangafox.me/manga/the_day_the_magpie_cries/c006/1.html')
	//echo get_single_content_mangareaderdotnet('http://www.mangareader.net/the-god-of-high-school/2');	
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
					<?php foreach ($html->find("#chapters .chlist li h3 a") as  $value) {

						$chaptitle	=trim($value->plaintext);
						$chapurl	=$value->href;
						
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





function get_single_content_mangafoxdotme($link_webtruyen)
{	$link_webtruyen="http://mangafox.me/manga/coppelion/vTBD/c213/1.html";
	$noidung="";
	//$html_ct = file_get_html($link_webtruyen);




$noidung=curl_get_contents($link_webtruyen);


$noidung=explode('<select onchange="change_page(this)" class="m">', $noidung);
$noidung=$noidung[1];
$noidung=explode('</select>', $noidung);

$noidung=$noidung[0];


$list_image=explode('</option>',$noidung);
$arr_image=array();

//print_r($list_image);

foreach ($list_image as $image) {
	$str=str_replace('<option','',$image);
	$str=explode('>',$str);
	$str=$str[1];
	$str=trim($str);
	if($str!=''&&$str!='Comments')
	{
		$arr_image[]=$str;
}
	}
	

print_r($arr_image);




	
	//return $noidung;

}

	



function get_single_content_mangafoxdotme_perpage($link_webtruyen)
{
$html = file_get_html($link_webtruyen);
	$noidung="";
	foreach($html->find('#viewer .read_img img') as $element) 
	{
   	  $noidung.=$element;
	}

	
	return $noidung;
}








?>