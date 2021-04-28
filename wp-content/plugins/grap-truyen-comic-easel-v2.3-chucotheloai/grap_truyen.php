<?php

/**
 * Plugin Name: Grab Truyện Manga
 * Description: Plugin Grab Truyện
 * Version: 2.3
 */
if (!defined('ABSPATH'))
    exit;

define('GRAP_TRUYEN_DIR', plugin_dir_path(__FILE__));
define('GRAP_TRUYEN_URL', plugin_dir_url(__FILE__));


/* ========== Add Custom Post Type ========== */
require_once GRAP_TRUYEN_DIR . 'grap_cpt.php';

/* ==========  Inslude anhdaidien function  ========== */
require_once GRAP_TRUYEN_DIR . 'grap_anhdaidien.php';

/* ==========  JS CSS  ========== */
require_once GRAP_TRUYEN_DIR . 'grap_enqueue.php';

/* ========== Add Library HTML DOM ========== */
require_once GRAP_TRUYEN_DIR . 'simple_html_dom.php';

/* ========== Add Grap-leech ========== */
require_once GRAP_TRUYEN_DIR . 'grap_leech.php';

/* ========== Add Taxonomy ========== */
require_once GRAP_TRUYEN_DIR . 'grap_tax.php';

/* ==========  Button Check  ========== */
require_once GRAP_TRUYEN_DIR . 'grap_check.php';


/* ==========  Include insert post function  ========== */
require_once GRAP_TRUYEN_DIR . 'functions/insert_post.php';

/* ==========  grab nettruyen.com  ========== */
require_once GRAP_TRUYEN_DIR . 'sources/grap_nettruyendotcom.php';

/* ==========  grab truyentranh8.com  ========== */
require_once GRAP_TRUYEN_DIR . 'sources/grap_truyentranh8dotcom.php';

/* ==========  grab truyenviet.com  ========== */
require_once GRAP_TRUYEN_DIR . 'sources/grap_truyenvietdotcom.php';

/* ==========  grab sstruyen.com  ========== */
require_once GRAP_TRUYEN_DIR . 'sources/grap_sstruyendotcom.php';

/* ==========  grab thichtruyen.vn  ========== */
require_once GRAP_TRUYEN_DIR . 'sources/grab_thichtruyendotvn.php';

/* ==========  grab comicvn.net  ========== */
require_once GRAP_TRUYEN_DIR . 'sources/grap_comicvndotnet.php';

//require_once GRAP_TRUYEN_DIR . 'autograp.php';

/* ==========  grab blogtruyen.com  ========== */
require_once GRAP_TRUYEN_DIR . 'sources/grap_blogtruyendotcom.php';

/* ==========  grab mangago.me  ========== */
require_once GRAP_TRUYEN_DIR . 'sources/grap_mangagome.php';

/* ==========  grab webtruyen.com  ========== */
require_once GRAP_TRUYEN_DIR . 'sources/grap_webtruyendotcom.php';

/* ==========  grab truyenyy.com  ========== */
require_once GRAP_TRUYEN_DIR . 'sources/grap_truyenyydotcom.php';

/* ==========  grab truyencv.com  ========== */
require_once GRAP_TRUYEN_DIR . 'sources/grap_truyencvdotcom.php';

/* ==========  grab bbsdothakodotre.com  ========== */
require_once GRAP_TRUYEN_DIR . 'sources/grap_bbshakodotre.php';

/* ==========  grab bbsdothakodotre.com  ========== */
require_once GRAP_TRUYEN_DIR . 'sources/grap_doctruyen360dotcom.php';
/* ==========  grab bbsdothakodotre.com  ========== */
require_once GRAP_TRUYEN_DIR . 'sources/grap_tunghoanhdotcom.php';




add_action('admin_head', 'admincss');

function admincss() {
    echo '<style type="text/css">';
    echo '#select2-results-1 li:nth-child(1){ display:none; }';
    echo '</style>';
}
