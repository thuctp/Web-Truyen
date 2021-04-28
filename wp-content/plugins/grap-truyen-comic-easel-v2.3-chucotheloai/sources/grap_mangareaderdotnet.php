<?php 
if( ! defined( 'ABSPATH' ) ) exit;

function grap_mangareaderdotnet($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen) {
	?>
	<div class="postbox"> <?php

		
			get_chaps_mangareaderdotnet($link_truyen, $ten_truyen);
		
		 ?>

	</div>
	<?php
}

function get_chaps_mangareaderdotnet($link_truyen, $ten_truyen){

	$array_ten_chap = check_chap_exists($ten_truyen);
	
	

	$html = file_get_html($link_truyen);
	//echo  "nôi dung".get_single_content_mangafoxdotme('http://mangafox.me/manga/the_day_the_magpie_cries/c006/1.html')
	//echo "aaaa".get_single_content_mangavolumedotcom_perpage('http://www.mangavolume.com/dragon-quest/chapter-dragon-quest-276/');	
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
					$list_commic=array();
					$list_commic=$html->find("#chapterlist tr a");
					krsort($list_commic);
					foreach ( $list_commic as  $value) {

						$chaptitle	=trim($value->plaintext);
						$chapurl	="http://www.mangareader.net".$value->href;
						
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






function get_single_content_mangareaderdotnet($link_webtruyen)
{
$html = file_get_html($link_webtruyen);
$slpage=$html->find('#selectpage',0)->plaintext;

$page=explode('of',$slpage);
$page=(int)trim($page[1]);

$noidung="";
if($page>0)
{
	for($i=1;$i<=$page;$i++)
		{	
			$link=$link_webtruyen."/".$i;

			//echo $link;
			//echo "<br>";
			$noidung.= get_single_content_mangareaderdotnet_perpage($link);
		}
}

	
	
	
	return "<div class='grab-content-chap'>" .$noidung."</div>";
	
}

function get_single_content_mangareaderdotnet_perpage($link_webtruyen)
{
$html = file_get_html($link_webtruyen);
$noidung="";

	
	$noidung=$html->find('#imgholder img',0)->src;
	
	return "<img src='".$noidung."'>";
}





?>