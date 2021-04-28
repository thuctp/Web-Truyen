<?php 
require_once( dirname( __FILE__ ) . '/inc/ajax.php' );

function manga_setup() {
	// Declare support for title theme feature
	add_theme_support( 'title-tag' );
	
	// This theme uses wp_nav_menu() in header.
	register_nav_menus( array(
		'primary'		=> 'Navigation',
	) );
}
add_action( 'after_setup_theme', 'manga_setup' );

/**
 * Enqueue scripts and styles.
 */
function manga_scripts() {
	wp_deregister_script( 'jquery');	
	
	wp_enqueue_style( 'manga-theme-css', get_stylesheet_directory_uri() . '/css/theme.min.css' );	
	wp_enqueue_style( 'manga-font-awesome-css', get_stylesheet_directory_uri() . '/css/font-awesome.min.css' );	
	wp_enqueue_style( 'manga-css', get_stylesheet_uri() );
	wp_enqueue_style( 'manga-common-css', get_stylesheet_directory_uri() . '/css/common.css' );
	wp_enqueue_style( 'manga-post-css', get_stylesheet_directory_uri() . '/css/post.css' );
    wp_enqueue_style( 'manga-custom-theme-css', get_stylesheet_directory_uri() . '/custom-theme/main.css' );

	wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'manga-bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js');
	wp_enqueue_script( 'manga-cookie-js', get_stylesheet_directory_uri() . '/js/js.cookie.js');
	wp_enqueue_script( 'manga-common-js', get_stylesheet_directory_uri() . '/js/common.js');
}
add_action( 'wp_enqueue_scripts', 'manga_scripts', 15 );

add_action( 'template_redirect', 'redirect_post_grap' );

function redirect_post_grap()
 {
  $queried_post_type = get_query_var('post_type');
  if ( is_single() && 'grap_truyen' ==  $queried_post_type ) {
    wp_redirect( home_url());
    exit;
  }
}


	function thumb_img($src,$h,$w,$q){ //lấy ảnh dùng link
	    echo bloginfo('template_url');
	    echo '/timthumb.php?src='.$src.'&amp;h='.$h.'&amp;w='.$w.'&amp;q='.$q;
	}
	
	/* Cắt word*/
	function truncate($string, $length) {	    
		return ( strlen($string) > $length ) ? substr( $string, 0, strpos($string, ' ', $length) ) . '...' : $string;
	}
	
	
	function my_admin_scripts() {
  wp_enqueue_script('media-upload');
  wp_enqueue_script('thickbox');
  wp_register_script('my-upload', get_template_directory_uri().'/library/js/my_js.js', array('jquery','media-upload','thickbox'));
  wp_enqueue_script('my-upload');
  
}

function my_admin_styles() {

    wp_enqueue_style('thickbox');
}
add_filter('show_admin_bar', '__return_false');

add_theme_support( 'post-thumbnails' );

add_action('template_redirect', 'readtruyen_setcookie');
function readtruyen_setcookie() {
    if (is_singular()){
    	$truyen = laytruyen(get_the_ID()); 
    	$idtruyen=$truyen['id'];
        if(isset($_COOKIE['read_truyen'])){
            $read = $_COOKIE['read_truyen'];
            $ary_read = unserialize($read);
            
           // $ary_read_new = array();
            $pos_truyen_old=pos_truyen_old($idtruyen);
            unset($ary_read[$pos_truyen_old]);
            
            $ary_read[][$idtruyen]=get_the_ID();
            $str_read = serialize($ary_read);
            setcookie('read_truyen', $str_read, time()+(86400 * 7), '/');    
            
           /* if(!empty($ary_read) && is_array($ary_read)){
                if(!in_array(get_the_ID(), $ary_read)){
                    $ary_read[] = (int)get_the_ID();
                    $str_read = serialize($ary_read);
                    setcookie('read_truyen', $str_read, time()+(86400 * 7), '/');    
                }
            }else{
                if((int)get_the_ID() != $read){
                    $ary_read_new[] = get_the_ID();
                    $ary_read_new[] = (int)$read;
                    $str_read = serialize($ary_read_new);
                    setcookie('read_truyen', $str_read, time()+(86400 * 7), '/');    
                }
            }

            */    
        }else{
        	$array_star_read=array();
        	$array_star_read[0][$idtruyen]=get_the_ID();
        	$str_read=serialize($array_star_read);
            setcookie('read_truyen', $str_read, time()+(86400 * 7), '/');
        }
    }
}

function pos_truyen_old($idtruyen) {
	if(isset($_COOKIE['read_truyen'])){
		$read = $_COOKIE['read_truyen'];
		$ary_read = unserialize($read);
		foreach ($ary_read as $key => $value) 
		{
			foreach ($value as $key_2 => $value_2)
			{
				if($key_2==$idtruyen)
				{
					return $key;
				}
			}
		}

	}
	return -1;
}
?>