<?php
add_action('admin_menu', 'quangcao');
function quangcao() {
    add_submenu_page('trang-cai-dat-truyen','Quảng cáo', 'Quảng cáo', 'manage_options', 'quang-cao', 'page_quangcao');
}
add_action('admin_init','quangcao_register_setting');

function quangcao_register_setting() {
	 register_setting('quangcao-setting','sl-quangcao');
   	 $num = get_option('sl-quangcao');
    settype($num,'int');

    for ($i = 0; $i <= $num; $i++) {
        register_setting('quangcao-setting','quangcao_'.$i);
    }
   
}
function page_quangcao()
{
?>

<form action="options.php" method="post">
<?php
    settings_fields('quangcao-setting');
    $num = get_option('sl-quangcao');
    settype($num,'int');
?>
<table class="form-table">
<tr>
	<td>
		Nhập số lượng quảng cáo
	</td>
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
	<td>
		Quảng cáo <?php echo $i; ?>
	</td>
	<td>
		<textarea name="quangcao_<?php echo $i; ?>" style="width: 60%; height: 98px; margin: 0px;"><?php echo get_option('quangcao_'.$i); ?></textarea> 
		<br>
		<span style="   font-size: 12px;    font-style: italic;">Chép đoạn code <strong> echo get_option('quangcao_<?php echo $i; ?>' )</strong> đặt vào nơi cần hiện thị quảng cáo này</span>
	</td>
</tr>
			 		<?php
			 		
			 	}
			 	 ?>
 
				
			 
</table>


<?php submit_button(); ?>

</form>
<?php
}