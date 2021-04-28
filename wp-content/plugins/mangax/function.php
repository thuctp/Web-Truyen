<?php 
function get_anhdaidien($id_truyen)/*lấy ảnh đại diện của truyện*/
{
	$term_truyen=get_option( "category_$id_truyen");
	return $term_truyen['anhdaidien']; 

}

function laytruyen($post_id)/*Lấy truyện dựa vào id của chương*/
{
								$truyen=array();
								$terms = get_the_terms($post_id, 'category' );
														
								if ( $terms && ! is_wp_error( $terms ) ) : 

								
									foreach ( $terms as $term )
									{
										$truyen['id']=$term->term_id;
										$truyen['name']=$term->name;
										$truyen['slug']=home_url()."/".$term->slug."/";
										
									}
														
								endif; 
								return $truyen;
}

function laytruyen_byid($id)/*lấy truyện thông qua id của truyện*/
{
	//$queried_object = $wp_query->get_queried_object(); echo $queried_object->name; 
	$truyen 			=array();

	/*Lấy truyện*/
	$term 				=get_term($id,'category');
	$truyen['id']		=$term->term_id;
	$truyen['name']		=$term->name;
	$truyen['slug']		=home_url()."/".$term->slug."/";
	/*Lấy mô tả*/
	$truyen['mota']			=$term->description;

	/*Lấy meta truyen*/
	$cat_meta			=get_option('category_'.$id);
	/*lấy lượt xem và hình ảnh*/
	$truyen['luotxem']	=$cat_meta['luotxem'];
	$truyen['img']		=$cat_meta['anhdaidien'];

	/*Lấy nhóm dịch*/
	$id_nhomdich		=$cat_meta['nhomdich'];
	$term_nhomdich		=get_term($id_nhomdich,'nhom-dich');
	$truyen['nhomdich_name']=$term_nhomdich->name;
	$truyen['nhomdich_slug']=home_url()."/nhom-dich/".$term_nhomdich->slug."/";

	/*lấy tác giả*/
	$id_tacgia				=$cat_meta['tacgia'];
	$term_tacgia			=get_term($id_tacgia,'tac-gia');
	$truyen['tacgia_name']	=$term_tacgia->name;
	$truyen['tacgia_slug']	=home_url()."/tac-gia/".$term_tacgia->slug."/";

	/*lấy tình trạng*/
	$tinhtrang     			=$cat_meta['tinhtrang'];
	if($tinhtrang=='tamngung')
	{
		$truyen['tinhtrang']='Tạm ngưng';
	}
	elseif ($tinhtrang=="hoanthanh") {
		$truyen['tinhtrang']='Hoàn thành';
	}
	else
	{
		$truyen['tinhtrang']='Đang cập nhật';
	}

	/*lấy nguồn truyện*/
	$truyen['nguon']		=$cat_meta['nguon'];
	
	/*Lấy truyện hot*/
	$truyen['hot']		=$cat_meta['hot'];





	/*lấy thể loại*/
	$id_theloai				=$cat_meta['theloai'];
	$term_theloai			=get_term($id_theloai,'the-loai');
	$truyen['theloai_name']	=$term_theloai->name;
	$truyen['theloai_slug']	=home_url()."/the-loai/".$term_theloai->slug."/";
	
	return $truyen;
}

function laytheloai($idtruyen)/*Trả về mảng danh sách các  thể loại của truyện*/
{
	$cat_meta			=get_option('category_'.$idtruyen);
	$list_theloai		=array();
	if(isset($cat_meta['theloai']))
	{
		foreach ($cat_meta['theloai'] as $value) 
		{
			$list_theloai[]=$value;
		}

				$str="";
				foreach ($list_theloai as $idtheloai) {
					$tem=get_term($idtheloai,'the-loai');
					$str.='<a  href="'.home_url().'/the-loai/'.$tem->slug.'/" title="'.$tem->name.'" >'.$tem->name.'</a> , ';

				}
				return substr($str,0,-2);
	}
	
	return "";
}
function laytacgia($idtruyen) 
{
	$cat_meta			=get_option('category_'.$idtruyen);
	if( $cat_meta['tacgia'] ) {
		return $cat_meta['tacgia'];
	} else {
		return 'Đang cập nhật';
	}
}
function laynhomdich($idtruyen) /*Trả về mảng danh sách các  nhóm dịch của truyện*/
{
	$cat_meta			=get_option('category_'.$idtruyen);
	$list_nhomdich		=array();
	if(isset($cat_meta['nhomdich']))
	{
			foreach ($cat_meta['nhomdich'] as $value) 
			{
			$list_nhomdich[]=$value;
			}

			$str="";
				foreach ($list_nhomdich as $idnhomdich) {
					$tem=get_term($idnhomdich,'nhom-dich');
					$str.='<a  href="'.home_url().'/nhom-dich/'.$tem->slug.'/" title="'.$tem->name.'" >'.$tem->name.'</a> , ';

				}
				return substr($str,0,-2);
	}
	
	return "";
}

