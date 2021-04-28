<?php 
class Truyenmoidang extends WP_Widget
{
	function Truyenmoidang(){
        parent::WP_Widget('Truyenmoidang', 
            'ZingWP-Truyện mới đăng', 
            array('description' => 'Danh Sách Các Truyện Mới Đăng'));
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
				   hienthidanhsachtruyenmoinhat($soluong);
				  	echo $after_widget;
        }
}

add_action('widgets_init', create_function('', 'return register_widget("Truyenmoidang");'));



function hienthidanhsachtruyenmoinhat($soluong)
{
	?>

<?php
                $list_truyen=array();
                $list_chapter=get_terms('category','get=all');//lay danh sach cac truyen
                foreach ($list_chapter as $chap_list) 
                {
                    
                        //lay danh sach cac truuyen cua chapter
                         $child_args = array( 
                            'numberposts' => 1, 
                            'post_type' => 'post',
                           
                            'post_status' => 'publish', 
                            'cat' => $chap_list->term_id ,
							'orderby'             => 'ID',
									'order' => 'DESC', 
                            );
                         $qcposts = get_posts( $child_args );
                         foreach ($qcposts as $list_comic) {
                            
                            $list_truyen[]=$list_comic->ID;
                           
                         }

                   
                }
              $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array(
                        
                      
                        'post__in'     =>  $list_truyen,
                       
                        
                    
                        //Order & Orderby Parameters
                        'order'               => 'DESC',
                        'orderby'             => 'id',
                        'post_type'             =>'post',
                        'paged' =>$page,
                        'showposts'=>$soluong

                       
                    );

									
				  query_posts( $args );
				while (have_posts()):the_post();
				$truyen=laytruyen($post->ID);
				$cat_meta	= get_option('category_'.$truyen['id']);
				?>
                <li>
                      <a href="<?php echo $truyen['slug']; ?>">
                        <p class="super-title"><?php echo $truyen['name']; ?> 
							<?php if ( $cat_meta['hot'] == 'on' ) : ?>
							<img src="<?php echo get_template_directory_uri(). '/images/icon_hot.gif'; ?>" alt="hot icon"/>
							<?php endif; ?>
						</p>
                        <p class="small-title">Chương mới nhất: <?php echo get_the_title($post->ID); ?></p>
                      </a>
                </li>
			
				<?php
				  
				 

				endwhile; ?>

			
		<?php wp_reset_query();?>
	<?php
}
?>