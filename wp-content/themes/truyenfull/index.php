<?php get_header(); ?>

<div class="navbar-breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li class="active">Đọc truyện online, đọc truyện chữ, truyện full, truyện hay. Tổng hợp đầy đủ và cập nhật liên tục.</li>
		</ul>
	</div>
</div>
	
<div class="container">
	<section class="section">
		<header class="section-header">
			<a class="link" href="<?php echo home_url(); ?>/truyen-hot/" title="Truyện hot">
				<h2>Truyện hot</h2><i class="fa fa-fire"></i>
			</a>
			<select class="form-control select-hot-comic">
				<option value="">Tất cả</option>
				<?php 
					$terms = get_terms( 'the-loai', array( 'hide_empty' => false ) );
					foreach( $terms as $term ) {
				?>
				<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>	
				<?php
					}
				?>
			</select>
		</header>
		<div class="section-content">
			<div class="group-hot-comic clearfix">
				<?php 
				$args = array(
					'post_per_page'	=> 13,
					'hot'		=> 'on',
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
				?>
			</div>
		</div>
	</section>
	<div class="row">
		<div class="col-md-9 content">
			<?php
				$list_truyenvuadoc = array();
				if(isset($_COOKIE['read_truyen'])) {
			?>
			<section class="section">
				<header class="section-header"><h2>Truyện bạn đã đọc</h2></header>
				<div class="section-content">
					<table class="table table-comic table-read-comic">
						<tbody>
						<?php
								$read = $_COOKIE['read_truyen'];

								
								if(is_numeric($read)){
									$list_truyenvuadoc = $read; 
								}else{
									$list_truyenvuadoc = unserialize($read);    
								  //  print_r($list_truyenvuadoc);
								}
							
								$slvd=0;
								if(!empty($list_truyenvuadoc) && is_array($list_truyenvuadoc)){	
								
									krsort($list_truyenvuadoc);
									foreach ($list_truyenvuadoc as $truyenvuadoc) 
									{
										
									$slvd++;
									//$termtruyen=get_term($value,'category');
										if($slvd>3) { break; }
										foreach ($truyenvuadoc as $key => $value) {
											
											$term_truyen=get_term($key,"category");
										
							?>
								<tr>
									<td class="name">
										<h5>
											<i class="fa fa-chevron-right"></i>
											<a href="<?php echo get_term_link($term_truyen ); ?>"><?php echo $term_truyen->name; ?></a>
										</h5>
									</td>
									<td class="chapter"><a href="<?php echo get_the_permalink($value); ?>" title="<?php echo get_the_title($value); ?>">Đọc tiếp <?php echo get_the_title($value); ?></a></td>
								</tr>
							<?php
										}
									}
								}else{
							?>
								<tr>
									<td class="name">
										<h5>
											<i class="fa fa-chevron-right"></i>
											<?php the_category(', ', '', $list_truyenvuadoc); ?>
										</h5>
									</td>
									<td class="chapter"><a href="<?php echo get_the_permalink($list_truyenvuadoc); ?>" title="<?php echo get_the_title($list_truyenvuadoc); ?>">Đọc tiếp <?php echo get_the_title($list_truyenvuadoc); ?></a></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</section>
			<?php } ?>
			<section class="section">
				<header class="section-header">
					<a class="link" href="<?php echo home_url(); ?>/truyen-moi-cap-nhat/" title="Truyện mới cập nhật">
						<h2>Truyện mới cập nhật</h2><i class="fa fa-menu-right"></i>
					</a>
					<select class="form-control select-new-comic">
						<option value="">Tất cả</option>
						<?php 
							$terms = get_terms( 'the-loai', array( 'hide_empty' => false ) );
							foreach( $terms as $term ) {
						?>
						<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>	
						<?php
							}
						?>
					</select>
				</header>
				<div class="section-content">
				
					<?php
					$soluong=get_option('sl-truyenmoi');
					$arg=array(
						'get=all',
						'exclude'           => array(1), 
					);
					$list_chapter=get_terms('category',$arg);//lay danh sach cac truyen
					$list_truyenmoicapnhat=array();
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
						'showposts'=>$soluong
					);
					?>
					
					<table class="table table-comic">
						<tbody class="group-new-comic">
						
						<?php
						$query = new WP_Query( $args );
						while ( $query->have_posts() ) : $query->the_post();
						$truyen = laytruyen($post->ID);
						$truyen = laytruyen_byid($truyen['id']); 
						$chuong = laychuongmoi( $truyen['id'] );
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
								<?php echo laytheloai( $truyen['id'] ); ?>
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
						endwhile;  
						wp_reset_postdata();
						?>
						
						</tbody>
					</table>
				</div>
			</section>
		</div>
		<div class="hidden-xs hidden-sm col-md-3 sidebar">
			
			<?php dynamic_sidebar('widget-category')?> 
			
			<?php dynamic_sidebar('widget-ads')?> 

		</div>
	</div>
	
	<section class="section">
		<header class="section-header">
			<a class="link" href="<?php echo home_url(); ?>/truyen-da-hoan-thanh/" title="Truyện hot">
				<h2>Truyện đã hoàn thành</h2><i class="fa fa-check"></i>
			</a>
		</header>
		<div class="section-content">
			<div class="row">
				<?php 
				$args = array(
					'post_per_page'	=> 12,
					'tinhtrang'		=> 'hoanthanh',
				);
				$danhsachtruyen=danhsachtruyen( $args );
				if( $danhsachtruyen ) :
					foreach ( $danhsachtruyen as $list_truyen) :
					$truyen=laytruyen_byid($list_truyen);
					$chuong=laychuongmoi($list_truyen);
				?>
			
				<div class="col-xs-4 col-sm-3 col-md-2 full-comic text-center">
					<a href="<?php echo $truyen['slug']; ?>" title="<?php echo $truyen['name']; ?>">    
						<img class="image" src="<?php echo thumb_img($truyen['img'],240,200,80) ; ?>" alt="<?php echo $truyen['name'];?>">
					</a>
					<h5 class="name"><a href="<?php echo $truyen['slug']; ?>" title="<?php echo $truyen['name']; ?>"><?php echo $truyen['name']; ?></a></h5>
					<span class="btn-xs btn btn-primary comic-chapter"><a href="<?php echo $chuong['slug']; ?>"><?php echo $chuong['name']; ?></a></span>
				</div>
				
				<?php endforeach; endif; ?>
			</div>
		</div>
	</section>
</div>

<?php get_footer(); ?>