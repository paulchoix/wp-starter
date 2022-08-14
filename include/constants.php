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
    public static $VERSION = '1.0.0';

    /**
     * Settings
     */
    public static $SLUG = 'starter-theme';
    public static $SNAKE = 'starter_theme';
    public static $SETTINGS = 'starter_theme_options';

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
