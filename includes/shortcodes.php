<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 09/03/14
 * Time: 4:08 AM
 */

$aMFShortcodes = array(
    'row' => '',
    'full_width'=> '',
    'one_half'=> '',
    'one_third'=> '',
    'two_third'=> '',
    'one_fourth'=> '',
    'three_fourth'=> '',
    'quote' => '<blockquote class = "clear"><p>[content]</p><span>&mdash;[by]</span></blockquote>',
    'bio' =>
        '<div class="profile clearfix">
            <h3>[name]</h3>
            <h5>[title]</h5>
            <div class="three_fourth">
                <p>[content]</p>
            </div>
            <div class="one_fourth">
                <img src="[image]" class="profile_pic" alt="[name]"/>
            </div>
        </div>',
    'button'=> '<a class="[size]_button accent_[color]" href="[link]">[content]</a>',
    'icon'=> '<span class=[icon]_icon>[content]</span>',
    'icon_button'=> '<div class = "icon_button accent_[color]"><a class="[icon]" href="[link]">[content]</a></div>',
    'frame'=> '<img src="[image]" class="frame1" alt="[alt]"/>'
);

foreach ($aMFShortcodes as $sc => $code) {

    if (empty($code)){
        $cs_func = function($atts, $content = null) use ($sc){
            return'<div class="'.$sc.'"><p>'.do_shortcode($content).'</p></div>';
        };
    }else{
        $cs_func = function($atts, $content = null) use ($sc,$code){
            $atts['content'] = do_shortcode($content);
            foreach ($atts as $token => $value) {
                $code = str_replace('['.$token.']', $value, $code);
            }
            return $code;
        };
    }
    add_shortcode($sc,$cs_func);
}
