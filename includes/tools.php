<?php

function subdata_search($aSearch, $sSection)
{
    if (!empty($aSearch)) {
        $mReturn_data = get_subdata($aSearch, $sSection);
        if (count($mReturn_data) == 1) {
            $mReturn_data = $mReturn_data[0];
        }
        return ($mReturn_data);
    } else {
        return;
    }
}

function get_subdata($aSearch, $sSection)
{
    if (!empty($aSearch[$sSection])) {
        if (is_array($aSearch[$sSection])) {
            return ($aSearch[$sSection]);
        } else {
            return array(
                $aSearch[$sSection]
            );
        }
    }
    $aSubdata = array();
    foreach ($aSearch as $mValue) {
        if (is_array($mValue)) {
            $aSubdata = array_merge(
                $aSubdata,
                get_subdata($mValue, $sSection)
            );
        }
    }
    return $aSubdata;
}

function display_user_ip()
{
    $ip = $_SERVER['REMOTE_ADDR'];
    return $ip;
}

function get_all_meta(){
    $meta = get_post_meta( get_the_ID() );
    echo ("<pre>".var_dump($meta)."</pre>");
}