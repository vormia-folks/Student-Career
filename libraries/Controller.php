<?php

require_once 'libraries/View.php';

class Controller
{

    public function __construct()
    {
        // Initiate the View
        $this->view = new View;
    }
}
