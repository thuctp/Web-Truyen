<?php get_header(); ?>
<?php 
$id_post = $post->ID;
$truyen = laytruyen($post->ID); 
$next_prev = prev_next($truyen['id'],$post->ID);
?>

<div class="navbar-breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="<?php echo home_url(); ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
			<li><a href="<?php echo $truyen['slug']; ?>"><?php echo $truyen['name']; ?></a></li>
			<li class="active"><?php the_title(); ?></li>
		</ul>
	</div>
</div>

<div class="single-chapter container">
	<button class="btn btn-success toggle-nav-open" type="button"></button>
	<h2 class="comic-title text-center"><a href="<?php echo $truyen['slug']; ?>"><?php echo $truyen['name']; ?></a></h2>
	<h4 class="chapter-title text-center"><a title="<?php the_permalink(); ?>" href="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
	
	<hr class="chapter-start">
	<div class="chapter-nav">
		<a href="<?php echo $next_prev['prev']; ?>" class="btn btn-success btn-prev <?php if( $next_prev['prev'] == '' ) : ?>disabled<?php endif; ?>"><i class="fa fa-chevron-left"></i> <span class="hidden-xs">Chương trước</span></a>
		<div class="dropdown">
			<button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"><?php the_title(); ?>
			<span class="caret"></span></button>
			<ul class="dropdown-menu hidden">
				<?php danhsachchuong($truyen['id'], $id_post); ?>
			</ul>
		</div>
		<a href="<?php echo $next_prev['next']; ?>" class="btn btn-success btn-next <?php if( $next_prev['next'] == '' ) : ?>disabled<?php endif; ?>"><span class="hidden-xs">Chương tiếp</span> <i class="fa fa-chevron-right"></i></a> 
	</div>
	<hr class="chapter-end">
	<?php dynamic_sidebar('content-top-ads'); ?> 
	
	<div class="chapter-content text-left">
		<?php the_content(); ?>
	</div>
	
	<?php dynamic_sidebar('content-bottom-ads'); ?> 
	<hr class="chapter-end">
	<div class="chapter-nav">
		<a href="<?php echo $next_prev['prev']; ?>" class="btn btn-success btn-prev <?php if( $next_prev['prev'] == '' ) : ?>disabled<?php endif; ?>"><i class="fa fa-chevron-left"></i> <span class="hidden-xs">Chương trước</span></a>
		<div class="dropdown dropup">
			<button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"><?php the_title(); ?>
			<span class="caret"></span></button>
			<ul class="dropdown-menu hidden">
				<?php danhsachchuong($truyen['id'], $id_post); ?>
			</ul>
		</div>
		<a href="<?php echo $next_prev['next']; ?>" class="btn btn-success btn-next <?php if( $next_prev['next'] == '' ) : ?>disabled<?php endif; ?>"><span class="hidden-xs">Chương tiếp</span> <i class="fa fa-chevron-right"></i></a> 
	</div>
	<div class="text-center">
		<p style="background: #D9EDF7; border: 1px dashed #2D9FD8; display: inline-block; padding: 5px 10px; border-radius: 5px; -webkit-border-radius: 5px;">
			Bạn có thể dùng phím mũi tên để lùi/sang chương. Các phím WASD cũng có chức năng tương tự như các phím mũi tên.
		</p>
	</div>
	<div class="chapter-comment">
		<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="100%" data-numposts="5"></div>
	</div>
	
	<div class="chapter-bar hidden">
		<div class="row">
			<div class="col-xs-12 col-sm-3 col-md-2">
				<a class="btn btn-primary btn-toggle-comment" href="javascript:void()"><i class="fa fa-facebook"></i> Bình luận</a>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-3">
				<div class="chapter-nav">
					<?php if($next_prev['prev']!='') : ?>
					<a href="<?php echo $next_prev['prev']; ?>" class="btn btn-success">← Chap trước</a>
					<?php endif; ?>
					
					<div class="dropdown dropup hidden">
						<button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"><?php the_title(); ?>
						<span class="caret"></span></button>
						<ul class="dropdown-menu hidden">
							<?php danhsachchuong($truyen['id'], $id_post); ?>
						</ul>
					</div>
					
					<?php if($next_prev['next']!='') : ?>
					<a href="<?php echo $next_prev['next']; ?>" class="btn btn-success">Chap sau →</a> 
					<?php endif; ?>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-4">
				<button class="btn btn-default btn-increase-font"><i class="fa fa-plus"></i> Chữ to</button>
				<button class="btn btn-default btn-decrease-font"><i class="fa fa-minus"></i> Chữ nhỏ</button>
				<button class="btn btn-default btn-style-dark"><i class="fa fa-moon-o"></i> Ban đêm</button>
				<button class="btn btn-default btn-style-light hidden"><i class="fa fa-sun-o"></i> Ban ngày</button>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-3">
				<div style="margin-top: 10px; display: inline-block;" class="clearfix">
					<div class="pull-left" style="margin-right: 10px;">
						<div class="fb-like" data-href="<?php the_permalink(); ?>" 
							data-layout="button_count" data-action="like" data-show-faces="true" data-share="true">
						</div>
					</div>
					<div class="pull-left">
						<div class="g-plusone" data-size="medium" data-href="<?php the_permalink(); ?>"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<style>
		.chapter-nav .dropdown-menu {
			display: block !important;
		}
		.chapter-nav .dropdown-menu.hidden {
			visibility: hidden;
		}
	</style>
	<script>
		jQuery(function($) {
			$('.chapter-nav .dropdown-toggle').click(function() {
				$(this).next().toggleClass('hidden');
			});
			$('.chapter-nav .dropdown-menu').scrollTop($('.chapter-nav .dropdown-menu .active').position().top);
			
			$('.btn-toggle-comment').on('click', function() {
				$('.chapter-comment').toggleClass('active');
			});
			$('.btn-increase-font').on('click', function() {
				$('.chapter-content').css({
					'font-size' : parseInt( $('.chapter-content').css('font-size') ) + 2 + 'px'
				});
			});
			$('.btn-decrease-font').on('click', function() {
				$('.chapter-content').css({
					'font-size' : parseInt( $('.chapter-content').css('font-size') ) - 2 + 'px'
				});
			});
			$('.btn-style-dark').on('click', function() {
				$('body').addClass('style-dark');
				$(this).addClass('hidden');
				$('.btn-style-light').removeClass('hidden');
			});
			$('.btn-style-light').on('click', function() {
				$('body').removeClass('style-dark');
				$(this).addClass('hidden');
				$('.btn-style-dark').removeClass('hidden');
			});
		});
	</script>
</div>
			
<script type="text/javascript">
	$(document).keydown(function(e) {
		var keypress = e.charCode ? e.charCode : e.keyCode;
		//37:left;
		//38:up, 
		//39:right;
		//40:down; 
		//65: A;
		//87:W ; 
		//68:D;
		//83:S
		if (keypress==39|| keypress==68) {
				window.location.href="<?php echo $next_prev['next']; ?>";
		} else {
			if(keypress==37||keypress==83) {
				window.location.href="<?php echo $next_prev['prev']; ?>";
			}
		}
	});
</script>
			
<?php get_footer(); ?>