function luotxemtruyen($idtruyen)
{
	 	$cat_meta=get_option('category_'.$idtruyen);
        if($cat_meta['luotxem']!='')
        {
           return $cat_meta['luotxem'];
        }
        else
        {
        	return 0;
        }
}


function capnhatluotxem($idtruyen)
{	
	$cat_meta= get_option('category_'.$idtruyen);
	$luotxem=$cat_meta['luotxem'];
	$cat_meta['luotxem']=(int)$luotxem+1;
	update_option('category_'.$idtruyen, $cat_meta);
}



/**Trả về thời gian đăng bài: 2 giây trước, 2 ngày trước, 2 hôm trước...**/
function thoigiandangbai() 
{
		global $post;
		return human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' trước';
}
function title_chuong($post_id)
{
	$post_categories = wp_get_post_categories( $post_id );
	$cats = array();
		
	foreach($post_categories as $c){
		$cat = get_category( $c );
		$cats[] = $cat->name;
	}

	$title_post=get_the_title($post_id );

	return $cats[0]."-".$title_post;
}
function laychuongmoi($idtruyen)
{
	$arg=array(
		'post_type' 		=>'post',
		'cat'				=>$idtruyen,
		'posts_per_page'	=>1,
		
		);
	$truyenmoi=new WP_Query($arg);
	$chuong=array();
	while ($truyenmoi->have_posts()):$truyenmoi->the_post();
	$chuong['slug']	=get_the_permalink($post->ID);
	$chuong['name']	=get_the_title($post->ID);
	$chuong['id']	=$post->ID;
	$chuong['time']	=thoigiandangbai();
		
	endwhile;	
	wp_reset_postdata();
	return $chuong;
	
}

function  danhsachchuong($idtruyen, $post_id)
{
	query_posts('post_type=post&cat='.$idtruyen.'&showposts=-1&order=ASC' );
	while (have_posts()):the_post();
		?>
			<li <?php if( $post_id == get_the_ID() ) echo 'class="active"'; ?>><a class="c-text-truncate" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		<?php
	endwhile;
	//wp_reset_postdata();
	wp_reset_query();
}


function prev_next($idtruyen,$idchuong)/*Truyền vào id của truyện và id của chương hiện tại*/
{
	$listchuong=array();
	query_posts('post_type=post&cat='.$idtruyen.'&showposts=-1&order=ASC' );
	while (have_posts()):the_post();
		$listchuong[]=get_the_ID();
	endwhile;
	wp_reset_query();
	




	$prev_next=array();

	if($listchuong[0]==$idchuong)/*Hiện tại là chương đầu tiên*/
	{
		$prev_next['prev']=null;
		$prev_next['next']=get_the_permalink($listchuong[1]);
	}
	elseif (end($listchuong)==$idchuong)/*Hiện tại là chương cuối*/
	{
		$prev_next['next']=null;
		//$key=endKey();
		$prev_next['prev']=get_the_permalink(prev($listchuong));
	}
	else
	{	
		foreach ($listchuong as $key => $value) 
		{
			//echo $value;
			if($value==$idchuong)
			{
			$prev_next['prev']=get_the_permalink($listchuong[$key-1]);
			$prev_next['next']=get_the_permalink($listchuong[$key+1]);		
			}
			

		}
	}


	return $prev_next;
}




function baoloi()
{
	if(isset($_REQUEST))
	{	   
			$idpost=$_REQUEST['idpost'];
			$lydo=$_REQUEST['lydo'];
			global $wpdb;

			$query = "INSERT INTO  ".$wpdb->prefix."comments( comment_post_ID, comment_author, comment_content,comment_approved) VALUES ('".$idpost."','Báo lỗi','".$lydo."',0)";
			
			if($wpdb->query($query))
			{
			echo "Cảm ơn bạn đã báo lỗi chương này ";
			}
			else
			{
			echo "Lỗi khi gửi thông tin!";
			
			}
    

     
		
		
	}
	
}
add_action( 'wp_ajax_baoloi', 'baoloi' );
add_action( 'wp_ajax_nopriv_baoloi', 'baoloi' );	



