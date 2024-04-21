<?php
define('DB_SERVERNAME', '172.16.0.214');
define('DB_USERNAME', 'group6');
define('DB_PASSWORD', '123456');
define('DB_NAME', 'group6');

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>