<?php
namespace StarterTheme;

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
    wp_enqueue_script('starter-theme-js', get_template_directory_uri() . 'assets/js/main.js');

    // Vendor CSS

    // Vendor JS

}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_scripts' );