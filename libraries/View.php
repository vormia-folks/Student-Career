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
     * -> Accept values
     */
    public function render($view, $vars = array(), $return = true)
    {
        // Include Config
        include 'libraries/Config.php';

        // Path to the file
        $path = $config['views'] . "/$view.php";
        $this->reqr_file_vars($path, $this->prepare_view_vars($vars), $return);
    }

    /**
     * Access File and pass Variables
     */
    public function reqr_file_vars($filePath, $variables = array(), $print = true)
    {
        $output = NULL;
        if (file_exists($filePath)) {
            // Extract the variables to a local namespace
            extract($variables);

            // Start output buffering
            ob_start();

            // Include the template file
            include $filePath;

            // End buffering and return its contents
            $output = ob_get_clean();
        }
        if ($print) {
            print $output;
        }
        return $output;
    }

    /**
     * Prepaire values for ease access
     */
    public function prepare_view_vars($vars)
    {
        // Check If Value is Array
        if (!is_array($vars)) {
            $vars = is_object($vars) ? get_object_vars($vars) : array();
        }

        return $vars;
    }
}
