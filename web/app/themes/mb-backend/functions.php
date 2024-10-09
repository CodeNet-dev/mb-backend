<?php

$directory = new RecursiveDirectoryIterator(get_template_directory() . '/functions');
$iterator = new RecursiveIteratorIterator($directory);
$php_files = new RegexIterator($iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);

foreach ($php_files as $php_file) {
    include_once $php_file[0];
}
