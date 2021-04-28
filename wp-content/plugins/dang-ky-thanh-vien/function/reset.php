<?php
function guimail_reset()
{
	if($_REQUEST)
	{	$rand=rand(100000,900000);
		$email=$_REQUEST['email'];
		$to=$email;
		$subject="Khôi phục mật khẩu";
		$message="Đây là mật khẩu của bạn :".$rand;
		$headers="Email từi từ ".home_url();
		
		global $wpdb;
		$select="SELECT * FROM ".$wpdb->prefix."thanhvien WHERE email='".$email."'";
		$check=$wpdb->get_results($select);
		if($check)
		{
			$update="UPDATE ".$wpdb->prefix."thanhvien SET pass='".md5($rand)."' WHERE email='".$email."'";
			$chen=$wpdb->get_var($update);
			if($chen==null)
			{	
				
				$guimail=wp_mail( $to, $subject, $message, $headers);
				if($guimail)
				{
					echo 'Gửi mail thành công';
				}
				else
				{
					echo 'Lỗi trong quá trình gửi mail';
				}
			}
			else
			{
				echo "Lỗi trong quá trình cập nhật";
			}
		}

		
	}
}
add_action('wp_ajax_nopriv_guimail_reset','guimail_reset');
add_action('wp_ajax_guimail_reset','guimail_reset');