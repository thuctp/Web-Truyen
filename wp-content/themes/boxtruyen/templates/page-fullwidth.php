<?php /* Template Name: Full width */ ?>
<?php get_header(); ?>
<?php
	$pid = get_the_ID();
	function get_info($id,$info){
		$result = get_post($id);
		$result = $result->$info;
		return $result;
	}
?>

<div class="container" id="truyen-slide" style="padding: 0px 15px">
    <h1 class="full-width-title"><?php echo get_info($pid,'post_title');?></h1>
    <div class="full-width-content">
    	<?php echo get_info($pid,'post_content');?>
    </div>
</div>

<?php get_footer();?>