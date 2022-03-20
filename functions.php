<?php

namespace Starter_Theme;

// require_once everything in the include folder
foreach (glob(__DIR__ . '/include/*.php') as $filename) require_once $filename;

use Starter_Theme\Constants;


/**
 * Styles & Scripts
 */

function enqueue_scripts()
{
    // Theme CSS
    wp_enqueue_style('starter-theme-css', get_stylesheet_uri());

    // Theme JS
    wp_enqueue_script('starter-theme-js', get_template_directory_uri() . 'assets/js/main.js');

    // Vendor CSS

    // Vendor JS

    // Filter for theme JS (allows modules and adds API endpoint)
    add_filter('script_loader_tag', __NAMESPACE__ . '\\script_modify', 10, 3);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_scripts');

// From: https://stackoverflow.com/questions/58931144/enqueue-javascript-with-type-module
// Adds module tag and API endpoint to starter-theme-js script
function script_modify($tag, $handle, $src)
{
    if (!in_array($handle, ['starter-theme-js'])) { // Add additional handles if necessary
        return $tag;
    }

    $CONSTANTS = new \Starter_Theme\Constants();

    $api_endpoint = get_home_url() . '/wp-json/' . $CONSTANTS->API_ROOT;
    $tag = sprintf('<script id="%s" type="module" data-api="%s" src="%s"></script>', $handle, $api_endpoint, esc_url($src));
    return $tag;
}

// Add a theme specific class to the body class to namespace CSS. Remember to use nesting in SASS!
add_filter('body_class', function ($classes) {
    return array_merge($classes, ['starter-theme']);
});

// Register API routes
add_action('rest_api_init', function () {
    $CONSTANTS = new \Starter_Theme\Constants();

    /*register_rest_route( $CONSTANTS->API_ROOT, 'resource', array(
      'methods' => 'GET',
      'callback' => 'function',
      'permission_callback' => '__return_true', // This makes the endpoint public
    ));*/
});
