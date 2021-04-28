<?php
/**
Template Name: Truyện mới cập nhật
**/
?>

<?php get_header(); ?>
<?php
	$i=0;
	$arg=array(
		'get=all',
		'exclude'           => array(1), 
	);
	$list_chapter=get_terms('category',$arg);//lay danh sach cac truyen
	$list_truyenmoicapnhat=array();
	foreach ($list_chapter as $chap_list) {
		
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
		'order'               => 'DESC',
		'orderby'             => 'id',
		'post_type'             =>'post',
		'paged' =>$page,
		'showposts'=> get_option('sl-truyen') 
	);
?>

<div class="navbar-breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="<?php echo home_url(); ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
			<li class="active"><?php the_title(); ?></li>
		</ul>
	</div>
</div>

<div class="container" id="list-page">
	<div class="row">
		<div class="col-md-9 content">				
			<section class="section">
				<header class="section-header">
					<h2><?php the_title(); ?></h2>
				</header>
				<div class="section-content">
				
					<?php
					$query = new WP_Query( $args );
					while( $query->have_posts() ) : $query->the_post();
					$truyen = laytruyen($post->ID);
					$truyen = laytruyen_byid($truyen['id']);
					$chuong = laychuongmoi($truyen['id']); 
					?>
					
					<div class="comic-item clearfix">
						<div class="col-sm-9 col-xs-12">
							<div class="media">
								<div class="media-left">
									<?php if( $truyen['img'] ) : ?>
									<a href="<?php echo $truyen['slug']; ?>"><img class="image" src="<?php echo thumb_img($truyen['img'], 80, 180, 100) ; ?>" alt="<?php echo $truyen['name']; ?>"></a>
									<?php else: ?>
									<a href="<?php echo $truyen['slug']; ?>"><img class="image" src="<?php echo thumb_img( get_template_directory_uri() . '/images/no-image.jpg', 80, 180, 100) ; ?>" alt="<?php echo $truyen['name']; ?>"></a>
									<?php endif; ?>
								</div>
								<div class="media-body">
									<h3 class="name">
										<i class="fa fa-book"></i>
										<a href="<?php echo $truyen['slug']; ?>" title="<?php echo $truyen['name']; ?>">
											<?php echo $truyen['name']; ?>
										</a>
										
										<?php if( $truyen['tinhtrang'] == 'Hoàn thành' ) : ?>
										<span class="label-title label-full"></span>
										<?php endif; ?>
										
										<?php if( $truyen['hot'] == 'on' ) : ?>
										<span class="label-title label-hot"></span>
										<?php endif; ?>
									</h3>

									<span class="author">
										<i class="fa fa-pencil"></i>
										<span><?php echo laytacgia( $truyen['id'] );?></span>
									</span>
								</div>
							</div>
						</div>
						<div class="col-sm-3 hidden-xs">
							<p class="chapter">
								<a href="<?php echo $chuong['slug']; ?>"><?php echo $chuong['name']; ?></a>
							</p>
						</div>
					</div>

					<?php
					endwhile;  
					//wp_reset_postdata();
					?>
				
				</div>
			</section>
			
			<div class="nav-pagination">
				<?php wp_pagenavi(array('query'=>$query));?>
			</div>
		</div>
		<div class="hidden-xs hidden-sm col-md-3 sidebar">
		
			<?php get_sidebar(); ?>
			
		</div>
	</div>
</div>

<?php get_footer(); ?>

