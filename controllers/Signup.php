<?php

require_once 'libraries/Controller.php';

class Signup extends Controller
{

    public function index()
    {

        echo "Signup Controller Page";
    }

    public function students($name = 'Andrew')
    {
        echo "Student Name is : $name";
    }

    public function passed()
    {
        $getData = $_GET;

        echo "<pre>";
        print_r($getData);
    }
}

/* End of file Signup.php */
