<?php

class DB
{


    public function __construct()
    {
        //Do your magic here

    }

    /**
     * Connect To database
     */
    public function db_connect()
    {
        // Include Config
        include 'libraries/Config.php';

        // Create connection
        $conn = new mysqli($config['db_host'], $config['db_user'], $config['db_password'], $config['db_name']);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            return $conn;
        }
    }

    /**
     * Insert Data
     */
    public function insert($table, $insert)
    {
        // Get Columns
        $columns = implode(',', array_keys($insert));
        $values = $this->insert_values($insert);

        // Insert
        $conn = $this->db_connect();
        $sql = "INSERT INTO `$table` ($columns) VALUES ($values)";

        // Query
        if ($conn->query($sql) === TRUE) {
            return $conn->insert_id;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close
        $conn->close();
    }

    /**
     *
     * This function help you to select and retun values
     *
     * In this function you pass
     *
     * 1: Table name
     *  -> This will be singularize and used to generate column Name
     *  -> Also pluralize for Table Name
     *
     * 2: Pass the selected column name
     * 3: Pass the comparison values
     *  array('column'=>'value')
     *
     * 4: Pass Limit
     *
     * NB: Full Column Name -- will be added by the function 
     * 
     */
    public function select($table, $select, $where, $limit = null)
    {
        // Construct
        require_once 'libraries/Plural.php';

        //Modules
        $module = Plural::singularize($table);
        $table = Plural::pluralize($module);

        //Columns
        $select_column = $this->get_column_name($module, $select);
        $columns = (is_array($select_column)) ? implode(',', array_values($select_column)) : $select_column;

        // Where
        foreach ($where as $key => $value) {

            $column = $this->get_column_name($module, $key);
            $where_column[$column] = $value; //Set Proper Column Name 
        }
        if (is_array($where_column)) {
            $where = implode(` AND `, $this->select_values($where_column));
        }
        $where = " WHERE $where";

        // Limit
        $limit = (is_null($limit)) ? '' : " LIMIT $limit";

        // Select
        $conn = $this->db_connect();
        $sql = "SELECT $columns FROM `$table` $where $limit";
        $result = $conn->query($sql);

        // Return
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return null;
        }
    }

    /**
     *
     * This function help you to select and retun specific column value
     * You can only select single column value
     *
     * In this function you pass
     *
     * 1: Module name / Table name
     *  -> This will be singularize and used to generate column Name
     *  -> Also pluralize for Table Name
     *
     * 2: Pass the selected column name
     * 3: Pass the comparison values
     *  array('column'=>'value')
     *
     * 4: Pass clause if you want to use Like etc.
     *
     * NB: Full Column Name -- will be added by the function 
     * 
     */
    public function select_single($table, $column, $where)
    {
        // Select From single column
        $select = $this->select($table, $column, $where, 1);

        // Return
        if (!is_null($select)) {
            // check if character exist in string $column
            if (strpos($column, ' as ') !== false) {
                $column = explode(' as ', $column);
                $column = $column[1];
            } else {
                //get column name
                $column = $this->get_column_name($table, $column);
            }

            // trim column
            $column = trim($column);

            // Return
            return $select[0]["$column"];
        } else {
            return null;
        }
    }

    /**
     * 
     * Extract values from Array
     */
    public function insert_values($insert)
    {
        $values = array_values($insert);
        $insert_values = array();

        //Get Values
        for ($i = 0; $i < count($values); $i++) {
            $value = $values[$i];
            if (!is_numeric($value)) {
                $insert_values[$i] = "'$value'";
            } else {
                $insert_values[$i] = $value;
            }
        }

        // Get Values
        $values = implode(',', array_values($insert_values));
        return $values;
    }

    /**
     * Extract Select Values From Array
     * 
     */
    public function select_values($select)
    {
        // Columns
        $columns = array_keys($select);

        $values = array_values($select);
        $select_values = array();

        //Get Values
        for ($i = 0; $i < count($values); $i++) {
            $value = $values[$i];
            if (!is_numeric($value)) {
                $select_values[$i] = "'$value'";
            } else {
                $select_values[$i] = $value;
            }
        }

        // Get Select
        $select_column_value = array();
        for ($i = 0; $i < count($columns); $i++) {
            $sign = '=';

            $col_sign = explode(' ', $columns[$i]);
            $col = $col_sign[0];
            $sign = (array_key_exists(1, $col_sign)) ? $col_sign[1] : $sign;

            $val = $select_values[$i];
            $select_column_value[$i] = "`$col` $sign $val";
        }

        array_values($select_column_value);

        // Return
        return $select_column_value;
    }

    /**
     * Generate Columns Names
     *
     * The function generate proper multiple/single column names
     * The function accepts
     * 1: Table Name
     * 2: Column simple name(s) | as number based array or string 
     * 
     */
    public function get_column_name($table, $column)
    {
        // Get Columns
        if (!is_array($column) && strpos($column, ",") == False) {
            $column_name = $table . '_' . trim($column); //Column Name
        } else {
            if (!is_array($column) && strpos($column, ",") == True) {
                $column = explode(",", $column); /* Get Column Name */
            }
            for ($i = 0; $i < count($column); $i++) {
                $column_name[$i] = $this->get_column_name($table, $column[$i]); //Column Name
            }
        }

        // Return Column
        return $column_name;
    }
}
