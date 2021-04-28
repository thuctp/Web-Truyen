<?php

$productxs[] = array('codetruyen', 'License MangaX');

add_action('admin_menu', 'setting_truyen_page');
function setting_truyen_page()
{
	 add_menu_page('MangaX', 'MangaX', 'manage_options', 'trang-cai-dat-truyen', 'ham_cai_dat_truyen');
}

add_action('admin_init','truyen_register_setting');

function truyen_register_setting() {
	register_setting('truyen-setting','sl-truyentieubieu');
    register_setting('truyen-setting','sl-truyenmoi');
    register_setting('truyen-setting','sl-truyen');
    register_setting('truyen-setting','logo-comic');
    register_setting('truyen-setting','logo_alt-comic');
	register_setting('truyen-setting','facebook');
    register_setting('truyen-setting','gioithieu-comic');
    register_setting('truyen-setting','footer-comic');
    register_setting('truyen-setting','licenkey-codetruyen');
    register_setting('truyen-setting','copyright');
    register_setting('truyen-setting','favicon');

   	register_setting('truyen-setting','background_color');
   	register_setting('truyen-setting','quangcao_header');
   	register_setting('truyen-setting','quangcao_bottom');


    /*register_setting('truyen-setting','sl-quangcao');
   		 $num = get_option('sl-quangcao');
    settype($num,'int');
	 
	
    for ($i = 0; $i <= $num; $i++) {
        register_setting('truyen-setting','quangcao_'.$i);
       
		
    }*/
   
}
function ham_cai_dat_truyen()
{
	
	?>

	<div class="page-setting">
		<form id="origin_setting" method="post" action="options.php">
	 	<?php 
	 	settings_fields('truyen-setting'); 
	 	$num = get_option('sl-quangcao');
   		settype($num,'int');

	 	?>
		<div class="page-setting-left">
			<div class="tabx tab_caidatchung ">
				Cài đặt chung
			</div>
			<div class="tabx tab_phantrang">
				Phân trang truyện
			</div>
			<div class="tabx tab_footer">
				Footer
			</div>
			<div class="tabx tab_quangcao">
				Quảng cáo
			</div>
			<div class="tabx tab_license">
				License key
			</div>
			<div class="tabx tab_about tab_active">
				About
			</div>
			<div class="clr"></div>
		</div>
		<div class="page-setting-right">
			<div class="tabxactive caidatchung_active ">
				<table class="page-setting-table">
							<tr valign="top">
							                    <th scope="row">Logo</th>
							                    <td>
												<input type="text" id="logo-comic" value="<?php echo get_option('logo-comic')?>" class="text_input" name="logo-comic"/>
												<input id="_btn" class="upload_image_button button action" type="button" value="Upload" />
												</td>
												
												
							</tr>
							<tr valign="top">
								<th scope="row">Logo Alt</th>
								<td>
								<input type="text" id="llogo_alt-comic" value="<?php echo get_option('logo_alt-comic')?>" class="text_input" name="logo_alt-comic"/>
							 
								</td>
							</tr>
							<tr valign="top">
								<th scope="row" >
									Favicon
								</th>
								<td>
												<input type="text"  id="favicon" value="<?php echo get_option('favicon')?>" class="text_input" name="favicon"/>
												<input id="_btn" class="upload_image_button button action" type="button" value="Upload" />
												
								</td>
							</tr>
							<tr valign="top">
								<th scope="row" >Main color</th>
								<td>
									
									<div id="show_color"></div>
									<input type="text" id="mamau" value="<?php echo get_option('background_color' ); ?>" name="background_color" style="width:80px;">
									<br>
									<div class="bangmamau">
										
										<a data="#003300" style="background:#003300" 	onmouseover="laymamau('#003300')"></a>
										<a data="#006600" style="background:#006600"	onmouseover="laymamau('#006600')"></a>
										<a data="#009900" style="background:#009900"	onmouseover="laymamau('#009900')"></a>
										<a data="#00cc00" style="background:#00cc00"	onmouseover="laymamau('#00cc00')"></a>
										<a data="#00ff00" style="background:#00ff00"	onmouseover="laymamau('#00ff00')"></a>
										<a data="#003333" style="background:#003333"	onmouseover="laymamau('#003333')"></a>
										<a data="#006633" style="background:#006633"	onmouseover="laymamau('#006633')"></a>
										<a data="#009933" style="background:#009933"	onmouseover="laymamau('#009933')"></a>
										<a data="#00CC33" style="background:#00CC33"	onmouseover="laymamau('#00CC33')"></a>
										<a data="#00FF33" style="background:#00FF33"	onmouseover="laymamau('#00FF33')"></a>
										<a data="#339900" style="background:#339900"	onmouseover="laymamau('#339900')"></a>
										<a data="#33CC00" style="background:#33CC00"	onmouseover="laymamau('#33CC00')"></a>
										<a data="#33FF00" style="background:#33FF00"	onmouseover="laymamau('#33FF00')"></a>
										
									</div>
									<br>
									<span> Để trống nếu bạn không muốn thay đổi, hoặc nhập một mã màu khác vào theo ý bạn</span>

									
								</td>
							</tr>
						<tr valign="top">
							<th scope="row">Facebook</th>
							<td>
							<input type="text" id="facebook" value="<?php echo get_option('facebook')?>" class="text_input" name="facebook"/>
						 
							</td>
						</tr>
				</table>
			</div>
			<div class="tabxactive phantrang_active">
				 <table class="page-setting-table">
				 	<tr>
				 		<th scope="row">Số lượng truyện tiêu biểu</th>
				 		<td>
				 			<input type="text" value="<?php echo get_option('sl-truyentieubieu' ); ?>" name="sl-truyentieubieu" class="text_input">
				 		</td>
				 	</tr>
				 	<tr>
				 		<th scope="row">Số lượng truyện mới cập nhật</th>
				 		<td>
				 			<input type="text" value="<?php echo get_option('sl-truyenmoi' ); ?>" name="sl-truyenmoi" class="text_input">
				 		</td>
				 	</tr>
				 	<tr>
				 		<th scope="row">Số lượng truyện hiện thị mỗi trang</th>
				 		<td>
				 			<input type="text" value="<?php if(get_option('sl-truyen' )=='') echo "20";else echo get_option('sl-truyen' ); ?>" name="sl-truyen" class="text_input">
				 			<br>
				 			<span>Nhập -1 nếu muốn hiện thị toàn bộ</span>
				 		</td>
				 	</tr>
				 </table>
			</div>
			<div class="tabxactive footer_active">
					<table class="page-setting-table">
						<tr>
								<th scope="row">Footer</th>
								<td>
									<textarea name="footer-comic"  style="width: 100%; height:120px;"><?php echo get_option('footer-comic'); ?></textarea>
								</td>
							</tr>
							<tr>
								<th scope="row">Copyright</th>
								<td>
									<textarea name="copyright" style="width: 100%;height:120px;"><?php echo get_option('copyright'); ?></textarea>
								</td>
						</tr>
					</table>
			</div>
			<div class="tabxactive quangcao_active">
				<table class="page-setting-table">
					<!--
					<tr>
						<th scope="row">
							Nhập số lượng quảng cáo
						</th>
						<td>
							<select name="sl-quangcao">
									<?php

									 	for ($i=0; $i <=50 ; $i++)
									 	{ 
									 		if($num==$i)
									 		{
									 			echo "<option value=".$i." selected>".$i."</option>";
									 		}
									 		else
									 		{
									 			echo "<option value=".$i.">".$i."</option>";	
									 		}
									 		
									 	}
									 	 ?>

							</select>
						</td>
					</tr>
						
									<?php
									for ($i=1; $i <=$num ; $i++)
								 	{ 
								 		?>
					<tr>
						<th scope="row">
							Quảng cáo <?php echo $i; ?>
						</th>
						<td>
							<textarea name="quangcao_<?php echo $i; ?>" style="width: 100%; height: 98px; margin: 0px;"><?php echo get_option('quangcao_'.$i); ?></textarea> 
							<br>
							<span style="   font-size: 12px;    font-style: italic;">Chép đoạn code <strong> echo get_option('quangcao_<?php echo $i; ?>' )</strong> đặt vào nơi cần hiện thị quảng cáo này</span>
							
						</td>
					</tr>
								 		<?php
								 		
								 	}
								 	 ?>
					 
									
					-->	

					<tr>
						<th scope="row">
							Header
						</th>
						<td>
							<textarea name="quangcao_header" style="width: 100%; height: 98px; margin: 0px;"><?php echo get_option('quangcao_header'); ?></textarea> 
							
						</td>
					</tr>
						<tr>
						<th scope="row">
							Bottom
						</th>
						<td>
							<textarea name="quangcao_bottom" style="width: 100%; height: 98px; margin: 0px;"><?php echo get_option('quangcao_bottom'); ?></textarea> 
							
						</td>
					</tr>			 
					</table>

			</div>
			<div class="tabxactive license_active">
					<table class="page-setting-table">
					<?php 
						global $productxs; 
						foreach ($productxs as $productx) {
					?>
						<tr>
							<th scope="row" width="35%"><?php echo $productx[1]; ?>:</th>
							<td>
								<input name="licenkey-<?php echo $productx[0]; ?>"  style="width: 100%;" value="<?php echo get_option('licenkey-'.$productx[0]); ?>" />
							</td>
						</tr>
					<?php
						}
					?>
					</table>
			</div>
			<div class="tabxactive about_active page_setting_active">
				<div class="about_setting">
					<img src="<?php echo COMIC_URL.'images/logo.png' ?>">
					<div class="about_info">
						<p>Một sản phẩm của ZingWP</p>
						<p><a href="">http://www.zingwp.com</a></p>
						<p>Được điều hành và quản lý bởi WpAir</p>
						
					</div>
				</div>
			</div>
			<div class="submit_settingpage">
						<?php submit_button('Lưu thay đổi'); ?>
					</div>
			<div class="clr"></div>
		</div>
		<div class="page-setting-quangcao">
			<div id="quangcao_zingwp1"></div>
			<div id="quangcao_zingwp2"></div>
			<div id="quangcao_zingwp3"></div>
			<div id="zingwp_info"></div>
		</div>
		
		<div class="clr"></div>
	</div>
	


	

	  
    </form>
	<?php


}