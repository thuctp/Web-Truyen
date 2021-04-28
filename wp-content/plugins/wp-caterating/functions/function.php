<?php
function wp_cate_rating($cat)
{
	wp_cate_rating_star($cat);
	
	

}


function wp_cate_rating_10star($cat)
{
	?>
	<div>
		<input value="<?php echo diemtrungbinh($cat); ?>" type="hidden" id="cate_rating_tb">
		<input value="<?php echo $cat; ?>" type="hidden" id="cate_rating_id">
		<input value="<?php echo check_wp_cate_rating($cat,$_SERVER['REMOTE_ADDR']); ?>" type="hidden" id="cate_rating_check">
		<?php

		$diemtrungbinh=diemtrungbinh($cat);
		$half=0;
		for($i=1;$i<=10;$i++)
		{
				if($diemtrungbinh>0)
				{
					if($i<=$diemtrungbinh)
					{
						?>
						<img src="<?php echo WP_CATERATING_URL."images/stars/star_25.png" ?>" onclick="tinhdiem(<?php echo $i; ?>)" class="wp_cate_rating_img wp_cate_rating_hover_<?php echo $i; ?>" onmouseout="outdiem(this)" onmouseover="overdiem(<?php echo $i; ?>)">
			
						<?php
					}
					else
					{
						$half=abs($diemtrungbinh-$i);
						//echo "So luogn";

						if($half>0&$half<1)
						{	
							?>
							<img src="<?php echo WP_CATERATING_URL."images/stars/star_25_half.png" ?>" onclick="tinhdiem(<?php echo $i; ?>)" class="wp_cate_rating_img wp_cate_rating_hover_<?php echo $i; ?>" onmouseout="outdiem(this)" onmouseover="overdiem(<?php echo $i; ?>)" >
							<?php
						}
						
						else
						{	
							?>
							<img src="<?php echo WP_CATERATING_URL."images/stars/star_25_off.png" ?>" onclick="tinhdiem(<?php echo $i; ?>)" class="wp_cate_rating_img wp_cate_rating_hover_<?php echo $i; ?>" onmouseout="outdiem(this)" onmouseover="overdiem(<?php echo $i; ?>)" >
						
							<?php
						}
					}
				}
				else
				{	

						
							?>
							<img src="<?php echo WP_CATERATING_URL."images/stars/star_25_off.png" ?>" onclick="tinhdiem(<?php echo $i; ?>)" class="wp_cate_rating_img wp_cate_rating_hover_<?php echo $i; ?>" onmouseout="outdiem(this)" onmouseover="overdiem(<?php echo $i; ?>)" >
						
							<?php
						
						
				}


				
		?>
			<?php
		
		}

		?>
	</div>
	<div id='wp_cate_rating_avg'><?php echo diemtrungbinh($cat); ?></div><!--so diem trung binh-->

	<div id='wp_cate_rating_vote'><?php echo " Đánh giá :".soluongdanhgia($cat); ?></div><!--So danh gia-->

	<?php
	
}

function wp_cate_rating_star($cat)
{	$number_star=get_option('sl-wp-rating-cate');
	if(!isset($number_star)||$number_star=="")
	{
		$number_star=10;
	}
	?>
	<div id="wp-cate-rating-stars">
	
		<input value="<?php echo diemtrungbinh($cat); ?>" type="hidden" id="cate_rating_tb">
		<input value="<?php echo $cat; ?>" type="hidden" id="cate_rating_id">
		<input value="<?php echo check_wp_cate_rating($cat,$_SERVER['REMOTE_ADDR']); ?>" type="hidden" id="cate_rating_check">
		<?php

		$diemtrungbinh=diemtrungbinh($cat);
		$half=0;
		for($i=1;$i<=$number_star;$i++)
		{
				if($diemtrungbinh>0)
				{
					if($i<=$diemtrungbinh)
					{
						?>
						<img src="<?php echo WP_CATERATING_URL."images/stars/star_25.png" ?>" onclick="tinhdiem(<?php echo $i; ?>)" class="wp_cate_rating_img wp_cate_rating_hover_<?php echo $i; ?>" onmouseout="outdiem(this)" onmouseover="overdiem(<?php echo $i; ?>)" title="<?php echo get_option('title-wp-rating-cate-'.$i); ?>">
			
						<?php
					}
					else
					{
						$half=abs($diemtrungbinh-$i);
						//echo "So luogn";

						if($half>0&$half<1)
						{	
							?>
							<img src="<?php echo WP_CATERATING_URL."images/stars/star_25_half.png" ?>" onclick="tinhdiem(<?php echo $i; ?>)" class="wp_cate_rating_img wp_cate_rating_hover_<?php echo $i; ?>" onmouseout="outdiem(this)" onmouseover="overdiem(<?php echo $i; ?>)" title="<?php echo get_option('title-wp-rating-cate-'.$i); ?>" >
							<?php
						}
						
						else
						{	
							?>
							<img src="<?php echo WP_CATERATING_URL."images/stars/star_25_off.png" ?>" onclick="tinhdiem(<?php echo $i; ?>)" class="wp_cate_rating_img wp_cate_rating_hover_<?php echo $i; ?>" onmouseout="outdiem(this)" onmouseover="overdiem(<?php echo $i; ?>)" title="<?php echo get_option('title-wp-rating-cate-'.$i); ?>" >
						
							<?php
						}
					}
				}
				else
				{	

						
							?>
							<img src="<?php echo WP_CATERATING_URL."images/stars/star_25_off.png" ?>" onclick="tinhdiem(<?php echo $i; ?>)" class="wp_cate_rating_img wp_cate_rating_hover_<?php echo $i; ?>" onmouseout="outdiem(this)" onmouseover="overdiem(<?php echo $i; ?>)" title="<?php echo get_option('title-wp-rating-cate-'.$i); ?>" >
						
							<?php
						
						
				}


				
		?>
			<?php
		
		}

		?>

	</div>
	<div id="wp-cate-rating-title" ></div>
	<div id='wp_cate_rating_avg'><?php echo diemtrungbinh($cat);?></div><!--so diem trung binh-->
	<div id='wp_cate_rating_vote'><?php echo " Số lượng đánh giá: ".soluongdanhgia($cat);?></div><!--So danh gia-->
	<div style="clear:both;"></div>
	<?php
	
}

