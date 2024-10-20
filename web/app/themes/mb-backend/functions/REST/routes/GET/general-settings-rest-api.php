<?php

add_action('rest_api_init', function () {
    register_rest_route('milanbeltman/v1', '/general-settings', array(
        'methods' => 'GET',
        'callback' => 'get_general_settings',
    ));

    register_rest_route('milanbeltman/v1', '/footer', array(
        'methods' => 'GET',
        'callback' => 'get_footer_data',
    ));

    register_rest_route('milanbeltman/v1', '/social-media', array(
        'methods' => 'GET',
        'callback' => 'get_social_media_data',
    ));
});

function get_general_settings()
{
    $general_settings = array(
        'website_title_&_tagline' => get_field('website_title_&_tagline', 'option'),
        'logo_en_favicon' => get_field('logo_en_favicon', 'option'),
    );

    return new WP_REST_Response($general_settings, 200);
}

function get_footer_data()
{
    $footer = get_field('footer', 'option');

    return new WP_REST_Response($footer, 200);
}


function get_social_media_data()
{
    $socials = get_field('socials', 'option');

    return new WP_REST_Response($socials, 200);
}
