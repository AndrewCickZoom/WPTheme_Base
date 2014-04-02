<?php

require_once 'cz_setup.php';
$aAdmin_msgs = array();
$sThemeURI = get_template_directory_uri();
$sThemeDIR = get_template_directory();
$sThemeTextDomain = 'mdctlm2014';

$includes = do_includes($sThemeDIR);

if (!$includes['success']) {
    foreach ($includes['files'] as $errors) {
        set_messages("error", "Required file: $errors files missing!!!!");
    }
}


theme_features($sThemeDIR);

/**
 *
 */
function TLM_Admin_Style_Enqueue()
{
    wp_enqueue_style('admin', $GLOBALS['sThemeURI'] . "/admin/admin.css");
}

/**
 *
 */
function TLM_Style_Enqueue()
{
    wp_enqueue_style('reset', $GLOBALS['sThemeURI'] . "/styles/reset.css");
    wp_enqueue_style('style', $GLOBALS['sThemeURI'] . "/styles/styles.css", array("reset"));
    wp_enqueue_style('gfont', 'http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic');
}

/**
 * @return bool
 */
function TLM_Script_Enqueue()
{
    $sPath = is_dir($GLOBALS['sThemeDIR'] . '/scripts') ? $GLOBALS['sThemeDIR'] . '/scripts' : '';
    $aScripts = !empty($sPath) ? scandir($sPath) : '';
    if (!empty($aScripts)) {
        foreach ($aScripts as $file) {
            $sFpath = $sPath . '/' . $file;
            if (is_file($sFpath)) {
                $sHandle = basename($sFpath);
                wp_enqueue_script($sHandle, $GLOBALS['sThemeURI'] . "/scripts/$file");
            }
        }
    } else {
        return FALSE;
    }
}


// Actions
add_action('wp_enqueue_scripts', 'TLM_Style_Enqueue');
add_action('wp_enqueue_scripts', 'TLM_Script_Enqueue');
add_action('admin_notices', 'admin_message');
add_action('admin_enqueue_scripts', 'TLM_Admin_Style_Enqueue');
add_filter('the_title', 'do_shortcode');
add_filter('widget_title','do_shortcode');
add_filter( 'widget_text', 'do_shortcode');
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 12);