function wp_cate_rating_star_none_rate($cat)
{	$number_star=get_option('sl-wp-rating-cate');
	if(!isset($number_star)||$number_star=="")
	{
		$number_star=10;
	}
	?>
	
	<div id="wp-cate-rating-stars">
	
	<?php

	$diemtrungbinh=diemtrungbinh($cat);
	$half=0;
	for($i=1;$i<=$number_star;$i++)
	{
			if($diemtrungbinh>0)
			{
				if($i<=$diemtrungbinh)
				{
				
					?>
					<img src="<?php echo WP_CATERATING_URL."images/stars/star_25.png" ?>" class="wp_cate_rating_img wp_cate_rating_hover_<?php echo $i; ?>"  title="<?php echo get_option('title-wp-rating-cate-'.$i); ?>">
		
					<?php
				}
				else
				{
					$half=abs($diemtrungbinh-$i);
					//echo "So luogn";

					if($half>0&$half<1)
					{	
						?>
						<img src="<?php echo WP_CATERATING_URL."images/stars/star_25_half.png" ?>" class="wp_cate_rating_img wp_cate_rating_hover_<?php echo $i; ?>"  title="<?php echo get_option('title-wp-rating-cate-'.$i); ?>" >
						<?php
					}
					
					else
					{	
						?>
						<img src="<?php echo WP_CATERATING_URL."images/stars/star_25_off.png" ?>" class="wp_cate_rating_img wp_cate_rating_hover_<?php echo $i; ?>" title="<?php echo get_option('title-wp-rating-cate-'.$i); ?>" >
					
						<?php
					}
				}
			}
			else
			{	

					
						?>
						<img src="<?php echo WP_CATERATING_URL."images/stars/star_25_off.png" ?>"  class="wp_cate_rating_img wp_cate_rating_hover_<?php echo $i; ?>"  title="<?php echo get_option('title-wp-rating-cate-'.$i); ?>" >
					
						<?php
					
					
			}


			
	?>
		<?php
	
	}

	?>

	</div>
	<div id="wp-cate-rating-title" ></div>
	<div id='wp_cate_rating_avg'><?php echo diemtrungbinh($cat);?></div><!--so diem trung binh-->

	<div id='wp_cate_rating_vote'><?php echo " Số lượng đánh giá: ".soluongdanhgia($cat);?></div><!--So danh gia-->
	<div style="clear:both;"></div>
	<?php
	
}
function soluongdanhgia($cat)
{	global $wpdb;
	$sql="SELECT COUNT( rating_cateid ) FROM  wp_cate_ratings WHERE rating_cateid= ".$cat;
	$result=$wpdb->get_var($sql);
	return $result;
}
function diemtrungbinh($cat)
{	global $wpdb;
	$sql="SELECT AVG( rating_rating ) FROM  wp_cate_ratings WHERE rating_cateid= ".$cat;
	$result=$wpdb->get_var($sql);
	return round($result,2);
}
function insertdiem()
{
	if(isset($_REQUEST))
	{
		$idcate	=$_REQUEST['idcate'];
		$diem 	=$_REQUEST['diem'];
		$ip 	= $_SERVER['REMOTE_ADDR'];

		global $wpdb;

		$result=$wpdb->insert( 
			'wp_cate_ratings', 
			array( 
				'rating_cateid' => $idcate, 
				'rating_rating' =>$diem ,
				'rating_ip'		=>$ip,
			)
		);
		if($result)
		{
			//echo "Thanh cong".soluongdanhgia($idcate);
			$data=array(soluongdanhgia($idcate),diemtrungbinh($idcate));
			
			echo json_encode($data);
			//return $data;
		}
		else
		{
			echo "0";
		}
	}
	die();
}
add_action('wp_ajax_insertdiem','insertdiem');
add_action('wp_ajax_nopriv_insertdiem','insertdiem');


function check_wp_cate_rating($cat,$ip)
{	global $wpdb;
	$sql="SELECT  count(rating_id) as sl  FROM  wp_cate_ratings WHERE rating_cateid= ".$cat." AND rating_ip='".$ip."'";
	$result=$wpdb->get_var($sql);
	
	if($result)
	{	
		
	
		return 1;/*Có*/
	
		
	}
	else
	{
		return 0;/*Chưa*/
	}
	
}




function xoa_wp_cate_rating()
{
	if(isset($_REQUEST))
	{
		$id=$_REQUEST['idcate'];
		$sql="DELETE FROM wp_cate_ratings WHERE rating_cateid=".$id;

		global $wpdb;
		$result=$wpdb->get_var($sql);
		if($result)
		{
			return "Delete successfull!";

		}
		else
		{
			return "Fail! Please contact with us!";
		}
	}
	die();

}
add_action('wp_ajax_xoa_wp_cate_rating','xoa_wp_cate_rating');
add_action('wp_ajax_nopriv_xoa_wp_cate_rating','xoa_wp_cate_rating');