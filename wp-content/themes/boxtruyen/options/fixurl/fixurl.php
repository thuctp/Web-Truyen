<?php
function a_qoute_admin_action(){
    add_submenu_page(
        'theme-option',
        'Sửa URL chương',
        'Sửa URL chương',
        'edit_themes',
        'fix_chap_url',
        'fix_chap_url'
    );
}
add_action('admin_menu', 'a_qoute_admin_action');

function fix_chap_url(){
	
	$count = wp_count_posts('chap');
	$count = $count->publish;

	if(!$_GET['request']){
		echo '
			<div class="wrap">
				<h2>Sửa URL chương</h2>	
				<div style="margin-bottom: 15px">Hãy sử dụng chức năng này để kiểm tra và sửa lỗi URL các chương khi bạn nâng cấp phiên bản mới.</div>
				<script language="javascript" src="'.get_template_directory_uri().'/js/jquery.js"></script>
				<p>
					Tốc độ: 
					<select name="request" id="request" style="height: 30px" onchange="tips()">
						<option value="200">200</option>
						<option value="300">300</option>
						<option value="400">400</option>
						<option value="500">500</option>
					</select>
					<button type="button" name="action" id="submit" class="button button-primary" value="run" onclick="crun(0)">Kiểm tra lỗi</button>
					<button type="button" name="action" id="submit2" class="button button-primary" value="run" onclick="frun(0)">Chạy trình sửa</button>
					<span id="tips"><b style="color:limegreen">Hoạt động tốt</b></span>
				</p>
				<table style="background: white; max-width: 200px; width: 100%; padding: 5px 10px; border: 1px solid #0073aa;">
					<tr><td align="right" width="50%"><b>Chương:</b></td><td><span id="chuong">'.$count.'</span></td></tr>
					<tr><td align="right" width="50%"><b>Đã quét:</b></td><td><span id="quet">0</span></td></tr>
					<tr><td align="right" width="50%"><b id="dasua">Đã sửa lỗi:</b></td><td><span id="count">0</span></td></tr>
				</table>
				<p>
					<a href="" class="button button-primary chaylai" style="display:none">Chạy lại trình sửa</a>
				</p>
				<div class="iframe" style="display:none"></div>
				<div class="result"></div>
				<div id="load" style="display:none"></div>
			</div>
			<script language="javascript">
				function tips(){
					request = $("#request option:selected").val();
					if(request == 200){
						$("#tips").html("<b style=\'color:limegreen\'>Hoạt động tốt</b>");
					}
					else if(request > 200 && request < 500){
						$("#tips").html("<b style=\'color:limegreen\'>Ổn định</b>");
					}
					else{
						$("#tips").html("<b style=\'color:darkgoldenrod\'>Không ổn định</b>");
					}
				}
				function crun(so){
					$("#dasua").html("Phát hiện lỗi:");
					request = $("#request option:selected").val();
					$("#submit").hide(); $("#submit2").hide();
					$("#load").load("?page=fix_chap_url&request="+request+"&so="+so,function(data){
						$("#load").html(""); // Xóa data ở div#load
						$("#quet").html(so); // Gán số quét
						chuong = $("#chuong").html();
						count = $("#count").html(); // Số chương lỗi được phát hiện
						phathien = $(data).find(".phathien").first().html(); // Số chương lỗi được phát hiện mỗi lần
						$("#count").html(count * 1 + phathien * 1); // Cộng số chương lỗi được phát hiện
						data = $(data).find(".loichuong").html();
						if(phathien > 0){
							$(".result").append(data); // Gán HTML vào div.result
						}
						if(so > chuong){
							$("#quet").html(chuong);
							$(".chaylai").show();
							return;
						}
						so = so * 1 + request * 1;
						setTimeout(function(){
							crun(so);
						},1000);
					});
				}
				function frun(so){
					request = $("#request option:selected").val();
					$("#submit").hide(); $("#submit2").hide();
					$("#load").load("?page=fix_chap_url&request="+request+"&so="+so,function(data){
						$("#load").html(""); // Xóa data ở div#load
						$(".iframe").append("<iframe src=\'?page=fix_chap_url&action=run&request="+request+"&so="+so+"\'></iframe>");
						$("#quet").html(so); // Gán số quét
						chuong = $("#chuong").html();
						phathien = $(data).find(".phathien").first().html(); // Số chương lỗi được phát hiện mỗi lần
						count = $("#count").html(); // Số chương đã sửa lỗi
						$("#count").html(count * 1 + phathien * 1); // Cộng số chương đã sửa lỗi
						data = $(data).find(".loichuong").html();
						if(phathien > 0){
							$(".result").html(data); // Gán HTML vào div.result
						}
						if(so > chuong){
							$("#quet").html(chuong);
							$(".chaylai").show();
							return;
						}
						so = so * 1 + request * 1;
						setTimeout(function(){
							frun(so);
						},1000);
					});
				}
			</script>
		';
	}
	else {
		global $wpdb;
		$request = $_GET['request'] ? $_GET['request'] : 200;
		$so = $_GET['so'] ? $_GET['so'] : 0;
		$chaps = $wpdb->get_results( 
			"
			SELECT ID
			FROM $wpdb->posts
			WHERE post_type = 'chap' AND post_status = 'publish' LIMIT ".$so.", ".$request."
			"
		);
		
		$items = [];
		
		foreach ( $chaps as $chap ) 
		{
			$chap = get_post($chap->ID);
			$parent = get_post($chap->post_parent);
			
			if(!preg_match('/'.$parent->post_name.'/',$chap->post_name)) {
				$items[] = $chap->ID;
			}
		}
	
	echo '<div class="loichuong"><table class="wp-list-table widefat fixed striped tags">
			    <thead>
			        <tr>
			            <th scope="col" id="description" class="manage-column column-description sortable desc"><a style="color:#23282d"><span>Phát hiện thêm: <b class="phathien">'.count($items).'</b> chương lỗi</span></a></th>
			            <th scope="col" id="slug" class="manage-column column-slug sortable desc"><a style="color:#23282d"><span>Chuỗi cho đường dẫn tĩnh</span></a></th>
			        </tr>
			    </thead>
			
			    <tbody id="the-list" data-wp-lists="list:tag">';
			    if(is_array($items)){
				    foreach($items as $key => $id){
				     echo '<tr id="chap_'.$id.'">
				            <td class="name column-name has-row-actions column-primary" data-colname="Chương">
				            	<strong><a class="row-title" href="'.get_edit_post_link($id).'" target="_blank">'.get_the_title($id).'</a></strong>
				            </td>
				            <td class="slug column-slug" data-colname="Chuỗi cho đường dẫn tĩnh">'.get_post($id)->post_name.'</td>
				        </tr>';
				    }
			    }
		      echo '</tbody>
			    <tfoot>
			        <tr>
			            <th scope="col" id="description" class="manage-column column-description sortable desc"><a style="color:#23282d"><span>Phát hiện thêm: <b>'.count($items).'</b> chương lỗi</span></a></th>
			            <th scope="col" id="slug" class="manage-column column-slug sortable desc"><a style="color:#23282d"><span>Chuỗi cho đường dẫn tĩnh</span></a></th>
			        </tr>
			    </tfoot>
			</table></div>';
	
	
		if($_GET['action'] == 'run'){
			if(is_array($items)){
				foreach($items as $key => $id){
					$chap = get_post($id); echo $id;
					$chap_title = preg_replace('/[^A-Za-z0-9\-]/', '', sanitize_title($chap->post_title));
					$parent = get_post($chap->post_parent);
					$update_args = array(
					    'ID' => $id,
					    'post_name' => $parent->post_name.'-'.$chap_title,
					);
					wp_update_post($update_args);
				}
			}
		}
	}
	
}