	<div class="footer hahahahaahah">
		<div class="container">
			<div class="hidden-xs col-sm-5">
				<?php echo get_option('footer-comic'); ?>
			</div>
			<ul class="col-xs-12 col-sm-7 list-unstyled">
				<li class="text-right pull-right">
					<a title="Contact" href="<?php echo home_url(); ?>/contact/">Contact</a> - 
					<a title="Terms of Service" href="<?php echo home_url(); ?>/tos/">ToS</a>
					<a rel="nofollow" href="#" class="backtop">
                        <i class="fa fa-arrow-circle-up"></i>
                    </a>
				</li>
				<li class="hidden-xs tag-list">
					<?php 
						$args = array(
							'tieubieu'				=> 'on',
						);
						$danhsachtruyen=danhsachtruyen( $args );
						if($danhsachtruyen) :
						foreach ( $danhsachtruyen as $list_truyen) :
							$truyen=laytruyen_byid($list_truyen);
					?>
					<a href="<?php echo $truyen['slug']; ?>" title="<?php echo $truyen['name']; ?>">
						<?php echo $truyen['name']; ?>
					</a>
					<?php endforeach; endif; ?>
				</li>
			</ul>
		</div>
	</div>
	
	<?php wp_footer(); ?>
	
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	
	<script src="https://apis.google.com/js/platform.js" async defer>
		{lang: 'vi'}
	</script>
	
	<script type="text/javascript">
		jQuery(function($) {
			$('.select-hot-comic').on('change', function(e) {
				var term_id = $(this).val();
				$('.group-hot-comic').html('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
				$.ajax({
					type: 'GET',
					url: '<?php echo home_url(); ?>/wp-admin/admin-ajax.php',
					data: {
						action: 'load_hot_comic',
						term_id: term_id
					},
					beforeSend: function( jqXHR, settings ) {
						
					},
					success: function( data, textStatus, jqXHR ) {
						$('.group-hot-comic').html(data);
					},
					error: function( jqXHR, textStatus, errorThrown ) {
						alert( errorThrown );
					}
				});
			});
			
			$('.select-new-comic').on('change', function(e) {
				var term_id = $(this).val();
				$('.group-new-comic').html('<div class="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
				$.ajax({
					type: 'GET',
					url: '<?php echo home_url(); ?>/wp-admin/admin-ajax.php',
					data: {
						action: 'load_new_comic',
						term_id: term_id
					},
					beforeSend: function( jqXHR, settings ) {
					},
					success: function( data, textStatus, jqXHR ) {
						$('.group-new-comic').html(data);
					},
					error: function( jqXHR, textStatus, errorThrown ) {
						alert( errorThrown );
					}
				});
			});
		});
	</script>
</body>

</html>