<?php

function grap_enqueue($hook) {

    $array = array('post-new.php', 'post.php');

    if (!in_array($hook, $array)) {
        return;
    }

    $localize = array(
        'ajaxurl' => admin_url('admin-ajax.php')
    );

    //JS AJAX
    //$direct = GRAP_TRUYEN_URL . '/js/grap-js.js';
    $direct1 = GRAP_TRUYEN_URL . 'js/grap-comic.js';
    //$direct = GRAP_TRUYEN_URL . 'js/jquery.min.js';
    //wp_register_script('grap-js', $direct1, false, null, true);

    wp_register_script('grap-js', $direct1, false, null, true);
    wp_enqueue_script('grap-js');
    wp_localize_script('grap-js', 'GRAP_AJ', $localize);









    //CSS
    $direct2 = GRAP_TRUYEN_URL . '/css/grap-style.css';
    wp_register_style('grap-style', $direct2);
    wp_enqueue_style('grap-style');
}

add_action('admin_enqueue_scripts', 'grap_enqueue');

