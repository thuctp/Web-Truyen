<?php 

function add_trangthai_to_category()
{
  ?>
<div class="form-field term-parent-wrap">
   <label for="cat_Theloai"><?php _e('Truyện hot'); ?></label>
    
        <input type="radio" name="Truyen[hot]" id="Truyen[hot]" value="on" > Có
        <input type="radio" name="Truyen[hot]" id="Truyen[hot]" value=""  > Không
</div>
<div class="form-field term-parent-wrap">    
    <label for="cat_Theloai"><?php _e('Trạng thái'); ?></label>
    <table>
      
      <tr>
        <td>Truyện đang cập nhật: </td>
        <td>
           <input type="radio" name="Truyen[tinhtrang]" id="Truyen[tinhtrang]" value="" >  
    
        </td>
      </tr>

       <tr>
        <td>
          Truyện tạm ngưng :
        </td>
        <td>
           <input type="radio" name="Truyen[tinhtrang]" id="Truyen[tinhtrang]" value="tamngung" >    
      
        </td>
       </tr>
       <tr>
        <td>
          Truyện hoàn thành: 
        </td>
        <td>
          <input type="radio" name="Truyen[tinhtrang]" id="Truyen[tinhtrang]" value="hoanthanh" > 

        </td>
       </tr>
      
       </table>
       
  </div>
  <div class="form-field term-parent-wrap"> 
       <label for="cat_Theloai"><?php _e('Truyện tiêu biểu'); ?></label>
      
        <input type="radio" name="Truyen[tieubieu]" id="Truyen[tieubieu]" value="on" > Có
        <input type="radio" name="Truyen[tieubieu]" id="Truyen[tieubieu]" value="off"> Không
        
     </div>


  <?php

}
add_action( 'category_add_form_fields', 'add_trangthai_to_category');












function edit_trangthai_to_category($truyen)
{

	$t_id = $truyen->term_id;

    $trangthai_meta = get_option( "category_$t_id");


	?>
<table class="form-table">
   	<tr>
  <th scope="row" valign="top"><label for="cat_Theloai"><?php _e('Truyện hot'); ?></label></th>
   		<td>
   			<input type="radio" name="Truyen[hot]" id="Truyen[hot]" value="on" <?php if($trangthai_meta['hot']=='on') echo "checked"; ?>> Có
	    	<input type="radio" name="Truyen[hot]" id="Truyen[hot]" value=""  <?php if($trangthai_meta['hot']=='') echo "checked"; ?>> Không
	    
   		</td>
   	</tr>

     <tr class="form-field">

    <th scope="row" valign="top"><label for="cat_Theloai"><?php _e('Trạng thái'); ?></label></th>

    <td>
    <table>
    	
    	<tr>
    		<td>Truyện đang cập nhật:	</td>
    		<td>
    			 <input type="radio" name="Truyen[tinhtrang]" id="Truyen[tinhtrang]" value="" <?php if($trangthai_meta['capnhat']=='') echo "checked"; ?>> 	
	  
    		</td>
    	</tr>

	     <tr>
	     	<td>
	     		Truyện tạm ngưng :
	     	</td>
	     	<td>
	     		 <input type="radio" name="Truyen[tinhtrang]" id="Truyen[tinhtrang]" value="tamngung" <?php if($trangthai_meta['tinhtrang']=='tamngung') echo "checked"; ?>> 		
   		
	     	</td>
	     </tr>
	     <tr>
	     	<td>
	     		Truyện hoàn thành: 
	     	</td>
	     	<td>
	     		<input type="radio" name="Truyen[tinhtrang]" id="Truyen[tinhtrang]" value="hoanthanh" <?php if($trangthai_meta['tinhtrang']=='hoanthanh') echo "checked"; ?>> 

	     	</td>
	     </tr>
	    
	     </table>
	     
    </td>

    </tr>
    <tr>
    	 <th scope="row" valign="top"><label for="cat_Theloai"><?php _e('Truyện tiêu biểu'); ?></label></th>
    	<td>
    		<input type="radio" name="Truyen[tieubieu]" id="Truyen[tieubieu]" value="on" <?php if($trangthai_meta['tieubieu']=='on') echo "checked"; ?>> Có
	    	<input type="radio" name="Truyen[tieubieu]" id="Truyen[tieubieu]" value="off"  <?php if($trangthai_meta['tieubieu']=='off' || $trangthai_meta['tieubieu']=='') echo "checked"; ?>> Không
	    	
    	</td>
    </tr>
</table>
<?php
}
add_action( 'category_edit_form_fields', 'edit_trangthai_to_category');
