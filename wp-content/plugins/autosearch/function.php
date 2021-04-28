<?php function autosearch() {
?>
<script>
	jQuery(function($) {
		$('.search_story').on('input', function(e) {
			
			$(this).attr('autocomplete', 'off');
			if( $.trim( $(this).val() ) ) {
				var key = $(this).val();
				search(key, $(this).parent());	
			} else {
				$(this).parent().next().empty().hide();
			}
		});
		
	
		
		$('body').click(function(){
			$('.search-result').html('').hide();
		});
		
		function search(key, element) {
			element.next().css({
				'width'   :	element.outerWidth() + 3,
			});		 
			$.ajax({
				url:"<?php echo home_url()."/wp-admin/admin-ajax.php" ?>",

				data: {
					'action':'resultautosearch',
					'key' :key,
					 
				},
				success:function(data) {
					console.log(data);
					element.next().html(data).show();
				},
				error: function(errorThrown){
					console.log(errorThrown);
				}
			});											
		}
	});
</script>
					
<?php
}

function resultautosearch()
{
	if(isset($_REQUEST))
	{
		$key=$_REQUEST['key'];
		$arg=array(

			'post_per_page' => 10,
			'sortby' 		=>'name',
			'key'			=>$key

			);
		$list_truyen=danhsachtruyen($arg);
		if(isset($list_truyen))
		{	echo "<ul>";
			foreach ($list_truyen as $value) {
				$truyen=laytruyen_byid($value);
				$chuongmoi=laychuongmoi($value);

				
				?>
					<a href="<?php echo $truyen['slug']; ?>" title="<?php echo $truyen['name']; ?>">
					<li class="clearfix">
						<img class="comic-image" src="<?php echo $truyen['img']; ?>" alt="<?php echo $truyen['name']; ?>" class="thumbautosearch">
						<p class="comic-name"><?php echo $truyen['name']; ?></p>
						<p class="comic-chapter"><?php echo $chuongmoi['name']; ?></p>
					</li>
					</a>

				<?php
			}
			echo "</ul>";
		}
	}
	die();
}
add_action('wp_ajax_resultautosearch','resultautosearch' );
add_action('wp_ajax_nopriv_resultautosearch','resultautosearch' );
?>