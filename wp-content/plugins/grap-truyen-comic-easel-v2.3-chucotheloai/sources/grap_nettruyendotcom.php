<?php
if (!defined('ABSPATH'))
    exit;

function grap_nettruyendotcom($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen) {
    ?>
    <div class="postbox">
        <?php
        if (empty($truyen_co_nhieu_chap)):
        // do something
        else:
            get_chaps_nettruyendotcom($link_truyen, $ten_truyen);
        endif;
        ?>
    </div>
    <?php
}

/**
 * Lấy danh sách chương của truyện từ nettruyen.com
 * @param type $link_truyen
 * @param type $ten_truyen
 */
function get_chaps_nettruyendotcom($link_truyen, $ten_truyen) {

    $array_ten_chap = check_chap_exists_by_name($ten_truyen);
    $array_link_chap = check_chap_exists_by_link($ten_truyen);
    $array_slug_chap = check_chap_exists_by_slug($ten_truyen);

    $html = file_get_html($link_truyen);
    $list_chaps = $html->find('#content-page #item-detail table.list-chapter tr');

    if (count($list_chaps) > 0) :
        ?>

        <h2 class="grap-title">Danh sách chương</h2>

        <table class="widefat" id="grap-result">

            <thead>
                <tr>
                    <th width="10px">
                        <a onclick="checkByParent(true);
                                jQuery('.grap-multi-btn').css('display', 'inherit');
                                return false;">Check</a>
                        <br/>
                        <a onclick="checkByParent(false);
                                jQuery('.grap-multi-btn').css('display', 'none');
                                return false;">UnCheck</a>
                    </th>
                    <th>Tên chương</th>
                    <th>Link</th>
                    <th>Lấy nội dung</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($list_chaps as $chap) :

                    $chapurl = trim($chap->find('td.chapter > a', 0)->href);
                    $chaptitle = trim($chap->find('td.chapter > a', 0)->innertext);

                    $has_chap_link = in_array($chapurl, $array_link_chap);
                    $has_chap_name = in_array($chaptitle, $array_ten_chap);
                    $has_chap_slug = in_array(sanitize_title($chaptitle), $array_slug_chap);

                    if (!empty($chaptitle)) {
                        ?>
                        <tr <?php if ($has_chap_link == true || $has_chap_name == true || $has_chap_slug == true) echo "class='grab-tr-disable'" ?> id="<?php echo sanitize_title($chaptitle); ?>">
                            <td>
                                <input type="checkbox" 
                                       value="<?php echo $chapurl; ?>" 
                                       data-link="<?php echo $chapurl ?>" 
                                       data-title="<?php echo $chaptitle; ?>" 
                                       <?php if ($has_chap_link == true || $has_chap_name == true || $has_chap_slug == true) echo "disabled"; ?> 
                                       <?php if ($has_chap_link == true || $has_chap_name == true || $has_chap_slug == true) echo "class='grab-not-select'" ?> />
                            </td>

                            <td><?php echo $chaptitle; ?></td>

                            <td>
                                <a>
                                    <?php echo $chapurl; ?>
                                </a>
                            </td>

                            <td>
                                <input type="button" data-link="<?php echo $chapurl ?>" 
                                       data-title="<?php echo $chaptitle; ?>" 
                                       class="button-primary click-to" 
                                       <?php if ($has_chap_link == true || $has_chap_name == true || $has_chap_slug == true) echo "disabled" ?> 
                                       value="<?php
                                       if ($has_chap_link == true || $has_chap_name == true || $has_chap_slug == true)
                                           echo "Đã lấy";
                                       else
                                           echo "Lấy";
                                       ?>" />
                            </td>
                        </tr>
                        <?php
                    }

                endforeach;
                ?>

            </tbody>

        </table>
        <?php
    endif;
}

/**
 * Get single content of chap
 * @param type $link_chap
 */
function get_single_content_nettruyendotcom($link_chap) {
    $html = file_get_html($link_chap);
    $chap_content = $html->find('.reading .reading-detail', 0)->innertext;
    return "<div class='grab-content-chap'>" . $chap_content . "</div>";
}

/**
 * Get link img
 * @param type $link_truyen
 */
function getimage_nettruyendotcom($link_truyen) {

    $html = file_get_html($link_truyen);

    $img_url = $html->find('.detail-info .col-image img', 0)->src;


    return $img_url;
}

/**
 * Get author truyen
 * @param type $link_truyen
 * @return type
 */
function getauthor_nettruyendotcom($link_truyen) {

    $html = file_get_html($link_truyen);
    $author = '';
    foreach ($html->find('.detail-info .col-info .list-info .author a') as $key => $auth) {
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
function gettheloai_nettruyendotcom($link_truyen) {
    $html = file_get_html($link_truyen);

    $ar_theloai = array();
    foreach ($html->find('.detail-info .col-info .kind a') as $theloai) {
        $ar_theloai [] = trim($theloai->innertext);
    }

    return $ar_theloai;
}

/**
 * Insert new theloai for truyen
 * @param type $ten_theloai
 * @return type
 */
function nettruyen_insert_theloai($ten_theloai) {
    $tl = wp_insert_term(
            trim($ten_theloai), // the term 
            'the-loai', // the taxonomy
            array(
        'description' => $ten_theloai,
            )
    );
    return $tl;
}

/**
 * Insert new truyen
 * @param type $ten_truyen
 */
function nettruyen_insert_truyen($ten_truyen) {
    $new_truyen = wp_insert_term(
            $ten_truyen, 'category', array(
        'slug' => sanitize_title($ten_truyen),
        'description' => $ten_truyen,
            )
    );

    // If insert cuccess category
    if (!empty($new_truyen['term_id'])) {
        return (int)$new_truyen['term_id'];
    }
    return 0;
}
