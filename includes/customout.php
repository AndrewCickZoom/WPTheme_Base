<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 11/03/14
 * Time: 11:54 AM
 */


function get_dimension($imagefile, $dimension)
{
    if (!empty($imagefile)):
        $aImageinfo = getimagesize($imagefile);
        switch ($dimension) {
            default:
                $return = $aImageinfo;
                break;
            case 'w':
                $return = $aImageinfo[0];
                break;
            case 'h':
                $return = $aImageinfo[1];
                break;
        }
    endif;
    return !empty($return) ? $return : false;
}

$aCss = array( //an array to hold css selectors and styles associated with Theme Mods
    'main_color' => array(
        'color' => array(
            'selectors' => '.full_width_container a, .sidebar_content a, .module a',
            'prefix' => '',
            'postfix' => ''
        ),
        'border-left-color' => array(
            'selectors' => 'blockquote',
            'prefix' => '',
            'postfix' => ''
        ),
        'background-color' => array(
            'selectors' => 'nav, footer, #slider_panel',
            'prefix' => '',
            'postfix' => ''
        ),
        'border-bottom-color' => array(
            'selectors' => '.frame1, .gallery img',
            'prefix' => '',
            'postfix' => ''
        ),

    ),
    'secondary_color' => array(
        'color' => array(
            'selectors' => '.full_width_container h1, .sidebar_content h1, .full_width_container h2, .sidebar_content h2, .full_width_container h3, .sidebar_content h3, .full_width_container h4, .sidebar_content h4, header aside h2 span, #response_form h2, #sidebar h2',
            'prefix' => '',
            'postfix' => ''
        ),
        'border=bottom-color' => array(
            'selectors' => '.full_width_container h1, .sidebar_content h1',
            'prefix' => '',
            'postfix' => ''
        ),
        'background-color' => array(
            'selectors' => 'input[type="submit"]',
            'prefix' => '',
            'postfix' => ''
        )
    ),
    'accent_color1' => array(
        'background-color' => array(
            'selectors' => '.accent_color1',
            'prefix' => '',
            'postfix' => ''
        )
    ),
    'accent_color2' => array(
        'background-color' => array(
            'selectors' => '.accent_color2',
            'prefix' => '',
            'postfix' => ''
        )
    ),
    'accent_color3' => array(
        'background-color' => array(
            'selectors' => '.accent_color3',
            'prefix' => '',
            'postfix' => ''
        )
    ),
    'accent_color4' => array(
        'background-color' => array(
            'selectors' => '.accent_color4',
            'prefix' => '',
            'postfix' => ''
        )
    ),
    'logo' => array(
        'background-image' => array(
            'selectors' => '#logo a',
            'prefix' => 'url(',
            'postfix' => ')'
        ),
        'width' => array(
            'selectors' => '#logo a',
            'prefix' => '',
            'postfix' => 'px',
            'value' => 'w'
        ),
        'height' => array(
            'selectors' => '#logo a',
            'prefix' => '',
            'postfix' => 'px',
            'value' => 'h'
        )
    ),
    'hours' => array(
        'html' => array(
            'selectors' => '#hours',
            'type' => 'html',
            'default' => 'Office Hours: M&#8211;F 8:30&#8211;4:30, Sat 8:30&#8211;12:00'
        )
    ),
    'phone' => array(
        'html' => array(
            'selectors' => '#phone',
            'type' => 'html',
            'default' => '1.831.205.2600'
        )
    )
);

/**
 * @param $selector
 * @param $style
 * @param $value
 * @param string $prefix
 * @param string $postfix
 * @param bool $echo
 * @return string
 */
function generate_css($selector, $style, $value, $prefix = '', $postfix = '', $echo = true)
{
    $return = '';
    if (!empty($value)) {
        $return = sprintf(
            '%s {
               %s:%s;
            }

            ',
            $selector,
            $style,
            $prefix . $value . $postfix
        );
        if ($echo) {
            echo $return;
        }
    }
    return $return;
}


$theme_settings_output = function () use ($aCss) {
    if (function_exists('get_theme_mod')) {
        echo "<style>" . "<!-- Customizer CSS -->" . "\n";
        foreach ($aCss as $mod_name => $styles) {
            if (!empty($mod_name)):
                foreach ($styles as $property => $details) {
                    if ($property != 'html') {
                        extract($details);
                        if (!empty($value)) {
                            if ($value == 'w' || $value == 'h')
                                $mod = get_dimension(get_theme_mod($mod_name), $value);
                            generate_css($selectors, $property, $mod, $prefix, $postfix);
                        } else {
                            $mod = get_theme_mod($mod_name);
                            generate_css($selectors, $property, $mod, $prefix, $postfix);
                        }
                    }
                }
            endif;
        }
        echo "</style>\n\r";
    }
};
function header_tracking_inject()
{
    $sHeader_tracking = get_theme_mod('header_tracking');
    echo !empty($sHeader_tracking) ? "<!--Header Tracking--!>\n $sHeader_tracking\n" : "<!--Header Tracking--!>\n";
}

function footer_tracking_inject()
{
    $sFooter_tracking = get_theme_mod('footer_tracking');
    echo !empty($sFooter_tracking) ? "<!--Footer Tracking--!>\n $sFooter_tracking\n" : "<!--Footer Tracking--!>\n";
}

function custom_css_injection()
{
    $sCustom_CSS = get_theme_mod('custom_css');
    if (!empty($sCustom_CSS)) {
        $sCustom_CSS_Out = "<style>\n" . $sCustom_CSS . "\n</style>\n";
        echo $sCustom_CSS_Out;
    }
}

if (function_exists('add_action')):
    add_action('wp_head', $theme_settings_output);
    add_action('wp_head', 'header_tracking_inject');
    add_action('wp_footer', 'footer_tracking_inject');
    add_action('wp_head', 'custom_css_injection');
endif;


if ($_GET['js'] == 1) { // Live Preview JS
    header('Content-Type: text/javascript; charset=UTF-8');
    echo '(function ($) {
            //Update site settings in real time...
';
    foreach ($aCss as $mod_name => $styles) {
        echo "            wp.customize('" . $mod_name . "', function (value){\n                  value.bind(function (newval) {\n";
        foreach ($styles as $property => $details) {
            extract($details);
            if ($property == 'html') {
                echo "                     if (newval){
                $('$selectors').html( newval );}else{
                $('$selectors').html( '$default' );}\n";
            } elseif (!empty($postfix) || !empty($prefix)) {
                echo "                     $('$selectors').css('$property', '$prefix'+newval+'$postfix');\n";
            } else {
                echo "                     $('$selectors').css('$property', newval);\n";
            }


        }
        echo "                   });\n                })\n";
    }
    echo "})(jQuery);\n";
} // Live Preview JS
