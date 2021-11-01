<?php
require_once 'libraries/Model.php';
require_once 'libraries/Controller.php';

class Auth extends Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->controller = new Controller;
    }

    /**
     *
     * This function is used to Start Session
     * 
     */
    public function auth_session()
    {
        session_start();
    }

    /**
     * Destriy Session Set
     */
    public function auth_destroy()
    {

        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();
    }
}
