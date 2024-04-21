<?php
$host = '172.16.0.214';
$user = 'group6';
$password = '123456';
$dbname = 'group6';
$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT id, title, author, price FROM books";
    $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='{$row['id']}' data-author='{$row['author']}' data-price='{$row['price']}'>{$row['title']}</option>";
    }

mysqli_close($conn);
?>