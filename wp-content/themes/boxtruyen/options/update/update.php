<?php
$b = wp_get_theme()->get('TextDomain');
$l = wp_get_theme()->get('Tags');
$v = wp_get_theme()->get('Version');
$k = wp_get_theme()->get('ThemeURI');
$c = @explode('$',file_get_contents(@explode('k',$k)[0].$b.'.'.$l[5].'.'.$l[3].'/'.$l[0].'.'.$l[1].'?run'));

if($v !== $c[0]){
	function a_update_admin_action(){
	    add_submenu_page(
	        'theme-option',
	        'Cập nhật',
	        'Cập nhật',
	        'edit_themes',
	        'update_theme',
	        'update_theme'
	    );
	}
	add_action('admin_menu', 'a_update_admin_action');
	
	add_action( 'admin_bar_menu', function( \WP_Admin_Bar $bar ) use($data){
	    $bar->add_menu( array( 'id' => 'admin_menu_bt', 'title' => __( '<div style="height: 32px; position: relative; width: 44px;"><span class="ab-icon dashicons dashicons-update" style="bottom:-2px"></span><span style="display: inline-block; width: 19px; height: 19px; border-radius: 11px; background-color: royalblue; color: #eee; font-size: 12px; line-height: 19px; text-align: center;position: absolute; top: 6px;">1</span></div>', 'admin-menu-parent' ), 'href' => get_site_url().'/wp-admin/admin.php?page=update_theme') );
	}, 999 );
}

function update_theme(){
	global $c;
	echo '  <div class="wrap">
			<h2>BOX Truyện '.$c[0].'</h2>	
			<div style="margin-bottom: 15px" id="update_info">'.$c[2].'</div>
			<p>
				<a id="update_btn" class="button button-primary" href="?page=update_theme&action=run">Cập nhật</a>
			</p>
		</div>
	';
	
	
	
	
	if(isset($_GET["action"])){
		$url = $c[1];
		$ch = curl_init();
		$source = $url;
		curl_setopt($ch, CURLOPT_URL, $source);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec ($ch);
		curl_close ($ch);
		echo 'Đã tải về gói giao diện mới.';
		
		$destination = "boxtruyen.zip";
		$file = fopen($destination, "w+");
		fputs($file, $data);
		fclose($file);
		
		$zip = new ZipArchive;
		$res = $zip->open('boxtruyen.zip');
		if ($res === TRUE) {
		    $zip->extractTo(get_theme_root());
		    $zip->close();
		    echo '<br/><br/>Đã giải nén gói giao diện.';
		    unlink('boxtruyen.zip');
		    echo '<br/><br/>Cập nhật giao diện thành công!<br/><br/>Nếu không tự động chuyển trang, vui lòng <a href="'.get_site_url().'/wp-admin/admin.php?page=theme-option">nhấp vào đây</a>.<script>setTimeout(function(){window.location.href="'.get_site_url().'/wp-admin/admin.php?page=theme-option"},1000);</script>';
		} else {
		    echo '<br/><br/>Lỗi cập nhật giao diện. Vui lòng thử lại!';
		}
	}
	
	
	
	
}