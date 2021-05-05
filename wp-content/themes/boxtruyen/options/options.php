<?php
class MySettingsPage
{

	private $options;

	public function __construct()
	{
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
	}


	public function add_plugin_page()
	{
		add_menu_page(
			'Tùy chọn',
			'Tùy chọn',
			'manage_options',
			'theme-option',
			array( $this, 'create_admin_page' ),
			'dashicons-admin-generic',
			2
		);
	}


	public function create_admin_page()
	{

		$this->options = get_option( 'my_option_name' );
		?>
		<div class="wrap">
			<?php screen_icon(); ?>
			<h2>Tùy chọn <small>(Phiên bản: <?php echo wp_get_theme()->get('Version');?>)</small></h2>
			<form method="post" action="options.php">
			<?php
				
				echo '<link rel="stylesheet" href="'; echo bloginfo('template_url'); echo '/admin-styles.css?'.wp_get_theme()->get('Version').'" type="text/css" media="all"/>';
				settings_fields( 'my_option_group' );
				echo '<div class="option-nav">
					<a class="each-option a-panel-1 a-panel-actived" href="#panel-1" onclick="panel(\'1\')">Số lượng</a>
					<a class="each-option a-panel-2" href="#panel-2" onclick="panel(\'2\')">Nội dung</a>
					<a class="each-option a-panel-3" href="#panel-3" onclick="panel(\'3\')">Khác</a>
				      </div>';
				echo '<div class="panel panel-1 panel-actived">'; do_settings_sections( 'my-setting-admin' ); echo '</div>';
				echo '<div class="panel panel-2">'; do_settings_sections( 'my-setting-admin2' ); echo '</div>';
				echo '<div class="panel panel-3">'; do_settings_sections( 'my-setting-admin3' ); echo '</div>';
				submit_button();
				echo '<script type="text/javascript" src="'; echo bloginfo('template_url'); echo '/js/admin-option.js?'.wp_get_theme()->get('Version').'"></script>';
			?>
			</form>
		</div>
		<?php
	}


	public function print_section_info()
	{
		if(isset($_GET['settings-updated'])){
			echo '<div id="message" class="updated notice is-dismissible"><p>Đã cập nhật.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Bỏ qua thông báo này </span></button></div>';
		}
	}

















/* START TẠO FIELD */

