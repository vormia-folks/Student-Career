<?php

class  View
{
    public function __construct()
    {
    }

    /**
     * 
     * Render the View
     * -> Pass the view script
     */

    public function render($view_script)
    {
        require($view_script);
    }
}
