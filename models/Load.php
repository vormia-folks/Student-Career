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
            'site_title' => 'Student Carrier Portal',
            'front_layout' => 'students',
            'base_url' => $this->controller->base_url(),
            'asset_url' => $this->controller->asset_url(),
        );

        return $data;
    }
}
