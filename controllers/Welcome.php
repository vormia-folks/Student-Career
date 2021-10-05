<?php

require_once 'libraries/Controller.php';

class Welcome extends Controller
{

    public function index()
    {

        $data['message'] = "You have accessed welcome controller";
        $this->view->render("welcome/index", $data);
    }
}

/* End of file Home.php */
