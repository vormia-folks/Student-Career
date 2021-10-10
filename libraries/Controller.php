<?php

require_once 'libraries/View.php';

class Controller
{
    public function __construct()
    {
        // Initiate the View
        $this->view = new View;
    }

    /**
     * URL to a Page URL
     */
    public function base_url($set_url = null)
    {
        // Include Config
        include 'libraries/Config.php';

        // Set URL
        if (!is_null($set_url)) {
            return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/' . $config['base_url'] . '/' . $set_url;
        } elseif (is_null($set_url)) {
            return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/' . $config['base_url'];
        }
    }

    /**
     * URL to a Assets Access 
     */
    public function asset_url($set_path = null)
    {
        // Include Config
        include 'libraries/Config.php';

        // Set URL
        if (!is_null($set_path)) {
            return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/' . $config['base_url'] . '/' . $config['assets'] . '/' . $set_path;
        } elseif (is_null($set_url)) {
            return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/' . $config['base_url'] . '/' . $config['assets'];
        }
    }

    /**
     * Check If Array Is Associative Array
     */
    function isAssoc(array $arr)
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}
