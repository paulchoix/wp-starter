<?php

namespace Starter_Theme;

function customizer_register_settings($wp_customize)
{
    $wp_customize->add_panel('panel', [
        'title' => __('Panel Title', 'starter-theme'),
        'description' => __('Panel Description', 'starter-theme'),
        'priority' => 160, // Mixed with top-level-section hierarchy.
    ]);
    $wp_customize->add_section('panel_section', [
        'panel' => 'panel',
        'title' => __('Section Title', 'starter-theme'),
        'description' => __('Section Description', 'starter-theme'),
        'priority' => 119,
        'capability' => 'edit_theme_options',
    ]);
    $wp_customize->add_setting('panel_section_setting', [
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('panel_section_setting_control', [
        'section' => 'panel_section',
        'settings' => 'panel_section_setting',
        'label' => __('Control Label', 'starter-theme'),
        'description' => __('Control Description', 'starter-theme'),
        'type' => 'text',
        'priority' => 10,
        //'active_callback' => 'is_panel',
    ]);
}
//add_action( 'customize_register', __NAMESPACE__ . '\\customizer_register_settings' );
