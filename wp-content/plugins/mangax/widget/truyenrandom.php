<?php 
class Truyenrandom extends WP_Widget
{
	function Truyenrandom(){
        parent::WP_Widget('Truyenrandom', 
            'ZingWP-Truyện Random', 
            array('description' => 'Danh Sách Các Truyện ngẫu nhiên'));
    }
  /**
         * Tạo form option cho widget
         */
        function form( $instance ) {
        
      
        //Tạo biến riêng cho giá trị mặc định trong mảng $default
        $title = esc_attr( $instance['title'] );
        $soluong = esc_attr( $instance['soluong'] );
      

        ?>
        Title:
        <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>"  style="width:100%"><br>
         Số lượng:
        <input type="text" name="<?php echo $this->get_field_name('soluong'); ?>" value="<?php echo $soluong; ?>"  style="width:100%">
       

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
				    $soluong = apply_filters('soluong',$instance['soluong']);
				    
				   
				    
				   
				    
				    echo $before_widget;
				    $title = $before_title.$title.$after_title;
				   	echo $title;
				   //	echo $soluong;
				   hienthidanhsachtruyenrandom($soluong);
				  	echo $after_widget;
        }
}

add_action('widgets_init', create_function('', 'return register_widget("Truyenrandom");'));



function hienthidanhsachtruyenrandom($soluong)
{   $arg=array(
    'get'               =>'all',
    'exclude'           => array(1), 
  );

    $list_truyen=get_terms('category',$arg);
    $list_id=array();
    foreach ($list_truyen as $value)
    {
      //  echo $value->term_id;
        $idtruyen=$value->term_id;
        $cat_meta=get_option('category_'.$idtruyen);
        $list_id[]=$idtruyen;
      
      
    
    }
   // print_r($list_id);
   shuffle ($list_id);
    $dem=0;
    foreach ($list_id as $key ) {
      if($dem<$soluong)
      {

         $truyen=get_term($key,'category');
           $chuongmoi=laychuongmoi($key);
		   $cat_meta	= get_option('category_'.$key);
      ?>

      

        <li>
          <a href="<?php echo home_url()."/".$truyen->slug."/"; ?>">
            <p class="super-title"><?php  echo $truyen->name; ?>
				<?php if ( $cat_meta['hot'] == 'on' ) : ?>
				<img src="<?php echo get_template_directory_uri(). '/images/icon_hot.gif'; ?>" alt="hot icon"/>
				<?php endif; ?>
			</p>
            <p class="small-title">Chương mới nhất: <?php echo $chuongmoi['name'];?></p>
          </a>
        </li>
      <?php
      }
      else
      {
        break;
      }
      $dem++;
     
     

    }
  



  
	
}
?>