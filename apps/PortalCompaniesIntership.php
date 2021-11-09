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

        // Get company ID by selected organization from company table where id = session id using db->select_single
        $user_id = $this->auth->auth_get_session('id');
        $data['organization'] = $this->db->select_single('companies', 'organization', array('id' => $user_id));

        // Select university id and name from table university where flg => 1 using db->select
        $university = $this->db->select('university', '*', array('flg' => 1));
        $data['universities'] = (!is_null($university)) ? $university : null;

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

        // select organization id from table companies where id = user_id using db->select_single
        $organization = $this->db->select_single('companies', 'organization', array('id' => $user_id));

        //  Select all Interships from table interships where organization = organization using db->select
        $interships = $this->db->select('interships', 'id as id,attachment as type,major as major,availability as availability,university as university,flg as status', array('organization' => $organization));
        // Add to Data
        $interships = (!is_null($interships)) ? $interships : null;
        // If Interships is not null loop get type,major,availability name by selecting title from options where id => internship['type'] using db->select_single
        if (!is_null($interships)) {
            foreach ($interships as $key => $intership) {
                $interships[$key]['type'] = $this->db->select_single('options', 'title', array('id' => $intership['type']));
                $interships[$key]['major'] = $this->db->select_single('options', 'title', array('id' => $intership['major']));
                $interships[$key]['availability'] = $this->db->select_single('options', 'title', array('id' => $intership['availability']));

                // If university is null set ANY
                if (is_null($interships[$key]['university'])) {
                    $interships[$key]['university'] = 'ANY';
                } else {
                    // Else select university name from table university where id = intership['university'] using db->select_single
                    $interships[$key]['university'] = $this->db->select_single('university', 'name', array('id' => $intership['university']));
                }

                // If status is 0 set disabled as <button></button> danger else set enabled as button success
                if ($interships[$key]['status'] == 0) {
                    $interships[$key]['status'] = '<button class="btn btn-danger">Disabled</button>';
                } else {
                    $interships[$key]['status'] = '<button class="btn btn-success">Enabled</button>';
                }
            }
        }
        // Add to Data
        $data['interships'] = (!is_null($interships)) ? $interships : null;

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
            $select = "id as id,organization as organization,attachment as attachment,major as major,availability as availability,paid as paid,university as university,description as description";
            $intern_details = $this->db->select($table, $select, $where);
            $data['internshipInfo'] = (!is_null($intern_details)) ? $intern_details[0] : null;

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
        if ($type == 'save') {
            // Get Form Data
            $formData = $this->modal->load->input();
            $emptyValues = $this->modal->load->emptyArrayKey($formData);
            $rules = array(
                'organization' => 'required|integer',
                'attachment' => 'required|integer',
                'availability' => 'required|integer',
                'major' => 'required|integer',
                'paid' => 'required|min:4|max:10',
                'university' => 'integer',
                'description' => 'required|max:1000',
            );
            // Validation using $this->valid
            $valid = $this->valid->validate($formData, $rules);

            // Unset values using load->unset
            $postData = $this->modal->load->unset($formData, $emptyValues);

            // Get user ID from session using auth->auth_get_session
            $user_id = $this->auth->auth_get_session('id');

            // Input Validation Success
            if ($this->valid->validation_check($valid) === false) {
                if ($this->insert($postData)) {
                    //Notification
                    $this->modal->notify->set('success');
                    $message = 'Internship Added Successfully';

                    //Redirect to Profile Edit Page
                    $this->open('add', $message);
                } else {
                    //Notification
                    $this->modal->notify->set('error');
                    $message = 'System could not add the Internship';

                    //Redirect to Profile Edit Page
                    $this->open('add', $message);
                }
            } else {

                $this->modal->notify->set('error');
                $message = 'Please check the fields, and try again'; //Notification Message				

                // Account Not Active
                $this->open('add', $message);
            }
        } elseif ($type == 'update') {
            // Get Form Data
            $formData = $this->modal->load->input();
            $emptyValues = $this->modal->load->emptyArrayKey($formData);
            $rules = array(
                'id' => 'required|integer',
                'attachment' => 'required|integer',
                'availability' => 'required|integer',
                'major' => 'required|integer',
                'paid' => 'required|min:4|max:10',
                'university' => 'integer',
                'description' => 'required|max:1000',
            );
            // Validation using $this->valid
            $valid = $this->valid->validate($formData, $rules);

            // Unset values using load->unset
            $postData = $this->modal->load->unset($formData, $emptyValues);

            // Get user ID from session using auth->auth_get_session
            $user_id = $this->auth->auth_get_session('id');
            $internship_id = $postData['id'];

            // Array Where id = internship id
            $where = array('id' => $internship_id);
            // $postData flg = 0
            $postData['flg'] = 0;
            // Unset
            $postData = $this->modal->load->unset($postData, 'id');

            // Input Validation Success
            if ($this->valid->validation_check($valid) === false) {

                if ($this->update($postData, $where)) {
                    //Notification
                    $this->modal->notify->set('success');
                    $message = 'Internship Updated Successfully';

                    //Redirect to Profile Edit Page
                    $this->edit('edit', 'id', $internship_id, $message);
                } else {
                    //Notification
                    $this->modal->notify->set('error');
                    $message = 'System could not update the Internship';

                    //Redirect to Profile Edit Page
                    $this->edit('edit', 'id', $internship_id, $message);
                }
            } else {

                $this->modal->notify->set('error');
                $message = 'Please check the fields, and try again'; //Notification Message				

                // Account Not Active
                $this->edit('edit', 'id', $internship_id, $message);
            }
        } elseif ($type == 'delete') {
            // Get Internship ID from Get request id using $this->modal->load->input('id', 'GET');
            $internship_id = $this->modal->load->input('id', 'GET');
            // Array Where id = internship id
            $where = array('id' => $internship_id);

            // Input Validation Success
            if (!is_null($internship_id)) {

                if ($this->delete($where)) {
                    //Notification
                    $this->modal->notify->set('success');
                    $message = 'Internship Deleted Successfully';

                    //Redirect to Profile Edit Page
                    $this->index($message);
                } else {
                    //Notification
                    $this->modal->notify->set('error');
                    $message = 'System could not delete the Internship';

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
     * The function is used to delete data in the table
     * First parameter is the values to be passed in where clause N:B the data needed to be in an associative array form E.g $data = array('column' => 'value');
     * Second parameter is the table name default is null
     * 
     */
    public function delete($valueWhere, $table = null)
    {
        //Authentication
        if ($this->auth->auth_check_level('level', $this->PageLevel)) {
            //Pluralize Table
            //if is null $table assign $this->plural->pluralize($this->Table) use ternarry operator
            $table = (!is_null($table)) ? $table : $this->Table;
            $table = $this->plural->pluralize($table);

            //Updated table using db->update
            $deletedStatus = $this->db->delete($table, $valueWhere);
            if ($deletedStatus == true) {

                return true; //Data Inserted
            } else {

                return false; //Data Insert Failed
            }
        }
    }
}

/* End of file PortalCompaniesIntership.php */
