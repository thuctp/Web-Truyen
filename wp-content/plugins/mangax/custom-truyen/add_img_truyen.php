<?php 

function edit_img_to_category($truyen)
{

	$t_id = $truyen->term_id;

    $luotxem_meta = get_option( "category_$t_id");


	?>
<table class="form-table">
   

     <tr class="form-field">

    <th scope="row" valign="top"><label for="cat_Theloai"><?php _e('Ảnh đại diện'); ?></label></th>

    <td>
    
    				<input type="text" name="Truyen[anhdaidien]" value="<?php echo $luotxem_meta['anhdaidien'] ?>" id="anhdaidien" size="30"  style=" width: 50%;">
                    <input type="button" class="chonanhdaidien " value="Chọn ảnh" ><br>

                    <img src="<?php echo $luotxem_meta['anhdaidien'] ?>" width="100px" id="show_img">
	    			
    </td>

    </tr>

    <script type="text/javascript">

      var orig_send_to_editor = window.send_to_editor;

jQuery('.chonanhdaidien').click(function() {
                    upload_button = jQuery(this);
                    var frame;
                    event.preventDefault();
                    if (frame) {
                        frame.open();
                        return;
                    }
                    frame = wp.media();
                    frame.on( "select", function() {
                        // Grab the selected attachment.
                        var attachment = frame.state().get("selection").first();
                        frame.close();
                        if (upload_button.parent().prev().children().hasClass("tax_list")) {
                            upload_button.parent().prev().children().val(attachment.attributes.url);
                            upload_button.parent().prev().prev().children().attr("src", attachment.attributes.url);
                        }
                        else
                            jQuery("#anhdaidien").val(attachment.attributes.url);
                    });
                    frame.open();
    });

        
    </script>
</table>
<?php
}
add_action( 'category_edit_form_fields', 'edit_img_to_category');




function add_img_to_category()
{
    ?>
   
<div class="form-field term-parent-wrap">
   

    <label for="cat_Theloai"><?php _e('Ảnh đại diện'); ?></label>
       <input type="text" name="Truyen[anhdaidien]" value="<?php echo $luotxem_meta['anhdaidien'] ?>" id="anhdaidien" >
                    <input type="button" class="chonanhdaidien " value="Chọn ảnh" >
   

    <script type="text/javascript">
     /* var formfield;
    jQuery('.upload_img_button').click(function(){
      
        jQuery('html').addClass('Image');
                        formfield = jQuery(this).prev().attr('name');
                        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
                        return false;
    });
     window.original_send_to_editor = window.send_to_editor;
                window.send_to_editor = function(html){
                        if (formfield) 
                        {
                            fileurl = jQuery('img',html).attr('src');
                            alert(fileurl);
                            jQuery('#anhdaidien').val(fileurl);
                            tb_remove();
                            jQuery('html').removeClass('Image');
                        } 
                        else
                        {
                              window.original_send_to_editor(html);
                        }
                     };

                     */
       jQuery(document).ready(function() {

var orig_send_to_editor = window.send_to_editor;

jQuery('.chonanhdaidien').click(function() {
                    upload_button = $(this);
                    var frame;
                    event.preventDefault();
                    if (frame) {
                        frame.open();
                        return;
                    }
                    frame = wp.media();
                    frame.on( "select", function() {
                        // Grab the selected attachment.
                        var attachment = frame.state().get("selection").first();
                        frame.close();
                        if (upload_button.parent().prev().children().hasClass("tax_list")) {
                            upload_button.parent().prev().children().val(attachment.attributes.url);
                            upload_button.parent().prev().prev().children().attr("src", attachment.attributes.url);
                        }
                        else
                            $("#anhdaidien").val(attachment.attributes.url);
                    });
                    frame.open();
    });
});


    </script>
</div>
<?php
}


add_action( 'category_add_form_fields', 'add_img_to_category');