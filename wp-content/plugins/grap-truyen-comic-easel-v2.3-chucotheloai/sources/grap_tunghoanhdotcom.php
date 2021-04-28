<?php 
if( ! defined( 'ABSPATH' ) ) exit;

function grap_tunghoanhdotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen) {
	?>
	<div class="postbox"> <?php

		if(empty($truyen_co_nhieu_chap)):
			//get_single_content($link_truyen, $html_noi_dung_truyen);
		elseif(!empty($truyen_co_nhieu_chap)):
			get_chaps_tunghoanhdotcom($link_truyen, $ten_truyen);
		
		endif; ?>

	</div>
	<?php
}

function get_chaps_tunghoanhdotcom($link_truyen, $ten_truyen){

	$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
	$context = stream_context_create($opts);

	$array_ten_chap = check_chap_exists($ten_truyen);
	
	

	
	$link_first= get_link_chaper_first($link_truyen);
	$list_chap=get_list_chap($link_first);
	$list_chap=explode('<option', $list_chap);


	
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

		
		
		
		
		
		
		if(count($list_chap) > 0){
			$sl=(int)count($list_chap);
			//foreach ($list_chap as $value) 
			for ($i=$sl; $i>=0; $i--) 
			{
				if($list_chap[$i]!='')
				{
			$str_chap= htmlspecialchars_decode($list_chap[$i]);
			//echo "Chương".$str_chap;
			//echo "</br>";
			$str_chap=str_replace('selected="selected"',"",$str_chap);
			
			$chaptitle= explode('>',$str_chap);
			$chaptitle=htmlspecialchars_decode($chaptitle[1]);
			//$chaptitle=str_replace('</option',"",$chaptitle);
			//echo htmlspecialchars_decode($chaptitle);

			$chapurl=str_replace('value="', "", $str_chap);
			$chapurl=str_replace($chaptitle, "", $chapurl);
			$chapurl=str_replace('">>', "", $chapurl);
			$chapurl=str_replace('" >>', "", $chapurl);
			$chapurl=trim($chapurl);



			$has_chap 	= in_array($chaptitle, $array_ten_chap);
				
				
				
					
					
					
					$quyen="";
					$img_link="";//layhinhanh($link_truyen);
					$tenchuong=get_title_single_tunghoanh($chapurl);
				?>
					<tr <?php if ($has_chap == true ) echo "class='grab-tr-disable'" ?> id="<?php echo sanitize_title($chaptitle); ?>">
						<td>
							<input type="checkbox" 
							value="<?php echo $chapurl; ?>" 
							data-link="<?php echo $chapurl ?>" 
							data-title="<?php echo str_replace('</option',"",$chaptitle); ?>" 
							data-tenchuong="<?php echo $tenchuong; ?>"
							data-quyen=""
							data-img=""
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
							data-title="<?php echo str_replace('</option',"",$chaptitle); ?>" 
							data-tenchuong="<?php echo $tenchuong;?>"
							data-quyen=""
							data-img=""
							class="button-primary click-to" 
							<?php if ($has_chap == true ) echo "disabled" ?> 
							value="<?php if ($has_chap == true ) echo "Đã lấy"; else echo "Lấy"; ?>" />
						</td>
					</tr>
				<?php
			}
		}
		}
		
	
}

/*==========  Lấy nội dung trang single  ==========*/
function get_single_content_tunghoanhdotcom($link_chap) {
	

	$content 	= "";
	$html = file_get_html($link_chap);
	$content = $html->find("div[id=chapter_content]", 0)->innertext;
	return "<div class='grab-content-chap'>" . $content . "</div>";
}

function get_list_chap($link_chap_first)
{
	$content 	= "";
	$html = file_get_html($link_chap_first);
	$content = $html->find("div[class=select] select",0)->innertext;	
	//$arr=array();
	//foreach ($html->find("div[class=select] select[value]") as $em) {
	//	$arr[]=$em;
	//}
	return $content;	
}
function get_link_chaper_first($link_truyen)
{
	$html=file_get_html($link_truyen);
	$chapfirst=$html->find('.main .table-cm #table-cm .tr a',0)->href;
	return $chapfirst;
}
/*Lấy tiêu đề bằng link*/
function get_title_single_tunghoanh($link_chap)
{
	$content 	= "";
	$html = curl_get_contents($link_chap);
	$content = explode('<h2 class="ctitle">',$html);
	$content=$content[1];
	$content=explode(' <div class="chapters">',$content);
	$content=$content[0];
	$content=str_replace('</h2>','',$content);
	if(preg_match('/(Chương)/',$content)) /*nếu tồn tại chữ Chương trong chuỗi tên chương*/
					{
						
					
						$content=strstr($content, ":" );
						/*Loại bỏ dấu : */
						$content=ltrim( $content,':') ;
	}
					return trim($content);
}
function layhinhanh_tunghoanh($url)
{
	$html = file_get_html($url);
	$link = $html->find("#body .w_left img",0)->src;
	return $link;
	
	
}


?>