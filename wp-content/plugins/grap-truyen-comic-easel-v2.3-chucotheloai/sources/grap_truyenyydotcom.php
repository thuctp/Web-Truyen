<?php 
if( ! defined( 'ABSPATH' ) ) exit;

function grap_truyenyydotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen) {
	?>
	<div class="postbox"> <?php

		if(empty($truyen_co_nhieu_chap)):
			//get_single_content($link_truyen, $html_noi_dung_truyen);
		elseif(!empty($truyen_co_nhieu_chap)):
			get_chaps_truyenyydotcom($link_truyen, $ten_truyen);
		
		endif; ?>

	</div>
	<?php
}

function get_chaps_truyenyydotcom($link_truyen, $ten_truyen){

	$array_ten_chap = check_chap_exists($ten_truyen);
	
	error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
	set_time_limit(0);
	$opts 		= array( 'http'=>array( 'header' => "User-Agent:MyAgent/1.0\r\n", 'timeout' => 1200 )) ;
	$context 	= stream_context_create( $opts );
	$url		= $link_truyen;
	$html 		= file_get_contents( $url, false, $context );	

	$trang = explode('<div class="pagination pagination-centered">', $html);
	$trang = explode('</ul>', $trang[1]);
	$tranglist = explode('<li>', $trang[0]);
	$countpage = count($tranglist);
	$sl = explode('">', $tranglist[$countpage-2]);
	$sl = explode('<', $sl[1]);
	$sl = $sl[0];
	
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
	$listchap = array();
	for($ii =$sl ; $ii>=1 ;$ii--)
	{
		
		$htmllist 	= file_get_contents( $url.'?page='.$ii, false, $context);	
		if($ii == 1 ){
			$htmllist 	= file_get_contents( $url, false, $context);
		}
		$chap_1		= explode( '<div class="chaplist" id="dschuong">',$htmllist);
		$chaps		= explode( '<a class="jblack"',$chap_1[1] );

		$dem = count($chaps)-1;
		if($dem > 0){
			$chaps = Array_reverse($chaps);
			for ( $i = 0; $i <$dem ; $i++) { 

				$link1 = explode('href="',$chaps[$i]);
				$link1 = explode('"',$link1[1]);

				$name = explode('</i>', $chaps[$i]);
				$name = explode('</a>',$name[1]);

				$chapurl =  $link1[0];
				$chaptitle = $name[0];

				

				$has_chap 	= in_array($chaptitle, $array_ten_chap);
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
	}
}

/*==========  Lấy nội dung trang single  ==========*/
function get_single_content_truyenyydotcom($link_chap) {
	
	$content 	= "";
	error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
	set_time_limit(0);
	$opts 		= array( 'http'=>array( 'header' => "User-Agent:MyAgent/1.0\r\n", 'timeout' => 1200 )) ;
	$context 	= stream_context_create( $opts );
	$url		= $link_chap;
	$html 		= file_get_contents( $url, false, $context );	

	$noidung = explode('<div class="text-truyen" id="id_noidung_chuong">', $html);
	$noidung2 = explode('<div>', $noidung[1]);
	
	$content =  $noidung2[0];
	

	return "<div class='grab-content-chap'>" . $content . "</div>";
}



function getimage_truyenyydotcom($linktruyen)
{

	$html = file_get_html($linktruyen);

	foreach($html->find('.rowest .xfor img') as $element) 
	{
   	  $noidung=$element->src;
	}

	
	return $noidung;

}
?>