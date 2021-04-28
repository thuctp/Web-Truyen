<?php 
function set_luotview($id)
{	date_default_timezone_set('Asia/Ho_Chi_Minh');
	global $wpdb;
	$check=check_id_view($id);
	if($check>0)
	{	$check++;
		$wpdb->update('wp_luotview_popular',array('last_viewed'=>date('Y-m-d H:i:s'),'pageviews'=>$check),array('postid'=>$id));
		//echo "cap nhat them moi"+$check;
		
	}
	else
	{
		$wpdb->insert('wp_luotview_popular',
		array('postid'=>$id,'day'=>date('Y-m-d H:i:s'),'last_viewed'=>date('Y-m-d H:i:s'))
		);
		
	}
	capnhat_luotview_day_week($id);
	
		
}

function check_id_view($id)
{
	global $wpdb;
	$select="SELECT pageviews FROM wp_luotview_popular Where postid=".$id;
	$result=$wpdb->get_results($select);
	if($result)
	{
		foreach($result as $res)
		{
			return $res->pageviews;
		}
	}
	return 0;
}

function list_top_all($num)
{	
	global $wpdb;
	$select="SELECT * FROM wp_luotview_popular order by pageviews DESC limit 0,".$num;
	$result=$wpdb->get_results($select);
	if($result)
	{
		//foreach($result as $res)
		{
			return $result;
		}
	}
	
	
}
function list_top_day($num)
{	date_default_timezone_set('Asia/Ho_Chi_Minh');
	global $wpdb;
	$select="SELECT pageview_day as pageviews,postid FROM wp_luotview_sumpopular WHERE last_viewed > '".date('Y-m-d')."' order by pageview_day DESC limit 0,".$num;
	
	$result=$wpdb->get_results($select);
	if($result)
	{
		//foreach($result as $res)
		{
			return $result;
		}
	}
	
	
}
function list_top_week($num)
{	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$thu2_week = date("Y-m-d",strtotime('monday this week'));
	$chunhat=date("Y-m-d",strtotime("sunday this week")); 
	global $wpdb;
	$select="SELECT pageview_week as pageviews,postid FROM wp_luotview_sumpopular WHERE last_viewed > '".$thu2_week."' order by pageview_week DESC limit 0,".$num;
	$result=$wpdb->get_results($select);
	if($result)
	{
		//foreach($result as $res)
		{
			return $result;
		}
	}
	
	
}

function list_top_month($num)
{	date_default_timezone_set('Asia/Ho_Chi_Minh');
	global $wpdb;
	$select="SELECT * FROM wp_luotview_popular WHERE last_viewed > DATE_SUB('".date('Y-m-d H:i:s')."', INTERVAL 1 MONTH) order by pageviews DESC limit 0,".$num;
	$result=$wpdb->get_results($select);
	if($result)
	{
		//foreach($result as $res)
		{
			return $result;
		}
	}
	
	
}



function capnhat_luotview_day_week($id)
{	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$thu2_week = date("Y-m-d",strtotime('monday this week'));
	$chunhat=date("Y-m-d",strtotime("sunday this week")); 
	$thu2_week_int=(int)strtotime($thu2_week);
	$chunhat_int=(int)strtotime($chunhat);
	
	$thoigianbatdaungay=strtotime(date('Y-m-d'));
	$thoigiankeththucngay=$thoigianbatdaungay+24*60*60;
	
	
	global $wpdb;
	
	$SELECT="SELECT * FROM wp_luotview_sumpopular where postid=".$id;
	
	$result=$wpdb->get_results($SELECT);
	if($result)
	{
		foreach($result as $res)
		{
			$luotxemtrongngay=$res->pageview_day;
			
			$luotxemtrongtuan=$res->pageview_week;
			
			$thoigianxemcuoicung=$res->last_viewed;
			$thoigianxemcuoicung_totime=(int)strtotime($thoigianxemcuoicung);
			
			$thoigianhientai=time();
			
			if($thoigianxemcuoicung_totime<$thoigianbatdaungay)/*bắt đầu đếm cho ngày mới*/
			{
				$wpdb->update('wp_luotview_sumpopular',array('last_viewed'=>date('Y-m-d H:i:s'),'pageview_day'=>1),array('postid'=>$id));
		
			}
			elseif($thoigianxemcuoicung_totime>=$thoigianbatdaungay)
			{
				$wpdb->update('wp_luotview_sumpopular',array('last_viewed'=>date('Y-m-d H:i:s'),'pageview_day'=>$luotxemtrongngay+1),array('postid'=>$id));
		
			}
			
			if($thoigianxemcuoicung_totime<$thu2_week_int)/*bắt đầu đếm tuần mới*/
			{
				$wpdb->update('wp_luotview_sumpopular',array('last_viewed'=>date('Y-m-d H:i:s'),'pageview_week'=>1),array('postid'=>$id));
		
			}
			elseif($thoigianxemcuoicung_totime>=$thu2_week_int)
			{
				$wpdb->update('wp_luotview_sumpopular',array('last_viewed'=>date('Y-m-d H:i:s'),'pageview_week'=>$luotxemtrongtuan+1),array('postid'=>$id));
		
			}
		}
	}else
	{
	
	$wpdb->insert('wp_luotview_sumpopular',
		array('postid'=>$id,'last_viewed'=>date('Y-m-d H:i:s'))
		);
	}
}