	public function page_init()
	{
		register_setting(
			'my_option_group',
			'my_option_name',
			array( $this, 'sanitize' )
		);
		
		
		
		
		
		
		
		// Panel-1
		add_settings_section(
			'setting_section_id',
			'',
			array( $this, 'print_section_info' ),
			'my-setting-admin'
		);
		
		// Panel-2
		add_settings_section(
			'setting_section_id2',
			'',
			array( $this, '' ),
			'my-setting-admin2'
		);
		
		// Panel-3
		add_settings_section(
			'setting_section_id3',
			'',
			array( $this, '' ),
			'my-setting-admin3'
		);
		
		
		
		
		
		
		
		
		
		// Fields panel-1
		add_settings_field(
			'number',
			'Số chương mỗi trang:',
			array( $this, 'number_callback' ),
			'my-setting-admin',
			'setting_section_id'         
		);

		add_settings_field(
			'truyen_ngan_moi_trang',
			'Số truyện ngắn mỗi trang:',
			array( $this, 'truyen_ngan_moi_trang_callback' ),
			'my-setting-admin',
			'setting_section_id'         
		);

		add_settings_field(
			'decu_number',
			'Số truyện đề cử:',
			array( $this, 'decu_callback' ),
			'my-setting-admin',
			'setting_section_id'         
		);

		add_settings_field(
			'so_truyen_hoan_thanh',
			'Số truyện hoàn thành mỗi trang:',
			array( $this, 'so_truyen_hoan_thanh_callback' ),
			'my-setting-admin',
			'setting_section_id'         
		);

		add_settings_field(
			'so_truyen_moi',
			'Số truyện mới mỗi trang:',
			array( $this, 'so_truyen_moi_callback' ),
			'my-setting-admin',
			'setting_section_id'         
		);

		add_settings_field(
			'so_truyen_moi_cap_nhat',
			'Số truyện mới cập nhật mỗi trang:',
			array( $this, 'so_truyen_moi_cap_nhat_callback' ),
			'my-setting-admin',
			'setting_section_id'         
		);

		add_settings_field(
			'so_truyen_xem_nhieu',
			'Số truyện xem nhiều mỗi trang:',
			array( $this, 'so_truyen_xem_nhieu_callback' ),
			'my-setting-admin',
			'setting_section_id'         
		);

		add_settings_field(
			'so_chuong_moi',
			'Số chương mới trong truyện:',
			array( $this, 'so_chuong_moi_callback' ),
			'my-setting-admin',
			'setting_section_id'         
		);








		// Fields panel-2
		add_settings_field(
			'foot_left',
			'Footer bên trái:',
			array( $this, 'foot_left_callback' ),
			'my-setting-admin2',
			'setting_section_id2'         
		);

		add_settings_field(
			'foot_right',
			'Footer bên phải:',
			array( $this, 'foot_right_callback' ),
			'my-setting-admin2',
			'setting_section_id2'         
		);

		add_settings_field(
			'gioi_thieu',
			'Giới thiệu dưới logo:',
			array( $this, 'gioi_thieu_callback' ),
			'my-setting-admin2',
			'setting_section_id2'         
		);

		add_settings_field(
			'select_middle_foot',
			'List truyện dưới footer:<p></p>Số lượng:',
			array( $this, 'select_middle_foot_callback' ),
			'my-setting-admin2',
			'setting_section_id2'         
		);

		add_settings_field(
			'mo_rong',
			'Đuôi URL:',
			array( $this, 'mo_rong_callback' ),
			'my-setting-admin2',
			'setting_section_id2'         
		);

		add_settings_field(
			'breadcrumb',
			'Breadcrumb post:',
			array( $this, 'breadcrumb_callback' ),
			'my-setting-admin2',
			'setting_section_id2'         
		);

		add_settings_field(
			'breadcrumb_ngan',
			'Breadcrumb post_ngan:',
			array( $this, 'breadcrumb_ngan_callback' ),
			'my-setting-admin2',
			'setting_section_id2'         
		);

		add_settings_field(
			'trangthai_hoanthanh',
			'Trạng thái hoàn thành:',
			array( $this, 'trangthai_hoanthanh_callback' ),
			'my-setting-admin2',
			'setting_section_id2'         
		);

		add_settings_field(
			'trangthai_dangcapnhat',
			'Trạng thái đang cập nhật:',
			array( $this, 'trangthai_dangcapnhat_callback' ),
			'my-setting-admin2',
			'setting_section_id2'         
		);

		add_settings_field(
			'chuaconoidung',
			'Chưa có nội dung:',
			array( $this, 'chuaconoidung_callback' ),
			'my-setting-admin2',
			'setting_section_id2'         
		);








		// Fields panel-3
		add_settings_field(
			'fb_app_id',
			'Facebook App ID:',
			array( $this, 'fb_app_id_callback' ),
			'my-setting-admin3',
			'setting_section_id3'         
		);

		add_settings_field(
			'google_analytics',
			'Google Analytics:',
			array( $this, 'google_analytics_callback' ),
			'my-setting-admin3',
			'setting_section_id3'         
		);


	}

/* END TẠO FIELD */



















/* START TẠO INPUT */

