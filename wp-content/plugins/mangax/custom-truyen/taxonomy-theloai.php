<?php

add_action( 'init', 'theloai_taxonomies', 0 );



function theloai_taxonomies() {



	register_taxonomy( 'the-loai', 'post', array(



			'hierarchical'  =>  true,



			'labels' => array(



				'name' => 'Thể Loại',



				'singual_name' => 'Thể Loại',



				'add_new' => 'Thêm thể loại',



				'add_new_item' => 'Thêm thể loại',



				'new_item' => 'Thể loại mới',



				'search_item' => 'Tìm thể loại'



				),

				'rewrite' => array('slug' => 'the-loai'),				



		) );}



/*thêm trường thể loại vào category or truyện*/

function add_theloai_to_category() {

		$orderby = 'name';

        $show_count = 0; // 1 for yes, 0 for no

        $pad_counts = 0; // 1 for yes, 0 for no

        $hierarchical = 1; // 1 for yes, 0 for no

        $taxonomy = 'the-loai';

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

		

		$category_theloai= get_categories($args_theloai);

 

	?>

	
<div class="form-field term-parent-wrap">
   
		<label for="cat_Theloai"><?php _e('Thể loại'); ?></label>
	  

				 <div style="height:200px;width:200px; overflow: auto; border: 1px solid #ccc; padding-left: 10px;">
      
    

      <?php

          foreach ($category_theloai as $category_item ) {

       ?>
               <input type="checkbox" value="<?php echo $category_item->term_id;  ?>" name="Truyen[theloai][<?php echo $category_item->term_id; ?>]"  >
            
                  <?php echo $category_item->cat_name; ?>  
                 <br>


           

       <?php } 
     //  echo "=================";
      // print_r($theloai_meta['theloai']);

       ?> 

     </div>  
	 <p class="description"><?php _e('Chọn giá trị thể loại cho truyện'); ?></p>
	    
</div>
<?php

}





add_action( 'category_add_form_fields', 'add_theloai_to_category');




//them trường thể loại trong phần edit category

function edit_theloai_to_category($theloai) {



$orderby = 'name';

        $show_count = 0; // 1 for yes, 0 for no

        $pad_counts = 0; // 1 for yes, 0 for no

        $hierarchical = 1; // 1 for yes, 0 for no

        $taxonomy = 'the-loai';

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

		

		$category_theloai= get_categories($args_theloai);

		

		$theloai_id = $theloai->term_id;

        $theloai_meta = get_option( "category_$theloai_id");

 

	?>

	
<table class="form-table">
   

     <tr class="form-field">

    <th scope="row" valign="top"><label for="cat_Theloai"><?php _e('Thể loại'); ?></label></th>

    <td>
    
	  <div style="height:200px;width:200px; overflow: auto; border: 1px solid #ccc; padding-left: 10px;">
      
    

      <?php

          foreach ($category_theloai as $category_item ) {

       ?>
               <input type="checkbox" value="<?php echo $category_item->term_id;  ?>" name="Truyen[theloai][<?php echo $category_item->term_id; ?>]" <?php if(esc_attr($theloai_meta['theloai'][$category_item->term_id])==$category_item->cat_ID){ echo "checked"; }?> >
            
                  <?php echo $category_item->cat_name; ?>  
                 <br>


           

       <?php } 
     //  echo "=================";
      // print_r($theloai_meta['theloai']);

       ?> 

     </div>  

    <span class="description"><?php _e('Enter a value thể loại for this field'); ?></span>

            </td>

    </tr>
</table>
<?php

}

add_action( 'category_edit_form_fields', 'edit_theloai_to_category');