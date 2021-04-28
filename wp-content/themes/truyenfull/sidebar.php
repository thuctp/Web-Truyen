<?php dynamic_sidebar('widget-category'); ?>

<?php dynamic_sidebar('sidebar-top-ads'); ?> 

<section class="section">
	<header class="section-header">
		<h2>Truyện đang hot</h2>
	</header>
	<div class="section-content">
		<ul class="nav nav-tabs nav-rank" role="tablist">
			<li class="nav-item active"><a class="nav-link" href="#top-day" role="tab" data-toggle="tab">Ngày</a></li>
			<li class="nav-item"><a class="nav-link" href="#top-month" role="tab" data-toggle="tab">Tháng</a></li>
			<li class="nav-item"><a class="nav-link" href="#top-alltime" role="tab" data-toggle="tab">All Time</a></li>
		</ul>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="top-day">
				<?php 
				$list_top=list_top_day(10); 
				if($list_top) :
					$stt=0;
					foreach($list_top as $top) :
						$stt++;	
				?>
				<div class="top-item">
					<div class="top-num top-<?php echo $stt; ?>"><?php echo $stt; ?></div>
					<div class="s-title">
						<h3><a title="<?php echo get_cat_name($top->postid);?>" href="<?php echo get_term_link(get_term($top->postid,'category')); ?>"><?php echo get_cat_name($top->postid);?></a></h3>
					</div>
					<div><?php echo laytheloai( $top->postid ); ?></div>
				</div>
				<?php
					endforeach;
				endif;
				?>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="top-month">
				<?php 
				$list_top=list_top_month(10); 
				if($list_top) :
					$stt=0;
					foreach($list_top as $top) :
						$stt++;	
				?>
				<div class="top-item">
					<div class="top-num top-<?php echo $stt; ?>"><?php echo $stt; ?></div>
					<div class="s-title">
						<h3><a title="<?php echo get_cat_name($top->postid);?>" href="<?php echo get_term_link(get_term($top->postid,'category')); ?>"><?php echo get_cat_name($top->postid);?></a></h3>
					</div>
					<div><?php echo laytheloai( $top->postid ); ?></div>
				</div>
				<?php
					endforeach;
				endif;
				?>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="top-alltime">
				<?php 
				$list_top=list_top_all(10); 
				if($list_top) :
					$stt=0;
					foreach($list_top as $top) :
						$stt++;	
				?>
				<div class="top-item">
					<div class="top-num top-<?php echo $stt; ?>"><?php echo $stt; ?></div>
					<div class="s-title">
						<h3><a title="<?php echo get_cat_name($top->postid);?>" href="<?php echo get_term_link(get_term($top->postid,'category')); ?>"><?php echo get_cat_name($top->postid);?></a></h3>
					</div>
					<div><?php echo laytheloai( $top->postid ); ?></div>
				</div>
				<?php
					endforeach;
				endif;
				?>
			</div>
		</div>
	</div>
</section>

<?php dynamic_sidebar('sidebar-bottom-ads'); ?> 


	
	