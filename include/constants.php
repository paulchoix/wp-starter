<?php

namespace Starter_Theme;

/**
 * Store all constants within a single class
 */

class Constants
{
    // Use public static variables to access them without instantiating the Constants class
    /**
     * Version
     */
    public static $THEME_VERSION = '1.0.0';

    /**
     * Settings
     */
    public static $OPTIONS_GROUP = 'starter_theme';
    public static $OPTIONS_PAGE = 'starter_theme';
    public static $OPTIONS_NAME = 'starter_theme_options';

    /**
     * Permalinks
     */
    //public static $BASE_AUTHOR = 'par';
    //public static $BASE_FEED = 'fil';
    //public static $BASE_SEARCH = 'recherche';
    //public static $BASE_COMMENTS = 'commentaire';
    //public static $BASE_NEWS = 'nouvelles';

    /**
     * API
     */
    public static $API_ENDPOINT = 'starter-theme';
    public $API_ROOT;

    function __construct($version = 1)
    {
        $this->API_ROOT = $this::$API_ENDPOINT . '/v' . $version;
    }
}
