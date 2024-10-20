<?php

add_action('rest_api_init', function () {
    register_rest_route('milanbeltman/v1', '/page/(?P<slug>[a-zA-Z0-9-_]+)', array(
        'methods' => 'GET',
        'callback' => 'page_by_slug',
        'permission_callback' => '__return_true',
        'args' => [
            'slug' => [
                'validate_callback' => function ($param, $request, $key) {
                    return is_string($param);
                },
            ],
        ],
    ));
});

function page_by_slug(WP_REST_Request $request): WP_REST_Response
{
    $slug = $request['slug'];

    $args = array(
        'name'        => $slug,
        'post_type'   => 'page',
        'post_status' => 'publish',
    );

    $query = new WP_Query($args);
    $page = $query->have_posts() ? $query->posts[0] : null;

    if (!$page) {
        return new WP_REST_Response([
            "message" => "Page not found",
            "slug" => $slug,
        ], 404);
    }

    return new WP_REST_Response([
        "ID" => $page->ID,
        "post_date" => $page->post_date,
        "post_title" => $page->post_title,
        "post_content" => $page->post_content,
        "acf" => get_fields($page->ID),
    ], 200);
}
