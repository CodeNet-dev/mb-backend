<?php
/*
 * Fix Roots Bedrock WP REST API base endpoint
 */
add_filter('rest_url', function ($url) {
    $pattern = '/(\S+)(\/wp\/?)$/';
    $siteURL = preg_replace($pattern, '${1}', site_url());
    $url = str_replace(home_url(), $siteURL, $url);

    return $url;
});
