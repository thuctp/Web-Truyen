<?php

add_action('admin_footer', 'my_admin_add_js');

function my_admin_add_js() {
	echo '<script language="javascript">
	url = document.URL;
	
	if(url.match(/(parent_chap)/ig)){
		tw_parent = url.split(\'parent_chap=\')[1];
		document.getElementsByClassName(\'page-title-action\')[0].href +=\'&id_story=\'+tw_parent;
	}
	
	if(url.match(/(action=edit)/ig)){
		tw_parent = document.getElementsByName(\'tw_parent\')[0].value;
		document.getElementsByClassName(\'page-title-action\')[0].href +=\'&id_story=\'+tw_parent;
		document.querySelector(\'#menu-posts\').classList.toggle(\'wp-has-current-submenu\');
		document.querySelector(\'#menu-posts a\').classList.toggle(\'wp-has-current-submenu\');
		document.querySelector(\'#menu-posts ul li a[href="'.get_site_url().'/wp-admin/edit.php?post_type=chap"]\').style=\'color:white;font-weight:600\';
	}
	
	if(url.match(/(post_type=chap)/ig)){
		document.querySelector(\'#menu-posts\').classList.toggle(\'wp-has-current-submenu\');
		document.querySelector(\'#menu-posts a\').classList.toggle(\'wp-has-current-submenu\');
		document.querySelector(\'#menu-posts ul li a[href="'.get_site_url().'/wp-admin/edit.php?post_type=chap"]\').style=\'color:white;font-weight:600\';
	}
	
	</script>';
	
	// JS COUNT ERROR REPORT
	if(wp_count_posts('error_report')->publish >= 1){
		echo '<script language="javascript"> document.querySelectorAll(\'a.menu-icon-error_report .wp-menu-name\')[0].innerHTML+=\' <span class="update-plugins">'.wp_count_posts('error_report')->publish.'</span>\'; </script>';
	}
}

?>