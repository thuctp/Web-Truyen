<?php
/*
Plugin Name: Quản lý thành viên
Version: 1.0


*/
?>
<?php
if( ! defined( 'ABSPATH' ) ) exit;
define ( 'THANHVIEN_DIR', plugin_dir_path(__FILE__) );
define ( 'THANHVIEN_URL', plugin_dir_url(__FILE__) );

function tao_bang_dangkythanhvien()
{
	global $wpdb;
	$sql=	"CREATE TABLE  ".$wpdb->prefix."thanhvien (
					  id int(10) NOT NULL AUTO_INCREMENT,
					  name varchar(250) NOT NULL,
					  pass varchar(250) NOT NULL,
					  email varchar(250) NOT NULL,
					  macauhoi int(10) NOT NULL,
					  traloi varchar(250) NOT NULL,
					  tinhtrang int(10) NOT NULL COMMENT '0:binh thuong,1: khoa',
					  PRIMARY KEY (id)
			)";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

register_activation_hook( __FILE__, 'tao_bang_dangkythanhvien' );

function tao_bang_theodoi()
{
	global $wpdb;
	$sql=	"CREATE TABLE  ".$wpdb->prefix."theodoi (
					    id int(10) NOT NULL AUTO_INCREMENT,
						  user int(10) NOT NULL,
						  truyen int(10) NOT NULL,
						  chuong int(10) NOT NULL,
						   tinhtrang int(10) NOT NULL,
						  PRIMARY KEY (id)
			)";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

register_activation_hook( __FILE__, 'tao_bang_theodoi' );

function tao_bang_tinnhan()
{
	global $wpdb;
	$sql=	"CREATE TABLE  ".$wpdb->prefix."tinnhan (
					     id int(10) NOT NULL AUTO_INCREMENT,
 				 		user int(10) NOT NULL,
					  noidung text NOT NULL,
					  tinhtrang int(10) NOT NULL DEFAULT '0' COMMENT '0:chua,1:roi',
					 ngaythang timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
					  PRIMARY KEY (id)
			)";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

register_activation_hook( __FILE__, 'tao_bang_tinnhan' );


function tao_bang_cauhoi()
{
	global $wpdb;
	$sql=	"CREATE TABLE  ".$wpdb->prefix."cauhoi (
					  id int(10) NOT NULL AUTO_INCREMENT,
					  noidung varchar(250) NOT NULL,
					  PRIMARY KEY (id)
			)
			
		";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

register_activation_hook( __FILE__, 'tao_bang_cauhoi' );
/*
function inser_bang_cauhoi()
{
	global $wpdb;
	


	$sql="INSERT INTO ".$wpdb->prefix."cauhoi (id, noidung) VALUES (1, 'Bạn tên gì?')";
	$sql.="INSERT INTO ".$wpdb->prefix."cauhoi (id, noidung) VALUES (2, 'Nhà bạn ở đâu?')";
	$sql.="INSERT INTO ".$wpdb->prefix."cauhoi (id, noidung) VALUES (3, 'Bạn bao nhiêu tuổi?')";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

register_activation_hook( __FILE__, 'insert_bang_cauhoi' );

*/






/*Gọi form đăng ký*/
require_once THANHVIEN_DIR .  "form/form_dk.php";
/*Gọi form đăng nhập*/
require_once THANHVIEN_DIR .  "form/form_dangnhap.php";
/*Gọi form quên mật khẩu*/
require_once THANHVIEN_DIR .  "form/form_reset.php";
/*Gọi hàm xử lý đăng ký*/
require_once THANHVIEN_DIR .  "function/dangky.php";

/*Gọi trang quản lý thành viên*/
require_once THANHVIEN_DIR .  "quanly/quanly.php";
require_once THANHVIEN_DIR .  "quanly/list_thanhvien.php";
//require_once THANHVIEN_DIR .  "quanly/sua_user.php";
require_once THANHVIEN_DIR .  "function/quanly.php";
require_once THANHVIEN_DIR .  "function/thongtinthanhvien.php";
require_once THANHVIEN_DIR .  "function/theodoitruyen.php";
require_once THANHVIEN_DIR .  "function/reset.php";



function thanhvien_scripts()
{
	wp_enqueue_script( 'thanhvien-js',THANHVIEN_URL .'js/thanhvien.js');
	
	wp_enqueue_style( 'thanhvien-css',THANHVIEN_URL .'css/thanhvien.css');
	$localize = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	);
	wp_localize_script('thanhvien-js', 'THANHVIEN_AJ', $localize);
}
add_action( 'admin_enqueue_scripts', 'thanhvien_scripts');
add_action( 'wp_enqueue_scripts', 'thanhvien_scripts', 15 );

