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

    /*
  *
  * This function allow user to remove array key and it's value from the data
  * The two parameters passed are
  * 1: $passedData - the array containing full data
  * 2: $unsetData - the value you wish to be removed from the array
  *
  *  -> The function will return the remaining of the data
  */
    public function unsetData($passedData, $unsetData = null)
    {
        if (!is_null($unsetData)) {
            //Set Array If it is String
            if (!is_array($unsetData)) {
                $unsetData = explode(',', $unsetData); //Produce Array
            }

            //Unset Data
            for ($i = 0; $i < count($unsetData); $i++) {
                $unset = $unsetData[$i]; //Key Value To Remove
                unset($passedData["$unset"]); //Remove Item
            }

            return $passedData; //Remaining Data AFter Unset
        } else {
            return $passedData; //All Data Without Unset
        }
    }

    /**
     * Header loaction 
     * Redirect Function
     */
    public function redirect($url)
    {
        //pass $url to base_url function
        header('Location: ' . $this->base_url($url));
    }
}
