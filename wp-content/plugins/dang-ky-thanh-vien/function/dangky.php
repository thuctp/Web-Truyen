<?php 
function list_cauhoi()
{	global $wpdb;
	$sql="SELECT * FROM ".$wpdb->prefix."cauhoi";
	$result=$wpdb->get_results($sql);
	if($result)
	{
		return $result;
	}
	return null;
}
function dangkythanhvien()
{	global $wpdb;
	if (isset($_REQUEST)) 
	{	session_start();
		$name=$_REQUEST['name'];
		$email=$_REQUEST['email'];
		$pass=$_REQUEST['pass'];
		


		$checkemail=checkemail($email);
		$checkname=checkname($name);
		if($checkemail==0&&$checkname==0)
		{
			/*	$result=$wpdb->insert(
					$wpdb->prefix."thanhvien",
					array(
						'name'=>$name,
						'pass'=>md5($pass),
						'email'=>$email,
						//'macauhoi'=>$macauhoi,

						//'traloi'=>$traloi,
						'tinhtrang'=>0

						)

					);
					*/
					$userdata = array(
						'user_login'    =>   $name,
						'user_email'    =>   $email,
						'user_pass'     =>   $pass,
						//'user_url'      =>   $website,
						//'first_name'    =>   $name,
						//'last_name'     =>   $last_name,
						'nickname'      =>   $name,
						//'description'   =>   $bio,
						);
					$result = wp_insert_user( $userdata );

				//$result=$wpdb->get_var($sql);
				if($result)
				{
					$_SESSION['tendangnhap']=$name;
					$_SESSION['idthanhvien']=$wpdb->insert_id;
					$_SESSION['matkhau']	=md5(md5($pass));
						echo "Đăng ký hoàn tất. cảm ơn bạn. Nhấn OK để về trang chủ";
					}
				else
				{
						echo "Đăng ký thất bại";
				}

			//echo $checkemail;
		}
		elseif($checkname>0)
		{
			echo "name_error";
		}
		elseif($checkemail>0)
		{
			echo "email_error";
		}

		
	}
	die();
}
add_action( 'wp_ajax_dangkythanhvien', 'dangkythanhvien' );
add_action( 'wp_ajax_nopriv_dangkythanhvien', 'dangkythanhvien' );	




function checkemail($email)
{
	//if($_REQUEST)
	//{
		global $wpdb;
		$sql="SELECT count(id) FROM ".$wpdb->prefix."users WHERE user_email='".$email."'";
		$result=$wpdb->get_var($sql);
		if($result>0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	//}
	//die();
}
//add_action( 'wp_ajax_checkemail', 'checkemail' );
//add_action( 'wp_ajax_nopriv_checkemail', 'checkemail' );	

function checkname($name)
{
	
		global $wpdb;
		$sql="SELECT count(id) FROM ".$wpdb->prefix."users WHERE user_login='".$name."'";
		$result=$wpdb->get_var($sql);
		if($result>0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	
}