<?php
if( ! defined( 'ABSPATH' ) ) exit;

function grap_mangavolumedotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen) {
	?>
	<div class="postbox"> <?php

		
			get_chaps_mangavolumedotcom($link_truyen, $ten_truyen);
		
		 ?>

	</div>
	<?php
}
function get_chaps_mangavolumedotcom($link_truyen, $ten_truyen){
$array_ten_chap = check_chap_exists($ten_truyen);
	
	

	$html = file_get_html($link_truyen);
	
	
	$page_num=$html->find("#NavigationPanel li a");
	$pageend=1;
	
	foreach($page_num as $pagend)
	{	$page_end=trim($pagend->plaintext);
		if($page_end!='Next')
		{
		$pageend=$page_end;
		}
	
	}
	echo $pageend;
	
	
	//echo  "nôi dung".get_single_content_mangafoxdotme('http://mangafox.me/manga/the_day_the_magpie_cries/c006/1.html')
//echo "aaaa".get_single_content_mangavolumedotcom('http://www.mangavolume.com/dragon-quest/chapter-dragon-quest-276/');	
//echo "aaaa".get_single_content_mangavolumedotcom_perpage('http://www.mangavolume.com/dragon-quest/chapter-dragon-quest-227/');
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
					for($page=1;$page<=$pageend;$page++)
					{
					if($page==1)
					{
					$link_page=$link_truyen;
					}
					else
					{
					$link_page=$link_truyen."npage-".$page;
					}
					
					$htmperpage = file_get_html($link_page);
					$list_commic=array();
					$list_commic=$htmperpage->find("#MainList tbody tr ");
					//krsort($list_commic);
					$stt=-1;
					foreach ( $list_commic as  $value) {
						$stt++;
						$chaptitle	=trim($value->find('td',0)->plaintext);
						if($stt!=0&&$stt!=count($list_commic)-1)
						{
						$chapurl	="http://www.mangavolume.com".$value->find('td a',0)->href;
						
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
					}  }
					
					
					}
					?>
					</tbody>
				</table>
			
	<?php
}

function get_single_content_mangavolumedotcom($link_webtruyen)
{
$html = file_get_html($link_webtruyen);
$slpage=1;
$page=0;
foreach($html->find('.SortBy select option') as $pages);
{
$page = str_replace('Page','',strip_tags($pages->plaintext));
$page = str_replace('#','',$page);
$page=(int)trim($page);

}


$noidung="";
if($page>0)
{
	for($i=1;$i<=$page;$i++)
		{	
			$link=$link_webtruyen.$i;

			//echo $link;
			//echo "<br>";
			$noidung.= "<img src='".get_single_content_mangavolumedotcom_perpage($link)."'>";
		}
}

	
	
	
	return "<div class='grab-content-chap'>" .$noidung."</div>";
	
}

function get_single_content_mangavolumedotcom_perpage($link_webtruyen)
{
$html = file_get_html($link_webtruyen);
$content="";

	
	$noidung=$html->find('#LeftPanel',0)->innertext;
	$content=$noidung;
	//$noidung=$noidung->find('table',0)->innertext;
	//$noidung=$noidung->find('img',0)->src;
	//$content=str_replace($noidung->find('table',0)->innertext,'',$content);
	$content=str_replace($html->find('.SelectBy',0)->innertext,'',$content);
	$content=str_replace($html->find('.SelectBy',1)->innertext,'',$content);
	$content=str_replace($html->find('#PageInfo',0)->innertext,'',$content);
	$content=str_replace($html->find('#fullscreen',0)->innertext,'',$content);
	$content=str_replace($html->find('.SortBy',0)->innertext,'',$content);
	$content=str_replace($html->find('#Detail',0)->innertext,'',$content);
	//$content=str_replace($html->find('div',0)->innertext,'',$content);
	//$content=str_replace($html->find('div',0)->innertext,'',$content);
	//$content=str_replace($html->find('div',0)->innertext,'',$content);
	//$content=str_replace($html->find('div',0)->innertext,'',$content);
	
	foreach($html->find('div') as $div)
	{
	
		$content=str_replace($div->innertext,'',$content);
	}
	
	//$content=explode('<table',$content);
	//$content=$content[1];
	
	//$content=explode('<img ',$content);
	//$content=$content[2];
	
	$pattern = '/src="([^"]*)"/';
	$src="";
	   if(preg_match_all($pattern, $content, $matches)) 
                {
					
					
					foreach($matches as $match) {
					
					$content=$match[1];
					$src= $content;
					//print_r($match[1]);
					}
				}
		//echo "src".$src;
	return $src;
}

?>