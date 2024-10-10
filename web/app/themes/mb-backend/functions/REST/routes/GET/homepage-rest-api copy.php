<?php

add_action('rest_api_init', function () {
    register_rest_route('milanbeltman/v1', '/homepage', array(
        'methods' => 'GET',
        'callback' => 'get_homepage',
    ));
});

function get_homepage($data)
{
    $homepage_url = get_home_url(null, '');
    $homepage_id = url_to_postid($homepage_url);
    if ($homepage_id) {
        return new WP_REST_Response([
            'ID' => $homepage_id,
            'title' => get_post_field('post_title', $homepage_id),
            'acf' => get_fields($homepage_id)
        ], 200);
    }
    return new WP_REST_Response([
        "message" => "Homepage not found",
    ], 404);
}