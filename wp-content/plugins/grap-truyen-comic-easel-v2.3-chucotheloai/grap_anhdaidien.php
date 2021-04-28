<?php

function grap_anhdaidien() {
    if (isset($_REQUEST)) {

        $link_truyen = $_REQUEST['link_truyen'];
        $nguon_truyen = $_REQUEST['nguon_truyen'];
        $ten_truyen = $_REQUEST['ten_truyen'];




        if ($nguon_truyen == "webtruyen.com") {
            
            // Get author for truyen
            $author = getauthor_webtruyendotcom($link_truyen);

            // Update theloai for truyen
            $theloais = gettheloai_webtruyendotcom($link_truyen);
            capnhat_meta_truyen($author,$theloais,$ten_truyen);
            
            
            $img_url = getimage_webtruyen($link_truyen); /* Lấy link trên mạng */
            $img_url = save_img_media($img_url); /* Lưu link vào server */
            $img_id = save_to_media($img_url); /* Lưu hình vào media */
            $images = wp_get_attachment_image_src($img_id); // lấy link hình featured
            $img_url = $images[0]; // 0: link hình ; 1: width ; 2: height


            capnhat_link_img_truyen($ten_truyen, $img_url);
        } elseif ($nguon_truyen == "truyentranh8.com") {
            $img_url = getimage_truyentranh8dotcom($link_truyen);
            $img_url = save_img_media($img_url); /* Lưu link vào server */
            $img_id = save_to_media($img_url); /* Lưu hình vào media */
            $images = wp_get_attachment_image_src($img_id); // lấy link hình featured
            $img_url = $images[0]; // 0: link hình ; 1: width ; 2: height


            capnhat_link_img_truyen($ten_truyen, $img_url);
        }
        elseif ($nguon_truyen == "thichtruyen.vn") {
            
             // Get author for truyen
            $author = getauthor_thichtruyendotcom($link_truyen);

            // Update theloai for truyen
            $theloais = gettheloai_thichtruyendotcom($link_truyen);
            capnhat_meta_truyen($author,$theloais,$ten_truyen);
            
            
            $img_url = getimage_thichtruyendotcom($link_truyen);
            $img_url = save_img_media($img_url); /* Lưu link vào server */
            $img_id = save_to_media($img_url); /* Lưu hình vào media */
            $images = wp_get_attachment_image_src($img_id); // lấy link hình featured
            $img_url = $images[0]; // 0: link hình ; 1: width ; 2: height


            capnhat_link_img_truyen($ten_truyen, $img_url);
        } 
        elseif ($nguon_truyen == "blogtruyen.com")/* Đang lỗi */ {
            $img_url = getimage_blogtruyendotcom($link_truyen);
            $img_url = save_img_media($img_url); /* Lưu link vào server */
            $img_id = save_to_media($img_url); /* Lưu hình vào media */
            $images = wp_get_attachment_image_src($img_id); // lấy link hình featured
            $img_url = $images[0]; // 0: link hình ; 1: width ; 2: height
            //echo $img_url;
            capnhat_link_img_truyen($ten_truyen, $img_url);
        } elseif ($nguon_truyen == "comicvn.net") {
            $img_url = getimage_comicvndotnet($link_truyen);
            $img_url = save_img_media($img_url); /* Lưu link vào server */
            $img_id = save_to_media($img_url); /* Lưu hình vào media */
            $images = wp_get_attachment_image_src($img_id); // lấy link hình featured
            $img_url = $images[0]; // 0: link hình ; 1: width ; 2: height
            //echo $img_url;
            capnhat_link_img_truyen($ten_truyen, $img_url);
        } elseif ($nguon_truyen == "nettruyen.com") {

            // Get author for truyen
            $author = getauthor_nettruyendotcom($link_truyen);

            // Update theloai for truyen
            $theloais = gettheloai_nettruyendotcom($link_truyen);
            capnhat_meta_truyen($author,$theloais,$ten_truyen);

            // Update img for truyen
            $img_url = getimage_nettruyendotcom($link_truyen);
            $img_url = save_img_media($img_url); /* Lưu link vào server */
            $img_id = save_to_media($img_url); /* Lưu hình vào media */
            $images = wp_get_attachment_image_src($img_id); // lấy link hình featured
            $img_url = $images[0]; // 0: link hình ; 1: width ; 2: height
            //echo $img_url;
            capnhat_link_img_truyen($ten_truyen, $img_url);
        } elseif ($nguon_truyen == "truyenyy.com") {
            $img_url = getimage_truyenyydotcom($link_truyen);
            $img_url = save_img_media($img_url); /* Lưu link vào server */
            $img_id = save_to_media($img_url); /* Lưu hình vào media */
            $images = wp_get_attachment_image_src($img_id); // lấy link hình featured
            $img_url = $images[0]; // 0: link hình ; 1: width ; 2: height


            capnhat_link_img_truyen($ten_truyen, $img_url);
        } elseif ($nguon_truyen == "truyencv.com") {
            $img_url = layhinhanh_truyencv($link_truyen);
            $img_url = save_img_media($img_url); /* Lưu link vào server */
            $img_id = save_to_media($img_url); /* Lưu hình vào media */
            $images = wp_get_attachment_image_src($img_id); // lấy link hình featured
            $img_url = $images[0]; // 0: link hình ; 1: width ; 2: height


            capnhat_link_img_truyen($ten_truyen, $img_url);
        } elseif ($nguon_truyen == "bbs.hako.re")/**/ {
            $img_url = getimage_bbshakodotre($link_truyen);
            $img_url = save_img_media($img_url); /* Lưu link vào server */
            $img_id = save_to_media($img_url); /* Lưu hình vào media */
            $images = wp_get_attachment_image_src($img_id); // lấy link hình featured
            $img_url = $images[0]; // 0: link hình ; 1: width ; 2: height


            capnhat_link_img_truyen($ten_truyen, $img_url);
        } else {
            echo "Lỗi";
        }
    }
    die();
}

add_action('wp_ajax_grap_anhdaidien', 'grap_anhdaidien');
add_action('wp_ajax_nopriv_grap_anhdaidien', 'grap_anhdaidien');

function capnhat_link_img_truyen($ten_truyen, $linkanh) {

    $chapter_id = term_exists($ten_truyen, 'category'); /* Truyen co roi se tra ve ID, chua co tu tao moi roi tra ve ID */
    $idtruyen = $chapter_id['term_id'];


    $cat_meta = get_option('category_' . $idtruyen);

    if ($cat_meta['anhdaidien'] != "") {
        echo "Ảnh đại diện đã có!! Không cập nhất lại";
    } else {


        //echo "Thanh cong".$linkanh;
        if ($linkanh != "") {
            $cat_meta['anhdaidien'] = $linkanh;
            update_option('category_' . $idtruyen, $cat_meta);
            echo "Ảnh đại diện vừa được cập nhật" + $linkanh;
        } else {
            echo "Không thể cập nhật ảnh đại diện";
        }
    }
}
