<?php
// save extra category extra fields hook

add_action ( 'edit_category', 'save_extra_theloai_fileds');

add_action( 'create_category', 'save_extra_theloai_fileds', 10, 2 ); 



   // save extra category extra fields callback function

function save_extra_theloai_fileds( $term_id ) {

    if ( isset( $_POST['Truyen'] ) ) {

        $t_id = $term_id;

        $cat_meta = get_option( "category_$t_id");

        $cat_keys = array_keys($_POST['Truyen']);

            foreach ($cat_keys as $key){

            if (isset($_POST['Truyen'][$key])){

                $cat_meta[$key] = $_POST['Truyen'][$key];

            }

        }

        //save the option array

        update_option( "category_$t_id", $cat_meta );

    }

}
















