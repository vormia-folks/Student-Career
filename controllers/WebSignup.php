<?php

// Use Autoload To Access Libraries & Model
require_once 'libraries/Autoload.php';

class WebSignup extends Controller
{

    /**
     *
     * The Main Website Home Page Controller
     * -> The controller open the first home page
     */
    public $Folder = ''; //View Dir Name
    public $SubFolder = '';

    /**
     *
     * To load libraries/Model/Helpers/Add custom code which will be used in this Model
     * This can ease the loading work 
     * 
     */
    public function __construct()
    {
        parent::__construct();

        // Models Instance
        $this->modal->load = new Load;
        $this->modal->notify = new Notify;
        $this->db = new DB;

        // Libraries Instance
        $this->plural = new Plural;

        //Do your magic here
    }

    /**
     * Load Default Values
     * 
     * NB: Do not change this function
     * Incase you wish to pass custom/addtional values use passed
     */
    private function load($pagePath = null)
    {
        //Model Data
        $data = $this->modal->load->load();
        $data['site_page'] = $pagePath; //Get Page

        // Get Passed Values
        $passed = $this->passed();

        // Merge data
        if (!is_null($passed) && $this->isAssoc($passed)) {
            $data = array_merge($data, $passed);
        }
        // Return
        return $data;
    }

    /**
     * Load the controller based data here
     * The data loaded here does not affect the other controller/views
     * It only can reach and expand to this controller only
     */
    private function passed()
    {

        // Standard Passed
        $data = array(
            'message' => 'You have accessed welcome controller2',
            'slogan' => 'Slogan More'
        );

        // Return
        return $data;
    }

    /**
     * Pages
     * 
     * -> Pass Page Data As Array()
     * -> Layout Name (Optional)
     */
    public function pages($data, $layout = null)
    {
        // Load Data
        $page = $data['site_page'];
        $layout = (!is_null($layout)) ? $layout : $data['front_layout'];

        // Load Page
        $this->view->render("$layout/includes/head", $data);
        $this->view->render("$layout/pages/$page", $data);
        $this->view->render("$layout/includes/footer", $data);
    }

    /**
     *
     * This is the first function to be accessed when a user open this controller
     * In here we can call the load function and pass data to passed as an array inorder to manupulate it inside passed function
     * 	* Set Notification here
     * 
     */
    public function index($notification = null)
    {
        //Prepaire Data
        $page = $this->plural->pluralize($this->Folder) . $this->SubFolder . "/access";
        $data = $this->load($page);

        // Custom Data Values

        //Open Page
        $this->pages($data);
    }


    /**
     *
     * This is the function to be accessed when a user want to open specific page which deals with same controller E.g Edit data after saving
     * In here we can call the load function and pass data to passed as an array inorder to manupulate it inside passed function
     * 	* Set your Page name here E.g home.php it should just be 'home'
     * 	* Set Notification here  (optional)
     * 	* Pass Notification Message  (optional)
     * 	* Pass Data (optional)
     * 
     */
    public function open($pageName, $notify = 'blank', $message = null)
    {

        //Prepaire Data
        $page = $this->plural->pluralize($this->Folder) . $this->SubFolder . "/" . $pageName;
        $data = $this->load($page);

        // Notification
        $data['notify'] = $this->modal->notify->$notify($message);

        //Open Page
        $this->pages($data);
    }


    /**
     * Validation
     * 
     * This function will deal with validation of user inputs
     */
    public function valid($type = null)
    {
        // Check Type
        if ($type == 'student') {

            $formData = $_POST;

            //Do validation Here

            // Unset Data
            $unset = array('confrm_student_password');

            // Password Encrypt
            $postData = $this->modal->load->unsetvalues($formData, $unset);
            $postData['student_password'] = sha1($postData['student_password']);

            // Insert
            $insertID = $this->db->insert($this->plural->pluralize('student'), $postData);

            $message = 'Your Account has been registered';

            // Open Page
            $this->open('access', 'success', $message);
        }
    }
}

/* End of file WebSignup.php */
