<?php

$directory = new RecursiveDirectoryIterator(get_template_directory() . '/functions');
$iterator = new RecursiveIteratorIterator($directory);
$php_files = new RegexIterator($iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);

foreach ($php_files as $php_file) {
    include_once $php_file[0];
}

function register_my_menus()
{
    register_nav_menus(array(
        'header-menu' => __('Header Menu'),
        'footer-menu' => __('Footer Menu')
    ));
}

add_action('init', 'register_my_menus');

function add_svg_support($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'add_svg_support');