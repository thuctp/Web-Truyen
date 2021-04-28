function khoa(id)
{
	//alert(id+THANHVIEN_AJ.ajaxurl);


	jQuery.ajax({
				url:THANHVIEN_AJ.ajaxurl,
				
				data: {
					'action':'khoauser',
					'id':id
					
				},
				success:function(data) {
					
				
						//	alert(data);
						if(data=='0')
						{
							//alert('Người dùng đã bị khóa!');
							document.getElementById('clock_user_'+id).innerHTML="Khóa </br> <a onlick='mokhoauser("+id+")''>Mở Khóa</a>";

						}
						

					
					
				},
				error: function(errorThrown){
					console.log(errorThrown);
					alert("Loi"+errorThrown);
				}
			});
								
						
}



function mokhoauser(id)
{
	//alert(id+THANHVIEN_AJ.ajaxurl);


	jQuery.ajax({
			url:THANHVIEN_AJ.ajaxurl,
			
			data: {
				'action':'mokhoauser',
				'id':id
				
			},
			success:function(data) {
				
			
					//	alert(data);
					if(data=='0')
					{
						
						document.getElementById('clock_user_'+id).innerHTML="Bình thường</br> <a onlick='khoa("+id+")''>Khóa</a>";

					}
					

				
				
			},
			error: function(errorThrown){
				console.log(errorThrown);
				alert("Loi"+errorThrown);
			}
		});
								
						
}


function xoauser(id)
{
	//alert(id+THANHVIEN_AJ.ajaxurl);

	var xacnhan=confirm('Bạn chắc muốn xóa chứ');
	if(xacnhan)
	{
			jQuery.ajax({
			url:THANHVIEN_AJ.ajaxurl,
			
			data: {
				'action':'xoauser',
				'id':id
				
			},
			success:function(data) {
				
			
					//	alert(data);
					if(data=='0')
					{
						
						//document.getElementById('clock_user_'+id).innerHTML="Bình thường</br> <a onlick='khoa("+id+")''>Khóa</a>";
						alert("Xóa thành công");
						window.location.href="";

					}
					

				
				
			},
			error: function(errorThrown){
				console.log(errorThrown);
				alert("Loi"+errorThrown);
			}
		});
	}

								
						
}




function suauser(id)
{
	//alert('sua');
		var email=document.getElementById('email_sua').value;
				var matkhau_cu=document.getElementById('pass_sua_cu').value;
				var matkhau_moi=document.getElementById('pass_sua_moi').value;
				

				if(email.length<1||matkhau_cu.length<1||matkhau_moi.length<8)
				{
					if(email.length<1)
					{
						document.getElementById('email_sua_tb').innerHTML="Vui lòng nhập email";
						
						}
						else
						{
							document.getElementById('email_sua_tb').innerHTML="Email user";
						}

						if(matkhau_cu.length<1)
						{
							document.getElementById('pass_sua_tb').innerHTML="Vui lòng nhập mật khẩu của user";
							
						}
						else
						{	document.getElementById('pass_sua_tb').innerHTML="Mật khẩu user";

						}
						
						if(matkhau_moi.length<8)
						{
							document.getElementById('pass_new_sua_tb').innerHTML="Mật khẩu mới dài ít nhất 8 ký tự";
							
						}
						else
						{
							document.getElementById('pass_new_sua_tb').innerHTML="Mật khẩu mới của user";
						}

						

					return false;
				}

				document.getElementById('tb_update').innerHTML="Chờ chút...........";
				jQuery.ajax({
						url:THANHVIEN_AJ.ajaxurl,
						
						data: {
							'action':'capnhatuser',
							'id':id,
							'email':email,
							'matkhau_cu':matkhau_cu,
							'matkhau_moi':matkhau_moi,
							
							
						},
						success:function(data) {
							
						
								
								if(data=='1')
								{
									
									
									alert("Cập nhật thành công");

									window.location.href="";
									document.getElementById('tb_update').innerHTML="";


								}
								else
								{
									alert(data);
								}
								

							
							
						},
						error: function(errorThrown){
							console.log(errorThrown);
							alert("Loi"+errorThrown);
						}
					});

	
	




	
}

function thaydoimatkhau(id)
{
document.getElementById('tb-thaydoimatkhau').innerHTML="Chờ chút...........";
var matkhau_cu=document.getElementById('doimatkhau_matkhaucu').value;
var matkhau_moi=document.getElementById('doimatkhau_matkhaumoi').value;
if(matkhau_cu.length<=0)
{
	alert('Vui lòng nhập mật khẩu cũ');
	document.getElementById('tb-thaydoimatkhau').innerHTML="";
	return false;
}
else
{
		if(matkhau_moi.length<8)
		{
			alert('Mật khẩu mới phải dài hơn 8 ký tự');
			document.getElementById('tb-thaydoimatkhau').innerHTML="";
			return false;
		}
}

jQuery.ajax({
						url:THANHVIEN_AJ.ajaxurl,
						
						data: {
							'action':'thaydoimatkhau',
							'id':id,
							
							'matkhau_cu':matkhau_cu,
							'matkhau_moi':matkhau_moi
							
							
						},
						success:function(data) {
							
						
								
							
									
									
									alert(data);

									window.location.href="";
									document.getElementById('tb-thaydoimatkhau').innerHTML="";


								
								

							
							
						},
						error: function(errorThrown){
							console.log(errorThrown);
							alert("Loi"+errorThrown);
						}
					});

}
function thoatthanhvien()
{
	jQuery.ajax({
						url:THANHVIEN_AJ.ajaxurl,
						
						data: {
							'action':'thoatthanhvien'
							
							
							
						},
						success:function(data) {
							
			
								
									//alert(data);
									window.location.href="";
									


								
								

							
							
						},
						error: function(errorThrown){
							console.log(errorThrown);
							alert("Loi"+errorThrown);
						}
					});

}

function xoatin(id)
{
	jQuery.ajax({
				url:THANHVIEN_AJ.ajaxurl,
				
				data: {
					'action':'xoatin',
					'id':id,
					
					
				},
				success:function(data) {
					
				
							alert(data);
							window.location.href='';
						
						

					
					
				},
				error: function(errorThrown){
					console.log(errorThrown);
					alert("Loi"+errorThrown);
				}
			});
}
function huytheodoi(iduser,idtruyen)
{
	jQuery.ajax({
						url:THANHVIEN_AJ.ajaxurl,
						
						data: {
							'action':'huytheodoi',
							'idtruyen':idtruyen,
							'iduser':iduser
							
							
							
						},
						success:function(data) {
							
			
								
									//alert(data);
									window.location.href="";
									


								
								

							
							
						},
						error: function(errorThrown){
							console.log(errorThrown);
							//alert("Loi"+errorThrown);
						}
					});

}

jQuery(function($) {
	var $tab = $('#user-info .nav-pills li');
	var $tabPane = $('#user-info .tab-pane');
	if( window.location.hash == "#follow" ) {
		$tab.eq(0).addClass('active');
		$tabPane.eq(0).addClass('in active');
	}
	if( window.location.hash == "#user" ) {
		$tab.eq(1).addClass('active');
		$tabPane.eq(1).addClass('in active');
	}
	if( window.location.hash == "#password" ) {
		$tab.eq(2).addClass('active');
		$tabPane.eq(2).addClass('in active');
	}
	if( window.location.hash == "#info" ) {
		$tab.eq(3).addClass('active');
		$tabPane.eq(3).addClass('in active');
	}
});
