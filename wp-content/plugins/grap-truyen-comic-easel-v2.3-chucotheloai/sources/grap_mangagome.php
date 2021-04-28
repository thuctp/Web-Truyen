<?php
if (!defined('ABSPATH'))
    exit;

function grap_mangagome($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen) {
    ?>
    <div class="postbox"> <?php
        if (empty($truyen_co_nhieu_chap)):
        //get_single_content($link_truyen, $html_noi_dung_truyen);
        elseif (!empty($truyen_co_nhieu_chap)):

            get_chaps_mangagome($link_truyen, $ten_truyen);

        endif;
        ?>

    </div>
    <?php
}

function get_chaps_mangagome($link_truyen, $ten_truyen) {

    // Lấy danh sách chương của truyện
    $array_ten_chap = check_chap_exists($ten_truyen);

    // Lấy html của truyện
    $html = file_get_html($link_truyen);

    $list_chaps = $html->find('table#chapter_table tr');
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
        foreach ($list_chaps as $key => $chap) :

            $chapurl = $chap->find('td h4 a', 0)->href;
            $chap_title = strip_tags($chap->find('td h4 a', 0)->innertext);

            $has_chap = in_array($chap_title, $array_ten_chap);
            ?>
            <tr <?php if ($has_chap == true) echo "class='grab-tr-disable'" ?> id="<?php echo sanitize_title($chap_title); ?>">
                <td>
                    <input type="checkbox" 
                           value="<?php echo $chapurl; ?>" 
                           data-link="<?php echo $chapurl ?>" 
                           data-title="<?php echo $chap_title; ?>"
                           <?php if ($has_chap == true) echo "disabled"; ?> 
                           <?php if ($has_chap == true) echo "class='grab-not-select'" ?> />
                </td>
                <td><?php echo $chap_title; ?></td>
                <td>
                    <a>
                        <?php echo $chapurl; ?>
                    </a>
                </td>
                <td>
                    <input type="button" data-link="<?php echo $chapurl ?>" 
                           data-title="<?php echo $chap_title; ?>"
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

function get_single_content_mangagome($link_chap) {

    $html = file_get_html($link_chap);
    $list_contents = $html->find('ul#dropdown-menu-page li');

    // Lấy url của nội dung chương
    $i = 0;
    $chap_contents = "";
    foreach ($list_contents as $content) {
        $i++;
        $chap_page_url = "http://www.mangago.me" . $content->find('a', 0)->href;
        $chap_page_content = file_get_html($chap_page_url);
        $chap_img = $chap_page_content->find('meta[property="og:image"]', 0)->content;
        $chap_contents .= "<img alt='' src='$chap_img'><br>";
    }
//    echo '<pre>';
//    var_dump($chap_contents);
//    echo '</pre>';die;
    return "<div class='grab-content-chap'>$chap_contents</div>";
}

?>