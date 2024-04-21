<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Purchase</title>
    <link rel="stylesheet" href="style/styles.css">
</head>
<body>
    <header>
        <h1>Bookstore</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Confirm Purchase</h2>
        <p>Please review your order and confirm the purchase.</p>
        <form action="process/process_order.php" method="post" id="purchaseForm">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="book_id" id="book_id">
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
                            </select>
                        </td>
                        <td id="author"></td>
                        <td id="price"></td>
                        <td><input type="number" name="quantity" value="1" min="1"></td>
                    </tr>
                </tbody>
            </table>
            <p>Total: </p>
            <input type="submit" value="Confirm Purchase">
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Bookstore</p>
    </footer>

    <script>
        document.getElementById('book_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            
            document.getElementById('author').textContent = selectedOption.dataset.author;
            document.getElementById('price').textContent = '$' + selectedOption.dataset.price;
        });
    </script>
</body>
</html>