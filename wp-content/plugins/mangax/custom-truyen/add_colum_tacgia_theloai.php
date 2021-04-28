<?php

/*them cot thet loai vao trang admin category*/

function xoa_columns_mota($col)

{

 // add 'My Column'
unset(
 $col['description']
 
);


 return $col;

}

add_filter('manage_edit-category_columns','xoa_columns_mota');

/*them cot thet loai vao trang admin category*/

function add_columns_theloai($col)

{

 // add 'My Column'

 $col['theloai'] = 'Thể Loại';
 $col['tacgia'] = 'Tác giả';
  $col['hinhanh'] = 'Ảnh';
  $col['tinhtrang']='Tình trạng';



 return $col;

}

add_filter('manage_edit-category_columns','add_columns_theloai');




function album_column_theloai( $columns, $column, $id ) {

  if ( $column == 'theloai' )
  {
    $theloai="";
     $theloai_category=get_option( "category_$id");
     if(isset($theloai_category['theloai']))
     {


       foreach ($theloai_category['theloai'] as $value) {

       $term_theloai=get_term($value,'the-loai'); 
       $theloai.=$term_theloai->name."<br>";
      }
    }
    

    $columns=$theloai;

    

    return $columns;
  }
  elseif ($column=="tacgia") {
    $tacgia="";
     $tacgia_category=get_option( "category_$id");
 
  
    
  //  $term_tacgia=get_term($tacgia_category['tacgia'],'tac-gia'); 

    $columns=$tacgia_category['tacgia'];

    

  return $columns;
  }


  elseif ($column=="hinhanh") {
  	
  	 $columns='<img src="'.get_anhdaidien($id).'" width="50px"';

    

  return $columns;
  }
   elseif ($column=="tinhtrang") {
     $tinhtrang_category=get_option( "category_$id");
     $tinhtrang="";
    if($tinhtrang_category['tieubieu']=='on')
    {
      $tinhtrang.="<a title='truyện nổi bật'  ><img src='".COMIC_URL."images/star.png' alt='truyện nổi bật' ></a>"; 
    }
    else
    {
      $tinhtrang.="<a title='truyện không nổi bật'  ><img src='".COMIC_URL."images/star_off.png' alt='truyện không nổi bật' ></a>"; 
    }
    $tinhtrang.="<br>";

    if($tinhtrang_category['hot']=='on')
    {
      $tinhtrang.="<a title='truyện hot'  ><img src='".COMIC_URL."images/hot.png' alt='truyện hot' ></a>"; 
    }
    if($tinhtrang_category['tinhtrang']=='hoanthanh')
    {
       $tinhtrang.="Hoàn thành";
    }
    elseif($tinhtrang_category['tinhtrang']=='tamngung')
    { $tinhtrang.="Tạm ngưng";

    }
    else
    {
      $tinhtrang.="Đang cập nhật";
    }
   
    $columns=$tinhtrang;

    

  return $columns;
  }

 

}

add_filter( 'manage_category_custom_column', 'album_column_theloai', 10, 3 );