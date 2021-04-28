<?php
/*Khai báo các widget*/
//  dynamic_sidebar('shortkhachsan');
if (function_exists('register_sidebar')) {
	
	register_sidebar(array(
		'name' 			=> 'Thể loại ở Sidebar',
		'id'   			=> 'widget-category',
		'description'   => 'Hiển thị thể loại ở sidebar',
		'before_widget' => '<section class="section section-category">',
		'after_widget'  => '</section>',
		'before_title'  => '<header class="section-header"><h2>',
		'after_title'   => '</h2></header>'
    ));
	
    register_sidebar(array(
		'name' 			=> 'Sidebar top ads',
		'id'   			=> 'sidebar-top-ads',
		'description'   => 'Hiển thị quảng cáo ở sidebar.',
		'before_widget' => '<div class="ads">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="hidden">',
		'after_title'   => '</span>'
	));
	
	register_sidebar(array(
		'name' 			=> 'Sidebar bottom ads',
		'id'   			=> 'sidebar-bottom-ads',
		'description'   => 'Hiển thị quảng cáo ở sidebar.',
		'before_widget' => '<div class="ads">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="hidden">',
		'after_title'   => '</span>'
	));
	
	register_sidebar(array(
		'name' 			=> 'Content top ads',
		'id'   			=> 'content-top-ads',
		'description'   => 'Hiển thị quảng cáo ở nội dung chính.',
		'before_widget' => '<div class="ads">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="hidden">',
		'after_title'   => '</span>'
	));
	
	register_sidebar(array(
		'name' 			=> 'Content bottom ads',
		'id'   			=> 'content-bottom-ads',
		'description'   => 'Hiển thị quảng cáo ở nội dung chính.',
		'before_widget' => '<div class="ads">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="hidden">',
		'after_title'   => '</span>'
	));
	
	register_sidebar(array(
		'name' => 'Filter danh sách truyện',
		'id'   => 'widget-filter',
		'description'   => 'Filter trang danh sách truyện.',
		'before_widget' => '<section class="widget-filter">',
		'after_widget'  => '</section>',
		'before_title'  => '',
		'after_title'   => ''
    ));
}