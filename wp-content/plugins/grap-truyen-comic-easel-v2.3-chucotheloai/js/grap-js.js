jQuery(document).ready(function(){

	/*==========  Khi click nút kiểm tra  ===========*/
	jQuery('.check-grap').click(function(){
		alert("thongbao");

		/*jQuery('.grap-spinner').hide().css('display','inherit').fadeIn('slow');
		jQuery('.grap-result').empty();
		jQuery('.grap-result-single').empty();

		var checked = jQuery('.grab-check-title input[type="checkbox"]').is(":checked");
		var ten_truyen;
		if (checked == true){
			var ten_truyen = jQuery('.grab-select-title .select2-choice .select2-chosen').text();
		}
		
		var checked_truyen_ngan =  jQuery('.truyen_co_nhieu_chap input[type="checkbox"]').is(":checked");

		// alert(checked_truyen_ngan);
		var truyen_co_nhieu_chap;
		if (checked_truyen_ngan == true){
			truyen_co_nhieu_chap = 1;
		}else{
			truyen_co_nhieu_chap = 0;
		}

		var link_truyen 			= jQuery('.link_truyen input').val();
		var nguon_truyen 			= jQuery('.nguon_truyen select').val();
		var kieu_noi_dung 			= jQuery('.kieu_noi_dung select').val();
		// var truyen_co_nhieu_chap 	= jQuery('.truyen_co_nhieu_chap input[type="checkbox"]').val();
		var loai_truyen	 			= jQuery('.loai_truyen select').val();
		var html_loop_item 			= jQuery('.html_loop_item input').val();
		var html_chap_truyen 		= jQuery('.html_chap_truyen input').val();
		var html_ten_chap_truyen 	= jQuery('.html_ten_chap_truyen input').val();
		var html_noi_dung_truyen 	= jQuery('.html_noi_dung_truyen input').val();

		var data = {
			'action' 				: 'grap_leech',
			'ten_truyen'			: ten_truyen,
			'link_truyen' 			: link_truyen,
			'nguon_truyen' 			: nguon_truyen,
			'kieu_noi_dung' 		: kieu_noi_dung,
			'truyen_co_nhieu_chap' 	: truyen_co_nhieu_chap,
			'loai_truyen' 			: loai_truyen,
			'html_loop_item' 		: html_loop_item,
			'html_chap_truyen' 		: html_chap_truyen,
			'html_ten_chap_truyen' 	: html_ten_chap_truyen,
			'html_noi_dung_truyen' 	: html_noi_dung_truyen,
		}

		jQuery.post(GRAP_AJ.ajaxurl, data, function(response){

			jQuery(response).hide().appendTo('.grap-result').fadeIn('slow');
			jQuery('.grap-spinner').hide().fadeOut('slow');
		});

		return false;*/
	});

	/*==========  Khi click nút Lấy  ===========*/
	jQuery(document).on("click", ".click-to", function(){

		jQuery(this).prop('disabled', true);
		var parent = jQuery(this).closest('tr').attr('id');
		jQuery('.grap-spinner2').hide().css('display','inherit').fadeIn('slow');
		jQuery('.grap-result-single').empty();

		var link_chap 				= jQuery(this).data('link');
		var chap_title 				= jQuery(this).data('title');

		var html_noi_dung_truyen 	= jQuery('.html_noi_dung_truyen input').val();
		var nguon_truyen 			= jQuery('.nguon_truyen select').val();
		
		var data = {
			'action' 				: 'grap_leech',
			'link_chap' 			: link_chap,
			'html_noi_dung_truyen' 	: html_noi_dung_truyen,
			'nguon_truyen'			: nguon_truyen
		}

		var afterCheck = jQuery.post(GRAP_AJ.ajaxurl, data, function(content){
			jQuery(content).hide().appendTo('.grap-result-single').fadeIn('slow');
			jQuery('.grap-spinner2').hide().fadeOut('slow');
		});

		/*==========  Sau khi Lấy dc nội dung thì tạo bài viết  ===========*/
		afterCheck.done(function(){

			var checked = jQuery('.grab-check-title input[type="checkbox"]').is(":checked");
		
			if (checked == true){
				var title = jQuery('.grab-select-title .select2-choice .select2-chosen').text();
				insert_chap(title, chap_title);
			}
			else {
				var post_title 	= jQuery('#title').val();
				var category 	= jQuery('.loai_truyen option').text();

				var data = {
					'action'		: 'grab_truyen_insert_post',
					'post_title' 	: post_title,
					'category' 		: category,
				}

				jQuery.post(GRAP_AJ.ajaxurl, data, function(response){
					console.log(response);
					if (response == '0'){
						var mes = '<p>Tạo truyện thất bại!</p>';
						jQuery(mes).hide().appendTo('.grap-result-insert-post').fadeIn('slow');
					}
					else {
						var mes = '<p>Tạo truyện ' + response + ' thành công!</p>';

						jQuery(mes).hide().appendTo('.field_type-message .acf-input').fadeIn('slow');
						jQuery(mes).hide().appendTo('.grap-result-insert-post').fadeIn('slow');

						jQuery('.grap-result-insert-post').removeClass('no_post_commic').addClass('has_post_commic');
		
						insert_chap(post_title, chap_title);
					}
				});
			}

		});

		/*==========  Insert Chap vào truyện  ==========*/
		function insert_chap(post_title, chap_title){

			var chap_content 	= jQuery('.grab-content-chap').html();

			var data = {
				'action'		: 'grab_truyen_insert_chap_to_post',
				'post_title' 	: post_title,
				'chap_title'	: chap_title,
				'chap_content'  : chap_content
			}

			jQuery.post(GRAP_AJ.ajaxurl, data, function(response){
				if (response != '0'){
					jQuery(response).hide().appendTo('.field_type-message .acf-input').fadeIn('slow');
					jQuery(response).hide().appendTo('.grap-result-insert-post').fadeIn('slow');
					
					jQuery('tr#'+parent).addClass('grab-tr-disable');
					jQuery('tr#'+parent + ' input[type="button"]').prop('value', 'Đã lấy');
					jQuery('tr#'+parent + ' input[type="button"]').prop('disabled', true);
					jQuery('tr#'+parent + ' input[type="checkbox"]').prop('disabled', true);
				}
				else {
					var mes = "<p>Lỗi: Không thể tạo chap!</p>";
					jQuery(mes).hide().appendTo('.field_type-message .acf-input').fadeIn('slow');
					jQuery(mes).hide().appendTo('.grap-result-insert-post').fadeIn('slow');
				}
			});
		}

		return false;
			
	});

});

