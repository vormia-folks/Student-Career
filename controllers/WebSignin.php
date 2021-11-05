<?php

// Use Autoload To Access Libraries & Model
require_once 'libraries/Autoload.php';

class WebSignin extends Controller
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
    public function open($pageName, $message = null, $layout = null)
    {

        //Prepaire Data
        $page = $this->plural->pluralize($this->Folder) . $this->SubFolder . "/" . $pageName;
        $data = $this->load($page);

        // Notification
        $notify = $this->modal->notify->notify();
        $data['notify'] = $this->modal->notify->$notify($message);

        //Open Page
        $this->pages($data, $layout);
    }
    /**
     * Validation
     * 
     * This function will deal with validation of user inputs
     */
    public function valid($type = null)
    {
        // Check Type
        if ($type == 'signin') {

            // Get Form Data
            $formData = $this->modal->load->input();

            //Do validation Here

            // Account Email
            $email = $formData['email'];
            // Password Encrypt
            $password = $formData['password'];
            $encrypt_password = sha1($password);

            // Check Account Type
            $found = $this->db->select('login', 'account as user,type as table_name, email as email, flg as active', array('email' => $email), 1);
            $found = (is_null($found)) ? null : $found;

            // Check if account exist
            if (is_null($found)) {
                //Notification
                $this->modal->notify->set('error');

                // Account Not Found
                $this->open('signin', 'Account Not Found');
            } else {
                // Account Found
                $foundData = $found[0];
                $table_name = $foundData['table_name'];
                $email = $foundData['email'];
                //active
                $active = $foundData['active'];
                //Account
                $user = $foundData['user'];

                // Check if account is active
                if ($active == 1) {

                    //Select Single Data
                    $password = $this->db->select_single($table_name, 'password', array('email' => $email), 1);
                    $password = (is_null($password)) ? null : $password;

                    // Check if password is correct
                    if ($password === $encrypt_password) {
                        $user_name = $this->db->select_single($table_name, 'first_name', array('email' => $email), 1);
                        // Password Correct
                        $session_set = array(
                            'id' => $user,
                            'level' => $table_name,
                            'name' => $user_name . ' Minga',
                            'logged' => true
                        );

                        //Auth Model
                        require_once 'libraries/Auth.php';
                        $this->auth = new Auth;

                        // call auth session
                        $this->auth->auth_set_session($session_set);

                        // Get name from session
                        $name = $this->auth->auth_get_session('name');

                        // Redirect
                        $this->redirect("portal/$table_name/profile");
                    } else {
                        //Notification
                        $this->modal->notify->set('error');

                        // Password Incorrect
                        $this->open('signin', 'Incorrect Password');
                    }
                } else {
                    //Notification
                    $this->modal->notify->set('error');

                    // Account Not Active
                    $this->open('signin', 'Account Not Active');
                }
            }
        } elseif ($type == 'logout') {
            //Auth Model
            require_once 'libraries/Auth.php';
            $this->auth = new Auth;

            // call auth session
            $this->auth->auth_logout();
            // Redirect
            $this->redirect("");
        }
    }
}

/* End of file WebSignin.php */
