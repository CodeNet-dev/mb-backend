<?php
/*
 * Fix Roots Bedrock WP REST API base endpoint
 * 
 * In Bedrock WordPress, the core WordPress files are located in the /wp/ subdirectory,
 * which causes REST API URLs to include /wp/ (e.g., http://yourdomain.com/wp/wp-json/).
 * 
 * This filter modifies the base REST API URL to remove the /wp/ portion, making the
 * API URLs cleaner and more consistent with non-Bedrock setups. After applying this 
 * filter, the REST API base URL will be http://yourdomain.com/wp-json/ instead of 
 * http://yourdomain.com/wp/wp-json/.
 */
add_filter( 'rest_url', function( $url ) {
    $pattern = '/(\S+)(\/wp\/?)$/';
    $siteURL = preg_replace( $pattern, '${1}', site_url() );
    $url = str_replace( home_url(), $siteURL, $url );
    
    return $url;
} );
