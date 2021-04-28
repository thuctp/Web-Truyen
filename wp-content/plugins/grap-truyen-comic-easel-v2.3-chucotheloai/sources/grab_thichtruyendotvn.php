<?php
if (!defined('ABSPATH'))
    exit;

function grap_thichtruyendotvn($link_truyen, $truyen_co_nhieu_chap, $loai_truyen, $ten_truyen) {
    ?>
    <div class="postbox"> <?php
        if (empty($truyen_co_nhieu_chap)):
        //get_single_content($link_truyen, $html_noi_dung_truyen);
        elseif (!empty($truyen_co_nhieu_chap)):

            get_chaps_thichtruyendotvn($link_truyen, $ten_truyen);

        endif;
        ?>

    </div>
    <?php
}

function get_chaps_thichtruyendotvn($link_truyen, $ten_truyen) {

    $array_ten_chap = check_chap_exists($ten_truyen);

    $array_ten_chap_re = array();
    foreach ($array_ten_chap as $value) {
        $array_ten_chap_re[] = sanitize_title($value);
    }

    ///echo get_single_content_thichtruyendotvn('http://thichtruyen.vn/doc-truyen/osin-lai-tron-viec-nua-a-chuyen-gia-tu-van-tinh-yeu-cua-toi-chuong-01');

    $html = file_get_html($link_truyen);
    ?>
    <h2 class="grap-title">Danh sách chap thichtruyen.vn</h2>
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
        $chaps = $html->find('#tab-chapper ul li');

//echo $chaps;

        $i = 0;
        //if(count($chaps) > 0)
        {
            $chaps = Array_reverse($chaps);
            foreach ($chaps as $chap) {
                //$i++;
                //if($i <=1 ){continue;}
                //if(count($chap->find("li a")) > 0)
                {
                    $chaptitle = $chap->find("a", 0)->innertext;
                    $chapurl = 'http://thichtruyen.vn' . $chap->find("a", 0)->href;



                    $has_chap = in_array(sanitize_title($chaptitle), $array_ten_chap_re);
                    ?>
                    <tr <?php if ($has_chap == true) echo "class='grab-tr-disable'" ?> id="<?php echo sanitize_title($chaptitle); ?>">
                        <td>
                            <input type="checkbox" 
                                   value="<?php echo $chapurl; ?>" 
                                   data-link="<?php echo $chapurl ?>" 
                                   data-title="<?php echo $chaptitle; ?>"

                                   <?php if ($has_chap == true) echo "disabled"; ?> 
                                   <?php if ($has_chap == true) echo "class='grab-not-select'" ?> />
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
                }
            }
        }
        ?>
    </tbody>
    </table>
    <?php
}

/* ==========  Lấy nội dung trang single  ========== */

function get_single_content_thichtruyendotvn($link_chap) {
    $html = file_get_html($link_chap);
    $content = $html->find(".story-detail-content", 0); //->innertext;

    foreach ($html->find(".story-detail-content div") as $element) {
        $content = str_replace($element, '', $content);
    }

    foreach ($html->find(".story-detail-content center") as $element) {
        $content = str_replace($element, '', $content);
    }
    //{	$element->outertext = '';
    //$ct="";
    //$content =$element;
    //}
    //$content->save();
    //function my_callback($content) 
    //{
    // Hide all <b> tags 
    //	if ($content->tag=='div')
    //		$content->outertext = '';
    //	$content->set_callback('my_callback');

    return "<div class='grab-content-chap'>" . $content . "</div>";
}

/**
 * Get link img
 * @param type $link_truyen
 */
function getimage_thichtruyendotcom($link_truyen) {

    $html = file_get_html($link_truyen);

    $img_url = $html->find('.story-intro-top .story-intro-image a img', 0)->src;


    return $img_url;
}

/**
 * Get author truyen
 * @param type $link_truyen
 * @return type
 */
function getauthor_thichtruyendotcom($link_truyen) {

    $html = file_get_html($link_truyen);
    $author = '';
    foreach ($html->find('.story-intro-top .story-intro-author a') as $key => $auth) {
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
function gettheloai_thichtruyendotcom($link_truyen) {
    $html = file_get_html($link_truyen);

    $ar_theloai = array();
    foreach ($html->find('.story-intro-top .story-intro-category a') as $theloai) {
        $ar_theloai [] = trim($theloai->innertext);
    }

    return $ar_theloai;
}
