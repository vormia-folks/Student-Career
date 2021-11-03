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
     * Select Data
     */
    public function select($table, $columns, $where = null, $limit = null)
    {
        // Get Columns
        if (is_array($columns)) {
            $columns = implode(',', $columns);
        }

        // Where
        if (is_array($where)) {
            $where = implode(` AND `, $this->select_values($where));
        }
        $where = (is_null($where)) ? '' : " WHERE $where";

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
}
