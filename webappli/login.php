<?php
    include 'db_conn.php';
    include 'database.php';
    include 'class/user_class.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/loginstyle.css?v=2">
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
    <h2>Login</h2>
    <div id="loginMessage"></div>
    <form id="loginForm" method="process/login_process.php">
        <input type="email" name="email" id="email" placeholder="Email" required>
        <br>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <br>
        <input type="hidden" name="login" value="1">
        <button type="submit">Login</button>
    </form>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    fetch('process/login_process.php', {
        method: 'POST',
        body: new FormData(this),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'home.html';
        } else {
            document.getElementById('loginMessage').textContent = data.message;
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>

</body>
</html>