<?php

function add_tacgia_to_category() {



?>
<div class="form-field term-parent-wrap">
   

    <label for="cat_Theloai"><?php _e('Tác giả'); ?></label>
                    <input type="text" name="Truyen[tacgia]" value="" size="30" style=" width: 50%;">
                    
</div>
<?php

}





add_action( 'category_add_form_fields', 'add_tacgia_to_category');




//them trường tacgia trong phần edit category

function edit_tacgia_to_category($tacgia) {




		

	

		

		$tacgia_id = $tacgia->term_id;

        $tacgia_meta = get_option( "category_$tacgia_id");

 

	?>

	
<table class="form-table">
   

     <tr class="form-field">

    <th scope="row" valign="top"><label for="cat_Theloai"><?php _e('Tác giả'); ?></label></th>

    <td>

	 
        <input type="text" name="Truyen[tacgia]" value="<?php echo $tacgia_meta['tacgia'] ?>" size="30" style=" width: 50%;">


     </div>  

    <span class="description"><?php _e('Enter a value tác giả for this field'); ?></span>

            </td>

    </tr>
</table>
<?php

}

add_action( 'category_edit_form_fields', 'edit_tacgia_to_category');

