<?php 
function grap_viewcomicdotcom($link_truyen,$ten_truyen)
{
$array_ten_chap = check_chap_exists($ten_truyen);
//echo get_single_content_viewcomic("http://viewcomic.com/plants-vs-zombies-garden-warfare-02-of-03-2015/");

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
$html = file_get_html($link_truyen);

$listchap=explode('<select id="selectbox" style="width:500px" name="" onchange="javascript:location.href = this.value;">',$html);
$listchap=$listchap[1];
$listchap=explode('</select>', $listchap);
$listchap=$listchap[0];


$listchap=explode('<option',$listchap);
//print_r($listchap);


$array_danh_sach_link=array();

foreach ($listchap as $value) {
	if(trim($value)!='')
	{	$value=trim($value);
		$link=str_replace('value="',"", $value);
		$link=str_replace('</option>',"", $link);
		$link=str_replace('selected',"", $link);
		$link=str_replace('Reading',"", $link);
		$link=str_replace('………………',"", $link);
		$link=str_replace('</div>',"", $link);
		
		$array=array();
		$link_ex=explode('">',$link);
		$array['link']=trim($link_ex[0]);
		$array['title']=trim($link_ex[1]);

		$array_danh_sach_link[]=$array;
	}
	
}



foreach($array_danh_sach_link as $chap)
					
				{
					$chapurl = $chap['link'];
					$chaptitle = $chap['title'];
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
				echo '</tbody></table>';
}




/*==========  Lấy nội dung trang single  ==========*/
function get_single_content_viewcomic($link_chap) {

	$content 	= "";
	$html 	= file_get_html($link_chap);
	foreach($html->find(".separator a") as $value )
	{
		$content.=$value->innertext;
	}
	
	
	return "<div class='grab-content-chap'>" . $content . "</div>";
}