function sotrang($post_per_page,$soluong=0)
{
	global $wpdb;
	$sotrang=1;
	/*if($soluong==0)
	{
			$sql_count="select count(a.term_id)
			from ".$wpdb->prefix."terms a join ".$wpdb->prefix."term_taxonomy b on a.term_id=b.term_id
			where b.taxonomy='category'
			 and a.term_id<>'1'
		";
	$count=$wpdb->get_var($sql_count);
	}
	else
	{
		$count=$soluong;
	}
	*/
	$count=$soluong;
	if(!isset($post_per_page)||!isset($count))
	{
		$count=0;
		$post_per_page=1;
	}
	$sotrang=(int)($count/$post_per_page);
	if(($sotrang*$post_per_page)<$count)
	{
		$sotrang=$sotrang+1;
	}
	return $sotrang;
}

/*các biến truyền vào:
arg=array(

'post_per_page' =>  //so luong bai viet moi trang
'hot'			=>'on' //lay danh sach cac truyen hot 
'tinhtrang'	=>'capnhat' or 'hoanthanh' or 'tamngung'
'chucai'		=>"A",B,C..... tìm theo chữ cái đầu tiên
'key'			=>"abc"... tìm theo ký tự hoặc chuỗi
'tieubieu'		=>'on'... những truyện tiêu biểu
'sortby'   		=>'name'.... sắp xếp theo name:tên, new: mới cập nhật, view: lượt xem    ,
'theloai'		=>''
'nhom'			=>
'tacgia'		=>


);
post_per_page, tinhtrang,hot,*/

