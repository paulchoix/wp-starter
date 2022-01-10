<?php
namespace Starter_Theme\Settings;

// Register configuration options
function init()
{
    register_setting( \Starter_Theme\Constants::$OPTIONS_GROUP, \Starter_Theme\Constants::$OPTIONS_NAME, ['type' => 'object']);

    /*add_settings_section(
        'starter_section',
        __( 'Starter Theme Section', 'starter-theme' ),
        __NAMESPACE__ . '\\starter_section_callback',
        \Starter_Theme\Constants::$OPTIONS_GROUP,
    );
    add_settings_field(
        'starter_field',
        __( 'Starter Theme Field', 'starter-theme' ),
        __NAMESPACE__ . '\\starter_field_callback',
        \Starter_Theme\Constants::$OPTIONS_GROUP,
        'section',
        ['label_for' => 'starter_field']
    );*/
}
add_action( 'admin_init', __NAMESPACE__ . '\\init' );

/*function starter_section_callback()
{
    _e( '<p>Description for the starter theme section.</p>', 'starter-theme' );
}

function starter_field_callback( $args )
{
    $options = get_option( \Starter_Theme\Constants::$OPTIONS_NAME );
    ?>
    <input type="text" name="<?php echo \Starter_Theme\Constants::$OPTIONS_NAME; ?>[<?php echo esc_attr( $args['label_for'] ); ?>]" value="<?php echo isset( $options[$args['label_for']] ) ? esc_attr( $options[$args['label_for']] ) : ''; ?>"></input>
    <?php
}*/

// Settings Page
function page_html()
{

    if ( !current_user_can( 'manage_options' ) ) return;

    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields( \Starter_Theme\Constants::$OPTIONS_GROUP );
            do_settings_sections( \Starter_Theme\Constants::$OPTIONS_PAGE );
            submit_button( __( 'Save', 'starter-theme' ) );
            ?>
        </form>
    </div>
    <?php
}

function page()
{

    add_menu_page(
        __( 'Starter Theme', 'starter-theme' ),
        __( 'Starter Theme', 'starter-theme' ),
        'manage_options',
        \Starter_Theme\Constants::$OPTIONS_PAGE,
        __NAMESPACE__ . '\\page_html',
        'dashicons-admin-settings' // For more Dashicons: https://developer.wordpress.org/resource/dashicons/
    );
}
add_action( 'admin_menu', __NAMESPACE__ . '\\page' );