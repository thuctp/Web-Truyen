<?php 
if( ! defined( 'ABSPATH' ) ) exit;

function grap_truyencvdotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen) {
	?>
	<div class="postbox"> <?php

			get_chaps_truyencvdotcom($link_truyen, $ten_truyen);
		
		?>

	</div>
	<?php
}

function get_chaps_truyencvdotcom($link_truyen, $ten_truyen){

	$array_ten_chap = check_chap_exists($ten_truyen);
	

	$linkchap = $link_truyen;
	$html = file_get_html($linkchap);
	$chapend = $html->find("#body .w_right .chapter a",0)->href;
	$chapend = str_replace($linkchap, "", $chapend);
	$chapend = strstr($chapend, "-");
	$chapend = str_replace("-", "", $chapend);
	$chapend = str_replace("/", "", $chapend);

	$chaps = $html->find(".main .table-cm #table-cm .tr",0)->plaintext;
//	echo "Nội dung".get_single_content_truyencvdotcom('http://truyencv.com/ngao-kiem-tan-thoi/chuong-170/');
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

	if($chaps=="")
	{
		//$chapend = $html->find("#main #dsc a")->href;
		$list_link_temp=$html->find("#main #dsc a");
		$chapend=end($list_link_temp);
		$chapend=explode('showChapter(',$chapend);
			$chapend=$chapend[1];
			$chapend=explode(')',$chapend);
			$chapend=$chapend[0];
			$chapend=explode(',', $chapend);
			$chapend=$chapend[1];
			$chapend=str_replace("'","",$chapend);

				for($i =(int)$chapend+30 ; $i >=1 ; $i--){
				//$chapurl = $chaps[$i];
					$chapurl=$linkchap."chuong-".$i;

				//$num = str_replace($linkchap, "", $chapurl);
				//$num = strstr($num, "-");
				//$num = str_replace("-", "", $num);
				//$num = str_replace("/", "", $num);

					$num=$i;

				if($num == ""){
					$chaptitle = "Chương 0";
				}else {
					$chaptitle = "Chương ".$num;
				}
				
				$has_chap 	= in_array($chaptitle, $array_ten_chap);
				
				
				
					
					
					
					$quyen="";
					$img_link="";//layhinhanh($link_truyen);
				?>
					<tr <?php if ($has_chap == true ) echo "class='grab-tr-disable'" ?> id="<?php echo sanitize_title($chaptitle); ?>">
						<td>
							<input type="checkbox" 
							value="<?php echo $chapurl; ?>" 
							data-link="<?php echo $chapurl ?>" 
							data-title="<?php echo $chaptitle; ?>" 
							data-tenchuong="<?php echo $chapurl ?>";
							data-quyen="<?php echo $quyen; ?>"
							data-img="<?php echo $img_link; ?>"
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
							data-tenchuong="<?php echo $chapurl ?>";
							data-quyen="<?php echo $quyen; ?>"
							data-img="<?php echo $img_link; ?>"
							class="button-primary click-to" 
							<?php if ($has_chap == true ) echo "disabled" ?> 
							value="<?php if ($has_chap == true ) echo "Đã lấy"; else echo "Lấy"; ?>" />
						</td>
					</tr>
				<?php
			}

	}
	


	if(count($chaps) > 0){
		?>
			
		<?php

		$listchap = array();
		
		
		foreach($chaps as $chap){

			$chapurl = $chap->find("a", 0)->href;
			// $chap_title = $chap->find("a", 0)->innertext;
			
			array_push($listchap ,$chapurl);
			
		}
		
		
		if(count($listchap) > 0){
			$temp = end($listchap);
			$chaptemp = str_replace($linkchap, "", $temp);
			$chaptemp = strstr($chaptemp, "-");
			$chaptemp = str_replace("-", "", $chaptemp);
			$chaptemp = str_replace("/", "", $chaptemp);
			//echo $chapend;
			if($chapend > $chaptemp){
				$temp = str_replace($linkchap, "", $temp);
				$temp = str_replace("/", "", $temp);
				$temp = str_replace($chaptemp, "", $temp);
				
				for($i= $chaptemp + 1; $i<=$chapend; $i++ ){
					$chapurl = $linkchap.$temp.$i."/";
					array_push($listchap ,$chapurl);
				}
			}
			
			$chaps = Array_reverse($listchap);
			for($i = 0; $i < count($chaps); $i++){
				$chapurl = $chaps[$i];

				$num = str_replace($linkchap, "", $chapurl);
				$num = strstr($num, "-");
				$num = str_replace("-", "", $num);
				$num = str_replace("/", "", $num);

				if($num == ""){
					$chaptitle = "Chương 0";
				}else {
					$chaptitle = "Chương ".$num;
				}
				
				$has_chap 	= in_array($chaptitle, $array_ten_chap);
				
				
				
					
					
					
					$quyen="";
					$img_link="";//layhinhanh($link_truyen);
				?>
					<tr <?php if ($has_chap == true ) echo "class='grab-tr-disable'" ?> id="<?php echo sanitize_title($chaptitle); ?>">
						<td>
							<input type="checkbox" 
							value="<?php echo $chapurl; ?>" 
							data-link="<?php echo $chapurl ?>" 
							data-title="<?php echo $chaptitle; ?>" 
							data-tenchuong="<?php echo $chapurl ?>";
							data-quyen="<?php echo $quyen; ?>"
							data-img="<?php echo $img_link; ?>"
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
							data-tenchuong="<?php echo $chapurl ?>";
							data-quyen="<?php echo $quyen; ?>"
							data-img="<?php echo $img_link; ?>"
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
function get_single_content_truyencvdotcom($link_chap) {
	

	$content 	= "";
	$html = file_get_html($link_chap);
	$content = $html->find(".chapter", 0)->innertext;


	$pattern = '/href="([^"]*)"/';
					    preg_match($pattern, $content, $matches);
					    $src = $matches[0];
					    unset($matches);
					    $content=str_replace($src,"",$content);
					  
$content=str_replace('target="_blank"','', $content);
$content=str_replace('</a>','',$content);
$content=str_replace('<a>','',$content);
 $content = preg_replace('/<p\b[^>]*>(.*?)<\/p>/i', '', $content);

	return "<div class='grab-content-chap'>" . $content . "</div>";
}


/*Lấy tiêu đề bằng link*/
function get_title_single_truyencv($link_chap)
{
	$content 	= "";
	$html = file_get_html($link_chap);
	$content = $html->find("#breadcrum span", 3)->innertext;
	
	if(preg_match('/(Chương)/',$content)) /*nếu tồn tại chữ Chương trong chuỗi tên chương*/
					{
						
						/*Lấy vị trí của dấu :*/
						//$vitri=strpos($tenchuong, ":" );
						/*Tách chuỗi, bỏ chữ Chương 1:*/
						$content=strstr($content, ":" );
						/*Loại bỏ dấu : */
						$content=ltrim( $content,':') ;
						
					}
	//return $content;
					return $content;
}
function layhinhanh_truyencv($url)
{
	$html = file_get_html($url);
	$link = $html->find("#body .w_left img",0)->src;

	


	return $link;
	
	
}


?>