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
}
