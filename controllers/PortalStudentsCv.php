<?php

// Use Autoload To Access Libraries & Model
require_once 'libraries/PortalAutoload.php';
//require model crud


class PortalStudentsCv extends Controller
{

    /**
     *
     * The Main Website Home Page Controller
     * -> The controller open the first home page
     */
    public $Table = 'curriculums'; //View Folder
    public $Layout = 'portals'; //View Folder
    public $Folder = 'students'; //View Dir Name
    public $SubFolder = '/cv';
    public $PageLevel = 'student';

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
        $page = $this->plural->pluralize($this->Folder) . $this->SubFolder . "/edit";
        $data = $this->load($page);

        //Variable user_id is set to the current session id
        $user_id = $this->auth->auth_get_session('id');

        // select user details from table students where array id = session id using $this->db->select second parameter is the array of columns set to *
        $user_details = $this->db->select($this->Table, 'id as id, attachment as attachment, availability as availability, major as major, about as about', array('student' => $user_id));
        // check if $data['user_details'] is not null, if is not null return array 0 use ternar operator to get the value
        $data['curriculumInfo'] = (!is_null($user_details)) ? $user_details[0] : null;
        if ($data['curriculumInfo'] == null) {
            $data['curriculumInfo'] = array(
                'attachment' => null,
                'availability' => null,
                'major' => null,
                'about' => null,
                'id' => null
            );
        }

        // call studentInfo function to get the student info
        $data['studentInfo'] = $this->studentInfo($user_id);

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
            $user_details = $this->db->select($table, '*', $where);
            $data['user_details'] = (!is_null($user_details)) ? (object) $user_details[0] : null;

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

            // Get user ID from session using auth->auth_get_session
            $user_id = $this->auth->auth_get_session('id');

            // Input Validation Success
            if (!is_null($user_id)) {

                //Add user id to postData
                $formData['student'] = $user_id;

                // get user_id select university from table student using select single
                $university = $this->db->select_single('students', 'university', array('id' => $user_id));
                // add University to postData
                $formData['university'] = $university;


                // Unset values using load->unset
                $postData = $this->modal->load->unset($formData, 'id');

                // check if postData id is null
                // if is null then insert using db->insert 
                // else update where id => postData['id'] using db->update
                if (!is_null($formData['id']) && !empty($formData['id'])) {
                    $status = $this->update($postData, array('id' => $formData['id']));
                } else {
                    $status = $this->insert($postData);
                }

                // check if $this->update($postData, array('id' => $user_id)) is success 
                if ($status) {
                    //Notification
                    $this->modal->notify->set('success');
                    $message = 'Your CV was updated successfully';

                    //Redirect to Profile Edit Page
                    $this->index($message);
                } else {
                    //Notification
                    $this->modal->notify->set('error');
                    $message = 'System could not update your profile';

                    //Redirect to Profile Edit Page
                    $this->index($message);
                }
            } else {

                $this->modal->notify->set('error');
                $message = 'Please check the fields, and try again'; //Notification Message				

                // Account Not Active
                $this->index($message);
            }
        }
    }

    /**
     * The function is used to insert data in the table
     * First parameter is the data to be inserted 
     * Second Parameter should be Taable Name
     */
    public function insert($insertData, $table = null)
    {

        //Authentication
        if ($this->auth->auth_check_level('level', $this->PageLevel)) {
            //Pluralize Table
            //if is null $table assign $this->plural->pluralize($this->Table) use ternarry operator
            $table = (!is_null($table)) ? $table : $this->Table;
            $table = $this->plural->pluralize($table);

            // Insert using db->insert
            $insertStatus = $this->db->insert($table, $insertData);
            if ($insertStatus) {

                return true; //Data Inserted
            } else {

                return false; //Data Insert Failed
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

    /**
     * Generate function to get Student Name, Email and University Name
     * 
     * To get university take student_id either passed as parameter or if is null then get from session id
     * 
     * Then select name,email and university using db->select from students table where student = student_id 
     * 
     * Take the found university and select name using db->select from universities table where id = university
     * 
     * Join the data and return as array
     */
    public function studentInfo($student_id = null)
    {
        //Authentication
        if ($this->auth->auth_check_level('level', $this->PageLevel)) {
            //Get Student ID from session if is null
            $student_id = (!is_null($student_id)) ? $student_id : $this->auth->auth_get_session('id');

            //Select Name, Email and University from students table using db->select
            $found = $this->db->select('students', 'first_name as f_name,last_name as l_name, email as student_email,university as university', array('id' => $student_id));
            $student = (is_null($found)) ? null : $found[0];

            //Join f_name and l_name to make student_name and add to array while unset f_name and l_name and escape any html tags
            $student['student_name'] = $this->modal->load->escape($student['f_name'] . ' ' . $student['l_name']);
            $student['student_name'] = $student['f_name'] . ' ' . $student['l_name'];
            //unset f_name and l_name using load->unset
            $student = $this->modal->load->unset($student, array('f_name', 'l_name'));

            //Select Name from universities table using db->select
            $university = $this->db->select_single('universities', 'name as university', array('id' => $student['university']));
            //Join university to make university_name and add to array while unset university and escape any html tags
            $student['university_name'] = $university;

            //Return
            return $student;
        }
    }
}

/* End of file PortalStudentsCv.php */
