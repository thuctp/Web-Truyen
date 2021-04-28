<?php 
class  Theloai extends WP_Widget
{
	function Theloai(){
        parent::WP_Widget('Theloai', 
            'ZingWP-Danh sách thể loại', 
            array('description' => 'Danh Sách thể loại'));
    }
  /**
         * Tạo form option cho widget
         */
        function form( $instance ) {
        
      
        //Tạo biến riêng cho giá trị mặc định trong mảng $default
        $title = esc_attr( $instance['title'] );
        $page=esc_attr($instance['page'] );
       
      

        ?>
		
        Title:
        <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>"  style="width:100%">
        
      

        <?php
 
        //Hiển thị form trong option của widget
       // echo 'Nhập tiêu đề <input class="widefat" type="text" name="'.$this->get_field_name('title').' value='.$title.' />';
 
 
        }
 
        /**
         * save widget form
         */
		function update($new_instance, $old_instance) {
		    return $new_instance;
		  }
		 
        /**
         * Show widget
         */
 
        function widget( $args, $instance ) 
        {
				 	 global $post;
				    
				    extract($args);
				    
				    $title = apply_filters('title',$instance['title']);
           
			
				   
				    
				    echo $before_widget;
				    $title = $before_title.$title.$after_title;
				   	echo $title;
				    //	echo $soluong;
				    hienthidanhsachtheloai($page);
				  	echo $after_widget;
        }
}

add_action('widgets_init', create_function('', 'return register_widget("Theloai");'));



function hienthidanhsachtheloai() { 
  
?>
	
	<?php
	$categories = get_terms( 'the-loai', array( 'hide_empty' => false ) );
	foreach ( $categories as $category ) :
	?>

	<div class="category-item"><a href="<?php echo esc_url( get_term_link( $category ) ); ?>"><?php echo $category->name; ?></a></div>

	<?php
	endforeach;
	?>

<?php
}
?>