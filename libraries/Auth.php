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
        if (isset($_SESSION['logged'])) {
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

    // check is session level is equal to passed variable
    // accept session name and level name
    public function auth_check_level($session, $level)
    {
        // call auth session
        $this->auth_session();
        // check session is set or not
        if (isset($_SESSION[$session])) {
            // check session level is equal to passed level
            if ($_SESSION[$session] == $level) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Generate function named set_flash that set session notification with passed value
     * accept a string parameter assign to session falsh
     * non return value
     */
    public function auth_set_flash($value)
    {
        // call auth session
        $this->auth_session();
        // set session flash
        $_SESSION['flash'] = trim($value);
    }

    /**
     * Generate function named get_flash that get session notification
     * accept no parameter
     * return session flash value
     * if session flash is not set return 'blank'
     * destroy session flash
     */
    public function auth_get_flash()
    {
        // call auth session
        $this->auth_session();
        // check session flash is set or not
        if (isset($_SESSION['flash'])) {
            // return session flash value
            $value = $_SESSION['flash'];
            // destroy session flash
            unset($_SESSION['flash']);
            return $value;
        } else {
            return 'blank';
        }
    }

    /**
     * Generate function auth_dump_session to dump all session
     */
    public function auth_dump_session()
    {
        // call auth session
        $this->auth_session();
        // dump all session
        var_dump($_SESSION);
    }
}
