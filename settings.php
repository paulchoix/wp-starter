<?php
namespace StarterTheme\Settings;

$STARTER_THEME_OPTIONS_GROUP = 'starter_theme';
$STARTER_THEME_OPTIONS_PAGE = 'starter_theme';
$STARTER_THEME_OPTIONS_NAME = 'starter_theme_options';

// Register configuration options
function init()
{
    global $STARTER_THEME_OPTIONS_GROUP, $STARTER_THEME_OPTIONS_PAGE, $STARTER_THEME_OPTIONS_NAME;
    register_setting( $STARTER_THEME_OPTIONS_GROUP, $STARTER_THEME_OPTIONS_NAME, ['type' => 'object']);

    /*add_settings_section(
        'starter_section',
        __( 'Starter Section', 'starter-theme' ),
        __NAMESPACE__ . '\\starter_section_callback',
        $STARTER_THEME_OPTIONS_PAGE
    );
    add_settings_field(
        'starter_field',
        __( 'Starter Field', 'starter-theme' ),
        __NAMESPACE__ . '\\starter_field_callback',
        $STARTER_THEME_OPTIONS_PAGE,
        'section',
        ['label_for' => 'starter_field']
    );*/
}
add_action( 'admin_init', __NAMESPACE__ . '\\init' );

/*function starter_section_callback()
{
    _e( '<p>Description for the starter section.</p>', 'starter-theme' );
}

function starter_field_callback( $args )
{
    global $STARTER_THEME_OPTIONS_NAME;
    $options = get_option( $STARTER_THEME_OPTIONS_NAME );
    ?>
    <input type="text" name="<?php echo $STARTER_THEME_OPTIONS_NAME; ?>[<?php echo esc_attr( $args['label_for'] ); ?>]" value="<?php echo isset( $options[$args['label_for']] ) ? esc_attr( $options[$args['label_for']] ) : ''; ?>"></input>
    <?php
}*/

// Settings Page
function page_html() {
    global $STARTER_THEME_OPTIONS_GROUP, $STARTER_THEME_OPTIONS_PAGE;

    if ( !current_user_can( 'manage_options' ) ) return;

    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields( $STARTER_THEME_OPTIONS_GROUP );
            do_settings_sections( $STARTER_THEME_OPTIONS_PAGE );
            submit_button( __( 'Save', 'starter-theme' ) );
            ?>
        </form>
    </div>
    <?php
}

function page() {
    global $STARTER_THEME_OPTIONS_PAGE;

    add_menu_page(
        __( 'Starter Theme', 'starter-theme' ),
        __( 'Starter Theme', 'starter-theme' ),
        'manage_options',
        $STARTER_THEME_OPTIONS_PAGE,
        __NAMESPACE__ . '\\page_html',
        'dashicons-admin-settings' // For more Dashicons: https://developer.wordpress.org/resource/dashicons/
    );
}
add_action( 'admin_menu', __NAMESPACE__ . '\\page' );