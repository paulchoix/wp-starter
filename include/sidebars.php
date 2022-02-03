<?php
namespace Starter_Theme\Widgets;

// Display using dynamic_sidebar()

function register_sidebars()
{
    register_sidebar( array(
        'id'            => 'starter-theme-sidebar',
        'name'          => __( 'Sidebar Name', 'starter-theme' ),
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
        'before_sidebar' => '<div>',
        'after_sidebar' => '</div>',
    ) );
}
//add_action( 'widgets_init', __NAMESPACE__ . '\\register_sidebars' );