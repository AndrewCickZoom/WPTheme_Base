<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 10/03/14
 * Time: 8:43 PM
 */

//CZ_TD: Started to play with a one click export... could not find a way to get WPs exporter to write to server.

if (class_exists('Widget_Data')) {
    $posted_array = array();
    $sidebars_array = get_option('sidebars_widgets');
    foreach ($sidebars_array as $sidebar => $widgets) {
        if (!empty($widgets) && is_array($widgets)) {
            foreach ($widgets as $sidebar_widget) {
                $posted_array[$sidebar_widget] = 1;
            }
        }
    }
    /*header( "Content-Description: File Transfer" );
    header( "Content-Disposition: attachment; filename=widget_data.json" );
    header( "Content-Type: application/octet-stream" );*/
    //  file_put_contents(__DIR__."/export/widget_data.json",Widget_Data::parse_export_data( $posted_array ));

};