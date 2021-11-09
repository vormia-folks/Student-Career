<?php

require_once 'libraries/Controller.php';

class Signup extends Controller
{

    public function index()
    {

        echo "Signup Controller Page";
    }

    public function students($name = 'Andrew', $score = 0)
    {
        echo "Student Name is : $name and he lost $score since registered";
    }

    public function passed()
    {
        $getData = $_GET;

        foreach ($getData as $key => $value) {
            echo "$key is $value <br />";
        }
    }
}

/* End of file Signup.php */
