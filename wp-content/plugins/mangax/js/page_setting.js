jQuery(document).ready(function(){
	jQuery('.tab_caidatchung').click(function(){
		jQuery('.tabx').removeClass('tab_active');
		jQuery('.tabxactive').removeClass('page_setting_active');
		
		jQuery('.tab_caidatchung').addClass('tab_active');
		jQuery('.tab_phantrang').removeClass('tab_active');
		jQuery('.tab_footer').removeClass('tab_active');
		jQuery('.tab_quangcao').removeClass('tab_active');
		jQuery('.tab_about').removeClass('tab_active');



		jQuery('.caidatchung_active').addClass('page_setting_active');
		jQuery('.phantrang_active').removeClass('page_setting_active');
		jQuery('.footer_active').removeClass('page_setting_active');
		jQuery('.quangcao_active').removeClass('page_setting_active');
		jQuery('.about_active').removeClass('page_setting_active');
		jQuery('.submit_settingpage').addClass('page_setting_active');
	});

	jQuery('.tab_phantrang').click(function(){
		jQuery('.tabx').removeClass('tab_active');
		jQuery('.tabxactive').removeClass('page_setting_active');
		
		jQuery('.tab_caidatchung').removeClass('tab_active');
		jQuery('.tab_phantrang').addClass('tab_active');
		jQuery('.tab_footer').removeClass('tab_active');
		jQuery('.tab_quangcao').removeClass('tab_active');
		jQuery('.tab_about').removeClass('tab_active');



		jQuery('.caidatchung_active').removeClass('page_setting_active');
		jQuery('.phantrang_active').addClass('page_setting_active');
		jQuery('.footer_active').removeClass('page_setting_active');
		jQuery('.quangcao_active').removeClass('page_setting_active');
		jQuery('.about_active').removeClass('page_setting_active');
		jQuery('.submit_settingpage').addClass('page_setting_active');
	});

	jQuery('.tab_footer').click(function(){
		jQuery('.tabx').removeClass('tab_active');
		jQuery('.tabxactive').removeClass('page_setting_active');
		
		jQuery('.tab_caidatchung').removeClass('tab_active');
		jQuery('.tab_phantrang').removeClass('tab_active');
		jQuery('.tab_footer').addClass('tab_active');
		jQuery('.tab_quangcao').removeClass('tab_active');
		jQuery('.tab_about').removeClass('tab_active');

		jQuery('.caidatchung_active').removeClass('page_setting_active');
		jQuery('.phantrang_active').removeClass('page_setting_active');
		jQuery('.footer_active').addClass('page_setting_active');
		jQuery('.quangcao_active').removeClass('page_setting_active');
		jQuery('.about_active').removeClass('page_setting_active');
		jQuery('.submit_settingpage').addClass('page_setting_active');
	});
	jQuery('.tab_quangcao').click(function(){
		jQuery('.tabx').removeClass('tab_active');
		jQuery('.tabxactive').removeClass('page_setting_active');

		jQuery('.tab_caidatchung').removeClass('tab_active');
		jQuery('.tab_phantrang').removeClass('tab_active');
		jQuery('.tab_footer').removeClass('tab_active');
		jQuery('.tab_quangcao').addClass('tab_active');
		jQuery('.tab_about').removeClass('tab_active');

		jQuery('.caidatchung_active').removeClass('page_setting_active');
		jQuery('.phantrang_active').removeClass('page_setting_active');
		jQuery('.footer_active').removeClass('page_setting_active');
		jQuery('.quangcao_active').addClass('page_setting_active');
		jQuery('.about_active').removeClass('page_setting_active');
		jQuery('.submit_settingpage').addClass('page_setting_active');
	});
	jQuery('.tab_about').click(function(){
		jQuery('.tabx').removeClass('tab_active');
		jQuery('.tabxactive').removeClass('page_setting_active');

		jQuery('.tab_caidatchung').removeClass('tab_active');
		jQuery('.tab_phantrang').removeClass('tab_active');
		jQuery('.tab_footer').removeClass('tab_active');
		jQuery('.tab_quangcao').removeClass('tab_active');
		jQuery('.tab_about').addClass('tab_active');

		jQuery('.caidatchung_active').removeClass('page_setting_active');
		jQuery('.phantrang_active').removeClass('page_setting_active');
		jQuery('.footer_active').removeClass('page_setting_active');
		jQuery('.quangcao_active').removeClass('page_setting_active');
		jQuery('.about_active').addClass('page_setting_active');
	});

	jQuery('.tab_license').click(function(){
		jQuery('.tabx').removeClass('tab_active');
		jQuery('.tab_license').addClass('tab_active');

		jQuery('.tabxactive').removeClass('page_setting_active');
		jQuery('.license_active').addClass('page_setting_active');
		jQuery('.submit_settingpage').addClass('page_setting_active');
	});

	function laymamau(ma)
	{
		alert(ma);
	}
});

	function laymamau(ma)
	{
		//alert('aaaaaaaaaaaaa'+ma);
		document.getElementById('mamau').value=ma;
		document.getElementById('show_color').innerHTML='<a style="background:'+ma+';    padding: 3px 40px;   border: 1px solid #222;" ></a>';
		jQuery('#show_color').addClass('show_color');
	}
	
