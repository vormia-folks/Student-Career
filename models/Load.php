<?php
require_once 'libraries/Model.php';

class Load extends Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here

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
            'site_title' => 'Student Carrier Portal',
            'front_layout' => 'students'
        );

        return $data;
    }
}
