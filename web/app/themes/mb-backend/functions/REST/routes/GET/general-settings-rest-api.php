<?php

add_action('rest_api_init', function () {
    register_rest_route('milanbeltman/v1', '/general-settings', array(
        'methods' => 'GET',
        'callback' => 'get_general_settings',
    ));
});

function get_general_settings($data) {
    $general_settings = array(
        'website_title_&_tagline' => get_field('website_title_&_tagline', 'option'),
        'logo_en_favicon' => get_field('logo_en_favicon', 'option'),
    );

    return new WP_REST_Response($general_settings, 200);
}