
function xoarating()
{
	alert("aaaaaaa");
}

function xoa_wp_cate_rating(id)
{
	var check=confirm("Bạn chắc muốn xóa!");
	if(check!=true)
	{
		return false;
	}

			jQuery.ajax({
			url:WP_CATE_RATING_HOME+"/wp-admin/admin-ajax.php",
			
			data: {
				'action':'xoa_wp_cate_rating',
				'idcate':id,
								
			},
			success:function(data) {
				
				
				alert(data);				
				
				

				
				
			},
			error: function(errorThrown){
				console.log(errorThrown);
				alert("Loi"+errorThrown);
			}
		});
		

		
}
