<?php
$book_id = $_POST['book_id'];
$quantity = $_POST['quantity'];

$host = '172.16.0.214';
$user = 'group6';
$password = '123456';
$dbname = 'group6';
$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM books WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $book_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Book not found.");
}

$book = mysqli_fetch_assoc($result);

$total_price = $book['price'] * $quantity;

if ($book['quantity'] < $quantity) {
    die("Not enough quantity in stock.");
}

$new_quantity = $book['quantity'] - $quantity;

$sql = "UPDATE books SET quantity = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $new_quantity, $book_id);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) <= 0) {
    die("Error updating inventory.");
}

$order_date = date('Y-m-d H:i:s');

$sql = "INSERT INTO orders (book_id, quantity, total_price, order_date) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "iiis", $book_id, $quantity, $total_price, $order_date);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) <= 0) {
    die("Error inserting order.");
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

header("Location: ../purchase_confirmation.php?book_id=$book_id&quantity=$quantity&total_price=$total_price");
exit();
?>