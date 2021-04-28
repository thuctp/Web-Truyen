<?php 
get_header(); 
?>
<?php 
	$truyen=laytruyen_byid($cat); 
	capnhatluotxem($cat);
	set_luotview($cat);
?>

<div class="navbar-breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="<?php echo home_url(); ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
			<li class="active"><?php echo $truyen['name']; ?></li>
		</ul>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-9 content">
			<section class="section">
				<header class="section-header">
					<h2>Thông tin truyện</h2>
				</header>
				<div class="section-content">
					<div class="comic-detail clearfix">
						<div class="col-md-4 col-sm-4 col-xs-12 info-holder">
							<div class="wrap-image">
								<img class="image" src="<?php echo thumb_img($truyen['img'], 324, 221, 80) ; ?>" alt="<?php echo $truyen['name']; ?>">
							</div>
							<div class="info">
								<div><h3>Tác giả:</h3><?php echo laytacgia( $truyen['id'] ); ?></div>
								<div><h3>Thể loại:</h3><?php echo laytheloai( $truyen['id'] ); ?></div>
								<div><h3>Nhóm dịch:</h3><?php echo laynhomdich( $truyen['id'] ); ?></div>					
								<div><h3>Trạng thái:</h3><span class="text-primary"><?php echo $truyen['tinhtrang']; ?></span></div>
								<div><h3>Lượt xem:</h3><?php echo luotxemtruyen( $truyen['id'] ); ?></div>
							</div>
						</div>
						<div class="col-md-8 col-sm-8 col-xs-12 desc">
							<h3 itemprop="name" class="title"><?php echo $truyen['name']; ?></h3>
							<div itemprop="about" class="desc-text"><?php echo $truyen['mota']; ?></div>							
							<div class="l-chapter">
								<div class="l-title"><h3>Các chương mới nhất</h3></div>
								<ul class="l-chapters">
									<?php
									query_posts('post_type=post&showposts=5&cat='.$cat);
									while(have_posts()):the_post();
									?>									
									<li>
										<i class="fa fa-book"></i>
										<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
											<span class="chapter-text"><?php the_title(); ?></span>
										</a>
									</li>
									<?php endwhile; wp_reset_query(); ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>
			
			<?php dynamic_sidebar('content-top-ads'); ?> 
			
			<section class="section">
				<header class="section-header">
					<h2>Danh sách chương</h2>
				</header>
				<div class="section-content">
					<div class="list-chapter clearfix">
						<table class="table borderless">
							<thead>
								<tr>
									<th>STT</th>
									<th>Chương</th>
									<th>Cập nhật</th>
								</tr>
							</thead>
							<tbody>
							
								<?php
								$args = array(
									'post_type' => 'post',
									'showposts' => -1,
									'cat'		=> $cat,
									'orderby'=>'id',
									
									'order'=>'ASC'
								);
								$query = new WP_Query( $args );
								$i = 0;
								while( $query->have_posts() ) : $query->the_post();
								$i++;
								?>
								
								<tr>
									<td><?php echo $i; ?></td>
									<td><a href="<?php the_permalink(); ?>"><?php echo $truyen['name']; ?> &ndash; <?php the_title(); ?> </a></td>
									<td><?php echo get_the_date('d/m/Y'); ?></td>
								</tr>
								
								<?php endwhile; ?>
								
							</tbody>
						</table>
					</div>
				</div>
			</section>
			
			<section class="section">
				<header class="section-header">
					<h2>Bình luận</h2>
				</header>
				<div class="section-content">
					<div class="comment">
						<div class="fb-comments" data-href="<?php echo $truyen['slug'] ?>" data-colorscheme="light" data-width="100%" data-numposts="5"></div>
					</div>
				</div>
			</section>
		</div>
		<div class="hidden-xs hidden-sm col-md-3 sidebar">
				<?php get_sidebar(); ?>
		</div>
	</div>
</div>
			
			
<?php get_footer(); ?>