<?php

function grap_theotheloai_webtruyendotcom($link_grap, $loai_truyen) {
    ?>
    <div class="postbox">
        <?php grap_list_truyen_by_the_loai_webtruyendotcom($link_grap, $loai_truyen); ?>
    </div>

    <?php
}

function grap_list_truyen_by_the_loai_webtruyendotcom($link_grap, $loai_truyen) {
    $list_link = array();
    $page = 1;
    while ($page >= 1) {
        $link = $link_grap . $page . "/";
        $html = file_get_html($link);
        $page_curent = $html->find('#divtab .pagination-centered .active a', 0);
        if ($page_curent) {

            $list_link[] = $link;
            $page++;
        } else {
            $page = -1;
        }
    }
    //print_r($list_link);
    ?>
    <h2 class="grap-title">Danh sách chap</h2>
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
        if ($list_link) {
            foreach ($list_link as $link) {
                $list_truyen = get_link_truyen($link);
                foreach ($list_truyen as $truyen) {
                    //print_r($truyen);
                    //echo "<br>";
                    $link_truyen = $truyen['url'];
                    $tieude = $truyen['tieude'];
                    $has_chap = check_truyen($tieude);
                    ?>
                    <tr <?php if ($has_chap == true) echo "class='grab-tr-disable'" ?> id="<?php echo sanitize_title($tieude); ?>">
                        <td>
                            <input type="checkbox" 
                                   value="<?php echo $link_truyen; ?>" 
                                   data-link="<?php echo $link_truyen ?>" 
                                   data-title="<?php echo $tieude; ?>" 


                                   <?php if ($has_chap == true) echo "disabled"; ?> 
                                   <?php if ($has_chap == true) echo "class='grab-not-select'" ?> />
                        </td>
                        <td><?php echo $tieude; ?></td>
                        <td>
                            <a>
                                <?php echo $link_truyen; ?>
                            </a>
                        </td>
                        <td>
                            <input type="button" data-link="<?php echo $link_truyen ?>" 
                                   data-title="<?php echo $tieude; ?>" 


                                   class="button-primary click-lay-truyen-theotheloai" 

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

function get_link_truyen($link) {
    $list_truyen = array();
    $html = file_get_html($link);
    //$content=$html->find('#divtab .line .list_ct li',0);
    //echo $content;
    foreach ($html->find('#divtab .line .list_ct li') as $truyen) {
        $array_truyen = array();
        $array_truyen['url'] = $truyen->find('.prodTitle a', 0)->href;
        $array_truyen['tieude'] = $truyen->find('.prodTitle a', 0)->innertext;
        $list_truyen[] = $array_truyen;
    }
    return $list_truyen;
}