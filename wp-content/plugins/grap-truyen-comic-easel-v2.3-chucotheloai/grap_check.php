<?php
/* ==========  Create Button check  ========== */
add_action('edit_form_after_editor', 'add_my_custom_button');

function add_my_custom_button() {

    global $current_screen;

    if ('grap_truyen' != $current_screen->post_type)
        return;
    ?>

    <div class="grap-w-button">

        <input type='button' class='button button-primary button-large check-grap grap-hidden' value='Kiểm tra'>
        <input type='button' class='button button-primary button-large grap-multi-btn' value='Lấy những chap đã chọn'>

        <span class="spinner grap-spinner"></span>
        <div class="clearfix"></div>
    </div>

    <div class="grap-result"></div>

    <span class="spinner grap-spinner2"></span>
    <div class="clearfix"></div>
    <div class="grap-result-insert-post"></div>
    <div class="grap-result-single"></div>

    <style>
        .html_loop_item, .html_chap_truyen, .html_ten_chap_truyen, .html_noi_dung_truyen, .kieu_noi_dung{display:none}
    </style>
    <script type="text/javascript">
        function checkByParent(aChecked) {
            var collection = document.getElementById("grap-result").getElementsByTagName('INPUT');
            for (var x = 0; x < collection.length; x++) {
                if (collection[x].type.toUpperCase() == 'CHECKBOX')
                    collection[x].checked = aChecked;
            }
        }
    </script>
    <?php
}
