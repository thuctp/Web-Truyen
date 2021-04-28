<?php 
if( ! defined( 'ABSPATH' ) ) exit;

function grap_blogtruyendotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen) {
	?>
	<div class="postbox"> <?php

		if(empty($truyen_co_nhieu_chap)):
			//get_single_content($link_truyen, $html_noi_dung_truyen);
		//elseif(!empty($truyen_co_nhieu_chap) && ($loai_truyen == "4")):
			elseif(!empty($truyen_co_nhieu_chap)):
			
			get_chaps_blogtruyendotcom($link_truyen, $ten_truyen);
		
		endif; ?>

	</div>
	<?php
}

function get_chaps_blogtruyendotcom($link_truyen, $ten_truyen){

	$array_ten_chap = check_chap_exists($ten_truyen);

	$opts 		= array( 'http'=>array( 'header' => "User-Agent:MyAgent/1.0\r\n", 'timeout' => 1200 )) ;
	$context 	= stream_context_create( $opts );
	$html 		= file_get_contents( $link_truyen, false, $context );
	$chaps		= explode( '<span class="title">',$html );
	if(count($chaps) > 0){
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
		for ( $i = 1; $i < count($chaps); $i++) { 
			$noidung 	= explode( '</span>', $chaps[$i] );
        	preg_match('/<a[^>]+href=([\'"])(.+?)\1[^>]*>/i', $noidung[0], $href);
        	preg_match('/<a[^>]+title=([\'"])(.+?)\1[^>]*>/i', $noidung[0], $title);
			
			$chapurl 	= 'http://blogtruyen.com'.$href[2];
			$chaptitle 	= html_entity_decode($title[2]);

			$has_chap 	= in_array(trim($chaptitle), $array_ten_chap);
				?>
					<tr <?php if ($has_chap == true ) echo "class='grab-tr-disable'" ?> id="chap-blogtruyen-<?php echo $i; ?>">
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
							<a href="<?php echo $chapurl; ?>" target="_blank">
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

/*==========  Lấy nội dung trang single  ==========*/
function get_single_content_blogtruyendotcom($link_chap) {
	$opts 		= array( 'http'=>array( 'header' => "User-Agent:MyAgent/1.0\r\n", 'timeout' => 1200 )) ;
    $context 	= stream_context_create( $opts );
	$html 		= file_get_contents( $link_chap, false, $context );	
	
	$loi 		= false;
	$vitri 		= explode( '<article id="content">',$html );
	$vitrin 	= explode('<div id="noidungchuong">',$html);

	if ( count( $vitri ) < 2 ) {
        if ( count( $vitrin ) < 2 ) {
            $loi = true;
            echo '<b style="color: red">'.$link_chap.' ... ERROR!</b><br />';
        } 
        else {
            $noidung = explode('</div>',$vitrin[1]);
    	}
    } 
    else {
        $noidung = explode( '</article>', $vitri[1] );
    }

    if ( !$loi ) {
        $img = explode( '<img src="', $noidung[0] );
        $i=0;
        $data = '';	                		                	
        foreach ( $img as $key_new => $item ) {
            $i++;
            $src = explode( '" />', $item );
            if ( $i != 1 ) {
                $data .= '<img src="'.$src[0].'" /><br/>';
            }
        }
	}
        $rm1 = "http://images2-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&resize_h=0&rewriteMime=image/*&url=";
	$data = str_replace($rm1, "", $data);


	return "<div class='grab-content-chap'>" . $data . "</div>";
}


function getimage_blogtruyendotcom($linktruyen)
{

	//$html = file_get_html($linktruyen);

	$opts 		= array( 'http'=>array( 'header' => "User-Agent:MyAgent/1.0\r\n", 'timeout' => 1200 )) ;
	$context 	= stream_context_create( $opts );
	$html 		= file_get_contents( $linktruyen, false, $context );


	$thumb		= explode( '<div class="thumbnail">',$html );
	
   	  $noidung=$thumb->src;
	

	
	return $noidung;

}

?>