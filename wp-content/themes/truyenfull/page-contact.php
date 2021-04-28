<?php
	/**
	Template Name: Liên hệ
	**/
?>

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
			<div class="row page-contact">
				<div class="col-md-8">
					<noscript><div class="alert alert-danger">Bạn cần bật javascript để sử dụng form liên hệ</div></noscript>
					<form class="form-contact">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Tên</label>
									<input type="text" required="required" placeholder="Tên của bạn" name="name" id="name" class="form-control">
								</div>
								<div class="form-group">
									<label for="email">Email</label>
									<div class="input-group">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-envelope"></span>
										</span>
										<input type="email" placeholder="Địa chỉ email của bạn" name="email" id="email" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label for="subject">Chủ đề</label>
									<select required="required" class="form-control" name="subject" id="subject">
										<option selected="selected" value="">Chọn một</option>
										<option value="Góp ý">Góp ý</option>
										<option value="Báo lỗi">Báo lỗi</option>
										<option value="Quảng cáo">Quảng cáo</option>
										<option value="Khác">Khác</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="content">Nội dung</label>
									<textarea placeholder="Nội dung liên hệ" required="required" cols="25" rows="8" class="form-control" id="content" name="content"></textarea>
								</div>
								<div class="form-group text-right">
									<button class="btn btn-primary" type="submit">Gửi</button>
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group lead hidden notice-contact">
									<i class="fa fa-spinner fa-spin"></i>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-4">
					<fieldset>
						<legend><span class="glyphicon glyphicon-globe"></span> Thông tin liên hệ</legend>
						<div>
							<strong><?php bloginfo('name'); ?></strong><br>
							<strong>Email:</strong> <a href="mailto:<?php echo get_option('admin_email'); ?>"><?php echo get_option('admin_email'); ?></a><br>
							<strong>Facebook:</strong> <a rel="nofollow" target="_blank" title="Facebook <?php bloginfo('name'); ?>" href="<?php echo get_option('facebook')?>"><?php echo get_option('facebook')?></a>
						</div>
					</fieldset>
				</div>
			</div>
		</div>
	</section>
</div>		
			
<?php get_footer(); ?>

<script type="text/javascript">
	jQuery(function($) {
		$('.form-contact .btn').on('click', function(e) {
			e.preventDefault();
			
			var parent = $(this).parents('.form-contact');
			var data = '';
			$.each( parent.serializeArray(), function() {
				data += this.name + '=' + this.value + '&';
			});
								
			$('.notice-contact').removeClass('hidden').html('<i class="fa fa-spinner fa-spin"></i>');
			$.ajax({
				type: 'POST',
				url: '<?php echo home_url(); ?>/wp-admin/admin-ajax.php',
				data: data + '&action=request_contact',
				beforeSend: function( jqXHR, settings ) {
					
				},
				success: function( data, textStatus, jqXHR ) {
					$('.notice-contact').html( '<div class="alert alert-info">' + data + '</div>');
				},
				error: function( jqXHR, textStatus, errorThrown ) {
					alert( errorThrown );
				}
			});
		});
	});
</script>