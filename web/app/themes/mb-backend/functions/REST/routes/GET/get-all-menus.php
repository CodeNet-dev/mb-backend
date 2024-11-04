<?php

add_action('rest_api_init', function () {
    register_rest_route('milanbeltman/v1', '/menu/header', array(
        'methods' => 'GET',
        'callback' => 'get_header_menu',
    ));
});

function get_header_menu()
{
    $menu = wp_get_nav_menu_items('Navbar');

    if ($menu) {
        $response = [];

        foreach ($menu as $item) {
            $response[] = [
                'ID' => $item->ID,
                'title' => $item->title,
                'url' => $item->url,
            ];
        }

        return new WP_REST_Response($response, 200);
    }

    return new WP_REST_Response([
        "message" => "No menu found",
    ], 404);

}