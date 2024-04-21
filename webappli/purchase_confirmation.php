<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Confirmation</title>
    <link rel="stylesheet" href="style/pcpage.css">
</head>
<body>
    <header>
        <h1>Purchase Confirmation</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
            </ul>
        </nav>
    </header>
    <?php
    $book_id = $_GET['book_id'];
    $quantity = $_GET['quantity'];
    $total_price = $_GET['total_price'];

    echo "<table>";
    echo "<tr><th colspan='2'>Purchase Details</th></tr>";
    echo "<tr><td>Book ID:</td><td>$book_id</td></tr>";
    echo "<tr><td>Quantity:</td><td>$quantity</td></tr>";
    echo "<tr><td>Total Price:</td><td>$total_price</td></tr>";
    echo "</table>";

    echo "<button onclick='window.history.back()'>Back to Purchase Page</button>";
    ?>
</body>
</html>
