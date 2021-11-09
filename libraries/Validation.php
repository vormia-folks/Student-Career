<?php
require_once 'libraries/Model.php';
require_once 'libraries/Controller.php';
require_once 'libraries/DB.php';

class Validation extends Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->controller = new Controller;
        $this->db = new DB;
    }

    //Validate the data
    public function validate($data, $rules)
    {
        // Values Set use $this->values_set
        $this->values_set($data);
        // Validate
        $errors = [];
        foreach ($rules as $field => $rule) {
            $rule = explode('|', $rule);
            foreach ($rule as $r) {
                $s = explode(':', $r);
                if (isset($s[1])) {
                    $s[0] = $s[0] . ':' . $s[1];
                    unset($s[1]);
                }
                $s[0] = explode(':', $s[0]);
                if (isset($s[0][1])) {
                    $method = $s[0][0];
                    $param = $s[0][1];
                    unset($s[0][0], $s[0][1]);
                } else {
                    $method = $s[0][0];
                    if (isset($s[1])) {
                        $param = $s[1];
                    } else {
                        $param = null;
                    }
                    unset($s[0][0]);
                }
                $fieldValue = $data[$field];
                if (isset($s[0][0])) {
                    $fields2check = explode(',', $s[0][0]);
                    foreach ($fields2check as $f) {
                        $fieldValue .= ' ' . $data[$f];
                    }
                }

                if (!$this->$method($fieldValue, $param)) {
                    $errors[] = $field . ': ' . $this->getErrorMessage($field, $method, $param);
                }
            }
        }

        if (empty($errors)) {
            return true;
        }
        return $errors;
    }

    public function required($value, $param = null)
    {
        if (is_null($value)) {
            return false;
        }
        if (is_array($value)) {
            if (empty($value)) {
                return false;
            }
        }
        if (is_string($value)) {
            $value = trim($value);
            if (empty($value)) {
                return false;
            }
        }
        return true;
    }

    public function min($value, $param = null)
    {
        if (is_null($param)) {
            return false;
        }
        if (is_string($value)) {
            $value = strlen($value);
        }
        if ($value < $param) {
            return false;
        }
        return true;
    }

    public function max($value, $param = null)
    {
        if (is_null($param)) {
            return false;
        }
        if (is_string($value)) {
            $value = strlen($value);
        }
        if ($value > $param) {
            return false;
        }
        return true;
    }

    public function email($value, $param = null)
    {
        // Check id $value is greater than 0
        if (!is_null($value) && strlen($value) > 0) {
            if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    public function url($value, $param = null)
    {
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return true;
        }
        return false;
    }

    //Alpha
    public function alpha($value, $param = null)
    {
        if (preg_match('/^[a-zA-Z]+$/', $value)) {
            return true;
        }
        return false;
    }

    // aplphaa numeric
    public function alpha_numeric($value, $param = null)
    {
        if (preg_match('/^[a-zA-Z0-9]+$/', $value)) {
            return true;
        }
        return false;
    }

    //Alpha dash
    public function alpha_dash($value, $param = null)
    {
        if (preg_match('/^[a-zA-Z0-9_\-]+$/', $value)) {
            return true;
        }
        return false;
    }

    //Numeric
    public function numeric($value, $param = null)
    {
        if (is_numeric($value)) {
            return true;
        }
        return false;
    }

    //Integer
    public function integer($value, $param = null)
    {
        if (preg_match('/^[\-+]?[0-9]+$/', $value)) {
            return true;
        }
        return false;
    }

    //If Decimal
    public function decimal($value, $param = null)
    {
        if (preg_match('/^[\-+]?[0-9]+\.[0-9]+$/', $value)) {
            return true;
        }
        return false;
    }

    // Is natural
    public function is_natural($value, $param = null)
    {
        if (preg_match('/^[0-9]+$/', $value)) {
            return true;
        }
        return false;
    }

    // Is natural no zero
    public function is_natural_no_zero($value, $param = null)
    {
        if (preg_match('/^[1-9][0-9]+$/', $value)) {
            return true;
        }
        return false;
    }

    // exact_length
    public function exact_length($value, $param = null)
    {
        if (strlen($value) == $param) {
            return true;
        }
        return false;
    }

    // Greater than
    public function greater_than($value, $param = null)
    {
        if (preg_match('/^[\-+]?[0-9]+$/', $value)) {
            if ($value > $param) {
                return true;
            }
        }
        return false;
    }

    // Less than
    public function less_than($value, $param = null)
    {
        if (preg_match('/^[\-+]?[0-9]+$/', $value)) {
            if ($value < $param) {
                return true;
            }
        }
        return false;
    }

    // Max length
    public function max_length($value, $param = null)
    {
        if (strlen($value) <= $param) {
            return true;
        } elseif (strlen($value) == 0) {
            return true;
        }
        return false;
    }

    // Min length
    public function min_length($value, $param = null)
    {
        if (strlen($value) >= $param) {
            return true;
        } elseif (strlen($value) == 0) {
            return true;
        }
        return false;
    }

    // Function to check if is unique
    public function is_unique($value, $param = null)
    {

        $table = $this->db->get_table_name($param);
        $field = $this->db->get_column_name($table, $param);

        $conn = $this->db->db_connect();
        $sql = "SELECT * FROM $table WHERE $field = '$value'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            return false;
        } else {
            return true;
        }
    }

    // Function to check if is unique
    public function is_unique_update($value, $param = null)
    {
        //Auth Model
        require_once 'libraries/Auth.php';
        $this->auth = new Auth;

        $table = $this->db->get_table_name($param);
        $field = $this->db->get_column_name($table, $param);
        // Get column name by explode $param and take second element
        $column = explode('.', $param);
        // check if index 1 exist if exist assign to column else assign index 0 use ternarry
        $column = isset($column[1]) ? $column[1] : $column[0];

        $user_id = $this->auth->auth_get_session('id');
        $found = $this->db->select_single($table, 'id', array("$column" => "$value"));

        if (is_null($found)) {
            return true;
        } elseif ($found == $user_id) {
            return true;
        } else {
            return false;
        }
    }

    // Function to check if value exist
    public function is_exist($value, $param = null)
    {

        $table = $this->db->get_table_name($param);
        $field = $this->db->get_column_name($table, $param);

        $conn = $this->db->db_connect();
        $sql = "SELECT * FROM $table WHERE $field = '$value'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    // Function to check if is unique
    public function is_valid_email($value, $param = null)
    {

        $table = $this->db->get_table_name($param);
        $field = $this->db->get_column_name($table, $param);

        // Select Emails
        $found_emails = $this->db->select($table, "$param as emails", array('flg' => 1));

        // Check if $found_emails is array change to index array
        if (is_array($found_emails)) {
            $found_emails = array_column($found_emails, 'emails');

            // Get $value top level domain
            $top_level_domain = substr(strrchr($value, "@"), 1);

            // Check if $top_level_domain is found among $found_emails
            if (in_array($top_level_domain, $found_emails)) {
                return true;
            } else {
                return false;
            }
        }
    }

    // Valid mobile number
    public function valid_mobile($value, $param = null)
    {
        // check $value length
        if (!is_null($value) && strlen($value) > 0) {
            if (preg_match('/^[0-9]{10}$/', $value)) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    //matches
    public function matches($value, $param = null)
    {
        // Check if $_POST has value, if not $_GET
        if (isset($_POST[$param])) {
            $field = $_POST;
        } else {
            $field = $_GET;
        }

        if (isset($field[$param])) {
            if ($value == $field[$param]) {
                return true;
            }
        }
        return false;
    }

    // getErrorMessage
    public function getErrorMessage($field, $method, $param)
    {
        $message = '';

        // If $field has underscore, repalce it with space and ucwords
        if (strpos($field, '_') !== false) {
            $field = str_replace('_', ' ', $field);
            $field = ucwords($field);
        }

        // Get Error Message
        switch ($method) {
            case 'required':
                $message = 'The ' . $field . ' field is required.';
                break;
            case 'min':
                $message = 'The ' . $field . ' field must be at least ' . $param . ' characters in length.';
                break;
            case 'max':
                $message = 'The ' . $field . ' field must not exceed ' . $param . ' characters in length.';
                break;
            case 'email':
                $message = 'The ' . $field . ' field must contain a valid email address.';
                break;
            case 'is_valid_email':
                $message = 'The ' . $field . ' you entered is not among partnered organizations.';
                break;
            case 'is_unique_update':
                $message = 'The ' . $field . ' you entered is already taken.';
                break;
            case 'url':
                $message = 'The ' . $field . ' field must contain a valid URL.';
                break;
            case 'alpha':
                $message = 'The ' . $field . ' field must only contain alphabetical characters.';
                break;
            case 'alpha_numeric':
                $message = 'The ' . $field . ' field must only contain alpha-numeric characters.';
                break;
            case 'alpha_dash':
                $message = 'The ' . $field . ' field must only contain alpha-numeric characters, underscores, and dashes.';
                break;
            case 'numeric':
                $message = 'The ' . $field . ' field must contain only numbers.';
                break;
            case 'integer':
                $message = 'The ' . $field . ' field must contain an integer.';
                break;
            case 'decimal':
                $message = 'The ' . $field . ' field must contain a decimal number.';
                break;
            case 'is_natural':
                $message = 'The ' . $field . ' field must contain only positive numbers.';
                break;
            case 'is_natural_no_zero':
                $message = 'The ' . $field . ' field must contain a number greater than zero.';
                break;
            case 'exact_length':
                $message = 'The ' . $field . ' field must be exactly ' . $param . ' characters in length.';
                break;
            case 'greater_than':
                $message = 'The ' . $field . ' field must contain a number greater than ' . $param . '.';
                break;
            case 'less_than':
                $message = 'The ' . $field . ' field must contain a number less than ' . $param . '.';
                break;
            case 'is_unique':
                $message = 'The ' . $field . ' field must contain a unique value.';
                break;
            case 'is_exist':
                $message = 'The ' . $field . ' field doest not exist in our database.';
                break;
            case 'valid_mobile':
                $message = 'The ' . $field . ' field must contain a valid mobile number.';
                break;
            case 'matches':
                $message = 'The ' . $field . ' field does not match the ' . $param . ' field.';
                break;
            case 'max_length':
                $message = 'The ' . $field . ' field must not exceed ' . $param . ' characters in length.';
                break;
            case 'min_length':
                $message = 'The ' . $field . ' field must be at least ' . $param . ' characters in length.';
                break;
            default:
                $message = 'The ' . $field . ' field is invalid.';
                break;
        }

        // Return the message
        return $message;
    }

    /**
     * Generate method values_set that accept $values
     * @param  array $values
     * 
     *  Encode the array and add to session
     * 
     */
    public function values_set($values)
    {
        // Check if $values is array
        if (is_array($values)) {
            //Auth Model
            require_once 'libraries/Auth.php';
            $this->auth = new Auth;
            //Session
            $values_found = array(
                'form_value' => json_encode($values),
            );
            //Set Message
            $this->auth->auth_set_session($values_found);
        } else {
            //Set Message
            $this->auth->auth_remove_session('form_value');
        }
    }

    /**
     * Generate method validation_check that accept $validation
     * @param  array $validation
     * 
     * Check if validation array and if it has value
     * 
     * Then return the results

     */
    public function validation_check($validation)
    {
        // Errors
        $errors = array();
        // Check if validation array and if it has value
        if (is_array($validation) && count($validation) > 0) {
            //If it has value loop the index based array, from each index explode where there is : trim the results
            foreach ($validation as $key => $value) {
                $explode = explode(':', $value);
                $new_key = trim($explode[0]);
                $new_value = trim($explode[1]);
                // Set the new index[0] as key and index[1] as value
                $errors[$new_key] = $new_value;
            }
        }

        // Check if $error has value, if has value return $error else return false use if else
        if (count($errors) > 0) {
            //Auth Model
            require_once 'libraries/Auth.php';
            $this->auth = new Auth;
            //Session
            $error_found = array(
                'form_error' => json_encode($errors),
            );
            //Set Message
            $this->auth->auth_set_session($error_found);
            return True;
        } else {
            //Remove session using auth_remove_session
            $this->auth->auth_remove_session('form_error');
            // Return
            return False;
        }
    }
}