/*==========  Điều kiện để nút "Lấy những chap đã chọn" hiện hoặc ẩn  ==========*/
jQuery(document).on("click", ".grap-result input[type='checkbox']", function(){

	var temp = 0;
	jQuery(".grap-result input[type='checkbox']:checked:not(:disabled)").each(function(){
		temp++;
		return false;
	});

	if (temp > 0){
		jQuery('.grap-multi-btn').css('display','inherit');
	}
	else {
		jQuery('.grap-multi-btn').css('display','none');
	}
});

/*==========  Sự kiện khi click nút "Lấy những chap đã chọn"  ==========*/
jQuery('.grap-multi-btn').click(function(){

	jQuery('.grap-spinner').hide().css('display','inherit').fadeIn('slow');
	var count = jQuery(".grap-result input[type='checkbox']:checked:not(:disabled)").length;

	var post_title;
	var checked = jQuery('.grab-check-title input[type="checkbox"]').is(":checked");
	if (checked == true){
		var post_title = jQuery('.grab-select-title .select2-choice .select2-chosen').text();
	}
	else {
		var post_title 	= jQuery('#title').val();
	}

	var array_id = [];
	
	var parent = [];
	var chap_title = [];
	var link_chap = [];
	var html_noi_dung_truyen = [];
	var nguon_truyen = [];

	jQuery(jQuery(".grap-result input[type='checkbox']:checked:not(:disabled)").get().reverse()).each(function(){

		parent.push(jQuery(this).closest('tr').attr('id'));
		chap_title.push(jQuery(this).data('title'));
		link_chap.push(jQuery(this).data('link'));
		html_noi_dung_truyen.push(jQuery('.html_noi_dung_truyen input').val());
		nguon_truyen.push(jQuery('.nguon_truyen select').val());

	});

	var i = 0;
	insert_multi_chap(link_chap[0], html_noi_dung_truyen[0], nguon_truyen[0], post_title, chap_title[0], parent[0]);

	function insert_multi_chap(link_chap, html_noi_dung_truyen, nguon_truyen, post_title, chap_title, parent){

		i++;

		var data_multi = {
			'action' 				: 'grap_leech',
			'link_chap' 			: link_chap,
			'html_noi_dung_truyen' 	: html_noi_dung_truyen,
			'nguon_truyen'			: nguon_truyen
		}

		jQuery.post(GRAP_AJ.ajaxurl, data_multi, function(chap_content){
			var data = {
				'action'		: 'grab_truyen_insert_chap_to_post',
				'post_title' 	: post_title,
				'chap_title'	: chap_title,
				'chap_content'  : chap_content
			}

			var chap_ajax = jQuery.post(GRAP_AJ.ajaxurl, data, function(response){
				if (response != '0'){
					jQuery(response).hide().appendTo('.field_type-message .acf-input').fadeIn('slow');
					jQuery(response).hide().appendTo('.grap-result-insert-post').fadeIn('slow');
					
					jQuery('tr#'+parent).addClass('grab-tr-disable');
					jQuery('.grap-multi-btn').css('display','none').hide();
					jQuery('tr#'+parent + ' input[type="button"]').prop('value', 'Đã lấy');
					jQuery('tr#'+parent + ' input[type="button"]').prop('disabled', true);
					jQuery('tr#'+parent + ' input[type="checkbox"]').prop('disabled', true);
				}
				else {
					var mes = "<p>Lỗi: Không thể tạo chap!</p>";
					jQuery(mes).hide().appendTo('.field_type-message .acf-input').fadeIn('slow');
					jQuery(mes).hide().appendTo('.grap-result-insert-post').fadeIn('slow');
				}
			});

			chap_ajax.done(call_back_ajax);
		});
	}

	function call_back_ajax() {
		if (i < count){
			insert_multi_chap(link_chap[i], html_noi_dung_truyen[i], nguon_truyen[i], post_title, chap_title[i], parent[i]);
		}
		else {
			jQuery('.grap-spinner').hide().fadeOut('slow');
		}
	}

	return false;
});
