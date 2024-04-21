<?php
include 'database.php';
include 'user_class.php';

$database = new Database();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["create"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        if ($database->createUser($name, $email, $password)) {
            $message = "New record created successfully";
        } else {
            $message = "Error creating record";
        }
    } elseif (isset($_POST["update"])) {
        $user_id = $_POST["user_id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        if ($database->updateUser($user_id, $name, $email, $password)) {
            $message = "Record updated successfully";
        } else {
            $message = "Error updating record";
        }
    } else {
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'delete_') !== false) {
                $user_id = str_replace('delete_', '', $key);
                if ($database->deleteUser($user_id)) {
                    $message = "Record deleted successfully";
                } else {
                    $message = "Error deleting record";
                }
            }
        }
    }
}

$users = $database->getUsers();

$database->closeConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<nav>
    <ul>
        <li><a href="registration.php">Registration</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="home.php">Home</a></li>
    </ul>
</nav>

<div class="container">
    <h2>Registration</h2>
    
    <form method="post" action="registration.php">
        <input type="text" name="name" placeholder="Name" required>
        <br>
        <input type="email" name="email" placeholder="Email" required>
        <br>
        <input type="password" name="password" placeholder="Password" required>
        <br>
        <br>
        <button type="submit" name="create">Create</button>
    </form>
    <br>
    <button id="toggleUsers">Show Users</button>
    <div id="userList" style="display: none;">
    
    <h3>Users</h3>
    <ul>
    <?php foreach ($users as $user): ?>
        <li>ID: <?= $user->getUserId() ?> - Name: <?= $user->getName() ?> - Email: <?= $user->getEmail() ?>
            <form method="post" action="registration.php">
                <input type="hidden" name="user_id" value="<?= $user->getUserId() ?>">
                <input type="text" name="name" value="<?= $user->getName() ?>" required>
                <input type="email" name="email" value="<?= $user->getEmail() ?>" required>
                <input type="password" name="password" value="<?= $user->getPassword() ?>" required>
                <button type="submit" name="update">Update</button>
                <button type="submit" name="delete_<?= $user->getUserId() ?>">Delete</button>
            </form>
        </li>
    <?php endforeach; ?>
    </ul>
    </div>
</div>

<script>
document.getElementById("toggleUsers").addEventListener("click", function() {
    var userList = document.getElementById("userList");
    if (userList.style.display === "none" || userList.style.display === "") {
        userList.style.display = "block";
        this.textContent = "Hide Users";
    } else {
        userList.style.display = "none";
        this.textContent = "Show Users";
    }
});
</script>

<?php if (!empty($message)): ?>
    <script>alert("<?php echo $message; ?>");</script>
<?php endif; ?>

</body>
</html>