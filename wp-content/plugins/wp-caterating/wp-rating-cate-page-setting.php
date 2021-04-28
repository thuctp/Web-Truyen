<?php
add_action('admin_menu', 'setting_wp_cate_rating');
function setting_wp_cate_rating()
{
	 add_menu_page('Cate Rating', 'Cate Rating', 'manage_options', 'wp-cate-rating', 'wp_cate_rating_custom_page');
}

add_action('admin_menu', 'sub_setting_wp_cate_rating');
function sub_setting_wp_cate_rating()
{
	 add_submenu_page('wp-cate-rating','Setting Cate Rating', 'Setting Cate Rating', 'manage_options', 'setting-wp-cate-rating', 'setting_wp_cate_rating_custom_page');
}
function wp_cate_rating_custom_page()
{
	echo "<h2>WP Cate Rating</h2><hr>";
	?>
	<div class="wp_cate_rating_page_setting">
	<table>
		<tr class="tr_head">
			<th>ID</th>
			<th>Name</th>
			<th>Score</th>
			<th>Count</th>
			<th>Delete</th>
		</tr>
		<?php
		global $wpdb;
		$sql="SELECT * FROM wp_cate_ratings GROUP BY  rating_cateid ";
		$result=$wpdb->get_results($sql);
		if($result)
		{
			foreach ($result as $value) {
				?>
				<tr class="tr_sub">
					<td class="td_centel">
						<?php echo $value->rating_cateid; ?>
					</td>
					<td class="td_left">
						<?php echo get_cat_name($value->rating_cateid); ?>
					</td>
					<td class="td_centel">
						<?php echo diemtrungbinh($value->rating_cateid) ?>
					</td>
					<td class="td_centel">
						<?php echo soluongdanhgia($value->rating_cateid) ?>
					</td>
					<td class="td_centel">
						<a href="#" onclick="xoa_wp_cate_rating(<?php echo $value->rating_cateid; ?>)">Delete</a>
					</td>
				</tr>

				<?php
				# code...
			}
		}


		?>
	</table>
	</div>

	<?php
}

add_action('admin_init', 'setting_wp_cate_rating_register');
function setting_wp_cate_rating_register() {
	 register_setting('wp_cate_rating-group','sl-wp-rating-cate');
	  register_setting('wp_cate_rating-group','size-wp-rating-cate');
   	 $num=(int)get_option('sl-wp-rating-cate' );

   	 for ($i=0; $i<=$num  ; $i++) { 
   	 	register_setting('wp_cate_rating-group','title-wp-rating-cate-'.$i);
   	 }
	
   
}


function setting_wp_cate_rating_custom_page()
{
	echo "<h2>Setting WP Cate Rating</h2><hr>";
	?>
	<form action="options.php" method="post">
	<?php settings_fields('wp_cate_rating-group'); ?>
		<table>
			<tr>
				<td>
					Number star
				</td>
				<td>
					<select name="sl-wp-rating-cate">
						<option value="5" <?php if(get_option('sl-wp-rating-cate' )==5) echo "selected"; ?>>5</option>
						<option value="10" <?php if(get_option('sl-wp-rating-cate' )==10) echo "selected"; ?>>10</option>
					</select>
					
				</td>
			</tr>
			<tr>
				<td>
					Size star
				</td>
				<td>
					<input type="radio" name="size-wp-rating-cate" value="25" checked>
					<img src="<?php echo WP_CATERATING_URL."images/stars/star_25.png" ?>">
					<br>
					
					<input type="radio" name="size-wp-rating-cate" value="50">
					<img src="<?php echo WP_CATERATING_URL."images/stars/star_50.png" ?>">

				</td>
			</tr>
			
				
					<?php

					 $num=(int)get_option('sl-wp-rating-cate' );

				   	 for ($i=1; $i<=$num  ; $i++) { 
				   	 	?>
				<tr>
					<td>
						Title
					</td>
					<td>
					   	 	<input type="text" name="title-wp-rating-cate-<?php echo $i ?>" value=<?php echo get_option('title-wp-rating-cate-'.$i); ?>>
					</td>
				</tr>
				   	 	<?php
				   	 	
				   	 }
					
					?>
					
				
			
		</table>
	<?php submit_button(); ?>

	<?php
}