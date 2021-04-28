<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	 <link rel="icon" type="image/png" href="<?php echo  get_option( 'favicon' ); ?>" />
	<meta property="og:url" content="<?php echo 'http://'. $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];?>" />
	<title><?php wp_title(); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   
	<link rel="image_src" type="image/jpeg" href="<?php if(is_category()) echo get_anhdaidien($cat);else echo get_option( 'logo-comic' ); ?>" />
	<meta property="og:image" content="<?php if(is_category()) echo get_anhdaidien($cat);else echo get_option( 'logo-comic' ); ?>" />

    <meta name="robots" content="index, follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.9.1.min.js"></script>
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
		
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	<div class="navbar navbar-default c-navbar-custom" role="navigation" id="navigation">
		<div class="container">
			<div class="pull-right" style="margin-top: 8px;">
				<?php if(function_exists('custom_thanhvien')) { custom_thanhvien(home_url('/dang-ky/'),home_url('/trang-thanh-vien/' ),home_url('/khoi-phuc-mat-khau/' ));} ?>
			</div>
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Hiện menu</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<h1 class="header-logo">
					<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo get_option('logo_alt-comic')?>">
<!--						todo add logo for website-->
					</a>
				</h1>
			</div>
			
			<div class="navbar-collapse collapse">
				
				<?php
				$defaults = array(
					'theme_location'  => 'primary',
					'container'       => false,
					'menu_class'      => 'control nav navbar-nav menu-header',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				);
				wp_nav_menu( $defaults );
				?>
				
				<script type="text/javascript">
					jQuery(function($) {
						$('.menu-header').children('li').each(function() {
							if( $(this).children('.sub-menu').length ) {
								$(this).addClass('dropdown');
								$(this).children('a')
									.addClass('dropdown-toggle')
									.attr({'data-toggle' : 'dropdown'})
									.prepend('<span class="glyphicon glyphicon-list"></span>')
									.append('<span class="caret"></span>');
								$(this).children('.sub-menu').addClass('dropdown-menu').attr({'role' : 'menu'});
							}
						});
					});
				</script>
				
				<?php if( is_single() ) : ?>
				<div class="dropdown setting">
					<a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0)"><i class="fa fa-cog"></i> Tùy chỉnh <span class="caret"></span></a>
					<div class="dropdown-menu dropdown-menu-right">
						<form class="form-horizontal">
							<div class="form-group form-group-sm">
								<label for="truyen-background" class="col-sm-2 col-md-5 control-label">Màu nền</label>
								<div class="col-sm-5 col-md-7">
									<select id="truyen-background" class="form-control">
										<option value="#F4F4F4">Xám nhạt</option>
										<option value="#EAE4D3">Màu sepia</option>
										<option value="#FFFFE5">Vàng nhạt</option>
										<option value="#FAFAC8">Vàng đậm</option>
										<option value="#EFEFAB">Vàng ố</option>
										<option value="#FFF">Màu trắng</option>
										<option value="#232323">Màu tối</option>
									</select>
								</div>
							</div>
							<div class="form-group form-group-sm">
								<label for="font-chu" class="col-sm-2 col-md-5 control-label">Font chữ</label>
								<div class="col-sm-5 col-md-7">
									<select id="font-chu" class="form-control">
										<option value="'Palatino Linotype', sans-serif">Palatino Linotype</option>
										<option value="'Segoe UI', sans-serif">Segoe UI</option>
										<option value="Roboto, sans-serif">Roboto</option>
										<option value="'Roboto Condensed', sans-serif">Roboto Condensed</option>
										<option value="'Patrick Hand', sans-serif">Patrick Hand</option>
										<option value="'Noticia Text', sans-serif">Noticia Text</option>
										<option value="'Times New Roman', sans-serif">Times New Roman</option>
										<option value="Verdana, sans-serif">Verdana</option>
										<option value="Tahoma, sans-serif">Tahoma</option>
										<option value="Arial, sans-serif">Arial</option>
									</select>
								</div>
							</div>
							<div class="form-group form-group-sm">
								<label for="size-chu" class="col-sm-2 col-md-5 control-label">Size chữ</label>
								<div class="col-sm-5 col-md-7">
									<select id="size-chu" class="form-control">
										<option value="16px">16</option>
										<option value="18px">18</option>
										<option value="20px">20</option>
										<option value="22px">22</option>
										<option value="24px">24</option>
										<option value="26px">26</option>
										<option value="28px">28</option>
										<option value="30px">30</option>
										<option value="32px">32</option>
										<option value="34px">34</option>
										<option value="36px">36</option>
										<option value="38px">38</option>
										<option value="40px">40</option>
									</select>
								</div>
							</div>
							<div class="form-group form-group-sm">
								<label for="line-height" class="col-sm-2 col-md-5 control-label">Chiều cao dòng</label>
								<div class="col-sm-5 col-md-7">
									<select id="line-height" class="form-control">
										<option value="100%">100%</option>
										<option value="120%">120%</option>
										<option value="140%">140%</option>
										<option value="160%">160%</option>
										<option value="180%">180%</option>
										<option value="200%">200%</option>
									</select>
								</div>
							</div>
							<div class="form-group form-group-sm">
								<label class="col-sm-2 col-md-5 control-label">Full khung</label>
								<div class="col-sm-5 col-md-7">
									<label for="fluid-yes" class="radio-inline">
										<input type="radio" value="yes" id="fluid-yes" name="fluid-switch"> Có
									</label>
									<label for="fluid-no" class="radio-inline">
										<input type="radio" checked="" value="no" id="fluid-no" name="fluid-switch"> Không
									</label>
								</div>
							</div>
							<div class="form-group form-group-sm">
								<label class="col-sm-2 col-md-5 control-label">Không cách đoạn</label>
								<div class="col-sm-5 col-md-7">
									<label for="onebreak-yes" class="radio-inline">
										<input type="radio" value="yes" id="onebreak-yes" name="onebreak-switch"> Có
									</label>
									<label for="onebreak-no" class="radio-inline">
										<input type="radio" checked="" value="no" id="onebreak-no" name="onebreak-switch"> Không
									</label>
								</div>
							</div>
						</form>
					</div>
				</div>
				<?php endif; ?>
				
				<?php if( function_exists('autosearch') ) { autosearch(); } ?>
				<form class="navbar-form navbar-right" action="<?php echo esc_url( home_url('/') ); ?>" method="get">
					<div class="input-group">
						<input class="form-control search_story search-input" type="text" name="s" placeholder="Tìm kiếm..." value="<?php echo get_search_query(); ?>">
				   
					<div class="input-group-btn">
						<button class="btn btn-default btn-search" type="submit"><span class="fa fa-search"></span></button>
					</div>
					</div>
					<div class="search-result"></div>
				</form>
			</div>
		</div>
	</div>