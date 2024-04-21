<?php
session_start();
include 'admin_class.php';
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Add your CSS links here -->
</head>
<body>

<nav>
    <ul>
        <li><a href="#">Dashboard</a></li>
        <li><a href="users.php">User Management</a></li>
        <!-- Add more navigation links as needed -->
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<div class="container">
    <h2>Welcome, <?php echo $_SESSION['admin_username']; ?>!</h2>
    <!-- Add your dashboard content here -->
</div>

</body>
</html>
