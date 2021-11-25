<?php
namespace StarterTheme;

require_once( 'constants.php' );
require_once( 'settings.php' );

require_once( 'include/helpers.php' );
require_once( 'include/widgets.php' );


$API_ENDPOINT = 'starter-theme';
$API_VERSION = 1;

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
    if ( $handle !== 'starter-theme-js' ) {
        return $tag;
    }

    global $API_ENDPOINT, $API_VERSION;
    $api_endpoint = get_home_url() . '/wp-json/' . $API_ENDPOINT . '/v' . $API_VERSION;
    $tag = '<script id="starter-theme-js" type="module" data-api="' . $api_endpoint . '" src="' . esc_url( $src ) . '"></script>';
    return $tag;
}

// Register API routes
add_action('rest_api_init', function () {
    global $API_ENDPOINT, $API_VERSION;

    /*register_rest_route( $API_ENDPOINT . '/v' . $API_VERSION, 'resource', array(
      'methods' => 'GET',
      'callback' => 'function',
    ));*/
});

// Verify nonce on API call
function verify_nonce()
{
    $response = new \WP_REST_Response();

    if ( !wp_verify_nonce( $_SERVER['HTTP_X_WP_NONCE'], 'wp_rest' ) ) {
        $response->set_status( 403 );
        $response->set_data( __( 'Missing or invalid nonce.', 'starter-theme' ) );
        return $response;
    }

    return $response;
}