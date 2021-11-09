<?php

// Use Autoload To Access Libraries & Model
require_once 'libraries/PortalAutoload.php';

class PortalStudentsApplication extends Controller
{

    /**
     *
     * The Main Website Home Page Controller
     * -> The controller open the first home page
     */
    public $Table = 'applications'; //View Folder
    public $Layout = 'portals'; //View Folder
    public $Folder = 'student'; //View Dir Name
    public $SubFolder = '/application';
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

        // Prepaire Query
        $select = 'application.id as id,intership.organization as company,intership.university as university,application.viewed as viewed,application.flg as status';
        $select_column = $this->db->get_column_name($this->Table, $select);
        $columns = (is_array($select_column)) ? implode(',', array_values($select_column)) : $select_column;

        //Table
        $table = $this->plural->pluralize($this->Table);
        // DB Connect
        $conn = $this->db->db_connect();
        $sql = "SELECT $columns FROM `$table`";
        $sql .= " INNER JOIN interships ON applications.application_internship = interships.intership_id";
        $sql .= " WHERE applications.application_student = $user_id";
        // Order By
        $sql .= " ORDER BY applications.application_id DESC";
        $result = $conn->query($sql);
        // Return
        // use tenary operator to check if result is not empty
        $applications = (!empty($result->num_rows > 0)) ? $result->fetch_all(MYSQLI_ASSOC) : null;

        // if applications is not null 
        // loop through applications get company name from organizations table where organization_id = company use db->select_single
        // Get university name from universities table where university_id = university use db->select_single
        // check if viewed is 1 then btn success = viewed else btn danger = not viewed
        if (!is_null($applications)) {
            foreach ($applications as $key => $value) {
                $applications[$key]['company'] = $this->db->select_single('organizations', 'name', ['id' => $value['company']]);
                $applications[$key]['university'] = $this->db->select_single('universities', 'name', ['id' => $value['university']]);
                $applications[$key]['viewed'] = ($value['viewed'] == 1) ? '<span class="badge bg-success">Viewed</span>' : '<span class="badge bg-danger">Not Viewed</span>';
                $applications[$key]['show'] = $value['viewed'];

                // If status is 0 set disabled as <button></button> danger else set enabled as button success
                if ($applications[$key]['status'] == 0) {
                    $applications[$key]['status'] = '<button class="btn btn-danger">Disabled</button>';
                } else {
                    $applications[$key]['status'] = '<button class="btn btn-success">Enabled</button>';
                }
            }
        }
        // Assign applications to data
        $data['applications'] = $applications;

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

            //Where
            $where = array($inputTYPE => $inputID);
            // Using $where select internship and student from applications using select
            $application = $this->db->select($this->Table, 'internship as internship, student as student', $where);
            // Check if application is not null if is not null return array 0 else null use ternar operator
            $application = (!is_null($application)) ? $application[0] : null;
            // Get internship and student from applications using select
            $internship = $application['internship'];
            $student = $application['student'];

            // Get Details getStudentDetails
            $found = $this->getStudentDetails($internship, $student);
            $data['studentInfo'] = (!is_null($found)) ? $found['student'] : null;
            $data['internshipInfo'] = (!is_null($found)) ? $found['internship'] : null;
            $data['curriculumInfo'] = (!is_null($found)) ? $found['curriculum'] : null;

            // Select description from applications where [id => $inputID] using select_single add value to $data['description']
            $data['description'] = $this->db->select_single($this->Table, 'description', $where);
            // Add Application id
            $data['application_id'] = $inputID;

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

            // Application ID
            $application_id = $postData['application'];

            // Unset application
            $postData = $this->modal->load->unset($postData, 'application');

            // Where
            $where = array('id' => $application_id);

            // Using $where select internship and student from applications using select
            $application = $this->db->select($this->Table, 'internship as internship, student as student', $where);
            // Check if application is not null if is not null return array 0 else null use ternar operator
            $application = (!is_null($application)) ? $application[0] : null;
            // Get internship and student from applications using select
            $internship = $application['internship'];
            $student = $application['student'];

