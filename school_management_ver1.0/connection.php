<?php
    require_once 'configs.php';
    
    global $conn;
    $conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DATABASE);
    
    mysqli_set_charset($conn,'utf8');
    mysqli_query($conn, "SET NAMES 'utf8' COLLATE 'utf8mb4_unicode_ci';");
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    