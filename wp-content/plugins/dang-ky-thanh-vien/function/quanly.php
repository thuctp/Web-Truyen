<?php



function xoatin()
{
	if($_REQUEST)
	{
		$id=$_REQUEST['id'];
		global $wpdb;

		$sql="DELETE FROM ".$wpdb->prefix."tinnhan WHERE id=".$id;
		$result=$wpdb->get_var($sql);
		if($result==null)
		{
			echo "Xóa tin nhắn thành công";
		}
		else
		{
			echo 'Lỗi trong quá trình xóa';
		}
		//echo "aaaaaaaaa";
	}
	die();
}
add_action( 'wp_ajax_xoatin', 'xoatin' );
add_action( 'wp_ajax_nopriv_xoatin', 'xoatin' );	


























function capnhatuser()
{
	if($_REQUEST)
	{
				$id=$_REQUEST['id'];
				$email=$_REQUEST['email'];
				$matkhau_cu=$_REQUEST['matkhau_cu'];
				$matkhau_moi=$_REQUEST['matkhau_moi'];
				
				global $wpdb;
				
				$checkemail=checkemail($email);
				if($checkemail==0)
				{
							//$sql="UPDATE ".$wpdb->prefix."users SET user_email='".$email."',user_pass='".md5($matkhau_moi)."' WHERE ID=".$id;
							
							$chen=wp_update_user( array( 'ID' => $id, 'user_pass' => $matkhau_moi,'user_email'=>$email ) );
							if ( is_wp_error( $chen ) ) {
									echo "0";
								} else {
									echo "1";
								}	
							
				}
				
				elseif($checkemail!=0)
				{
					echo "Mail đã được sử dụng";
				}

		
	}
	die();
}
add_action( 'wp_ajax_capnhatuser', 'capnhatuser' );
add_action( 'wp_ajax_nopriv_capnhatuser', 'capnhatuser' );







function sl_tinnhan($user)
{
		global $wpdb;
		$sql="SELECT count(id) FROM ".$wpdb->prefix."tinnhan WHERE user='".$user."' ";
		$result=$wpdb->get_var($sql);
		if($result>0)
		{
			return $result;
		}
		else
		{
			return ;
		}
}

