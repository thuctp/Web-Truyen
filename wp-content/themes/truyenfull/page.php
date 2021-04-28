<?php get_header(); ?>

<div class="navbar-breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="<?php echo home_url(); ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
			<li class="active"><?php the_title(); ?></li>
		</ul>
	</div>
</div>

<div class="container">
	<section class="section">
		<header class="section-header">
			<h2><?php the_title(); ?></h2>
		</header>
		<div class="section-content">
			<div class="entry-content">
				<?php 
				while( have_posts() ) : the_post();
					the_content();
				endwhile;
				?>
			</div>
		</div>
	</section>
</div>

			
<?php get_footer(); ?>