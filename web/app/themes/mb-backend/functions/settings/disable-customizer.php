<?php
/**
 * Completely disable the WordPress Customizer in the admin panel.
 * 
 * This code removes the actions that load the Customizer and prevents
 * users from accessing the Customizer by stopping them with a custom message.
 */
add_action('admin_init', function ()
{
    // Drop some customizer actions
    remove_action('plugins_loaded', '_wp_customize_include', 10);
    remove_action('admin_enqueue_scripts', '_wp_customize_loader_settings', 11);

    // Manually overrid Customizer behaviors
    add_action('load-customize.php', function ()
    {
        wp_die( 'The Customizer is currently disabled.');
    });
}, 10);