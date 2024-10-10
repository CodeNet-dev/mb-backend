<?php

function clear_frontend_cache_page($post_id) {
    // If this is just a revision, don't continue
    if (wp_is_post_revision($post_id)) {
        return;
    }
    $post = get_post($post_id);
    $baseUrl = getenv('FRONT_END_URL');
    $url = $baseUrl . '/api/revalidateTag';

    $data = array('tag' => "content");
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ),
    );
    
    $context  = stream_context_create($options);
    file_get_contents($url, false, $context);
}
add_action('save_post', 'clear_frontend_cache_page');
add_action('acf/save_post', 'clear_frontend_cache_page', 20);