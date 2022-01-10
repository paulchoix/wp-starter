<?php
namespace Starter_Theme;

/**
 * Store all constants within a single object
 */

 class Constants {
    // Use public static variables to access them without instantiating the Constants class

    /**
     * Settings
     */
    public static $OPTIONS_GROUP = 'starter_theme';
    public static $OPTIONS_PAGE = 'starter_theme';
    public static $OPTIONS_NAME = 'starter_theme_options';

    /**
     * API
     */
    public static $API_ENDPOINT = 'starter-theme';
    public static $API_VERSION = 1;
    public $API_ROOT;

    function __construct()
    {
        $this->API_ROOT = $this->API_ENDPOINT . '/v' . $this->API_VERSION;
    }
 }