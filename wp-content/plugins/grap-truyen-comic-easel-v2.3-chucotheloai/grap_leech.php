<?php
/* ==========  Check  ========== */

function grap_leech() {

    if (isset($_POST['link_truyen'])):

        $ten_truyen = trim($_POST['ten_truyen']);
        $link_truyen = $_POST['link_truyen'];
        $nguon_truyen = $_POST['nguon_truyen'];
        $kieu_noi_dung = $_POST['kieu_noi_dung'];
        $truyen_co_nhieu_chap = $_POST['truyen_co_nhieu_chap'];
        $loai_truyen = $_POST['loai_truyen'];
        $html_loop_item = $_POST['html_loop_item'];
        $html_chap_truyen = $_POST['html_chap_truyen'];
        $html_ten_chap_truyen = $_POST['html_ten_chap_truyen'];
        $html_noi_dung_truyen = $_POST['html_noi_dung_truyen'];

        //#wrapper_listchap .nano .content .tenChapter

        if ($nguon_truyen == "truyentranh8.com"):
            grap_truyentranh8dotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen);

        elseif ($nguon_truyen == "truyenviet.com"):
            grap_truyenvietdotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen);

        elseif ($nguon_truyen == "nettruyen.com"):
            grap_nettruyendotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen);

        elseif ($nguon_truyen == "mangago.me"):
            grap_mangagome($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen);

        elseif ($nguon_truyen == "thichtruyen.vn"):
            grap_thichtruyendotvn($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen);

        elseif ($nguon_truyen == "vechai.info"):
            grap_vechaidotinfo($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen);

        elseif ($nguon_truyen == "comicvn.net"):
            grap_comicvndotnet($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen);

        elseif ($nguon_truyen == "blogtruyen.com"):

            grap_blogtruyendotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen);

        elseif ($nguon_truyen == "webtruyen.com"):
            grap_webtruyendotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen);
        elseif ($nguon_truyen == "truyenyy.com"):
            grap_truyenyydotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen);

        elseif ($nguon_truyen == "truyencv.com"):
            grap_truyencvdotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen);
        elseif ($nguon_truyen == "truyentranhtuan.com"):
            grap_truyentranhtuandotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen);

        elseif ($nguon_truyen == "bbs.hako.re"):
            grap_bbshakodotre($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen);

        elseif ($nguon_truyen == "doctruyen360.com"):
            grap_doctruyen360dotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen);
        elseif ($nguon_truyen == "mangasee.co"):
            grap_mangaseedotco($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen);
        elseif ($nguon_truyen == "tunghoanh.com"):
            grap_tunghoanhdotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen);
        elseif ($nguon_truyen == "thuquantruyen.com"):
            grap_thuquantruyendotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen);
        elseif ($nguon_truyen == "santruyen.com"):
            grap_santruyendotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen);

        else:
            echo '<div class="postbox">';
            if (empty($truyen_co_nhieu_chap) && ($kieu_noi_dung == "html")) {
                get_single_content($link_truyen, $html_noi_dung_truyen);
            } else if (!empty($truyen_co_nhieu_chap)) {
                get_list($ten_truyen, $link_truyen, $kieu_noi_dung, $html_loop_item, $html_chap_truyen, $html_ten_chap_truyen);
            } else {
                echo "<p style='margin:10px'><b>Oops!</b> Hình như các giá trị bạn nhập vào chưa đúng. Vui lòng kiểm tra lại!</p>";
            }
            echo '</div>';
        endif;
    endif;

    if (isset($_POST['link_chap'])):

        $link_chap = $_POST['link_chap'];
        $html_noi_dung_truyen = $_POST['html_noi_dung_truyen'];
        $nguon_truyen = $_POST['nguon_truyen'];

        echo '<div class="postbox">';

        if ($nguon_truyen == "truyentranh8.com") {
            echo $content_chap = get_single_content_truyentranh8dotcom($link_chap);
        } elseif ($nguon_truyen == "vechai.info") {
            echo get_single_content_vechaidotinfo($link_chap);
        } elseif ($nguon_truyen == "nettruyen.com") {
            echo get_single_content_nettruyendotcom($link_chap);
        } elseif ($nguon_truyen == "mangago.me") {
            echo get_single_content_mangagome($link_chap);
        } elseif ($nguon_truyen == "truyenviet.com") {
            echo get_single_content_truyenvietdotcom($link_chap);
        } elseif ($nguon_truyen == "thichtruyen.vn") {
            echo get_single_content_thichtruyendotvn($link_chap);
        } elseif ($nguon_truyen == "comicvn.net") {
            echo get_single_content_comicvndotnet($link_chap);
        } elseif ($nguon_truyen == "blogtruyen.com") {
            echo get_single_content_blogtruyendotcom($link_chap);
        } elseif ($nguon_truyen == "webtruyen.com") {
            echo get_single_content_webtruyendotcom($link_chap);
        } elseif ($nguon_truyen == "truyentranhtuan.com") {
            echo get_single_content_truyentranhtuandotcom($link_chap);
        } elseif ($nguon_truyen == "truyenyy.com") {
            echo get_single_content_truyenyydotcom($link_chap);
        } elseif ($nguon_truyen == "truyencv.com") {
            echo get_single_content_truyencvdotcom($link_chap);
        } elseif ($nguon_truyen == "bbs.hako.re") {
            echo get_single_content_bbshakodotre($link_chap);
        } elseif ($nguon_truyen == "doctruyen360.com") {
            echo get_single_content_doctruyen360dotcom($link_chap);
        } elseif ($nguon_truyen == "mangasee.co") {
            echo get_single_content_mangaseedotco($link_chap);
        } elseif ($nguon_truyen == "tunghoanh.com") {
            echo get_single_content_tunghoanhdotcom($link_chap);
        } elseif ($nguon_truyen == "thuquantruyen.com") {
            echo get_single_content_thuquantruyendotcom($link_chap);
        } elseif ($nguon_truyen == "santruyen.com") {
            echo get_single_content_santruyendotcom($link_chap);
        }

        echo '</div>';
    endif;
    die;
}

