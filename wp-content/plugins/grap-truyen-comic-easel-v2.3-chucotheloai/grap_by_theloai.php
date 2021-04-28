<?php

function check_grap_the_loai() {
    if (isset($_POST['link_grap'])):
        $link_grap = $_POST['link_grap'];
        $nguon_grap = $_POST['nguon_grap'];
        $loai_truyen = $_POST['loai_truyen'];
        if ($nguon_grap == "webtruyen.com") {
            grap_theotheloai_webtruyendotcom($link_grap, $loai_truyen);
        }
    endif;
    die();
}

add_action('wp_ajax_check_grap_the_loai', 'check_grap_the_loai');

function grap_theo_the_loai() {
    if (isset($_REQUEST['link_truyen'])):
        $link_truyen = $_REQUEST['link_truyen'];
        $ten_truyen = $_REQUEST['ten_truyen'];
        $nguon_grap = $_REQUEST['nguon_grap'];
        $loai_truyen = $_REQUEST['loai_truyen'];

        if ($nguon_grap == "webtruyen.com") {
            //$truyen = array('cat_name' => $ten_truyen, 'category_description' =>$ten_truyen, 'category_parent' => '');
            //$chapter_id = wp_insert_category($truyen);
            //if($chapter_id!=0)
            //{
            //lay_danh_sanh_chuong_grap($link_truyen,$nguon_grap,$ten_truyen);
            //}
            //print_r(get_chaps_webtruyendotcom_auto($link_truyen, $ten_truyen));
            $list_link_chap = get_chaps_webtruyendotcom_auto($link_truyen, $ten_truyen);
            echo json_encode($list_link_chap);
            /*
              krsort($list_link_chap);
              if(count($list_link_chap)>0)
              {
              foreach ($list_link_chap as $chap)
              {
              $content=get_single_content_webtruyendotcom_auto($chap['link']);

              insert_chap_auto($chap['tentruyen'],$chap['title'],$content,$chap['tenchuong']);
              sleep(3);

              }
              }
             */
            //lay_danh_sanh_chuong_grap($link_truyen,$nguon_grap,$ten_truyen);
        }
    endif;
    die();
}

add_action('wp_ajax_grap_theo_the_loai', 'grap_theo_the_loai');

function check_truyen($ten_truyen) {

    $chapter_id = term_exists($ten_truyen, 'category');


    if ($chapter_id != 0)/* Có truyen này */ {
        return true;
    }
    return false;
}