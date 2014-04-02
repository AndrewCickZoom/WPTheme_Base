<?php
// Handy site info shortcodes
add_shortcode('sitelink', 'get_sitelink'); //returns a link with the Site Name as the title
add_shortcode('siteurl', 'get_siteurl'); // returns content of bloginfo->url
add_shortcode('sitename', 'get_sitename'); // returns content of bloginfo->url
add_shortcode('user_ip', 'display_user_ip'); // returns user ip address
add_shortcode('sitedomain', 'get_sitedomain'); // returns just site domain
add_shortcode('allmeta' , 'get_all_meta');

// Network wide content shortcodes
add_shortcode('networkpost', 'display_netpost'); // will pull content from specified post.

// Shortcode functions
function get_sitelink()
{
    return '<a href="' . get_bloginfo('url') . '" title="' . get_bloginfo('sitename') . '">' . get_bloginfo('name') . '</a>';
}

function get_siteurl()
{
    return get_bloginfo('url');
}


function get_sitename()
{
    return get_bloginfo('sitename');
}


function get_sitedomain()
{
    $url_variable = get_bloginfo('url');
    preg_match('#https?://(?:www.)?([^/]+)#', $url_variable, $matches);
    $host_variable = $matches[1];
    return $host_variable;
}


function display_netpost($atts) //CZ_TD: Test display_netpost SC
{

    // Attributes
    extract(shortcode_atts(
            array(
                'blog' => '',
                'post' => '',
                'noautop' => ''
            ), $atts)
    );

    // Code
    if (empty($blog)) {
        $bolierplate = get_post($post);
    } else {
        $bolierplate = get_blog_post($blog, $post);
    };

    if ($noautop == 1) {
        $fullcontent = do_shortcode($bolierplate->post_content);
    } else {
        $fullcontent = do_shortcode(wpautop($bolierplate->post_content));
    };

    return $fullcontent;
}