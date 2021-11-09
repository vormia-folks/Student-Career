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
        $this->valid = new Validation;

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
    public function index($message = null)
    {
        //Prepaire Data
        $page = $this->plural->pluralize($this->Folder) . $this->SubFolder . "/access";
        $data = $this->load($page);

        // Notification
        $notify = $this->modal->notify->notify();
        $data['notify'] = $this->modal->notify->$notify($message);

        //Open Page
        $this->pages($data);
    }


    /**
     *
     * This is the function to be accessed when a user want to open specific page which deals with same controller E.g Edit data after saving
     * In here we can call the load function and pass data to passed as an array inorder to manupulate it inside passed function
     * 	* Set your Page name here E.g home.php it should just be 'home'
     * 	* Pass Notification Message  (optional)
     * 	* Pass Data (optional)
     * 
     */
    public function open($pageName, $message = null)
    {

        //Prepaire Data
        $page = $this->plural->pluralize($this->Folder) . $this->SubFolder . "/" . $pageName;
        $data = $this->load($page);

        // Notification
        $notify = $this->modal->notify->notify();
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

            // Get Form Data
            $formData = $this->modal->load->input();

            $rules = array(
                'first_name' => 'required|min:2|max:20',
                'last_name' => 'required|min:2|max:20',
                'email' => 'required|email|is_unique:student.email|is_valid_email:universities.toplevel|max:30',
                'phone_number' => 'valid_mobile|min_length:10',
                'password' => 'required|min:6',
                'confirm_password' => 'required|min:6|matches:password',
            );
            // Validation using $this->valid
            $valid = $this->valid->validate($formData, $rules);
            // Check if validation is true validation_check
            if ($this->valid->validation_check($valid) !== false) {
                //Notification
                $this->modal->notify->set('error');
                $message = 'Please fill in all the required fields';
            } else {
                // Unset Data
                $unset = array('confirm_password');

                // Password Encrypt
                $postData = $this->modal->load->unset($formData, $unset);
                $postData['password'] = sha1($postData['password']);

                // get the domain top level from email passed
                $domain = explode('@', $postData['email']);
                $toplevel = $domain[1];

                // Get university ID by selecting from university table where toplevel = $toplevel using select_single
                $university = $this->db->select_single('university', 'id', array('toplevel' => $toplevel), 1);

                //Check if university !empty or !null
                if (!empty($university) && !is_null($university)) {
                    $postData['university'] = $university;

                    // Insert
                    $insertID = $this->db->insert($this->plural->pluralize('student'), $postData);

                    // Add Login
                    $loginData = array(
                        'email' => $postData['email'],
                        'account' => $insertID,
                        'type' => 'student',
                    );
                    $this->db->insert($this->plural->pluralize('login'), $loginData);

                    //Notification
                    $this->modal->notify->set('success');
                    $message = 'Your Account has been registered';
                } else {
                    //Notification
                    $this->modal->notify->set('error');
                    $message = 'Your University is not registered';
                }
            }

            // Open Page
            $this->open('student', $message);
        } elseif ($type == 'company') {

            // Get Form Data
            $formData = $this->modal->load->input();

            //Rules
            // $rules = array(
            //     'name' => 'required',
            //     'email' => 'required|email',
            //     'password' => 'required|min:6',
            //     'confirm_password' => 'required|min:6|matches:password',
            //     'phone' => 'required|min:10',
            //     'address' => 'required',
            //     'website' => 'required',
            //     'description' => 'required',
            //     'logo' => 'required',
            //     'cover' => 'required',
            // );

            $rules = array(
                'email' => 'required|email|is_unique:company.email|is_valid_email:organizations.toplevel|max:30',
                'mobile' => 'valid_mobile|min_length:10',
                'password' => 'required|min:6',
                'confirm_password' => 'required|min:6|matches:password',
            );
            // Validation using $this->valid
            $valid = $this->valid->validate($formData, $rules);

            // Check if validation is true validation_check
            if ($this->valid->validation_check($valid) !== false) {
                //Notification
                $this->modal->notify->set('error');
                $message = 'Please fill in all the required fields';
            } else {

                // Unset Data
                $unset = array('confirm_password');

                // Password Encrypt
                $postData = $this->modal->load->unset($formData, $unset);
                $postData['password'] = sha1($postData['password']);

                // get the domain top level from email passed
                $domain = explode('@', $postData['email']);
                $toplevel = $domain[1];

                // Get organizations ID by selecting from organization table where toplevel = $toplevel using select_single
                $organization = $this->db->select_single('organization', 'id', array('toplevel' => $toplevel), 1);

                //Check if organization !empty or !null
                if (!empty($organization) && !is_null($organization)) {
                    $postData['organization'] = $organization;

                    // Insert
                    $insertID = $this->db->insert($this->plural->pluralize('company'), $postData);

                    // Add Login
                    $loginData = array(
                        'email' => $postData['email'],
                        'account' => $insertID,
                        'type' => 'company',
                    );
                    $this->db->insert($this->plural->pluralize('login'), $loginData);

                    //Notification
                    $this->modal->notify->set('success');
                    $message = 'Your Account has been registered';
                } else {
                    //Notification
                    $this->modal->notify->set('error');
                    $message = 'Your Organization is not registered';
                }
            }

            // Open Page
            $this->open('company', $message);
        }
    }
}

/* End of file WebSignup.php */
