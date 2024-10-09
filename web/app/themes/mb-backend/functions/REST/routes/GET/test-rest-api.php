<?php

add_action('rest_api_init', function () {
    register_rest_route('milanbeltman/v1', '/test', array(
        'methods' => 'GET',
        'callback' => 'test_rest_api',
        'permission_callback' => '__return_true',
    ));
});

function test_rest_api($data) {
    return new WP_REST_Response(array(
        'message' => 'Hello World!',
    ), 200);
}