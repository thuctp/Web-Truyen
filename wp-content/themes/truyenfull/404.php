<?php get_header(); ?>

<div class="navbar-breadcrumb">
	<div class="container breadcrumb-container">
	
	<?php echo get_option('slogan')?>
   
	</div>
</div>
	
<div class="container text-center" style="margin-bottom: 10px;">
	<img src="<?php echo get_template_directory_uri(); ?>/images/error_404.png" alt="404 not found"/>
</div>

<?php get_footer(); ?>