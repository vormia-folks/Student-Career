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

    public function render($view, $vars = array(), $return = true)
    {
        // Path to the file
        $path = 'views/' . $view;
        $this->_reqr_file_vars($path, $this->prepare_view_vars($vars), $return);
    }

    public function _reqr_file_vars($filePath, $variables = array(), $print = true)
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

    public function prepare_view_vars($vars)
    {
        // Check If Value is Array
        if (!is_array($vars)) {
            $vars = is_object($vars) ? get_object_vars($vars) : array();
        }

        // Loop
        foreach (array_keys($vars) as $key) {
            if (strncmp($key, '_ci_', 4) === 0) {
                unset($vars[$key]);
            }
        }

        return $vars;
    }
}