function danhsachtruyen($arg=null)
{	global $wpdb;
	
	

	
	$sql="select a.term_id as id , a.name as ten 
			from ".$wpdb->prefix."terms a join ".$wpdb->prefix."term_taxonomy b on a.term_id=b.term_id
			where b.taxonomy='category'  and a.term_id<>'1' ";

	if(isset($arg['chucai'])&&$arg['chucai']!='')
	{
		$sql.=" and a.name like '".$arg['chucai']."%'";
	}
	if(isset($arg['key'])&&$arg['key']!='')
	{
		$sql.=" and a.name like '%".$arg['key']."%'";
	}

	if(isset($arg['sortby'])&&$arg['sortby']!='')
	{	$sortby=$arg['sortby'];
		if($sortby=='name')
		{
			$sql.=" order by ten ASC ";


		}
		elseif($sortby=='new')
		{
			$sql.=" order by id DESC ";

		}

		else
		{
			$sql.=" order by id DESC ";



		}
	}
	else
	{
		$sql.=" order by id DESC ";

		
	}
	
	


	
	$current_trang=$_GET['trang'];

	if($current_trang<=0)
	{
			$limit=10;
			$star=0;
			$current_trang=1;
	}
	$star=$current_trang;
	$limit=$arg['post_per_page'];

	
	/*$sotrang=sotrang($limit,$arg);
	if($current_trang>$sotrang)
	{
		
			$current_trang=$sotrang;
	}
	*/
	if(!isset($star)&&!isset($limit))/*Mặc định*/
	{
		$star=0;
		$limit=10;


	}
	elseif(!isset($star)&&isset($limit))/*Trang 1 hoặc không tồn tại trang*/
	
	{
		$star=0;
		$limit=$arg['post_per_page'];
		echo "mac dinh";
	}
	elseif(isset($current_trang)&&isset($limit)&&$current_trang==1)
	{
		$star=0;
		$limit=$arg['post_per_page'];
	}
	elseif(isset($current_trang)&&isset($limit)&&$current_trang>1)
	{
					$star=($current_trang-1)*$limit;
					$limit=$limit;
	}
	
	//echo "bắt đầu".$star;
	//echo "Soluong".$limit;
//	echo "Trang".$current_trang;
	

	




	if(isset($arg['hot'])&&$arg['hot']!='')
	{
			$truyenhot 			=$arg['hot'];
	}
	if(isset($arg['tinhtrang'])&&$arg['tinhtrang']!='all'&&$arg['tinhtrang']!='')
	{		if($arg['tinhtrang']=='capnhat')
			{
				$truyen_tinhtrang='';
			}
			else
			{
					$truyen_tinhtrang 	=$arg['tinhtrang'];
			}
		
	}
	if(isset($arg['theloai'])&&$arg['theloai']!='')
	{
			$theloai 			=$arg['theloai'];
	}
	if(isset($arg['nhom'])&&$arg['nhom']!='')
	{
			$nhom 				=$arg['nhom'];

	}
	if(isset($arg['tacgia'])&&$arg['tacgia']!='')
	{
			$tacgia 				=$arg['tacgia'];
			
	}
	if(isset($arg['tieubieu'])&&$arg['tieubieu']!='')
	{
			$truyen_tieubieu 	=$arg['tieubieu'];
	}


	$result=$wpdb->get_results($sql);
	$list_truyen=array();
	if($result)
	{
		
		if(isset($truyenhot)&&!isset($truyen_tinhtrang)&&!isset($theloai)&&!isset($nhom)) /*lấy theo truyen hot*/
		{	foreach ($result as $value)
			{
				$id=$value->id;
				$cat_meta=get_option('category_'.$id);
				if($cat_meta['hot']==$truyenhot)
				{
					$list_truyen[]=$value->id;
				}
			}
			//echo "hot";
			//return $list_truyen;
			
		}
		elseif (isset($truyen_tinhtrang)&&!isset($truyenhot)&&!isset($theloai)&&!isset($nhom)) /*láy theo tinh trang*/
		{
			foreach ($result as $value)
			{
				$id=$value->id;
				$cat_meta=get_option('category_'.$id);
				if($cat_meta['tinhtrang']==$truyen_tinhtrang)
				{
					$list_truyen[]=$value->id;
				}
			}
			//echo "tinh trang";
			//return $list_truyen;
			
		}
		elseif (!isset($truyen_tinhtrang)&&!isset($truyenhot)&&!isset($theloai)&&isset($nhom)) /*láy theo tinh nhóm*/
		{
			foreach ($result as $value)
			{
				$id=$value->id;
				$cat_meta=get_option('category_'.$id);
				if($cat_meta['nhomdich'])
					{
						foreach ($cat_meta['nhomdich'] as $idtl) 
						{
							if($idtl==$nhom)
							{	
								$list_truyen[]=$value->id;
							}
						}
					}
			}
			//echo "nhóm";
			return $list_truyen;
			
		}
		elseif (!isset($truyen_tinhtrang)&&!isset($truyenhot)&&!isset($theloai)&&!isset($nhom)&&isset($tacgia)) /*láy theo tinh tac gia*/
		{
			foreach ($result as $value)
			{
				$id=$value->id;
				$cat_meta=get_option('category_'.$id);
				if($cat_meta['tacgia'])
					{
						foreach ($cat_meta['tacgia'] as $idtl) 
						{
							if($idtl==$tacgia)
							{	
								$list_truyen[]=$value->id;
							}
						}
					}
			}
			//echo "nhóm";
			//return $list_truyen;
			
		}
		elseif (!isset($truyen_tinhtrang)&&!isset($truyenhot)&&isset($theloai)&&!isset($nhom)) /*láy theo thể loại*/
		{
			foreach ($result as $value)
			{
				$id=$value->id;
				$cat_meta=get_option('category_'.$id);

				//print_r($cat_meta['theloai']);
				if(isset($cat_meta['theloai']))
				{
					foreach ($cat_meta['theloai'] as $idtl) 
					{
						if($idtl==$theloai)
						{	
							$list_truyen[]=$value->id;
						}
					}
				}
				
			
				
			}
			return $list_truyen;
			//echo "theloai";
		}
		elseif (isset($truyen_tinhtrang)&&isset($truyenhot)&&!isset($theloai)&&!isset($nhom)) /*láy theo trang thai-hot*/
		{
			foreach ($result as $value)
			{
				$id=$value->id;
				$cat_meta=get_option('category_'.$id);
				if($cat_meta['tinhtrang']==$truyen_tinhtrang&&$cat_meta['hot']==$truyenhot)
				{
					$list_truyen[]=$value->id;
				}
			}
			//return $list_truyen;
		}
		elseif (isset($truyen_tinhtrang)&&!isset($truyenhot)&&isset($theloai)&&!isset($nhom)) /*láy theo trang thai-loai*/
		{
			foreach ($result as $value)
			{
				$id=$value->id;
				$cat_meta=get_option('category_'.$id);
				if($cat_meta['tinhtrang']==$truyen_tinhtrang)
				{	
					foreach ($cat_meta['theloai'] as $idtl) 
					{
						if($idtl==$theloai)
						{	
							$list_truyen[]=$value->id;
						}
					}
					//$list_truyen[]=$value->id;
				}
			}
			//return $list_truyen;
		}
		elseif (isset($truyen_tinhtrang)&&!isset($truyenhot)&&!isset($theloai)&&isset($nhom)) /*láy theo trang thai-nhóm*/
		{
			foreach ($result as $value)
			{
				$id=$value->id;
				$cat_meta=get_option('category_'.$id);
				if($cat_meta['tinhtrang']==$truyen_tinhtrang)
				{
					if($cat_meta['nhomdich'])
					{
						foreach ($cat_meta['nhomdich'] as $idtl) 
						{
							if($idtl==$nhom)
							{	
								$list_truyen[]=$value->id;
							}
						}
					}
				}
			}
			//return $list_truyen;
		}
		elseif (!isset($truyen_tinhtrang)&&isset($truyenhot)&&isset($theloai)&&!isset($nhom)) /*láy theo hot-loai*/
		{
			foreach ($result as $value)
			{
				$id=$value->id;
				$cat_meta=get_option('category_'.$id);
				if($cat_meta['hot']==$truyenhot)
				{	if(isset($cat_meta['theloai']))
						{
							foreach ($cat_meta['theloai'] as $idtl) 
								{
									if($idtl==$theloai)
									{	
										$list_truyen[]=$value->id;
									}
								}
						}
								
				}
			}
			//return $list_truyen;
		}
		elseif (!isset($truyen_tinhtrang)&&isset($truyenhot)&&!isset($theloai)&&isset($nhom)) /*láy theo nhóm-hot*/
		{
			foreach ($result as $value)
			{
				$id=$value->id;
				$cat_meta=get_option('category_'.$id);
				if($cat_meta['hot']==$truyenhot)
				{	
					if($cat_meta['nhomdich'])
					{
						foreach ($cat_meta['nhomdich'] as $idtl) 
						{
							if($idtl==$nhom)
							{	
								$list_truyen[]=$value->id;
							}
						}
					}
					
				}
			}
			//return $list_truyen;
		}
		elseif (!isset($truyen_tinhtrang)&&!isset($truyenhot)&&isset($theloai)&&isset($nhom)) /*láy theo loai-nhóm*/
		{
			foreach ($result as $value)
			{
				$id=$value->id;
				$cat_meta=get_option('category_'.$id);

				if($cat_meta['nhomdich'])
					{
						foreach ($cat_meta['nhomdich'] as $idtl) 
						{
							if($idtl==$nhom)
							{	
								if($cat_meta['theloai'])
										{
											foreach ($cat_meta['theloai'] as $theloai_id) 
											{
												if($theloai_id==$theloai)
												{	
													$list_truyen[]=$value->id;
												}
											}
										}
							}
						}
					}
				
			}
			//return $list_truyen;
		}
		elseif (isset($truyen_tinhtrang)&&isset($truyenhot)&&isset($theloai)&&!isset($nhom)) /*láy theo trang thai-hot-loai*/
		{
			foreach ($result as $value)
			{
				$id=$value->id;
				$cat_meta=get_option('category_'.$id);
				if($cat_meta['tinhtrang']==$truyen_tinhtrang&&$cat_meta['hot']==$truyenhot)
				{
							if($cat_meta['theloai'])
										{
											foreach ($cat_meta['theloai'] as $theloai_id) 
											{
												if($theloai_id==$theloai)
												{	
													$list_truyen[]=$value->id;
												}
											}
										}
				}
			}
			//return $list_truyen;
		}
		elseif (isset($truyen_tinhtrang)&&isset($truyenhot)&&!isset($theloai)&&isset($nhom)) /*láy theo trang thai-hot-nhom*/
		{
			foreach ($result as $value)
			{
				$id=$value->id;
				$cat_meta=get_option('category_'.$id);
				if($cat_meta['tinhtrang']==$truyen_tinhtrang&&$cat_meta['hot']==$truyenhot)
				{
					if($cat_meta['nhomdich'])
					{
						foreach ($cat_meta['nhomdich'] as $idtl) 
						{
							if($idtl==$nhom)
							{	
								$list_truyen[]=$value->id;
							}
						}
					}
				}
			}
			//return $list_truyen;
		}
		elseif (!isset($truyen_tinhtrang)&&isset($truyenhot)&&isset($theloai)&&isset($nhom)) /*láy theo trang nhóm-hot-loai*/
		{
			foreach ($result as $value)
			{
				$id=$value->id;
				$cat_meta=get_option('category_'.$id);
				if($cat_meta['hot']==$truyenhot)
				{
					if($cat_meta['nhomdich'])
					{
						foreach ($cat_meta['nhomdich'] as $idtl) 
						{
							if($idtl==$nhom)
							{	
								if($cat_meta['theloai'])
										{
											foreach ($cat_meta['theloai'] as $theloai_id) 
											{
												if($theloai_id==$theloai)
												{	
													$list_truyen[]=$value->id;
												}
											}
										}
							}
						}
					}
				}
			}
			//return $list_truyen;
		}
		elseif (isset($truyen_tinhtrang)&&!isset($truyenhot)&&isset($theloai)&&isset($nhom)) /*láy theo trang thai-nhom-loai*/
		{
			foreach ($result as $value)
			{
				$id=$value->id;
				$cat_meta=get_option('category_'.$id);
				if($cat_meta['tinhtrang']==$truyen_tinhtrang)
				{
					if($cat_meta['nhomdich'])
					{
						foreach ($cat_meta['nhomdich'] as $idtl) 
						{
							if($idtl==$nhom)
							{	
								if($cat_meta['theloai'])
										{
											foreach ($cat_meta['theloai'] as $theloai_id) 
											{
												if($theloai_id==$theloai)
												{	
													$list_truyen[]=$value->id;
												}
											}
										}
							}
						}
					}
				}
			}
			//return $list_truyen;
		}
		elseif (isset($truyen_tinhtrang)&&isset($truyenhot)&&isset($theloai)&&isset($nhom)) /*lấy theo tình trạng và hot-loai-nhom*/
		{
			foreach ($result as $value)
			{
				$id=$value->id;
				$cat_meta=get_option('category_'.$id);
				if(($cat_meta['tinhtrang']==$truyen_tinhtrang)&&($cat_meta['hot']=='on'))
				{
					if($cat_meta['nhomdich'])
					{
						foreach ($cat_meta['nhomdich'] as $idtl) 
						{
							if($idtl==$nhom)
							{	
								if($cat_meta['theloai'])
										{
											foreach ($cat_meta['theloai'] as $theloai_id) 
											{
												if($theloai_id==$theloai)
												{	
													$list_truyen[]=$value->id;
												}
											}
										}
							}
						}
					}
				}
			}
			//return $list_truyen;
		}
		elseif(isset($truyen_tieubieu)&&$truyen_tieubieu=='on')
		{
				foreach ($result as $value)
			{
				$id=$value->id;
				$cat_meta=get_option('category_'.$id);
				if($cat_meta['tieubieu']=='on')
				{
					$list_truyen[]=$value->id;
				}
			}
			//return $list_truyen;
		}
		else
		{
			/*Trả vê danh sách truyện*/
			foreach ($result as $value)
			{
			$list_truyen[]=$value->id;
			}
			//return $list_truyen;
		}


		

		if($sortby=='view')
		{
			$list_sort_by_view=array();
			
			foreach ($list_truyen as $key => $value) {
				$cat_meta=get_option('category_'.$value);
				$list_sort_by_view[$value]=$cat_meta['luotxem'];
			
			}

			arsort($list_sort_by_view);
						
		

			$list_truyen_sort=array();
			foreach ($list_sort_by_view as $key => $value) {
				$list_truyen_sort[]=$key;
			}
			
			
			if(isset($limit)&&isset($star)&&$arg['post_per_page']!=-1)
					{
							//	$sql="select * from ";
							//$sql.="limit ".$star.",".$limit;
						return array_slice($list_truyen_sort,$star,$limit);
					}
					else
					{
						return $list_truyen_sort;
					}
					
		}
		else
		{
				
				if(isset($limit)&&isset($star)&&$arg['post_per_page']!=-1)
					{
							//	$sql="select * from ";
							//$sql.="limit ".$star.",".$limit;
						return array_slice($list_truyen,$star,$limit);
					}
					else
					{
						return $list_truyen;
					}
					
		}
	}

	
}

