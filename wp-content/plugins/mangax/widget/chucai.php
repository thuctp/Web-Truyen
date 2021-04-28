<?php 
class  Chucai extends WP_Widget
{
	function Chucai(){
        parent::WP_Widget('Chucai', 
            'ZingWP-Danh sách chữ cái', 
            array('description' => 'Danh Sách chữ cái'));
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
        <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>"  style="width:100%"><br>
        Page:
        <select name="<?php echo $this->get_field_name('page'); ?>">
          <?php

             $list_page=array(
            'post_type'=>'page',
            'post_status'=>'publish'
            );
           $chucai=new WP_Query($list_page);
           while ($chucai->have_posts()):$chucai->the_post();
               // $idpage=$page ;
           if(get_the_ID()==$page)
           {
               echo '<option value="'.get_the_ID().'" selected  >'.get_the_title($post->ID).'</option>';
           }
           else
           {
               echo '<option value="'.get_the_ID().'"  >'.get_the_title($post->ID).'</option>';
           }
           endwhile;

           ?>
        </select>
      

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
             $page = apply_filters('page',$instance['page']);
			
				   
				    
				    echo $before_widget;
				    $title = $before_title.$title.$after_title;
				   	echo $title;
				   //	echo $soluong;
				   hienthidanhsachchucai($page);
				  	echo $after_widget;
        }
}

add_action('widgets_init', create_function('', 'return register_widget("Chucai");'));



function hienthidanhsachchucai($page)
{ 
  $link=get_the_permalink($page);
  ?>

  <li><a href="<?php echo $link; ?>?chucai=A">A</a></li>
  <li><a href="<?php echo $link; ?>?chucai=B">B</a></li>
  <li><a href="<?php echo $link; ?>?chucai=C">C</a></li>
  <li><a href="<?php echo $link; ?>?chucai=D">D</a></li>
  <li><a href="<?php echo $link; ?>?chucai=E">E</a></li>
  <li><a href="<?php echo $link; ?>?chucai=F">F</a></li>
  <li><a href="<?php echo $link; ?>?chucai=G">G</a></li>
  <li><a href="<?php echo $link; ?>?chucai=H">H</a></li>
  <li><a href="<?php echo $link; ?>?chucai=I">I</a></li>
  <li><a href="<?php echo $link; ?>?chucai=J">J</a></li>
  <li><a href="<?php echo $link; ?>?chucai=K">K</a></li>
  <li><a href="<?php echo $link; ?>?chucai=L">L</a></li>
  <li><a href="<?php echo $link; ?>?chucai=M">M</a></li>
  <li><a href="<?php echo $link; ?>?chucai=N">N</a></li>
  <li><a href="<?php echo $link; ?>?chucai=O">O</a></li>
  <li><a href="<?php echo $link; ?>?chucai=P">P</a></li>
  <li><a href="<?php echo $link; ?>?chucai=Q">Q</a></li>
  <li><a href="<?php echo $link; ?>?chucai=R">R</a></li>
  <li><a href="<?php echo $link; ?>?chucai=S">S</a></li>
  <li><a href="<?php echo $link; ?>?chucai=T">T</a></li>
  <li><a href="<?php echo $link; ?>?chucai=V">V</a></li>
  <li><a href="<?php echo $link; ?>?chucai=U">U</a></li>
  <li><a href="<?php echo $link; ?>?chucai=X">X</a></li>
  <li><a href="<?php echo $link; ?>?chucai=Y">Y</a></li>

  <li><a href="<?php echo $link; ?>?chucai=Z">Z</a></li>
  <li><a href="<?php echo $link; ?>?chucai=W">W</a></li>  

  <?php
}



?>