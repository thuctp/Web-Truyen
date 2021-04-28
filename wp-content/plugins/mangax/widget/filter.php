<?php 
class  Filter extends WP_Widget
{
	function Filter(){
        parent::WP_Widget('Filter', 
            'ZingWP-Filter', 
            array('description' => 'Filter'));
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
				   loctheochucai($page);
				  	echo $after_widget;
        }
}

add_action('widgets_init', create_function('', 'return register_widget("Filter");'));



function loctheochucai($page)
{ 
  $link=get_the_permalink($page);
  ?>
  
	<ul class="filter-chucai">
		<?php 
		$chucai=$_GET['chucai'];
		$sort       =$_GET['sort']; 
		$trangthai  =$_GET['trangthai'];
		$hot        =$_GET['hot'];
		$theloai    =$_GET['theloai'];
		$nhom       =$_GET['nhom'];
		?>
		<li><a <?php active_fitler('active'); ?> href="<?php echo $link; ?>?chucai=&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">ALL</a></li>
		<li><a <?php active_fitler('active','A'); ?> href="<?php echo $link; ?>?chucai=A&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">A</a></li>
		<li><a <?php active_fitler('active','B'); ?> href="<?php echo $link; ?>?chucai=B&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">B</a></li>
		<li><a <?php active_fitler('active','C'); ?> href="<?php echo $link; ?>?chucai=C&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">C</a></li>
		<li><a <?php active_fitler('active','D'); ?> href="<?php echo $link; ?>?chucai=D&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">D</a></li>
		<li><a <?php active_fitler('active','E'); ?>  href="<?php echo $link; ?>?chucai=E&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">E</a></li>
		<li><a <?php active_fitler('active','F'); ?> href="<?php echo $link; ?>?chucai=F&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">F</a></li>
		<li><a <?php active_fitler('active','G'); ?> href="<?php echo $link; ?>?chucai=G&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">G</a></li>
		<li><a <?php active_fitler('active','H'); ?> href="<?php echo $link; ?>?chucai=H&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">H</a></li>
		<li><a <?php active_fitler('active','I'); ?> href="<?php echo $link; ?>?chucai=I&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">I</a></li>
		<li><a <?php active_fitler('active','J'); ?> href="<?php echo $link; ?>?chucai=J&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">J</a></li>
		<li><a <?php active_fitler('active','K'); ?> href="<?php echo $link; ?>?chucai=K&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">K</a></li>
		<li><a <?php active_fitler('active','L'); ?> href="<?php echo $link; ?>?chucai=L&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">L</a></li>
		<li><a <?php active_fitler('active','M'); ?> href="<?php echo $link; ?>?chucai=M&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">M</a></li>
		<li><a <?php active_fitler('active','N'); ?> href="<?php echo $link; ?>?chucai=N&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">N</a></li>
		<li><a <?php active_fitler('active','O'); ?> href="<?php echo $link; ?>?chucai=O&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">O</a></li>
		<li><a <?php active_fitler('active','P'); ?> href="<?php echo $link; ?>?chucai=P&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">P</a></li>
		<li><a <?php active_fitler('active','Q'); ?> href="<?php echo $link; ?>?chucai=Q&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">Q</a></li>
		<li><a <?php active_fitler('active','R'); ?> href="<?php echo $link; ?>?chucai=R&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">R</a></li>
		<li><a <?php active_fitler('active','S'); ?> href="<?php echo $link; ?>?chucai=S&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">S</a></li>
		<li><a <?php active_fitler('active','T'); ?> href="<?php echo $link; ?>?chucai=T&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">T</a></li>
		<li><a <?php active_fitler('active','V'); ?> href="<?php echo $link; ?>?chucai=V&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">V</a></li>
		<li><a <?php active_fitler('active','U'); ?> href="<?php echo $link; ?>?chucai=U&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">U</a></li>
		<li><a <?php active_fitler('active','X'); ?> href="<?php echo $link; ?>?chucai=X&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">X</a></li>
		<li><a <?php active_fitler('active','Y'); ?> href="<?php echo $link; ?>?chucai=Y&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">Y</a></li>

		<li><a <?php active_fitler('active','Z'); ?> href="<?php echo $link; ?>?chucai=Z&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">Z</a></li>
		<li><a <?php active_fitler('active','W'); ?> href="<?php echo $link; ?>?chucai=W&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">W</a></li> 
	</ul>
  
   <div class="dropdown">
	  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Sắp xếp : <span class="value"></span>
	  <span class="caret"></span></button>
	  <ul class="dropdown-menu">
		<li><a <?php active_sapxep('active');?> href="<?php echo $link; ?>?chucai=<?php echo $chucai; ?>&sort=&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">ALL</a></li>
		<li><a <?php active_sapxep('active','name');?> href="<?php echo $link; ?>?chucai=<?php echo $chucai; ?>&sort=name&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">Tên</a></li>
		<li><a <?php active_sapxep('active','view');?>href="<?php echo $link; ?>?chucai=<?php echo $chucai; ?>&sort=view&trangthai=<?php echo $trangthai ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">Lượt xem</a></li>
	  </ul>
	</div>
  
	<div class="dropdown">
		<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Đặc biệt : <span class="value"></span>
		<span class="caret"></span></button>
		<ul class="dropdown-menu">

			<li><a <?php active_hot('active'); ?>  href="<?php echo $link; ?>?chucai=<?php echo $chucai; ?>&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">All</a></li>
			<li><a <?php active_hot('active','on'); ?> href="<?php echo $link; ?>?chucai=<?php echo $chucai; ?>&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai ?>&hot=on&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">Hot</a></li>
		</ul>
	</div>
	
	<div class="dropdown">
		<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Tình trạng : <span class="value"></span>
		<span class="caret"></span></button>
		<ul class="dropdown-menu">
			<li><a <?php active_trangthai('active'); ?> href="<?php echo $link; ?>?chucai=<?php echo $chucai; ?>&sort=<?php echo $sort  ?>&trangthai=&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">All</a></li>
			<li><a <?php active_trangthai('active','hoanthanh'); ?> href="<?php echo $link; ?>?chucai=<?php echo $chucai; ?>&sort=<?php echo $sort  ?>&trangthai=hoanthanh&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">Hoàn thành</a></li>
			<li><a <?php active_trangthai('active','tamngung'); ?> href="<?php echo $link; ?>?chucai=<?php echo $chucai; ?>&sort=<?php echo $sort  ?>&trangthai=tamngung&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">Tạm ngưng</a></li>
			<li><a <?php active_trangthai('active','capnhat'); ?> href="<?php echo $link; ?>?chucai=<?php echo $chucai; ?>&sort=<?php echo $sort  ?>&trangthai=capnhat&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $nhom; ?>">Đang cập nhật</a></li>
		</ul>
	</div>
	
	<div class="dropdown">
		<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Nhóm dịch : <span class="value"></span>
		<span class="caret"></span></button>
		<ul class="dropdown-menu">
			
			<li><a <?php active_nhomdich('active'); ?> href="<?php echo $link; ?>?chucai=<?php echo $chucai; ?>&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai; ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=">ALL</a></li>

			<?php $list_nhom=get_terms('nhom-dich','get=all'); 
			foreach ($list_nhom as $value) {
			?>

			<li><a <?php active_nhomdich('active',$value->term_id); ?> href="<?php echo $link; ?>?chucai=<?php echo $chucai; ?>&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai; ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $theloai; ?>&nhom=<?php echo $value->term_id; ?>"><?php echo $value->name; ?></a></li>


			<?php
			}
			?>
			
		</ul>
	</div>

    <div class="dropdown">
		<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Thể loại : <span class="value"></span>
		<span class="caret"></span></button>
		<ul class="dropdown-menu">
			
			<li><a <?php active_theloai('active');?> href="<?php echo $link; ?>?chucai=<?php echo $chucai; ?>&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai; ?>&hot=<?php echo $hot; ?>&theloai=&nhom=<?php echo $nhom; ?>">ALL</a></li>

			<?php $list_theloai=get_terms('the-loai','get=all'); 

			foreach ($list_theloai as $value) {
			?>

			<li><a <?php active_theloai('active',$value->term_id);?> href="<?php echo $link; ?>?chucai=<?php echo $chucai; ?>&sort=<?php echo $sort  ?>&trangthai=<?php echo $trangthai; ?>&hot=<?php echo $hot; ?>&theloai=<?php echo $value->term_id; ?>&nhom=<?php echo $nhom ?>"><?php echo $value->name; ?></a></li>


			<?php
			}
			?>
			
		</ul>
	</div>
	<script>
		(function($) {
			$('.widget-filter .dropdown').each(function() {
				$(this).find('.value').text( ( $(this).find('.active').text() ) );
			});
		})(jQuery);
	</script>

  <?php
}




?>