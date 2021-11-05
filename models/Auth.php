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
    public function auth_logout()
    {

        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();
    }

    /**
     *
     * This function is used to set session
     * 
     */
    public function auth_set_session($session)
    {
        // call auth session
        $this->auth_session();
        // foreach session variable assign to session
        foreach ($session as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    /**
     *
     * This function is used to check user is logged in or not
     * 
     */
    public function auth_check()
    {
        // call auth session
        $this->auth_session();
        // check session is set or not
        if (isset($_SESSION['id'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Access value from session
     * Pass session name as variable
     * check if session name is set or not
     * return the session value
     */
    public function auth_get_session($session)
    {
        // call auth session
        $this->auth_session();
        // check session is set or not
        if (isset($_SESSION[$session])) {
            return $_SESSION[$session];
        } else {
            return false;
        }
    }
}