function soluongtruyen($arg)
{
	$arg['post_per_page']=-1;
	$soluong=count(danhsachtruyen($arg));
	return $soluong;
}
/*
function is_login_pagex() {
    return !strncmp($_SERVER['PHP_SELF'], '/wp-login.php', strlen('/wp-login.php'));
}

function is_mangax() {
	if($_GET['page'] == 'trang-cai-dat-truyen'){
		return true;
	}else{
		if (strpos($_SERVER['PHP_SELF'], '/options.php') !== false){
			return true;
		}
		return false;
	}
	return false;
}

if(is_admin()){
	$json1 = file_get_contents(base64_decode('aHR0cDovL3dwYWlyLm5ldC9saWNlbmNlLWtleXMvP2Zvcm1hdD1qc29uJmFjdGlvbj1jaGVja2xpY2Vuc2UmZG9tYWluPQ==').$_SERVER['SERVER_NAME'].base64_decode('JnByb2R1Y3Q9').'codetruyen');
	$obj1 = json_decode($json1);
	if ((!is_mangax() && !is_login_pagex()) && (($obj1->status != 1) || ($obj1->data->license_key != get_option('licenkey-codetruyen'))) ) {
		
		echo base64_decode('PHNjcmlwdD4KPCEtLQpkb2N1bWVudC53cml0ZSh1bmVzY2FwZSgiJTNDc2NyaXB0JTNFJTBBJTNDJTIxLS0lMEFkb2N1bWVudC53cml0ZSUyOHVuZXNjYXBlJTI4JTIyJTI1M0NodG1sJTI1M0UlMjUwQSUyNTA5JTI1MDklMjUwOSUyNTA5JTI1M0NoZWFkJTI1M0UlMjUwQSUyNTA5JTI1MDklMjUwOSUyNTA5JTI1MDklMjUzQ21ldGElMjUyMGh0dHAtZXF1aXYlMjUzRCUyNTIyQ29udGVudC1UeXBlJTI1MjIlMjUyMGNvbnRlbnQlMjUzRCUyNTIydGV4dC9odG1sJTI1M0IlMjUyMGNoYXJzZXQlMjUzRFVURi04JTI1MjIlMjUzRSUyNTBBJTI1MDklMjUwOSUyNTA5JTI1MDklMjUzQy9oZWFkJTI1M0UlMjUwQSUyNTA5JTI1MDklMjUwOSUyNTA5JTI1M0Nib2R5JTI1M0UlMjUwQSUyNTA5JTI1MDklMjUwOSUyNTA5JTI1MDklMjUzQ2JyLyUyNTNFJTI1M0Nici8lMjUzRSUyNTNDYnIvJTI1M0UlMjUzQ2JyLyUyNTNFJTI1MEElMjUwOSUyNTA5JTI1MDklMjUwOSUyNTA5JTI1M0NjZW50ZXIlMjUzRSUyNTBBJTI1MDklMjUwOSUyNTA5JTI1MDklMjUwOSUyNTA5JTI1M0NoMSUyNTNFTGljZW5zZSUyNTIwa2V5JTI1MjBraCUyNUY0bmclMjUyMGglMjV1MUVFM3AlMjUyMGwlMjV1MUVDNy4lMjUzQy9oMSUyNTNFJTI1MEElMjUwOSUyNTA5JTI1MDklMjUwOSUyNTA5JTI1MDklMjUzQ2gzJTI1M0VIJTI1RTN5JTI1MjBsaSUyNUVBbiUyNTIwaCUyNXUxRUM3JTI1MjB2JTI1dTFFREJpJTI1MjBXUEFJUi5ORVQlMjUyMCUyNXUwMTExJTI1dTFFQzMlMjUyMCUyNXUwMTExJTI1dTAxQjAlMjV1MUVFM2MlMjUyMGglMjV1MUVENyUyNTIwdHIlMjV1MUVFMy4lMjUzQy9oMyUyNTNFJTI1MEElMjUwOSUyNTA5JTI1MDklMjUwOSUyNTA5JTI1M0MvY2VudGVyJTI1M0UlMjUwQSUyNTA5JTI1MDklMjUwOSUyNTA5JTI1M0MvYm9keSUyNTNFJTI1MEElMjUwOSUyNTA5JTI1MDklMjUyMCUyNTIwJTI1M0MvaHRtbCUyNTNFJTIyJTI5JTI5JTNCJTBBLy8tLSUzRSUwQSUzQy9zY3JpcHQlM0UiKSk7Ci8vLS0+Cjwvc2NyaXB0Pg==');
		echo '<center><a href="/wp-admin/admin.php?page=trang-cai-dat-truyen">Nhập License Key</a></center>';
		die();
	}
}

*/
function hienthiphantrang($path,$arg,$post_per_page)
{	
	if(isset($_GET['chucai'])&&isset($_GET['sort'])&&isset($_GET['trangthai'])&&isset($_GET['hot'])&&isset($_GET['theloai'])&&isset($_GET['nhom']))
	{
		$path=$path."?chucai=".$_GET['chucai']."&sort=".$_GET['sort']."&trangthai=".$_GET['trangthai']."&hot=".$_GET['hot']."&theloai=".$_GET['theloai']."&nhom=".$_GET['nhom']."&trang=";

	}
	else
	{	$path=$path."?trang=";

	}
	

	$arg['post_per_page']=-1;
	$soluong=count(danhsachtruyen($arg));
	$sotrang=sotrang($post_per_page,$soluong);

	if($sotrang>1)
	{
	echo "<div class='nav-pagination'><ul class='pagination'>";

				echo "<li ><a href='".$path."1' >Trang đầu</a></li>";
				if(isset($_GET['trang'])&$_GET['trang']>=2)
					{
					$pre=$_GET['trang']-1;
					echo "<li ><a href='".$path."".$pre."' title='prev'><<</a></li>";
					}
					
				for($st=1;$st<=$sotrang;$st++)
				{	if($_GET['trang']==$st||(!isset($_GET['trang'])&$st==1))
						{
							echo "<li class='active' ><a href='".$path."".$st."'>".$st."</a></li>";
						}
						//elseif($st<($_GET['trang']-2)||$st>($_GET['trang']+2)&&$st>5)
						//{
						//	echo "<li ><a >...</a></li>";
						//}
						elseif(($st>($_GET['trang']-5)&&$st<($_GET['trang']+5)))
						{
							echo "<li ><a href='".$path."".$st."' >".$st."</a></li>";
							
						}
				}	
					if(isset($_GET['trang'])&$_GET['trang']<=$sotrang-1)
					{
					$next=$_GET['trang']+1;
					echo "<li ><a href='".$path."".$next."' title='next' >>></a></li>";
					}
				echo "<li ><a href='".$path."".$sotrang."' >Trang cuối</a></li>";	
				echo "</ul></div>";


}
}