add_action('wp_ajax_grap_leech', 'grap_leech');

/* ==========  Lấy danh sách chap của truyện  ========== */

function get_list($ten_truyen, $link_truyen, $kieu_noi_dung, $html_loop_item, $html_chap_truyen, $html_ten_chap_truyen) {
    if ($kieu_noi_dung == "rss") {
        $dom = new DOMDocument('1.0', 'utf-8'); //tao doi tuong dom 
        $dom->load($link_truyen); //muon lay rss tu trang nao thi ban khai bao day 
        $items = $dom->getElementsByTagName($html_loop_item); //lay cac element co tag name la item va gan vao bien $items





        if (count($items) > 0) {
            ?>
            <h2 class="grap-title">Danh sách Chap</h2>
            <table class="widefat">
                <thead>
                <th width="10px"></th>
                <th>Chap</th>
                <th>Link</th>
                <th width="110px">Lấy nội dung</th>
            </thead>
            <tbody>
                <?php
                $i = 0;

                $array_ten_chap = check_chap_exists($ten_truyen);

                foreach ($items as $item) {
                    //lay cac element co tag name la title va gan vao bien $titles 
                    $titles = $item->getElementsByTagName($html_ten_chap_truyen);

                    //lay ra gia tri dau tien trong array $titles
                    $title = trim($titles->item(0)->nodeValue);
                    $links = $item->getElementsByTagName('link');
                    $link = $links->item(0)->nodeValue;

                    $has_chap = in_array($title, $array_ten_chap);
                    ?>
                    <tr <?php if ($has_chap == true) echo "class='grab-tr-disable'" ?> id="<?php echo sanitize_title($title); ?>">

                        <td>
                            <input type="checkbox" 
                                   data-id="<?php
                                   echo $i;
                                   $i++;
                                   ?>"
                                   value="<?php echo $link; ?>" 
                                   data-link="<?php echo $link ?>" 
                                   data-title="<?php echo $title; ?>" 
                                   <?php if ($has_chap == true) echo "disabled"; ?> 
                                   <?php if ($has_chap == true) echo "class='grab-not-select'" ?> />
                        </td>

                        <td>
                            <?php echo $title; ?>
                        </td>

                        <td>
                            <a href="<?php echo $link; ?>" target="_blank"><?php echo $link; ?></a>
                        </td>

                        <td>
                            <input type="button" data-link="<?php echo $link ?>" 
                                   data-title="<?php echo $title; ?>" 
                                   data-chapname="chapter"
                                   class="button-primary click-to" id="lay-<?php echo $i; ?>"
                                   <?php if ($has_chap == true) echo "disabled" ?> 
                                   value="<?php
                                   if ($has_chap == true)
                                       echo "Đã lấy";
                                   else
                                       echo "Lấy ";
                                   ?>" />
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            </table>
            <?php
        }
    }else if ($kieu_noi_dung == "html") {
        $html = file_get_html($link_truyen);

        $array_chap = $html->find($html_chap_truyen);

        if (is_array($array_chap)):
            ?>
            <h2 class="grap-title">Danh sách chap</h2>
            <table class="widefat">
                <thead>
                <th>Chap</th>
                <th>Link</th>
                <th>Lấy nội dung</th>
            </thead>
            <tbody>
                <?php
                foreach ($array_chap as $article) {
                    ?>
                    <tr>
                        <td><?php echo $article->find('a', 0)->plaintext ?></td>
                        <td>
                            <a>
                                <?php
                                $link_chap = $article->find('a', 0)->href;
                                $link_chap = Check_link($link_truyen, $link_chap);
                                echo $link_chap;
                                ?>
                            </a>
                        </td>
                        <td>
                            <input data-link="<?php echo $link_chap ?>" type="button" class="button-primary click-to"   value="Chạy" />
                        </td>
                    </tr>
                    <?php
                }
                echo '</tbody></table>';
            endif;
        }
    }

    /* ==========  Lấy nội dung trang single  ========== */

    function get_single_content($link_chap, $html_noi_dung_truyen) {

        $html2 = file_get_html($link_chap);
        //$html2 = str_replace('<img < p>','',$html2);
        $array_content = $html2->find($html_noi_dung_truyen, 0);
        //$array_content = str_replace('<img <','',$array_content);
        echo '<h2 class="grap-title">Kiểm tra nội dung</h2>';
        //foreach($array_content as $content){
        echo "<div class='grab-content-chap'>" . $array_content . "</div>";
        //}
    }

    function Check_link($url, $link_chap) {

        $check_link_chap = parse_url($link_chap);
        if ($check_link_chap['scheme'] == null):
            $get_link_truyen = parse_url($url);
            $link_chap = $get_link_truyen['scheme'] . "://" . $get_link_truyen['host'] . $link_chap;
        endif;

        return $link_chap;
    }

    /**
     * Kiểm tra chap trong truyện đã có chưa
     * @param  string 	$ten_truyen 	[Tên đầy đủ có dấu của truyện]
     * @return array             		[Mảng Danh sách các chap]
     */
    function check_chap_exists($ten_truyen) {

        $chapter_id = term_exists($ten_truyen, 'category');
        $array_ten_chap = array();

        if ($chapter_id != 0)/* Có truyen này */ {

            $chapter_id = $chapter_id['term_id'];
            $chaps_exists = get_posts(
                    array(
                        'post_type' => 'post',
                        'posts_per_page' => -1,
                        'post_status' => 'publish',
                        'cat' => $chapter_id,
                    )
            );

            if ($chaps_exists):


                foreach ($chaps_exists as $chap):
                    $array_ten_chap[] = $chap->post_title;
                endforeach;
            endif;
        }






        return $array_ten_chap;
    }

    function get_post_by_name($ten_chuong) {
        global $wpdb;
        $query = "SELECT ID FROM wp_posts WHERE post_title like('%" . $ten_chuong . "%') AND post_status='publish' AND post_type ='post'";
        $result = $wpdb->get_var($query);
        $list = $wpdb->get_results($query);
        if ($result) {
            $id = 0;
            //ton tai truyen nay
            foreach ($list as $value) {
                $id = $value->ID;
            }
            return $id;
        } else {
            return 0;
        }
    }

    function curl_get_contents($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    /**
     * Kiểm tra chương đã tồn tại trong truyện theo link
     * @param type $ten_truyen
     * @return type
     */
    function check_chap_exists_by_link($ten_truyen) {

        $chapter_id = term_exists($ten_truyen, 'category');
        $array_link_chap = array();

        if ($chapter_id != 0)/* Có truyen này */ {

            $chapter_id = $chapter_id['term_id'];
            $chaps_exists = get_posts(
                    array(
                        'post_type' => 'post',
                        'posts_per_page' => -1,
                        'post_status' => 'publish',
                        'cat' => $chapter_id,
                    )
            );

            if ($chaps_exists):


                foreach ($chaps_exists as $chap):
                    $link_chap_url = get_post_meta($chap->ID, 'link_chap_url', true);
                    $array_link_chap[] = trim($link_chap_url);
                endforeach;
            endif;
        }

        return $array_link_chap;
    }

    /**
     *  Kiểm tra chương đã tồn tại trong truyện theo slug
     * @param type $ten_truyen
     * @return type
     */
    function check_chap_exists_by_slug($ten_truyen) {

        $chapter_id = term_exists($ten_truyen, 'category');
        $array_slug_chap = array();

        if ($chapter_id != 0)/* Có truyen này */ {

            $chapter_id = $chapter_id['term_id'];
            $chaps_exists = get_posts(
                    array(
                        'post_type' => 'post',
                        'posts_per_page' => -1,
                        'post_status' => 'publish',
                        'cat' => $chapter_id,
                    )
            );

            if ($chaps_exists):
                foreach ($chaps_exists as $chap):
                    $array_slug_chap[] = $chap->post_name;
                endforeach;
            endif;
        }
        return $array_slug_chap;
    }

    /**
     * Kiểm tra chương đã tồn tại trong truyện theo name
     * @param type $ten_truyen
     * @return type
     */
    function check_chap_exists_by_name($ten_truyen) {

        $chapter_id = term_exists($ten_truyen, 'category');
        $array_ten_chap = array();

        if ($chapter_id != 0)/* Có truyen này */ {

            $chapter_id = $chapter_id['term_id'];
            $chaps_exists = get_posts(
                    array(
                        'post_type' => 'post',
                        'posts_per_page' => -1,
                        'post_status' => 'publish',
                        'cat' => $chapter_id,
                    )
            );

            if ($chaps_exists):


                foreach ($chaps_exists as $chap):
                    $array_ten_chap[] = $chap->post_title;
                endforeach;
            endif;
        }

        return $array_ten_chap;
    }

    /**
     * Update truyen meta
     * @param type $author
     * @param type $theloai
     * @param type $ten_truyen
     */
    function capnhat_meta_truyen($author, $theloais, $ten_truyen) {

        $truyen = term_exists(trim($ten_truyen), 'category');
        if ($truyen !== 0 && $truyen !== null) {
            $idtruyen = $truyen['term_id'];
        } else {
            $idtruyen = nettruyen_insert_truyen(trim($ten_truyen));
        }


        $truyen_meta = get_option('category_' . $idtruyen);
        $truyen_meta['tacgia'] = $author;

        foreach ($theloais as $theloai) {

            $checktl = term_exists(trim($theloai), 'the-loai');

            if ($checktl !== 0 && $checktl !== null) {
                $truyen_meta['theloai'][$checktl['term_id']] = $checktl['term_id'];
            } else {
                $new_theloai = nettruyen_insert_theloai($theloai);
                $truyen_meta['theloai'][$new_theloai['term_id']] = $new_theloai['term_id'];
            }
        }


        update_option("category_$idtruyen", $truyen_meta);
    }
    