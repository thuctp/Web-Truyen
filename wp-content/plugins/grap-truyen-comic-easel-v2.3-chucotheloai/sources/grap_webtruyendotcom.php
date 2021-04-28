<?php
if (!defined('ABSPATH'))
    exit;

function grap_webtruyendotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen) {
    ?>
    <div class="postbox"> <?php
        if (empty($truyen_co_nhieu_chap)):
        //get_single_content($link_truyen, $html_noi_dung_truyen);
        elseif (!empty($truyen_co_nhieu_chap)):

            get_chaps_webtruyendotcom($link_truyen, $ten_truyen);

        endif;
        ?>

    </div>
    <?php
}

function get_chaps_webtruyendotcom($link_truyen, $ten_truyen) {

    // Lấy danh sách chương của truyện
    $array_ten_chap = check_chap_exists($ten_truyen);

    // Lấy html của truyện
    $html = file_get_html($link_truyen);

    // Lấy số trang của truyện
    $maxpage = $html->find(".numbpage", 0)->innertext;
    $maxpage = strstr($maxpage, "/");
    $maxpage = trim(str_replace("/", "", $maxpage));
    ?>
    <h2 class="grap-title">Danh sách chaps</h2>

    <table class="widefat" id="grap-result">
        <thead>
        <th width="10px">
            <a onclick="checkByParent(true);
                        jQuery('.grap-multi-btn').css('display', 'inherit');
                        return false;">Check</a>
            <br/>
            <a onclick="checkByParent(false);
                        jQuery('.grap-multi-btn').css('display', 'none');
                        return false;">UnCheck</a>
        </th>
        <th>Chap</th>
        <th>Link</th>
        <th>Lấy nội dung</th>
    </thead>

    <tbody>
        <?php
        $list_chuong = array();

        $j = 0;

        for ($i = (int) $maxpage; $i >= 1; $i--) :

            $linkpage = $link_truyen . $i . '/';

            $page = file_get_html($linkpage);
            $chaps = $page->find("#divtab ul li");
            $chaps = Array_reverse($chaps);

            if (count($chaps) > 0) {

                foreach ($chaps as $chap) :
                    $chapurl = $chap->find("h4 a", 0)->href;
                    $tenchuong = $chap->find("h4 a", 0)->innertext;

                    $array_chuong = array();
                    if ($chapurl != '') {
                        $array_chuong['chapurl'] = $chapurl;
                        $array_chuong['tenchuong'] = $tenchuong;
                        $list_chuong[] = $array_chuong;
                        $j++;
                    }
                endforeach;
            }

        endfor;

        foreach ($list_chuong as $key => $chuong) :

            $chapurl = $chuong['chapurl'];
            $tenchuong = $chuong['tenchuong'];

            $has_chap = in_array($tenchuong, $array_ten_chap);
            ?>
            <tr <?php if ($has_chap == true) echo "class='grab-tr-disable'" ?> id="<?php echo sanitize_title($tenchuong); ?>">
                <td>
                    <input type="checkbox" 
                           value="<?php echo $chapurl; ?>" 
                           data-link="<?php echo $chapurl ?>" 
                           data-title="<?php echo $tenchuong; ?>"
                           <?php if ($has_chap == true) echo "disabled"; ?> 
                           <?php if ($has_chap == true) echo "class='grab-not-select'" ?> />
                </td>
                <td><?php echo $tenchuong; ?></td>
                <td>
                    <a>
                        <?php echo $chapurl; ?>
                    </a>
                </td>
                <td>
                    <input type="button" data-link="<?php echo $chapurl ?>" 
                           data-title="<?php echo $tenchuong; ?>"
                           class="button-primary click-to" 

                           <?php if ($has_chap == true) echo "disabled" ?> 
                           value="<?php
                           if ($has_chap == true)
                               echo "Đã lấy";
                           else
                               echo "Lấy";
                           ?>" />
                </td>
            </tr>
            <?php
        endforeach;
        ?>
    </tbody>
    </table>
    <?php
}

/* ==========  Lấy nội dung trang single  ========== */

function get_single_content_webtruyendotcom($link_chap) {

    $content = "";
    $html = file_get_html($link_chap);
    $content .= $html->find("#content", 0)->innertext;
    $content = preg_replace('#<div class="ads-chapter-1">(.*?)</div>#', '', $content);
    return "<div class='grab-content-chap'>$content</div>";
}

function getimage_webtruyen($link_webtruyen) {

    $html = file_get_html($link_webtruyen);

    foreach ($html->find('.detail-thumbnail img') as $element) {
        $noidung = $element->src;
    }


    return $noidung;
}

/**
 * Get author truyen
 * @param type $link_truyen
 * @return type
 */
function getauthor_webtruyendotcom($link_truyen) {

    $html = file_get_html($link_truyen);

    $get_auth = $html->find('.detail .detail-info .w3-ul li', 0);
    $get_auth = $get_auth->find('h2 a');

    $author = '';
    foreach ($get_auth as $key => $auth) {
        if ($key == 0)
            $author .= trim($auth->innertext);
        else
            $author .= ", " . trim($auth->innertext);
    }
    return $author;
}

/**
 * Get theloai for truyen
 * @param type $link_truyen
 */
function gettheloai_webtruyendotcom($link_truyen) {
    $html = file_get_html($link_truyen);

    $get_theloai = $html->find('.detail .detail-info .w3-ul li', 1);
    $get_theloai = $get_theloai->find('a');
    
    $ar_theloai = array();
    foreach ($get_theloai as $theloai) {
        $ar_theloai [] = trim($theloai->innertext);
    }
    return $ar_theloai;
}
