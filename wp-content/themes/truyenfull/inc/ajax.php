<?php
	function load_hot_comic() {
		$term_id = $_GET['term_id'];
		
		$args = array(
			'post_per_page'	=> 13,
			'hot'		    => 'on',
			'theloai'		=> $term_id,
		);
		$danhsachtruyen=danhsachtruyen( $args );
		$i = 0;
		if( $danhsachtruyen ) {
			foreach ( $danhsachtruyen as $item) {
			$i++;
			$truyen=laytruyen_byid($item);
			$chuong=laychuongmoi($item);
		?>
		
		<div class="hot-comic">
			<a href="<?php echo $truyen['slug']; ?>" title="<?php echo $truyen['name']; ?>">  					
				<?php if( $i == 1 ) : ?>
				<img class="image" src="<?php echo thumb_img($truyen['img'],390,265,100) ; ?>" alt="<?php echo $truyen['name'];?>">
				<?php else: ?>
				<img class="image" src="<?php echo thumb_img($truyen['img'],193,129,100) ; ?>" alt="<?php echo $truyen['name'];?>">
				<?php endif; ?>
				<h5 class="name"><?php echo $truyen['name']; ?></h5>
				<span class="full-label"></span>
			</a>
		</div>
		
		<?php 
			} 
		}

		else
		

		{
		?>
		<br>
		<p class="col-xs-12">Chưa có truyện thuộc thể loại này!</p>
		<?php	
		} 
		die();
	}
	// creating Ajax call for WordPress
	add_action( 'wp_ajax_nopriv_load_hot_comic', 'load_hot_comic' );
	add_action( 'wp_ajax_load_hot_comic', 'load_hot_comic' );
	
	function load_new_comic() {
		$term_id = $_GET['term_id'];
		
		$soluong=get_option('sl-truyenmoi');
		$arg = array(
			'get'       => 'all',
			'exclude'   => array(1), 
			'child_of'	=> $term_id,
		);
		$list_chapter=get_terms('category',$arg);//lay danh sach cac truyen
		$list_truyen = array();
		foreach ($list_chapter as $chap_list) {
			//lay danh sach cac truuyen cua chapter
			$child_args = array( 
				'numberposts'  => 1, 
				'post_type'    => 'post',
				'post_status'  => 'publish', 
				'cat'          => $chap_list->term_id ,
				'orderby'      => 'ID',
				'order'        => 'DESC', 
			);
			$qcposts = get_posts( $child_args );
			foreach ($qcposts as $list_comic) {
				$list_truyen[]=$list_comic->ID;
			}
		}
		$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			'post__in'     =>  $list_truyen,					
			'order'               => 'DESC',
			'orderby'             => 'id',
			'post_type'             =>'post',
			'paged' =>$page,
			'showposts'=>$soluong,
		);
		$query = new WP_Query( $args );
		if( $query->have_posts() ) {
			while ( $query->have_posts() ) : $query->the_post();
			$truyen = laytruyen($post->ID);
			$truyen = laytruyen_byid($truyen['id']); 
			$chuong = laychuongmoi( $truyen['id'] );
			
			$option_truyen=get_option('category_'.$truyen['id']);
			$list_the_loai=$option_truyen['theloai']; 
			
			$has=in_array($term_id,$list_the_loai);
			if($term_id=="")
			{
				$has=true;
			}

			if($has==true)
			{
			?>
			
			<tr>
				<td class="name">
					<h5>
						<i class="fa fa-chevron-right"></i>
						<a href="<?php echo $truyen['slug']; ?>"><?php echo $truyen['name']; ?></a>
						<?php if( $truyen['hot'] == 'on' ) : ?>
						<span class="label-title label-hot"></span>
						<?php endif; ?>
					</h5>
				</td>
				<td class="category hidden-xs">
					<?php echo laytheloai( $truyen['id'] ); 	
					
					
					?>
				</td>
				<td class="chapter">
					<a href="<?php echo $chuong['slug']; ?>" title="<?php echo $chuong['name']; ?>">
						<?php echo $chuong['name']; ?>
					</a>
				</td>
				<td class="release hidden-sm hidden-xs">
					<time datetime="<?php echo $chuong['time']; ?>">
						<?php echo $chuong['time']; ?>
					</time>
				</td>
			</tr>	

			<?php
			}
			endwhile;  
			wp_reset_postdata();
		} else 
		
		
		
		{
		?>
		<br>
		<p>Chưa có truyện thuộc thể loại này!</p>
		<?php	
		} 
		die();
	}
	// creating Ajax call for WordPress
	add_action( 'wp_ajax_nopriv_load_new_comic', 'load_new_comic' );
	add_action( 'wp_ajax_load_new_comic', 'load_new_comic' );
	
	function request_contact() {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$content = $_POST['content'];
		
		if ( $name == '' ) {
			die( 'Bạn chưa nhập tên.' );
		}
		if ( $email == '' ) {
			die( 'Bạn chưa nhập email.' );
		}
		if ( !is_email( $_POST['email'] ) ) {
			die( 'Email không hợp lệ.' );
		}
		if ( $subject == '' ) {
			die( 'Bạn chưa chọn chủ đề.' );
		}
		if ( $content == '' ) {
			die( 'Bạn chưa nhập nội dung.' );
		}
		
		$to = get_option('admin_email');
		$subject = 'Liên hệ đến ' . $name;
		$message = 'Tên: <b>' . $name . '</b><br>' . 'Email: <b>' . $email . '</b><br>' . 'Nội dung: <br>' . $content;
		$headers = array(
			'Reply-To: ' . $email,
			'Content-Type: text/html; charset=UTF-8'
		);

		wp_mail( $to, $subject, $message, $headers );
		
		die( 'Gửi yêu cầu thành công.' ) ;
	}
	// creating Ajax call for WordPress
	add_action( 'wp_ajax_nopriv_request_contact', 'request_contact' );
	add_action( 'wp_ajax_request_contact', 'request_contact' );
?>