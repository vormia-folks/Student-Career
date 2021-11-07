<?php
require_once 'libraries/Model.php';
require_once 'libraries/Controller.php';

//Require library DB
require_once 'libraries/DB.php';

class Load extends Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->controller = new Controller;
        // create instance of DB called $this->db
        $this->db = new DB;
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

        // Get Attachments from DB by selecting options using db->select_order
        // Pass table name, pass select id and title, pass where(type => attachment) order by (title => ASC)
        $data['attachments'] = $this->db->select_order('options', 'id,title', array('type' => 'attachment', 'flg' => 1), array('title' => 'ASC'));
        //Do same for major and availability
        $data['majors'] = $this->db->select_order('options', 'id,title', array('type' => 'major', 'flg' => 1), array('title' => 'ASC'));
        $data['availabilities'] = $this->db->select_order('options', 'id,title', array('type' => 'availability', 'flg' => 1), array('id' => 'ASC'));

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

    /**
     * Create method escape 
     * which escape any HTML special characters and won't allow any HTML tags to be printed
     * Accepts one parameter
     * 
     * if is array it should loop theough the array and escape the values
     * if is string it should escape the string
     * 
     * and return the values
     */
    public function escape($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            }
        } else {
            $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        }
        return $data;
    }
}
