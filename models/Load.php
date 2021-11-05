<?php
require_once 'libraries/Model.php';
require_once 'libraries/Controller.php';

class Load extends Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->controller = new Controller;
    }

    /**
     *
     * This function is used to load all data requred to be present for the system to operate well
     * Data Loaded here will be available globally
     * 
     */
    public function load()
    {

        $data = array(
            'site_title' => 'Student Career Portal',
            'front_layout' => 'students',
            'base_url' => $this->controller->base_url(),
            'asset_url' => $this->controller->asset_url(),
        );

        return $data;
    }

    /**
     * Unset Values
     */
    public function unset($data, $unset)
    {
        return $this->controller->unsetData($data, $unset);
    }

    /** 
     *
     *  This function clean and return the inputs from your POST or Get request
     *  The function accept two parameters
     *  1: The value is the post data array you wish to get
     *     E.g <input name='firstName' value="">
     *         This form in Post or Get request it array Key name is firstName
     *         That is the $value to be passed |i.e $value = 'firstName';
     *
     *    If this is left as null or passed as null, the function will return all data inside your post/get request. 
     *    This is best if you want to store all data in one array or as JSON data later
     *
     *  2: the rule parameter is to determine if you want data from POST/GET value
     *  
     */
    public function input($value = null, $rule = 'post')
    {
        //Set the rule to lower string
        $rule = (strtolower($rule) == 'post') ? $_POST : $_GET;
        //Input Value
        if (is_null($value)) {
            //Check the whole Post/Get Array
            foreach ($rule as $key => $val) {
                $input[$key] = trim($val);
            }
        } else {
            //Check specific value in Post/Get Array
            $input = trim($rule[$value]);
        }
        //returned DATA
        return $input;
    }

    /**
     * Return Empty Array key
     * accept array parameter
     * loop through the array and check if value is null or empty
     * if is null or empty, return the keys
     */
    public function emptyArrayKey($array)
    {
        foreach ($array as $key => $value) {
            if (is_null($value) || empty($value)) {
                $emptyArray[] = $key;
            }
        }
        return $emptyArray;
    }
}
