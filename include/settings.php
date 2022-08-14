<?php

namespace Starter_Theme\Settings;

use \Starter_Theme\Constants;

// Register configuration options
function init()
{
    register_setting(Constants::$SNAKE, Constants::$SETTINGS, ['type' => 'object']);

    /*add_settings_section(
        'starter_section',
        __( 'Starter Theme Section', 'starter-theme' ),
        __NAMESPACE__ . '\\starter_section_callback',
        Constants::$SNAKE,
    );
    add_settings_field(
        'starter_field',
        __( 'Starter Theme Field', 'starter-theme' ),
        __NAMESPACE__ . '\\starter_field_callback',
        Constants::$SNAKE,
        'starter_section',
        ['label_for' => 'starter_field', 'settings' => Constants::$SETTINGS]
    );*/
}
//add_action('admin_init', __NAMESPACE__ . '\\init');

/*function starter_section_callback()
{
    echo sprintf( '<p>%s</p>', __( '<p>Description for the starter theme section.</p>', 'starter-theme' ) );
}

function starter_field_callback( $args )
{
    $options = get_option( Constants::$SETTINGS );
    ?>
    <input type="text" name="<?php echo Constants::$SETTINGS; ?>[<?php echo esc_attr( $args['label_for'] ); ?>]" value="<?php echo isset( $options[$args['label_for']] ) ? esc_attr( $options[$args['label_for']] ) : ''; ?>"></input>
    <?php
}*/

// Settings Page
function page_html()
{

    if (!current_user_can('manage_options')) return;

?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields(Constants::$SNAKE);
            do_settings_sections(Constants::$SNAKE);
            submit_button(__('Save', 'starter-theme'));
            ?>
        </form>
    </div>
<?php
}

function page()
{

    add_menu_page(
        __('Starter Theme', 'starter-theme'),
        __('Starter Theme', 'starter-theme'),
        'manage_options',
        Constants::$SNAKE,
        __NAMESPACE__ . '\\page_html',
        'dashicons-admin-settings' // For more Dashicons: https://developer.wordpress.org/resource/dashicons/
    );
}
//add_action('admin_menu', __NAMESPACE__ . '\\page');