	public function sanitize( $input )
	{
		$new_input = array();
		if( isset( $input['number'] ) )
			$new_input['number'] = absint( $input['number'] );

		if( isset( $input['truyen_ngan_moi_trang'] ) )
			$new_input['truyen_ngan_moi_trang'] = absint( $input['truyen_ngan_moi_trang'] );

		if( isset( $input['decu_number'] ) )
			$new_input['decu_number'] = absint( $input['decu_number'] );

		if( isset( $input['so_truyen_hoan_thanh'] ) )
			$new_input['so_truyen_hoan_thanh'] = absint( $input['so_truyen_hoan_thanh'] );

		if( isset( $input['foot_left'] ) )
			$new_input['foot_left'] = $input['foot_left'];

		if( isset( $input['foot_right'] ) )
			$new_input['foot_right'] = $input['foot_right'];

		if( isset( $input['gioi_thieu'] ) )
			$new_input['gioi_thieu'] = $input['gioi_thieu'];

		if( isset( $input['select_middle_foot'] ) )
			$new_input['select_middle_foot'] = $input['select_middle_foot'];

		if( isset( $input['select_middle_foot_count'] ) )
			$new_input['select_middle_foot_count'] = absint( $input['select_middle_foot_count'] );

		if( isset( $input['mo_rong'] ) )
			$new_input['mo_rong'] = $input['mo_rong'];

		if( isset( $input['breadcrumb'] ) )
			$new_input['breadcrumb'] = $input['breadcrumb'];

		if( isset( $input['breadcrumb_ngan'] ) )
			$new_input['breadcrumb_ngan'] = $input['breadcrumb_ngan'];

		if( isset( $input['trangthai_hoanthanh'] ) )
			$new_input['trangthai_hoanthanh'] = $input['trangthai_hoanthanh'];

		if( isset( $input['chuaconoidung'] ) )
			$new_input['chuaconoidung'] = $input['chuaconoidung'];

		if( isset( $input['chuaconoidung2'] ) )
			$new_input['chuaconoidung2'] = $input['chuaconoidung2'];
			
		if( isset( $input['trangthai_dangcapnhat'] ) )
			$new_input['trangthai_dangcapnhat'] = $input['trangthai_dangcapnhat'];

		if( isset( $input['so_truyen_moi'] ) )
			$new_input['so_truyen_moi'] = absint( $input['so_truyen_moi'] );

		if( isset( $input['so_truyen_moi_cap_nhat'] ) )
			$new_input['so_truyen_moi_cap_nhat'] = absint( $input['so_truyen_moi_cap_nhat'] );

		if( isset( $input['so_truyen_xem_nhieu'] ) )
			$new_input['so_truyen_xem_nhieu'] = absint( $input['so_truyen_xem_nhieu'] );

		if( isset( $input['so_chuong_moi'] ) )
			$new_input['so_chuong_moi'] = absint( $input['so_chuong_moi'] );

		if( isset( $input['fb_app_id'] ) )
			$new_input['fb_app_id'] = $input['fb_app_id'];

		if( isset( $input['google_analytics'] ) )
			$new_input['google_analytics'] = $input['google_analytics'];

		return $new_input;
	}

/* END TẠO INPUT */












/* START TẠO CALLBACK */

	public function number_callback()
	{
		printf(
			'<input type="number" id="number" name="my_option_name[number]" value="%s" />',
			isset( $this->options['number'] ) ? esc_attr( $this->options['number']) : ''
		);
	}

	public function truyen_ngan_moi_trang_callback()
	{
		printf(
			'<input type="number" id="truyen_ngan_moi_trang" name="my_option_name[truyen_ngan_moi_trang]" value="%s" />',
			isset( $this->options['truyen_ngan_moi_trang'] ) ? esc_attr( $this->options['truyen_ngan_moi_trang']) : ''
		);
	}


	public function decu_callback()
	{
		printf(
			'<input type="number" id="decu_number" name="my_option_name[decu_number]" value="%s" />',
			isset( $this->options['decu_number'] ) ? esc_attr( $this->options['decu_number']) : ''
		);
	}


	public function so_truyen_hoan_thanh_callback()
	{
		printf(
			'<input type="number" id="so_truyen_hoan_thanh" name="my_option_name[so_truyen_hoan_thanh]" value="%s" />',
			isset( $this->options['so_truyen_hoan_thanh'] ) ? esc_attr( $this->options['so_truyen_hoan_thanh']) : ''
		);
	}


	public function so_truyen_moi_callback()
	{
		printf(
			'<input type="number" id="so_truyen_moi" name="my_option_name[so_truyen_moi]" value="%s" />',
			isset( $this->options['so_truyen_moi'] ) ? esc_attr( $this->options['so_truyen_moi']) : ''
		);
	}


	public function so_truyen_moi_cap_nhat_callback()
	{
		printf(
			'<input type="number" id="so_truyen_moi_cap_nhat" name="my_option_name[so_truyen_moi_cap_nhat]" value="%s" />',
			isset( $this->options['so_truyen_moi_cap_nhat'] ) ? esc_attr( $this->options['so_truyen_moi_cap_nhat']) : ''
		);
	}


	public function foot_left_callback()
	{
		echo "<style>#foot_left, #foot_right, #gioi_thieu, #google_analytics{width:100%;height:100px}</style>";
		printf(
			'<textarea type="text" id="foot_left" name="my_option_name[foot_left]">%s</textarea>',
			isset( $this->options['foot_left'] ) ? esc_attr( $this->options['foot_left']) : ''
		);
	}


	public function foot_right_callback()
	{
		printf(
			'<textarea type="text" id="foot_right" name="my_option_name[foot_right]">%s</textarea>',
			isset( $this->options['foot_right'] ) ? esc_attr( $this->options['foot_right']) : ''
		);
	}


	public function gioi_thieu_callback()
	{
		printf(
			'<textarea type="text" id="gioi_thieu" name="my_option_name[gioi_thieu]">%s</textarea>',
			isset( $this->options['gioi_thieu'] ) ? esc_attr( $this->options['gioi_thieu']) : ''
		);
	}


