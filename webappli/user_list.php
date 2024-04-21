<?php
session_start();
include 'admin_class.php'; // Include the admin class file
include 'database.php'; // Include the database connection file

// Check if admin is logged in, if not, redirect to login page
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("location: login.php");
    exit;
}

// Fetch the list of users from the database
$database = new Database();
$users = $database->getUsers(); // Assuming getUsers() method fetches all users from the database

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="user_table.css"> <!-- Add link to your CSS file -->
</head>
<body>

<nav>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="#">User Management</a></li>
        <!-- Add more navigation links as needed -->
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<div class="container">
    <h2>User List</h2>
    <table>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <!-- Add more table headers as needed -->
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <!-- Add more table cells as needed -->
            </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
