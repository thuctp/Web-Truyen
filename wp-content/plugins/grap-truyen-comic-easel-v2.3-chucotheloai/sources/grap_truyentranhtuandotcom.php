<?php 
if( ! defined( 'ABSPATH' ) ) exit;

function grap_truyentranhtuandotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen) {
	?>
	<div class="postbox"><?php

		
			
			get_list_truyentranhtuandotcom($link_truyen, $ten_truyen);
		
		?>

	</div>
	<?php
}

/*==========  Lấy danh sách chap của truyện  ==========*/
function get_list_truyentranhtuandotcom($link_truyen, $ten_truyen) {

		$array_ten_chap = check_chap_exists($ten_truyen);
		
		//get_single_content_truyentranhtuandotcom('http://truyentranhtuan.com/shin-kotaro-makaritoru-juudouhen-chuong-51/');

		$html = file_get_html($link_truyen);
				
		
		$content =$html->find("#manga-chapter",0);
		
		$list_link=array();
		
		foreach($content->find('.chapter-name') as $chaps)
		{	$href=$chaps->find('a',0)->href;
			
			if($href!='')
			{
			$array_chap=array();
			$array_chap['href']=$href;
			$array_chap['title']=$chaps->find('a',0)->innertext;
			
			$list_link[]=$array_chap;
			
			}
		
		
		}
		
		
		
		
		
		
		
		
			?>
			
			<h2 class="grap-title">Danh sách chap</h2>
			<table class="widefat">
				<thead>
					<th width="10px"></th>
					<th>Chap</th>
					<th>Link</th>
					<th>Lấy nội dung</th>
				</thead>
				<tbody>
				
			<?php
			
			
			
				
				
				

				foreach($list_link as $chap)
					
				{
					$chapurl = $chap['href'];
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
			?>
			
			<?php
			
			
		
}


/*==========  Lấy nội dung trang single  ==========*/
function get_single_content_truyentranhtuandotcom($link_chap) {
	
	$content 	= "";
	$html 	= file_get_html($link_chap);
	$content =explode('slides_page_url_path',$html);
	$content=$content[1];
	$content=explode('"];',$content);
	$content=$content[0];
	$content=str_replace('= ["','',$content);
	$content=explode('","',$content);
	$str_img='';
	foreach($content as $link_img)
	{
		$str_img.="<img src='".$link_img."' >";
	
	}
	$content=$str_img;
	
	return "<div class='grab-content-chap'>" . $content . "</div>";
}

?>