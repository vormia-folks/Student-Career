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
        $select = implode(',', array_keys($insert));
        $values = $this->insert_values($insert);

        //Modules
        $module = Plural::singularize($table);
        $table = Plural::pluralize($module);

        $select_column = $this->get_column_name($module, $select);
        $columns = (is_array($select_column)) ? implode(',', array_values($select_column)) : $select_column;

        // Insert
        $conn = $this->db_connect();
        $sql = "INSERT INTO `$table` ($columns) VALUES ($values)";

        // Query
        if ($conn->query($sql) === TRUE) {
            return $conn->insert_id;
        } else {
            return false;
            // echo "Error: " . $sql . "<br>" . $conn->error;
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
        // if $select = * skip columns sequense
        if ($select == '*') {
            $columns = "*";
        } else {
            $select_column = $this->get_column_name($module, $select);
            $columns = (is_array($select_column)) ? implode(',', array_values($select_column)) : $select_column;
        }

        // Where
        foreach ($where as $key => $value) {

            $column = $this->get_column_name($module, $key);
            $where_column[$column] = $value; //Set Proper Column Name 
        }
        if (is_array($where_column)) {
            $where = implode(' AND ', $this->select_values($where_column));
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
     * Generate method select_order
     * @param  string $table
     * @param  string $select
     * @param  array $where
     * @param  array $order_by [optional]
     * @return int $limit [optional]
     * @return array or null
     * 
     * Use connect() first
     * Then use get_column_name to get column names from $column
     * Do same for $where and $order_by
     * 
     * write the sql and run the query
     * return the result
     * 
     */
    public function select_order($table, $select, $where, $order_by = array('id' => 'DESC'), $limit = null)
    {

        //Modules
        $module = Plural::singularize($table);
        $table = Plural::pluralize($module);

        // if $select = * skip columns sequense
        if ($select == '*') {
            $columns = "*";
        } else {
            $select_column = $this->get_column_name($module, $select);
            $columns = (is_array($select_column)) ? implode(',', array_values($select_column)) : $select_column;
        }

        // Where
        foreach ($where as $key => $value) {

            $column = $this->get_column_name($module, $key);
            $where_column[$column] = $value; //Set Proper Column Name 
        }
        if (is_array($where_column)) {
            $where = implode(' AND ', $this->select_values($where_column));
        }

        // Order By
        foreach ($order_by as $key => $value) {

            $column = $this->get_column_name($module, $key);
            $order_by_column = "`$column` $value"; //Set Proper Column Name 
        }

        // Limit
        $limit = (is_null($limit)) ? '' : " LIMIT $limit";

        // Query
        $sql = "SELECT $columns FROM $table WHERE $where ORDER BY $order_by_column $limit";
        $result = $this->db_connect()->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return null;
        }
    }

    /**
     * *** This function help you to update data ***
     * 
     * update table values
     * Accept table name and prularise the table name string
     * Accept the column name and value to be updated
     * Accept the where clause
     */
    public function update($table, $update, $where)
    {
        //Modules
        $module = Plural::singularize($table);
        $table = Plural::pluralize($module);

        // Update
        foreach ($update as $key => $value) {
            $column = $this->get_column_name($module, $key);
            $update_column[$column] = $value; //Set Proper Column Name 
        }
        if (is_array($update_column)) {
            $update = $this->update_values($update_column);
        }
        $update = " SET $update";

        // Where
        foreach ($where as $key => $value) {

            $column = $this->get_column_name($module, $key);
            $where_column[$column] = $value; //Set Proper Column Name 
        }
        if (is_array($where_column)) {
            $where = implode(' AND ', $this->select_values($where_column));
        }
        $where = " WHERE $where";

        // Update
        $conn = $this->db_connect();
        $sql = "UPDATE `$table` $update $where";

        $result = $conn->query($sql);

        // Return
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * *** This function help you to delete data ***
     * Accept table name and prularise the table name string
     * Accept the where clause
     * 
     */
    public function delete($table, $where)
    {
        //Modules
        $module = Plural::singularize($table);
        $table = Plural::pluralize($module);

        // Where
        foreach ($where as $key => $value) {

            $column = $this->get_column_name($module, $key);
            $where_column[$column] = $value; //Set Proper Column Name 
        }
        if (is_array($where_column)) {
            $where = implode(' AND ', $this->select_values($where_column));
        }
        $where = " WHERE $where";

        // Delete
        $conn = $this->db_connect();
        $sql = "DELETE FROM `$table` $where";

        $result = $conn->query($sql);

        // Return
        if ($result) {
            return true;
        } else {
            return false;
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
            //Connect to db
            $conn = $this->db_connect();
            $value = $conn->real_escape_string($values[$i]); // Escape string

            // Assign Value
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
     * 
     * Generate function update_values
     * 
     * accept array value
     * extract array key and value
     * set key inside `$key`
     * set value inside "$value"
     */
    public function update_values($update)
    {
        $update_values = array();
        foreach ($update as $key => $value) {
            if (!is_numeric($value)) {
                $update_values[$key] = "$key = '$value'";
            } else {
                $update_values[$key] = "$key = $value";
            }
        }
        $values = implode(',', array_values($update_values));
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
        // Singularize Table Name
        $table = Plural::singularize($table);

        // Get Columns
        if (!is_array($column) && strpos($column, ",") == False) {
            // Generate Column Name
            $column_name = $this->handle_column_with_dot($table, $column); //Column Name
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

    /**
     * Generate Get Table Name Method
     * 
     * Pass processed column name
     * if is not array check if there is a dot in the column name 
     * if there is a dot then extract the table name from the column name
     * if there is no dot then return the table name by explode the column name where ther is _ 
     * Pluralize the table name
     *  check if is array then loop while calling the function
     */
    public function get_table_name($column)
    {
        if (!is_array($column)) {
            if (strpos($column, ".") == True) {
                $table = explode(".", $column);
                $table = $table[0];
            } else {
                $table = explode("_", $column);
                $table = $table[0];
            }
            $table = Plural::pluralize($table);
        } else {
            for ($i = 0; $i < count($column); $i++) {
                $table[$i] = $this->get_table_name($column[$i]);
            }
        }
        return $table;
    }

    /**
     * Handle columns with dot
     * pass table name
     * pass the column name with dot as string
     * return the column name with table name
     */
    public function handle_column_with_dot($table, $column)
    {
        //Check if there is dot in column name use ternary operator
        $column = (strpos($column, ".") !== false) ? explode(".", $column) : $column;
        // Check if is $column is array
        if (is_array($column)) {
            $module = Plural::pluralize($column[0]); //Module
            // Singularize Table Name
            $row = Plural::singularize($column[0]); // Row Name
            $column =  $module . '.' . $row . '_' . trim($column[1]); //Column Name
        } else {
            // Singularize Table Name
            $table = Plural::singularize($table);
            $column = $table . '_' . trim($column); //Column Name
        }

        return $column;
    }
}
