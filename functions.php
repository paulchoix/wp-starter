<?php

namespace Starter_Theme;

// require_once everything in the include folder
foreach (glob(__DIR__ . '/include/*.php') as $filename) require_once $filename;

use Starter_Theme\Constants;


/**
 * Styles & Scripts
 */

// See: https://developer.wordpress.org/reference/functions/add_theme_support/
add_theme_support('custom-thumbnails');
add_theme_support('custom-logo');


function enqueue_scripts()
{
    $version = Constants::$VERSION;

    // Theme CSS
    wp_enqueue_style("starter-theme-{$version}", get_stylesheet_uri());

    // Theme JS
    wp_enqueue_script("starter-theme-{$version}", get_template_directory_uri() . '/assets/js/main.js', ['wp-i18n']);

    // Vendor CSS

    // Vendor JS

    // Filter for theme JS (allows modules and adds API endpoint)
    add_filter('script_loader_tag', __NAMESPACE__ . '\\script_modify', 10, 3);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_scripts');


function enqueue_admin_scripts()
{
    //wp_enqueue_script( Constants::$SLUG . '-js-admin',  plugin_dir_url( __FILE__ ) . 'assets/js/admin.js' );         
}
add_action('admin_enqueue_scripts', __NAMESPACE__ . '\\enqueue_admin_scripts');


// From: https://stackoverflow.com/questions/58931144/enqueue-javascript-with-type-module
// Adds module tag and API endpoint to starter-theme-js script
function script_modify($tag, $handle, $src)
{
    $version = Constants::$VERSION;

    if (!in_array($handle, ["starter-theme-{$version}"])) { // Add additional handles if necessary
        return $tag;
    }

    $CONSTANTS = new Constants();

    $api_endpoint = get_home_url() . '/wp-json/' . $CONSTANTS->API_ROOT;
    $tag = sprintf('<script id="%s" type="module" data-api="%s" src="%s"></script>', $handle, $api_endpoint, esc_url($src));
    return $tag;
}


// Add a theme specific class to the body class to namespace CSS. Remember to use nesting in SASS!
add_filter('body_class', function ($classes) {
    return array_merge($classes, ['starter-theme']);
});


// Custom login logo
/*function login_logo()
{
    $directory = get_template_directory_uri();
    echo <<<EOF
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url($directory/assets/img/logo.svg);
            height: 65px;
            width: 320px;
            background-size: 320px 65px;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }
    </style>
    EOF;
?>
<?php }
add_action('login_enqueue_scripts', __NAMESPACE__ . '\\login_logo');*/


// Change login redirect url
/*add_filter('login_redirect', function ($login_url, $redirect, $force_reauth) {
    return get_home_url();
}, 10, 3);*/


// Block access to admin page
/*add_action('admin_init', function () {
    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : home_url('/');
    global $current_user;
    $user_roles = $current_user->roles;
    $user_role = array_shift($user_roles);
    if (!in_array($user_role, ['administrator', 'editor', 'author'])) {
        exit(wp_redirect($redirect));
    }
}, 100);*/


// Register API routes
add_action('rest_api_init', function () {
    $CONSTANTS = new Constants();

    /*register_rest_route( $CONSTANTS->API_ROOT, 'resource', array(
      'methods' => 'GET',
      'callback' => 'function',
      'permission_callback' => '__return_true', // This makes the endpoint public
    ));*/
});


// Load translation files
function load_textdomain()
{
    load_plugin_textdomain('starter-theme', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('init', __NAMESPACE__ . '\\load_textdomain');
