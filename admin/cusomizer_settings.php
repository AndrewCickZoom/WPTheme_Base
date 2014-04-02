<?php

include_once __DIR__ . '/customizer/CZ_Customized_Control.php';

function load_custom_wp_admin_style()
{
    wp_register_style('custom_wp_admin_css', get_template_directory_uri() . '/admin/customizer/customizer.css', false, '1.0.0');
    wp_enqueue_style('custom_wp_admin_css');
}

add_action('customize_controls_print_styles', 'load_custom_wp_admin_style');

function customize_register_settings($wp_customize)
{
//<editor-fold desc="Remove Defaults">
    $wp_customize->remove_section('title_tagline');
    $wp_customize->remove_section('nav');
    $wp_customize->remove_section('static_front_page');
//</editor-fold>
//<editor-fold desc="Define Sections">
    $wp_customize->add_section('tlm_colors', array(
        'title' => __('Site Colors', $GLOBALS['sThemeTextDomain']),
        'description' => 'Define Site Colors',
        'priority' => '2'
    ));
    $wp_customize->add_section('tlm_header', array(
        'title' => __('Header Settings', $GLOBALS['sThemeTextDomain']),
        'description' => 'Site Logo, Social Icons, Office Hours & Phone Number',
        'priority' => '1'
    ));
    $wp_customize->add_section('tlm_social', array(
        'title' => __('Social Network Icons'),
        'description' => 'Add a link to have icon appear',
        'priority' => '3'
    ));
    $wp_customize->add_section('tlm_tracking', array(
        'title' => __('Tracking Codes', $GLOBALS['sThemeTextDomain']),
        'description' => 'Site wide Tracking Codes stored here: <br/><small style="text-align: center;"></small>',
        'priority' => '4'
    ));
    $wp_customize->add_section('tlm_css', array(
        'title' => __('Custom CSS', $GLOBALS['sThemeTextDomain']),
        'description' => 'CSS Overrides',
        'priority' => '5'
    ));
//</editor-fold>
//<editor-fold desc="Color Setting and Controls">
    $wp_customize->add_setting('main_color', array(
        'default' => '#416693',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_setting('secondary_color', array(
        'default' => '#760e44',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_setting('accent_color1', array(
        'default' => '#416693',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_setting('accent_color2', array(
        'default' => '#937b41',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_setting('accent_color3', array(
        'default' => '#933071',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_setting('accent_color4', array(
        'default' => '#819341',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'main_color',
            array(
                'label' => __('Main Color', $GLOBALS['sThemeTextDomain']),
                'section' => 'tlm_colors',
                'settings' => 'main_color',
                'priority' => '1'
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'secondary_color',
            array(
                'label' => __('Secondary Color', $GLOBALS['sThemeTextDomain']),
                'section' => 'tlm_colors',
                'settings' => 'secondary_color',
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'accent_color1',
            array(
                'label' => __('Accent Color 1', $GLOBALS['sThemeTextDomain']),
                'section' => 'tlm_colors',
                'settings' => 'accent_color1',
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'accent_color2',
            array(
                'label' => __('Accent Color 2', $GLOBALS['sThemeTextDomain']),
                'section' => 'tlm_colors',
                'settings' => 'accent_color2',
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'accent_color3',
            array(
                'label' => __('Accent Color 3', $GLOBALS['sThemeTextDomain']),
                'section' => 'tlm_colors',
                'settings' => 'accent_color3',
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'accent_color4',
            array(
                'label' => __('Accent Color 4', $GLOBALS['sThemeTextDomain']),
                'section' => 'tlm_colors',
                'settings' => 'accent_color4',
            )
        )
    );
//</editor-fold>
//<editor-fold desc="Header Settings and Controls">
    $wp_customize->add_setting('logo');
    $wp_customize->add_setting('fav');
    $wp_customize->add_setting('hours', array(
        'transport' => 'postMessage'
    ));
    $wp_customize->add_setting('phone', array(
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'logo',
            array(
                'label' => __('Upload a logo', $GLOBALS['sThemeTextDomain']),
                'section' => 'tlm_header',
                'settings' => 'logo',
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'hours',
            array(
                'label' => __('Hours of Operation', $GLOBALS['sThemeTextDomain']),
                'section' => 'tlm_header',
                'settings' => 'hours',
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'phone',
            array(
                'label' => __('Office Phone Number', $GLOBALS['sThemeTextDomain']),
                'section' => 'tlm_header',
                'settings' => 'phone',
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'fav',
            array(
                'label' => __('Upload a favicon', $GLOBALS['sThemeTextDomain']),
                'section' => 'tlm_header',
                'settings' => 'fav',
            )
        )
    );
//</editor-fold>
//<editor-fold desc="Tracking Code Setting and Controls">
    $wp_customize->add_setting('header_tracking', array(
        'transport' => 'postMessage'
    ));
    $wp_customize->add_setting('footer_tracking', array(
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new CZ_Customize_Textarea_Control(
            $wp_customize,
            'footer_tracking',
            array(
                'label' => __('Footer Tracking Codes', $GLOBALS['sThemeTextDomain']),
                'section' => 'tlm_tracking',
                'settings' => 'footer_tracking',
                'side' => 'right'
            )
        )
    );
    $wp_customize->add_control(
        new CZ_Customize_Textarea_Control(
            $wp_customize,
            'header_tracking',
            array(
                'label' => __('Header Tracking Codes', $GLOBALS['sThemeTextDomain']),
                'section' => 'tlm_tracking',
                'settings' => 'header_tracking',
                'side' => 'left'
            )
        )
    );
//</editor-fold>
//<editor-fold desc="Custom CSS Settings and Controls">
    $wp_customize->add_setting('custom_css');
    $wp_customize->add_control(new CZ_Customize_Textarea_Control(
        $wp_customize,
        'custom_css',
        array(
            'label' => __('Custom CSS', $GLOBALS['sThemeTextDomain']),
            'section' => 'tlm_css',
            'settings' => 'custom_css'
        )
    ));
//</editor-fold>
//<editor-fold desc="Social Icon Settings and Controls">
    $wp_customize->add_setting('facebook');
    $wp_customize->add_setting('linkedin');
    $wp_customize->add_setting('twitter');
    $wp_customize->add_setting('googleplus');
    $wp_customize->add_setting('pintrest');
    $wp_customize->add_setting('youtube');
    $wp_customize->add_setting('rss');
    $wp_customize->add_setting('email');

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'facebook',
        array(
            'label' => __('Facebook Link', $GLOBALS['SThemeTextDomain']),
            'section' => 'tlm_social',
            'setting' => 'facebook'
        )
    ));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'linkedin',
        array(
            'label' => __('LinkedIn Link', $GLOBALS['SThemeTextDomain']),
            'section' => 'tlm_social',
            'setting' => 'linkedin'
        )
    ));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'twitter',
        array(
            'label' => __('Twitter Link', $GLOBALS['SThemeTextDomain']),
            'section' => 'tlm_social',
            'setting' => 'twitter'
        )
    ));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'googleplus',
        array(
            'label' => __('Google+ Link', $GLOBALS['SThemeTextDomain']),
            'section' => 'tlm_social',
            'setting' => 'googleplus'
        )
    ));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'pintrest',
        array(
            'label' => __('Pintrest Link', $GLOBALS['SThemeTextDomain']),
            'section' => 'tlm_social',
            'setting' => 'pintrest'
        )
    ));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'youtube',
        array(
            'label' => __('YouTube Link', $GLOBALS['SThemeTextDomain']),
            'section' => 'tlm_social',
            'setting' => 'youtube'
        )
    ));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'rss',
        array(
            'label' => __('RSS Link', $GLOBALS['SThemeTextDomain']),
            'section' => 'tlm_social',
            'setting' => 'rss'
        )
    ));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'email',
        array(
            'label' => __('Email Link', $GLOBALS['SThemeTextDomain']),
            'section' => 'tlm_social',
            'setting' => 'email'
        )
    ));
//</editor-fold>
}

add_action('customize_register', 'customize_register_settings');
function customizer_live_preview()
{
    $sScript = get_template_directory_uri() . '/includes/customout.php?js=1';

    wp_enqueue_script(
        'theme-customizer',
        $sScript,
        array('jquery', 'customize-preview'), //Define dependencies
        '', //Define a version (optional)
        true //Put script in footer?
    );

}

add_action('customize_preview_init', 'customizer_live_preview');