<?php
function form_dangky()
{
	
	?>

<div class="form-dangky">
	<h4 class="title">Đăng Ký Thành Viên</h4>
	<div role="form">
		<div class="form-group">
			<label class="control-label">Tên đăng ký (*)</label>
			<input type="text" class="form-control" value="" name="dangky_name" id="dangky_name">
			<div id="tb_name" class="error"></div>
		</div>
		<div class="form-group">
			<label class="control-label">Mật khẩu(*)</label>
			<input type="password" class="form-control" value="" name="dangky_pass" id="dangky_pass">
			<div id="tb_pass" class="error"></div>
		</div>
		<div class="form-group">
			<label class="control-label">Nhập lại mật khẩu</label>
			<input type="password" class="form-control" value="" name="dangky_pass_check" id="dangky_pass_check">
			<div id="tb_check_pass" class="error"></div>
		</div>
		<div class="form-group">
			<label class="control-label">Email(*)</label>
			<input type="email" class="form-control" value="" name="dangky_email" id="dangky_email">
			<div id="tb_email" class="error"></div>
		</div>
		
		<div class="form-group">
			<input type="hidden" id="traloi-hide" value="">
			<label class="control-label">Mã code(*)</label>
			<input type="text" class="form-control" value="" name="traloi" id="traloi">
			<div id="traloi-code" style="background: #555555; color: #fff; padding: 5px 10px; display: inline-block;margin-top: 10px;"></div>
			<div id="tb_traloi" class="error"></div>
			<script type="text/javascript">
				var rand=Math.floor((Math.random() * 9999) + 1000);
					document.getElementById('traloi-hide').value=rand;
					document.getElementById('traloi-code').innerHTML=rand;

				setInterval(function(){
					var rand=Math.floor((Math.random() * 9999) + 1000);
					document.getElementById('traloi-hide').value=rand;
					document.getElementById('traloi-code').innerHTML=rand;

				},30000);

			</script>
		</div>
		<div class="form-group">
			<label class="control-label"></label>
			<input type="checkbox" class="checkbox_dongy" id="dongy" checked class="form-control"> Bạn đã đọc và hoàn toàn đồng ý với các điều khoản của chúng tôi.
		</div>
		<div class="form-group">
			<button name="dangky" class="btn btn-primary" id="dangky"> Đăng ký</button>
		</div>
		<div class="form-group">
			<label class="control-label"></label>
			<div id="thongbaodangky"></div>
		</div>
	</div>
</div>

	<script type="text/javascript">
		

	jQuery('#dangky').click(function(){
				document.getElementById('thongbaodangky').innerHTML="Vui lòng đợi chốc lát";
				var name=document.getElementById('dangky_name').value;
				var pass=document.getElementById('dangky_pass').value;
				var pass_check=document.getElementById('dangky_pass_check').value;
				var email=document.getElementById('dangky_email').value;
				var traloi=document.getElementById('traloi').value;
				var traloi_hide=document.getElementById('traloi-hide').value;

				var dongy=document.getElementById('dongy').value;
				if(dongy!='1')
				{

				}

				if(name.length<3)
				{	
					document.getElementById('tb_name').innerHTML='Tên đăng ký phải dài hơn 3 ký tự';
					return false;
				}
				else
				{
					document.getElementById('tb_name').innerHTML="";
				}
				if(pass.length<8)
				{
					document.getElementById('tb_pass').innerHTML="Mật khẩu phải dài hơn 8 ký tự";
					document.getElementById('tb_pass').value="";
					return false;
				}
				else
				{
					document.getElementById('tb_pass').innerHTML="";
				}
				if(pass!=pass_check)
				{
					document.getElementById('tb_check_pass').innerHTML='2 chuỗi mật khẩu không khớp nhau';
					document.getElementById('dangky_pass_check').value="";
					return false;
				}
				else
				{document.getElementById('tb_check_pass').innerHTML="";

				}
				if(email.length<1)
				{
					
					document.getElementById('tb_email').innerHTML="Vui lòng nhập email";
					return false;
				}
				else
				{
					document.getElementById('tb_email').innerHTML="";
							
												
				}
				if(traloi!=traloi_hide)
				{
					document.getElementById('tb_traloi').innerHTML="bạn chưa trả lời câu hỏi bảo mật";
					return false;
				}
				else
				{
					document.getElementById('tb_traloi').innerHTML="";
				}


				jQuery.ajax({
					url:"<?php echo home_url()."/wp-admin/admin-ajax.php" ?>",
					
					data: {
						'action':'dangkythanhvien',
						'name':name,
						'email':email,
						'pass':pass
						
						
					},
					success:function(data) {
						
						if(data=="email_error")
						{
							document.getElementById('tb_email').innerHTML="Email này đã được sử dụng!";
						}

						else
						{	if(data=="name_error")
							{
								document.getElementById('tb_name').innerHTML='Tên này đã có người sử dụng';
							}
							else
							{
								alert(data);
								window.location.href="<?php echo home_url(); ?>";
							}
								
						}
						

						
						
					},
					error: function(errorThrown){
						console.log(errorThrown);
						alert("Loi"+errorThrown);
					}
				});
								
							

			
	});	

	
</script>
	
	

	<?php
}
add_shortcode('form_dangky','form_dangky');