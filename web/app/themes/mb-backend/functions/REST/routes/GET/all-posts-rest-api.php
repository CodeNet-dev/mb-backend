<?php

add_action('rest_api_init', function () {
    register_rest_route('milanbeltman/v1', '/all-posts', array(
        'methods' => 'GET',
        'callback' => 'get_all_posts',
    ));
});

function get_all_posts($data)
{
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    );

    $query = new WP_Query($args);
    $posts = $query->get_posts();

    if ($posts) {
        $response = [];

        foreach ($posts as $post) {
            $response[] = [
                'ID' => $post->ID,
                'title' => get_the_title($post->ID),
                'acf' => get_fields($post->ID),
                'content' => apply_filters('the_content', $post->post_content),
                'date' => get_the_date('', $post->ID),
                'link' => get_permalink($post->ID),
                'slug' => $post->post_name
            ];
        }

        return new WP_REST_Response($response, 200);
    }

    return new WP_REST_Response([
        "message" => "No posts found",
    ], 404);
}