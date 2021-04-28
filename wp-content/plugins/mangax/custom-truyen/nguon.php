<?php 

function edit_nguon_to_category($truyen)
{

	$t_id = $truyen->term_id;

    $luotxem_meta = get_option( "category_$t_id");


	?>
<table class="form-table">
   

     <tr class="form-field">

    <th scope="row" valign="top"><label for="cat_Theloai"><?php _e('Nguồn truyện'); ?></label></th>

    <td>
    
    				<input type="text" name="Truyen[nguon]" value="<?php echo $luotxem_meta['nguon'] ?>" size="30" style=" width: 50%;">
	    			
    </td>

    </tr>
</table>
<?php
}
add_action( 'category_edit_form_fields', 'edit_nguon_to_category');



function add_nguon_to_category()
{

   

    ?>
<div class="form-field term-parent-wrap">
   

    <label for="cat_Theloai"><?php _e('Nguồn truyện'); ?></label>
                    <input type="text" name="Truyen[nguon]" value="" size="30">
                    
   </div>
<?php
}
add_action( 'category_add_form_fields', 'add_nguon_to_category');





