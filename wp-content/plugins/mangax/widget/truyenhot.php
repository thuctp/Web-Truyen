<?php 
class Truyenhot extends WP_Widget
{
	function Truyenhot(){
        parent::WP_Widget('Truyenhot', 
            'ZingWP-Truyện hot', 
            array('description' => 'Danh Sách Các Truyện hot tính theo lượt view'));
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
				   hienthidanhsachtruyenhot($soluong);
				  	echo $after_widget;
        }
}

add_action('widgets_init', create_function('', 'return register_widget("Truyenhot");'));



function hienthidanhsachtruyenhot($soluong)
{  $arg=array(
    'get'               =>'all',
    'exclude'           => array(1), 
  );
    $list_truyen=get_terms('category',$arg);
    $list_id=array();
    foreach ($list_truyen as $value)
    {
      //  echo $value->term_id;
        $idtruyen=$value->term_id;
       // $cat_meta=get_option('category_'.$idtruyen);
        $luotxem=luotxemtruyen($idtruyen);
           $list_id[$idtruyen]= $luotxem;
        
       
      
    
    }
   // print_r($list_id);
    arsort($list_id);
    $dem=0;
	$i = 0;
    foreach ($list_id as $key => $value) {
		$i++;
      if($dem<$soluong)
      {

         $truyen    = laytruyen_byid( $key );
         $chuongmoi = laychuongmoi($key);
		 $cat_meta	= get_option('category_'.$truyen->term_id);
          ?>

        
		<div class="comic-item">
			<div class="label <?php if($i <= 3) : ?>label-success<?php else: ?>label-default<?php endif; ?> label-sm"><?php echo $i; ?></div>
			<div class="group">
				<h5 class="name"><a title="<?php echo $truyen['name']; ?>" href="<?php echo $truyen['slug']; ?>"><?php echo $truyen['name']; ?></a></h5>
				<div class="category">
					<?php  echo laytheloai( $truyen['id'] ); ?>							
				</div>
			</div>
		</div>
		
		
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