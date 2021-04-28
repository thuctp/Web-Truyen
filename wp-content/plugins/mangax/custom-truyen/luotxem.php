<?php 

function add_luotxem_to_category($truyen)
{

	$t_id = $truyen->term_id;

    $luotxem_meta = get_option( "category_$t_id");


	?>
<table class="form-table">
   

     <tr class="form-field">

    <th scope="row" valign="top"><label for="cat_Theloai"><?php _e('Lượt xem'); ?></label></th>

    <td>
    
    				<input type="text" name="Truyen[luotxem]" value="<?php echo $luotxem_meta['luotxem'] ?>" size="30" style=" width: 50%;">
	    			
    </td>

    </tr>
</table>
<?php
}
add_action( 'category_edit_form_fields', 'add_luotxem_to_category');