	public function select_middle_foot_callback()
	{
		printf(
			'<select type="text" id="select_middle_foot" name="my_option_name[select_middle_foot]"><option value="">Hiện</option><option value="none" id="none">Ẩn</option></select>',
			isset( $this->options['select_middle_foot'] ) ? esc_attr( $this->options['select_middle_foot']) : ''
		);
		if($this->options['select_middle_foot'] == "none") echo "<script>document.getElementById('none').setAttribute(\"selected\", \"selected\");</script>";
		printf(
			'<br/><input type="number" id="select_middle_foot_count" name="my_option_name[select_middle_foot_count]" value="%s" />',
			isset( $this->options['select_middle_foot_count'] ) ? esc_attr( $this->options['select_middle_foot_count']) : ''
		);
	}


	public function mo_rong_callback()
	{
		printf(
			'<input type="text" id="mo_rong" name="my_option_name[mo_rong]" value="%s" placeholder=".html hoặc .htm"/>',
			isset( $this->options['mo_rong'] ) ? esc_attr( $this->options['mo_rong']) : ''
		);
	}


	public function breadcrumb_callback()
	{
		printf(
			'<input type="text" id="breadcrumb" name="my_option_name[breadcrumb]" value="%s" placeholder="Truyện, Sách,..."/>',
			isset( $this->options['breadcrumb'] ) ? esc_attr( $this->options['breadcrumb']) : ''
		);
	}


	public function breadcrumb_ngan_callback()
	{
		printf(
			'<input type="text" id="breadcrumb_ngan" name="my_option_name[breadcrumb_ngan]" value="%s" placeholder="Truyện ngắn, Tác phẩm ngắn,..."/>',
			isset( $this->options['breadcrumb_ngan'] ) ? esc_attr( $this->options['breadcrumb_ngan']) : ''
		);
	}


	public function trangthai_hoanthanh_callback()
	{
		printf(
			'<input type="text" id="trangthai_hoanthanh" name="my_option_name[trangthai_hoanthanh]" value="%s" placeholder="Hoàn thành"/>',
			isset( $this->options['trangthai_hoanthanh'] ) ? esc_attr( $this->options['trangthai_hoanthanh']) : ''
		);
	}


	public function trangthai_dangcapnhat_callback()
	{
		printf(
			'<input type="text" id="trangthai_dangcapnhat" name="my_option_name[trangthai_dangcapnhat]" value="%s" placeholder="Đang cập nhật"/>',
			isset( $this->options['trangthai_dangcapnhat'] ) ? esc_attr( $this->options['trangthai_dangcapnhat']) : ''
		);
	}


	public function chuaconoidung_callback()
	{
		printf(
			'<input type="text" id="chuaconoidung" name="my_option_name[chuaconoidung]" value="%s" placeholder="Nhiều chương"/>',
			isset( $this->options['chuaconoidung'] ) ? esc_attr( $this->options['chuaconoidung']) : ''
		);
		
		printf(
			' <input type="text" id="chuaconoidung2" name="my_option_name[chuaconoidung2]" value="%s" placeholder="Không chương"/>',
			isset( $this->options['chuaconoidung2'] ) ? esc_attr( $this->options['chuaconoidung2']) : ''
		);
	}


	public function so_truyen_xem_nhieu_callback()
	{
		printf(
			'<input type="number" id="so_truyen_xem_nhieu" name="my_option_name[so_truyen_xem_nhieu]" value="%s" />',
			isset( $this->options['so_truyen_xem_nhieu'] ) ? esc_attr( $this->options['so_truyen_xem_nhieu']) : ''
		);
	}


	public function so_chuong_moi_callback()
	{
		printf(
			'<input type="number" id="so_chuong_moi" name="my_option_name[so_chuong_moi]" value="%s" />',
			isset( $this->options['so_chuong_moi'] ) ? esc_attr( $this->options['so_chuong_moi']) : ''
		);
	}


	public function fb_app_id_callback()
	{
		printf(
			'<input type="text" id="fb_app_id" name="my_option_name[fb_app_id]" value="%s" />',
			isset( $this->options['fb_app_id'] ) ? esc_attr( $this->options['fb_app_id']) : ''
		);
	}


	public function google_analytics_callback()
	{
		printf(
			'<textarea type="text" id="google_analytics" name="my_option_name[google_analytics]">%s</textarea>',
			isset( $this->options['google_analytics'] ) ? esc_attr( $this->options['google_analytics']) : ''
		);
	}

/* END TẠO CALLBACK */

















}

if( is_admin() )
	$my_settings_page = new MySettingsPage();