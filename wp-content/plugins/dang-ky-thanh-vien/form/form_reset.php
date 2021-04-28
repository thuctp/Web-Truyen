<?php

function form_reset()
{
	?>
	

<div class="form-reset">
	<h2 class="title">Khôi phục mật khẩu</h2>
	<div class="form-horizontal">
		<div class="form-group">
			<span class="col-sm-12">Bạn nhập Tên đăng nhập vào ô dưới đây, chúng tôi sẽ gửi lại bạn mật khẩu qua email bạn đã đăng ký</span>
		</div>
		<div class="form-group">
            <label class="col-sm-2 control-label">&nbsp;</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="email_reset" value="" placeholder="Email">
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-2 control-label">&nbsp;</label>
			<div class="col-sm-10">
				<button class="btn btn-primary" id="guimail_reset">Gửi Mật Khẩu Vào Mail Cho Tôi</button>
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-2 control-label">&nbsp;</label>
			<div id="tb-guimail" class="col-sm-10"></div>
		</div>
	</div>
</div>


	<script type="text/javascript">
		jQuery('#guimail_reset').click(function(){
			var  mail=document.getElementById('email_reset').value;
			if(mail.length<=0)
			{
				alert('Vui lòng nhập email!');
				return false;
			}
			
			document.getElementById('tb-guimail').innerHTML="Đang gửi............";
			jQuery.ajax({
						url:THANHVIEN_AJ.ajaxurl,
						
						data: {
							'action':'guimail_reset',
							'email':mail,
							
							
						},
						success:function(data) {
							
						
								
							
									
									
									alert(data);

									window.location.href="";
									document.getElementById('tb-guimail').innerHTML="";


								

							
							
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
add_shortcode('form_reset','form_reset');