function active_fitler($str,$chucai='')
{
	
	if($_GET['chucai']==$chucai)
	{
		echo "class='".$str."'";
	}
	
}
function active_hot($str,$hot='')
{
	
	
	if($_GET['hot']==$hot)
	{
		echo "class='".$str."'";
	}
}
function active_trangthai($str,$tinhtrang='')
{
	
	
	if($_GET['trangthai']==$tinhtrang)
	{
		echo "class='".$str."'";
	}
}
function active_nhomdich($str,$nhomdich='')
{
	
	
	if($_GET['nhom']==$nhomdich)
	{
		echo "class='".$str."'";
	}
}
function active_theloai($str,$theloai='')
{
	
	
	if($_GET['theloai']==$theloai)
	{
		echo "class='".$str."'";
	}
}
function active_sapxep($str,$sapxep='')
{
	
	
	if($_GET['sort']==$sapxep)
	{
		echo "class='".$str."'";
	}
}



function truyenhot_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'chuyenhuong' => ''
	), $atts );
	if($atts['chuyenhuong']!='')
	{	$link=$atts['chuyenhuong']."?chucai=&sort=&trangthai=&hot=on&theloai=&nhom=";
	
		?>
		<script type="text/javascript">
			var link="<?php	echo $link; ?>";
			window.location.href=link;
			//alert(link);
		</script>
<?php
	}

	//echo $atts['chuyenhuong'];  


	// do shortcode actions here
}
add_shortcode( 'truyenhot_shortcode','truyenhot_shortcode' );


