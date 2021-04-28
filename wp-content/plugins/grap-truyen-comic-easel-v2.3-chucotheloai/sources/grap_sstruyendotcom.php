<?php 
if( ! defined( 'ABSPATH' ) ) exit;

function grap_sstruyendotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen) {
	?>
	<div class="postbox"> <?php

		if(empty($truyen_co_nhieu_chap)):
			//get_single_content($link_truyen, $html_noi_dung_truyen);
		//elseif(!empty($truyen_co_nhieu_chap)):
			elseif(!empty($truyen_co_nhieu_chap) ):
			
			get_list_sstruyendotcom($link_truyen, $ten_truyen);
		
		endif; ?>

	</div>
	<?php
}

/*==========  Lấy danh sách chap của truyện  ==========*/
function get_list_sstruyendotcom($link_truyen, $ten_truyen) {

		$array_ten_chap = check_chap_exists($ten_truyen);

		$html = file_get_html($link_truyen);
				
		$content = $html->find(".content .page-split a");
		$endpage = 0;
		$beforeurl =  substr($link_truyen, 0, strpos($link_truyen, '.html'));

		foreach($content as $page){
			$endpage = $page->plaintext;
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
			
			for($i=0; $i < $endpage; $i++){
				$pageurl =  $beforeurl."/page-".$i.".html";
				$html2 = file_get_html($pageurl);
				$chaps = $html2->find(".fixContent",2);
				$chaps = $chaps->find(".chuongmoi a");
				foreach($chaps as $chap){
					$chapurl = "http://sstruyen.com".$chap->href;
					$chaptitle = $chap->title;
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
			
			echo '</tbody></table>';
		
}


/*==========  Lấy nội dung trang single  ==========*/
function get_single_content_sstruyendotcom($link_chap) {

	$content 	= "";
	$html 	= file_get_html($link_chap);
	$content = $html->find(".detail-content #chapt-content", 0);
	
	
	return "<div class='grab-content-chap'>" . $content . "</div>";
}

?>