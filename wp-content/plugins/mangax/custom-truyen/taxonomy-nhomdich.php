<?php

add_action( 'init', 'nhomdich_taxonomies', 0 );



function nhomdich_taxonomies() {



	register_taxonomy( 'nhom-dich', 'post', array(



			'hierarchical'  =>  true,



			'labels' => array(



				'name' => 'Nhóm  dịch',



				'singual_name' => 'Nhóm dịch',



				'add_new' => 'Thêm nhóm dịch',



				'add_new_item' => 'Thêm nhóm dịch',



				'new_item' => 'Nhóm dịch mới',



				'search_item' => 'Tìm nhóm dịch'



				),

				'rewrite' => array('slug' => 'nhom-dich'),				



		) );}




/*thêm trường tác giả vào category or truyện*/

function add_nhomdich_to_category() {

		$orderby = 'name';

        $show_count = 0; // 1 for yes, 0 for no

        $pad_counts = 0; // 1 for yes, 0 for no

        $hierarchical = 1; // 1 for yes, 0 for no

        $taxonomy = 'nhom-dich';

        $title = '';



        $args_theloai = array(

        'post_type'=>'post',

          'orderby' => $orderby,

          'show_count' => $show_count,

          'pad_counts' => $pad_counts,

          'hierarchical' => $hierarchical,

          'taxonomy' => $taxonomy,

          'title_li' => $title,

          'hide_empty' => 0,

          

        );

		

		$category_nhomdich= get_categories($args_theloai);

 

	?>

	
<div class="form-field term-parent-wrap">
   
	<label for="cat_Theloai"><?php _e('Nhóm dịch'); ?></label>

				  <div style="height:200px;width:200px; overflow: auto; border: 1px solid #ccc; padding-left: 10px;">
      
    

      <?php

          foreach ($category_nhomdich as $category_item ) {

       ?>
               <input type="checkbox" value="<?php echo $category_item->term_id;  ?>" name="Truyen[nhomdich][<?php echo $category_item->term_id; ?>]" <?php if(esc_attr($category_nhomdich['nhomdich'][$category_item->term_id])==$category_item->cat_ID){ echo "checked"; }?>  >
            
                  <?php echo $category_item->cat_name; ?>  
                 <br>


           

       <?php } 
     

       ?> 

     </div>  
		<span class="description"><?php _e('Chọn giá trị nhóm dịch cho truyện'); ?>
    </span>
    </div>
<?php

}





add_action( 'category_add_form_fields', 'add_nhomdich_to_category');




//them trường tacgia trong phần edit category

function edit_nhomdich_to_category($nhomdich) {



$orderby = 'name';

        $show_count = 0; // 1 for yes, 0 for no

        $pad_counts = 0; // 1 for yes, 0 for no

        $hierarchical = 1; // 1 for yes, 0 for no

        $taxonomy = 'nhom-dich';

        $title = '';



        $args_theloai = array(

        'post_type'=>'post',

          'orderby' => $orderby,

          'show_count' => $show_count,

          'pad_counts' => $pad_counts,

          'hierarchical' => $hierarchical,

          'taxonomy' => $taxonomy,

          'title_li' => $title,

          'hide_empty' => 0,

          

        );

		

		$category_nhomdich= get_categories($args_theloai);

		

		$nhomdich_id = $nhomdich->term_id;

        $nhomdich_meta = get_option( "category_$nhomdich_id");

 

	?>

	
<table class="form-table">
   

     <tr class="form-field">

    <th scope="row" valign="top"><label for="cat_Theloai"><?php _e('Nhóm dịch'); ?></label></th>

    <td>

 <div style="height:200px;width:200px; overflow: auto; border: 1px solid #ccc; padding-left: 10px;">
      
    

      <?php

          foreach ($category_nhomdich as $category_item ) {

       ?>
               <input type="checkbox" value="<?php echo $category_item->term_id;  ?>" name="Truyen[nhomdich][<?php echo $category_item->term_id; ?>]" <?php if(esc_attr( $nhomdich_meta ['nhomdich'][$category_item->term_id])==$category_item->cat_ID){ echo "checked"; }?>  >
            
                  <?php echo $category_item->cat_name; ?>  
                 <br>


           

       <?php } 
     

       ?> 

     </div>  

    <span class="description"><?php _e('Enter a value nhóm dịch for this field'); ?></span>

            </td>

    </tr>
</table>
<?php

}

add_action( 'category_edit_form_fields', 'edit_nhomdich_to_category');

