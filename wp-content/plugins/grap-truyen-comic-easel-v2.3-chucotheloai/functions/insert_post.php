<?php

/* ==========  Tạo truyện  ========== */

function grab_truyen_insert_post() {
    if (isset($_POST['post_title'])):

        $post_title = $_POST['post_title'];
        $cat_name = $_POST['category'];
        $nguon = $_POST['nguon_truyen'];




        //$check=get_post_by_name($post_title);
        $check = term_exists($post_title, 'category');
        if ($check == 0) {
            insert_chapter($post_title);
            $chapter_id = term_exists($post_title, 'category');
            $idtruyen = $chapter_id['term_id'];

            echo "Tạo thành công truyện " . $post_title;


            /* Cập nhật thể loại */
            insert_theloai($cat_name);
            $theloai = term_exists($cat_name, 'the-loai');
            $theloai = $theloai['term_id'];
            $cat_meta = get_option('category_' . $idtruyen);


            $cat_meta['theloai'][$theloai] = $theloai;
            $cat_meta['nguon'] = $nguon;
            update_option('category_' . $idtruyen, $cat_meta);
            //echo "<br> Chèn thành công thể loại".$cat_name;
        } else {
            echo "Truyện này đã được tạo";
        }

    endif;

    die;
}

add_action('wp_ajax_grab_truyen_insert_post', 'grab_truyen_insert_post');

/* ==========  Tạo chap  ========== */

function grab_truyen_insert_chap_to_post() {

    if (isset($_POST['post_title'])):

        $post_title = $_POST['post_title'];
        $chap_title = $_POST['chap_title'];
        $chap_content = $_POST['chap_content'];
        $tenchuong = $_POST['tenchuong'];
        $quyen = $_POST['quyen'];
        $link_chap = $_POST['link_chap'];

        if (preg_match('/truyencv/', $tenchuong)) {
            $tenchuong = get_title_single_truyencv($tenchuong);
        }


        $chapter_id = term_exists($post_title, 'category');

        if ($chapter_id == 0) {

            insert_chapter($post_title);
            $chapter_id = term_exists($post_title, 'category');
            $chapter_id = $chapter_id['term_id'];
        } else {
            $chapter_id = $chapter_id['term_id'];
        }


        $my_post = array(
            'post_type' => 'post',
            'post_title' => $chap_title,
            'post_status' => 'publish',
            'post_date' => current_time('mysql'),
            'post_content' => $chap_content,
            'post_category' => array($chapter_id)
        );




        $res = wp_insert_post($my_post);



        if ($res > 0):
            //wp_set_object_terms( $res, (int) $chapter_id, 'category', true);
            update_post_meta($res, 'comic_post_tenchuong', $tenchuong);
            update_post_meta($res, 'link_chap_url', $link_chap);
            echo '<p>*Chèn <span class="grab-chap-span-title">' . $chap_title . "-" . $chapter_id . '</span> vào truyện <span class="grab-truyen-span-title">' . $post_title . '</span> thành công!</p>';

        else:
            echo '0';
        endif;


    endif;
    die;
}

add_action('wp_ajax_grab_truyen_insert_chap_to_post', 'grab_truyen_insert_chap_to_post');




/* ===============Tạo chương========================= */

function insert_chapter($ten_chuong) {
    wp_insert_term(
            $ten_chuong, // the term 
            'category', // the taxonomy
            array(
        'description' => $ten_chuong,
            )
    );
}

/* ===============Tạo chương========================= */

function insert_theloai($ten_theloai) {
    wp_insert_term(
            $ten_theloai, // the term 
            'the-loai', // the taxonomy
            array(
        'description' => $ten_theloai,
            )
    );
}

/* ==========  Lưu ảnh vào WP Media  ========== */

function save_img_media($link_anh) {
    if ($link_anh != "") {

        $imageurl = $link_anh;

        $upload_dir = wp_upload_dir();
        $upload_path = $upload_dir['path'] . '/';

        $pr = '.jpg';
        $name = date("Y-m-d-H-i-s", time()) . '-' . date("Y-m-d-H-i-s", time());
        $ul = $upload_path . $name . $pr;
        $contents = file_get_contents($imageurl);
        $savefile = fopen($ul, 'w');
        fwrite($savefile, $contents);
        fclose($savefile);

        //return $upload_dir['url'] . '/'.$name.$pr;
        return $upload_path . $name . $pr;
    }
}

/* =========đặt ảnh đại diện cho truyen========= */

function save_to_media($img)/* Lưu vào media */ {
    if ($img != "") {
        $filename = $img; //$_SERVER['DOCUMENT_ROOT'].'/hamtruyen/wp-content/uploads/2015/03/demo.jpg';
        // Check the type of file. We'll use this as the 'post_mime_type'.
        $filetype = wp_check_filetype(basename($filename), null);

        $wp_upload_dir = wp_upload_dir();
        $attachment = array(
            'guid' => $wp_upload_dir['url'] . '/' . basename($filename),
            'post_mime_type' => $filetype['type'],
            'post_title' => $filename,
            'post_content' => $filename,
            'post_status' => 'inherit'
        );

        $attach_id = wp_insert_attachment($attachment, $filename, "");
        //include( ABSPATH . 'wp-admin/includes/image.php' );
        $attach_data = wp_generate_attachment_metadata($attach_id, $filename);
        $thumbid = wp_update_attachment_metadata($attach_id, $attach_data);
        return $attach_id;
        //set_post_thumbnail($idpost, $attach_id );
    }
}
