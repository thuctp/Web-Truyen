<?php get_header(); ?>

<div class="navbar-breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="<?php echo home_url(); ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
			<li class="active"><?php echo get_queried_object()->name; ?> </li>
		</ul>
	</div>
</div>

<div class="container" id="list-page">
	<div class="row">
		<div class="col-md-9 content">				
			<section class="section">
				<header class="section-header">
					<h2><?php echo get_queried_object()->name; ?></h2>
				</header>
				<div class="section-content">
					
					<?php 
					$args = array(
						'post_per_page' => get_option('sl-truyen'),
						'nhom'			=> get_queried_object()->term_id,
					);
					$danhsachtruyen = danhsachtruyen( $args );
					if( $danhsachtruyen ) :
					foreach ( $danhsachtruyen as $list_truyen ) :
						$truyen=laytruyen_byid($list_truyen);
						$chuong=laychuongmoi($list_truyen);
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

					<?php endforeach; endif; ?>
					
				</div>
			</section>
			
			<?php hienthiphantrang( get_term_link(get_queried_object()->term_id, 'nhom-dich'), $args, get_option('sl-truyen') ); ?>
			
		</div>
		<div class="hidden-xs hidden-sm col-md-3 sidebar">
		
			<?php get_sidebar(); ?>
			
		</div>
	</div>
</div>

<?php get_footer(); ?>

