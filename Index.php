<?php

/*
Plugin Name: Import Data Custom Table
Description: Simpal Plugin in import Data
Author: Rahul
*/


add_action('admin_menu', 'Import_data_clt');

function Import_data_clt()
{
    add_menu_page(
        'Import Data CLT',
        'Import Data CLT',
        'manage_options',
        'import_data_clt',
        'import_data_clt_cbf',
        'dashicons-tickets-alt',
        2
    );
}


function import_data_clt_cbf()
{

    ob_start();
    include_once plugin_dir_path(__FILE__) . 'views/custom_table.php';
    $template = ob_get_contents();
    ob_end_clean();
    echo $template;
}

function wp_custom_admin_assets()
{
    if (isset($_GET['page']) && $_GET['page'] == "import_data_clt") {
        wp_enqueue_style('bootstarp', plugin_dir_url(__FILE__) . 'assets/css/bootstrap.min.css', array());
        wp_enqueue_script('bootstarp_js', plugin_dir_url(__FILE__) . 'assets/js/bootstrap.min.js', array());
        wp_enqueue_script('jquery-slim-min-js', plugin_dir_url(__FILE__) . 'assets/js/jquery-3.3.1.slim.min.js', array());
        wp_enqueue_script('jquery-min', plugin_dir_url(__FILE__) . 'assets/js/jquery.min.js', array());
        wp_enqueue_script('bootstrap-min-js', plugin_dir_url(__FILE__) . 'assets/js/popper.min.js', array());
    }
}
