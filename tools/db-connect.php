<?php 
    function create_db_connection($db_name) {
        $host = 'localhost';
        $port = '3306';
        $user = 'dev';
        $pass = 'devpass';

        $conn = new mysqli($host, $user, $pass, $db_name);
        if ($conn->connect_error) {
            die ("Connection failed: " . $conn->connect_error);
        }
        
        return $conn;
    }
?>