function thanhvien_scripts_theme()
{
	wp_enqueue_script( 'jquery-js',THANHVIEN_URL .'js/jquery-1.9.1.min.js');	
}
add_action( 'wp_enqueue_scripts', 'thanhvien_scripts_theme'); 





function custom_thanhvien($link_dangky,$link_thongtin,$link_reset)
{
	session_start();
?>
	<div class="user-menu">
	
		<?php
		
		if(is_user_logged_in()) :
			$user_id = get_current_user_id();
			$current_user = wp_get_current_user();
		
			//checktaikhoan($_SESSION['idthanhvien'],$_SESSION['matkhau']);
			$sl_tinnhan=sl_tinnhan($user_id);
			
			if($sl_tinnhan==0) {
				$info = "Bạn không có thông báo nào từ hệ thống!";
			} else {
				$info = "Bạn có ".$sl_tinnhan." thông báo từ hệ thống";
			}
		?>
		
		<a class="username icon" href="<?php echo $link_thongtin; ?>#user">
			<i class="fa fa-user"></i>
			<?php echo $current_user->display_name; ?>
		</a>
		<a class="userinfo icon" href="<?php echo $link_thongtin; ?>#user" data-toggle="popover" data-trigger="hover focus" data-html="true" data-placement="bottom" data-content='<?php esc_attr( showtabs( $user_id, $link_thongtin ) ); ?>'>
			<i class="fa fa-gear"></i>
			Cấu hình
		</a>
			
		<?php else: ?>
		
		<button class="btn btn-primary" data-toggle="modal" data-target="#modal-login-register">Đăng nhập / Đăng ký</button> 
		
		<?php endif; ?>
	
	</div>

	<?php
	form_dangnhap($link_dangky,$link_reset);
}
function thoatthanhvien()
{	session_start();
	if($_REQUEST)
	{
		unset($_SESSION['tendangnhap']);
		unset($_SESSION['idthanhvien']);
		unset($_SESSION['matkhau']);
		echo "Thoát";
	}
	die();
}
add_action('wp_ajax_thoatthanhvien','thoatthanhvien' );
add_action('wp_ajax_nopriv_thoatthanhvien','thoatthanhvien' );


function checktaikhoan($id,$matkhau)
{		session_start();
		global $wpdb;
		$select="SELECT * FROM ".$wpdb->prefix."thanhvien WHERE id='".$id."'";
		$check=$wpdb->get_results($select);
		if($check)
		{
			foreach ($check as  $value) {
				
				if(md5($value->pass)!=$matkhau)
				{	unset($_SESSION['tendangnhap']);
					unset($_SESSION['idthanhvien']);
					unset($_SESSION['matkhau']);
			

					
					?>
						<script type="text/javascript">
						alert('Tài khoản truy cập không đúng.');
						window.location.href="";
						</script>

					<?php
				}
			}
		}

}

function showtabs( $user_id, $link_thongtin ) {	
//$user_id = get_current_user_id();
			$current_user = wp_get_current_user();
		
			//checktaikhoan($_SESSION['idthanhvien'],$_SESSION['matkhau']);
			$sl_tinnhan=sl_tinnhan($user_id);
?>

<ul class="nav nav-pills nav-justified">
	<li class="active"><a data-toggle="pill" href="#tab-config">Cấu hình chung</a></li>
	<li><a data-toggle="pill" href="#tab-follow">Truyện theo dõi</a></li>
</ul>

<div class="tab-content">
	<div id="tab-config" class="tab-pane fade in active text-center clearfix">
		<a class="message icon" href="<?php echo $link_thongtin; ?>#info" title="Thông báo">
			<i class="fa fa-envelope-o"></i>
			<sup><?php echo $sl_tinnhan; ?></sup>
		</a>
		<a class="username icon" href="<?php echo $link_thongtin; ?>#user" title="Thông tin người dùng">
			<i class="fa fa-user"></i>
			<?php echo $current_user->display_name; ?>
		</a>
		<a class="change-password icon" href="<?php echo $link_thongtin; ?>#password" title="Đổi mật khẩu">
			<i class="fa fa-edit"></i>
		</a>
		<a class="logout icon"	href="<?php echo wp_logout_url( home_url() ); ?>"title="Thoát">
			<i class="fa fa-power-off"></i>
		</a>
	</div>
	<div id="tab-follow" class="tab-pane fade">
		<?php echo esc_attr( danhsachtheodoi( $user_id ) ); ?>
	</div>
</div>

<?php
} 
?>

