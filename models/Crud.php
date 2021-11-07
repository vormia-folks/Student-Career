<?php
require_once 'libraries/Model.php';
require_once 'libraries/Controller.php';
require_once 'libraries/Plural.php';
require_once 'libraries/DB.php';

class Crud extends Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->controller = new Controller;
        $this->db = new DB;

        // Libraries Instance
    }
}
