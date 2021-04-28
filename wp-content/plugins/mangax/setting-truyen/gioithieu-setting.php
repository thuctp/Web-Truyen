<?php
add_action('admin_menu', 'submenu_gioithieu');
function submenu_gioithieu() {
    add_submenu_page('trang-cai-dat-truyen','Cài đặt', 'Cài đặt', 'manage_options', 'sub-page-gioi-thieu', 'sub_page_gioithieu');
}

add_action('admin_init', 'gioithieu_register_setting');
function gioithieu_register_setting() {
    register_setting('comic-group','logo-comic');
    register_setting('comic-group','logo_alt-comic');
    register_setting('comic-group','gioithieu-comic');
    register_setting('comic-group','footer-comic');
    register_setting('comic-group','copyright');
}

function sub_page_gioithieu()
{
	echo "<h2>Giới thiệu</h2>";
	?>

	<form action="options.php" method="post">
	<?php settings_fields('comic-group'); ?>
	<?php
	$settings = array(
        'media_buttons' => true,
        'tinymce' => array(
            'theme_advanced_buttons' => 'formatselect,|,bold,italic,underline,|,' .
                'bullist,blockquote,|,justifyleft,justifycenter' .
                ',justifyright,justifyfull,|,link,unlink,|' .
                ',spellchecker,wp_fullscreen,wp_adv'
        )
    );
	?>
	<table>
		<tr valign="top">
		                    <th scope="row">Logo</th>
		                    <td>
								<input type="text" id="logo-comic" value="<?php echo get_option('logo-comic')?>" style="width: 350px; float:left; margin:0 5px;" name="logo-comic"/>
								<input id="_btn" class="upload_image_button button action" type="button" value="Upload Image" />
							</td>				
		</tr>
		<tr>
							<th scope="row">Logo Alt</th>
		                    <td>
								<input type="text" id="llogo_alt-comic" value="<?php echo get_option('logo_alt-comic')?>" style="width: 350px; float:left; margin:0 5px;" name="logo_alt-comic"/>
							</td>
		</tr>
		<tr>
			<td>
				Giới thiệu
			</td>
			<td>
				<?php
                        wp_editor( get_option('gioithieu-comic'), 'gioithieu-comic', $settings ); ?> 	
			</td>
		</tr>
		<tr>
			<td>Footer</td>
			<td>
				<textarea name="footer-comic"  style="width: 100%;"><?php echo get_option('footer-comic'); ?></textarea>
			</td>
		</tr>
		<tr>
			<td>Copyright</td>
			<td>
				<textarea name="copyright" style="width: 100%;"><?php echo get_option('copyright'); ?></textarea>
			</td>
		</tr>
	</table>
	<?php submit_button(); ?>

	<?php
}