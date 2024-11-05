<?php

add_action('rest_api_init', function () {
    register_rest_route('milanbeltman/v1', '/post/(?P<slug>[a-zA-Z0-9-]+)', array(
        'methods' => 'GET',
        'callback' => 'get_post_by_slug',
        'args' => array(
            'slug' => array(
                'validate_callback' => function ($param, $request, $key) {
                    return is_string($param);
                }
            )
        )
    ));
});

function get_post_by_slug(WP_REST_Request $request): WP_REST_Response
{
    $slug = $request->get_param('slug');

    $args = array(
        'name' => $slug,
        'post_type' => 'post',
        'post_status' => 'publish'
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $post = $query->get_posts()[0];

        $response = [
            'ID' => $post->ID,
            'title' => get_the_title($post->ID),
            'acf' => get_fields($post->ID),
            'content' => apply_filters('the_content', $post->post_content),
            'date' => get_the_date('', $post->ID),
            'link' => get_permalink($post->ID),
            'slug' => $post->post_name
        ];

        return new WP_REST_Response($response, 200);
    }

    return new WP_REST_Response([
        "message" => "No post found",
    ], 404);
}
