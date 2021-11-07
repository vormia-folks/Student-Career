<?php

// Use Autoload To Access Libraries & Model
require_once 'libraries/PortalAutoload.php';

class PortalCompaniesIntership extends Controller
{

    /**
     *
     * The Main Website Home Page Controller
     * -> The controller open the first home page
     */
    public $Table = 'interships'; //View Folder
    public $Layout = 'portals'; //View Folder
    public $Folder = 'companies'; //View Dir Name
    public $SubFolder = '/intership';
    public $PageLevel = 'company';

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
        $this->auth = new Auth;
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
        $layout = (!is_null($layout)) ? $layout : $this->Layout;

        // check if user has logged in using auth_check
        if ($this->auth->auth_check()) {
            // accept two parameters 1 = level and 2 = student
            if ($this->auth->auth_check_level('level', $this->PageLevel)) {
                // Load Page
                $this->view->render("$layout/includes/head", $data);
                $this->view->render("$layout/pages/$page", $data);
                $this->view->render("$layout/includes/footer", $data);
            } else {
                // Redirect to not allowed page
                $this->redirect('not-allowed');
            }
        } else {
            // Redirect to login
            $this->redirect('login');
        }
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
        $page = $this->plural->pluralize($this->Folder) . $this->SubFolder . "/list";
        $data = $this->load($page);

        //Variable user_id is set to the current session id
        $user_id = $this->auth->auth_get_session('id');

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
     *
     *  This function is to be called when you want to pass the Edit form
     * In here we can call the load function and pass data to passed as an array inorder to manupulate it inside passed function
     * 	* Set your Page name here 
     * 	* Set Notification here
     * 	Custom notification message can be set/passed via $message
     * 	PageName can be passed via $pageName
     *
     * 	For inputTYPE and inputID
     *
     * 	--> inputTYPE
     * 	  This is the name of the column you wish to select, most of the time is column name 
     * 	  Remember to Pass ID or Pass data via GET request using variable inputTYPE 
     * 	  
     * 	--> inputID
     * 	  This is the value of the column you wish to match
     * 	  Remember to Pass Value or Pass data via GET request using variable inputID 
     *
     *  If either inputTYPE or inputID is not passed error message will be generated
     * 
     */
    public function edit($pageName, $inputTYPE = 'id', $inputID = null, $message = null, $layout = null)
    {
        //Pluralize Module
        $table = $this->plural->pluralize($this->Table);
        // check if $layout is null assign $this->Layout else set $layout use ternar operator
        $layout = (!is_null($layout)) ? $layout : $this->Layout;

        //Model Query
        $page = $this->plural->pluralize($this->Folder) . $this->SubFolder . "/" . $pageName;
        $data = $this->load($page);

        $inputTYPE = (is_null($inputTYPE)) ? $this->modal->load->input('inputTYPE', 'GET') : $inputTYPE; //Access Value
        $inputID = (is_null($inputID)) ? $this->modal->load->input('inputID', 'GET') : $inputID; //Access Value

        if (!is_null($inputTYPE) || !is_null($inputID)) {

            //Table Select & Clause
            $where = array($inputTYPE => $inputID);
            // $user_details = $this->db->select($table, '*', $where);
            // $data['user_details'] = (!is_null($user_details)) ? (object) $user_details[0] : null;

            //Notification
            $notify = $this->modal->notify->notify();
            $data['notify'] = $this->modal->notify->$notify($message);

            //Open Page
            $this->pages($data, $layout);
        } else {

            //Notification //set auth_set_flash
            $this->modal->notify->set('error');
            $message = 'System could not find the profile ID';

            //Error Edit | Load the Index Page
            $this->index($message);
        }
    }

    /**
     * Validation
     * 
     * This function will deal with validation of user inputs
     */
    public function valid($type = null)
    {
        // Check Type
        if ($type == 'update') {
            // Get Form Data
            $formData = $this->modal->load->input();
            $emptyValues = $this->modal->load->emptyArrayKey($formData);

            // Unset values using load->unset
            $postData = $this->modal->load->unset($formData, $emptyValues);

            // Get user ID from session using auth->auth_get_session
            $user_id = $this->auth->auth_get_session('id');

            // Input Validation Success
            if (!is_null($user_id)) {
                // check if $this->update($postData, array('id' => $user_id)) is success 
                if ($this->update($postData, array('id' => $user_id))) {
                    //Notification
                    $this->modal->notify->set('success');
                    $message = 'Profile Updated Successfully';

                    //Redirect to Profile Edit Page
                    $this->edit('edit', 'id', $user_id, $message);
                } else {
                    //Notification
                    $this->modal->notify->set('error');
                    $message = 'System could not update your profile';

                    //Redirect to Profile Edit Page
                    $this->edit('edit', 'id', $user_id, $message);
                }
            } else {

                $this->modal->notify->set('error');
                $message = 'Please check the fields, and try again'; //Notification Message				

                // Account Not Active
                $this->edit('edit', 'id', $user_id, $message);
            }
        }
    }

    /**
     * The function is used to update data in the table
     * First parameter is the data to be updated 
     *  N:B the data needed to be in an associative array form E.g $data = array('name' => 'theName');
     *      the array key will be used as column name and the value as inputted Data
     *  For colum default/details convert data to JSON on valid() method level
     * Third is the values to be passed in where clause N:B the data needed to be in an associative array form E.g $data = array('column' => 'value');
     * Fourth is the data to be unset | Unset is to be used if some of the input you wish to be removed
     * 
     */
    public function update($updateData, $valueWhere, $table = null)
    {

        //Authentication
        if ($this->auth->auth_check_level('level', $this->PageLevel)) {
            //Pluralize Table
            //if is null $table assign $this->plural->pluralize($this->Table) use ternarry operator
            $table = (!is_null($table)) ? $table : $this->Table;
            $table = $this->plural->pluralize($table);

            //Updated table using db->update
            $updatedStatus = $this->db->update($table, $updateData, $valueWhere);
            if ($updatedStatus == true) {

                return true; //Data Inserted
            } else {

                return false; //Data Insert Failed
            }
        }
    }
}

/* End of file PortalCompaniesIntership.php */
