<?php
namespace Starter_Theme;

require_once( 'constants.php' );
require_once( 'settings.php' );

require_once( 'include/helpers.php' );
require_once( 'include/widgets.php' );


/**
 * Styles & Scripts
 */

function enqueue_scripts()
{
    // Theme CSS
    wp_enqueue_style( 'starter-theme-css', get_stylesheet_uri() );

    // Theme JS
    wp_enqueue_script( 'starter-theme-js', get_template_directory_uri() . 'assets/js/main.js' );

    // Vendor CSS

    // Vendor JS

    // Filter for theme JS (allows modules and adds API endpoint)
    add_filter( 'script_loader_tag', __NAMESPACE__ . '\\script_modify', 10, 3 );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_scripts' );

// From: https://stackoverflow.com/questions/58931144/enqueue-javascript-with-type-module
// Adds module tag and API endpoint to starter-theme-js script
function script_modify( $tag, $handle, $src )  {
    if ( !in_array( $handle, [ 'starter-theme-js' ] ) ) { // Add additional handles if necessary
        return $tag;
    }

    $api_endpoint = get_home_url() . '/wp-json/' . \Starter_Theme\Constants::$API_ROOT;
    $tag = sprintf( '<script id="%s" type="module" data-api="%s" src="%s"></script>', $handle, $api_endpoint, esc_url( $src ) );
    return $tag;
}

// Register API routes
add_action('rest_api_init', function () {
    /*register_rest_route( \Starter_Theme\Constants::$API_ROOT, 'resource', array(
      'methods' => 'GET',
      'callback' => 'function',
      'permission_callback' => '__return_true', // This makes the endpoint public
    ));*/
});