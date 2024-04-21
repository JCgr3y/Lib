<?php
    $host = '172.16.0.214';
    $user = 'group6';
    $password = '123456';
    $dbname = 'group6';
    
    $conn = mysqli_connect($host, $user, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>