            // By select_single from application where internship_id = internship_id and student_id = student_id using db->select_single
            $viewed = $this->db->select_single('applications', 'viewed', array('internship' => $internship, 'student' => $student));
            // If applied return to page with error message
            if ($viewed == 1) {
                $this->modal->notify->set('error');
                $message = 'This application has already been viewed';
                $this->edit('edit', 'id', $application_id, $message);
            } else {

                // Validation Rules
                $rules = array(
                    'application' => 'required|integer',
                    'description' => 'max:1000',
                );
                // Validation using $this->valid
                $valid = $this->valid->validate($formData, $rules);
                if ($this->valid->validation_check($valid) === false) {

                    // check if $this->update($postData, array('id' => $user_id)) is success 
                    if ($this->update($postData, $where)) {
                        //Notification
                        $this->modal->notify->set('success');
                        $message = 'Application Was Successfully Updated';
                    } else {
                        //Notification
                        $this->modal->notify->set('error');
                        $message = 'System could not update your application';
                    }
                } else {
                    // Notification
                    $message = 'Please fill all the required fields';
                    $data['notify'] = $this->modal->notify->error($message);
                }

                //Redirect to Profile Edit Page
                $this->edit('edit', 'id', $application_id, $message);
            }
        } elseif ($type == 'delete') {
            // Get Internship ID from Get request id using $this->modal->load->input('id', 'GET');
            $application = $this->modal->load->input('id', 'GET');
            //Variable user_id is set to the current session id
            $student = $this->auth->auth_get_session('id');
            $application_id = $this->db->select_single('applications', 'id', array('id' => $application, 'student' => $student));
            $viewed = $this->db->select_single('applications', 'viewed', array('id' => $application_id));

            // Array Where id = internship id
            $where = array('id' => $application_id);

            // Input Validation Success
            if ($viewed == 0) {

                if ($this->delete($where)) {
                    //Notification
                    $this->modal->notify->set('success');
                    $message = 'Application Deleted Successfully';

                    //Redirect to Profile Edit Page
                    $this->index($message);
                } else {
                    //Notification
                    $this->modal->notify->set('error');
                    $message = 'System could not delete the Internship';

                    //Redirect to Profile Edit Page
                    $this->edit('edit', 'id', $application_id, $message);
                }
            } else {

                $this->modal->notify->set('error');
                $message = 'Could not update, the application might have been viewed or not under your account'; //Notification Message				

                // Account Not Active
                $this->index($message);
            }
        } elseif ($type == 'view') {

            // Get Internship ID from Get request id using $this->modal->load->input('id', 'GET');
            $application = $this->modal->load->input('inputID', 'GET');
            //Variable user_id is set to the current session id
            $student = $this->auth->auth_get_session('id');
            $application_id = $this->db->select_single('applications', 'id', array('id' => $application, 'student' => $student));

            // Input Validation Success
            if (True && !is_null($application_id)) {

                $internship = $this->db->select_single('applications', 'internship', array('id' => $application_id));

                //Prepaire Data
                $page = $this->plural->pluralize($this->Folder) . $this->SubFolder . "/view";
                $data = $this->load($page);

                // Get Details getStudentDetails
                $found = $this->getStudentDetails($internship, $student);
                $data['studentInfo'] = (!is_null($found)) ? $found['student'] : null;
                $data['internshipInfo'] = (!is_null($found)) ? $found['internship'] : null;
                $data['curriculumInfo'] = (!is_null($found)) ? $found['curriculum'] : null;

                // Array Where id = internship id
                $where = array('id' => $application_id);
                // Select description from applications where [id => $inputID] using select_single add value to $data['description']
                $data['description'] = $this->db->select_single($this->Table, 'description', $where);
                $data['response'] = $this->db->select_single($this->Table, 'response', $where);

                // Status
                $status = $this->db->select_single('applications', 'status', array('id' => $application_id));
                if ($status == 1) {
                    //Notification
                    $this->modal->notify->set('success');
                    $message = 'Your Application has been accepeted';
                } else {
                    //Notification
                    $this->modal->notify->set('error');
                    $message = 'Your Application was rejected';
                }

                // Notification
                $notify = $this->modal->notify->notify();
                $data['notify'] = $this->modal->notify->$notify($message);

                //Open Page
                $this->pages($data);
            } else {

                $this->modal->notify->set('error');
                $message = 'Could not update, the application might have been viewed or not under your account'; //Notification Message

                // Open index
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

    /**
     * 
     * Get Student | Intership and Curriculum Details
     * 
     */
    public function getStudentDetails($internship_id, $student_id = null)
    {
        // Check if student_id is null get student_id from session
        $student_id = (!is_null($student_id)) ? $student_id : $this->auth->auth_get_session('id');

        // Get Internship details by db->select_single id as id, name as name from internships where id => internship and assign to data
        $select = "id as id,organization as organization,attachment as type,major as major,availability as availability,paid as paid,university as university,description as description";
        $interships = $this->db->select('interships', $select, array('id' => $internship_id), 1);
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
            }
        }
        // check if interships is not null assign [0] to data else set null use ternar operator
        $internshipInfo = (!is_null($interships)) ? $interships[0] : null;

        // Select curriculum from curriculums where student = student_id using db->select
        $select = "id as id,university as university_id,university as university,attachment as attachment,major as major,availability as availability,about as description";
        $curriculums = $this->db->select('curriculums', $select, array('student' => $student_id), 1);
        if (!is_null($curriculums)) {
            foreach ($curriculums as $key => $curriculum) {
                $curriculums[$key]['attachment'] = $this->db->select_single('options', 'title', array('id' => $curriculum['attachment']));
                $curriculums[$key]['major'] = $this->db->select_single('options', 'title', array('id' => $curriculum['major']));
                $curriculums[$key]['availability'] = $this->db->select_single('options', 'title', array('id' => $curriculum['availability']));
                $curriculums[$key]['university'] = $this->db->select_single('university', 'name', array('id' => $curriculum['university']));
            }
        }
        // check if curriculums is not null assign [0] to data else set null use ternar operator
        $curriculumInfo = (!is_null($curriculums)) ? $curriculums[0] : null;

        // Get student details by db->select id as id, name as name from students where id => student and assign to data
        $student = $this->db->select('students', 'id as id, first_name as first_name,last_name as last_name,email as email,personal_email as personal_email,phone_number as phone_number', array('id' => $student_id));
        // check if is null assign null else assign student to data use ternar operator
        $studentInfo = (!is_null($student)) ? $student[0] : null;

        // Return Data
        return array(
            'internship' => $internshipInfo,
            'curriculum' => $curriculumInfo,
            'student' => $studentInfo
        );
    }
}

/* End of file PortalStudentsApplication.php */