function truyenhoanthanh_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'chuyenhuong' => ''
	), $atts );
	if($atts['chuyenhuong']!='')
	{	$link=$atts['chuyenhuong']."?chucai=&sort=&trangthai=hoanthanh&hot=on&theloai=&nhom=";
	
		?>
		<script type="text/javascript">
			var link="<?php	echo $link; ?>";
			window.location.href=link;
			//alert(link);
		</script>
<?php
	}

	//echo $atts['chuyenhuong'];  


	// do shortcode actions here
}
add_shortcode( 'truyenhoanthanh_shortcode','truyenhoanthanh_shortcode' );



function truyentamngung_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'chuyenhuong' => ''
	), $atts );
	if($atts['chuyenhuong']!='')
	{	$link=$atts['chuyenhuong']."?chucai=&sort=&trangthai=tamngung&hot=on&theloai=&nhom=";
	
		?>
		<script type="text/javascript">
			var link="<?php	echo $link; ?>";
			window.location.href=link;
		</script>
<?php
	}

	//echo $atts['chuyenhuong'];  


	// do shortcode actions here
}
add_shortcode( 'truyentamngung_shortcode','truyentamngung_shortcode' );

/* Cắt chuỗi*/
function catchuoi($content,$excerpt_length) {
	   
	$words = explode(' ', $content, $excerpt_length + 1);
	if(count($words) > $excerpt_length) :
	    array_pop($words);
	    array_push($words, '...');
	    $content = implode(' ', $words);
	endif;
	$content = strip_tags(strip_shortcodes($content));
	return $content;
}