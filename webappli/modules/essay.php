<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Essay</title>
    <link rel="stylesheet" href="../style/fiction.css">
</head>
<body>

<nav>
    <ul>
        <li><a href="../home.php">Home</a></li>
    </ul>
</nav>

<div class="container">
    <h2>Essay Books</h2>
    <div class="modules">
    <div class="module-box reveal brk active essay-module">
        <div class="content-container">
            <div class="module-text">
                <h3>Book Title 1</h3>
                <p>Lorem Ipsum 1.</p>
                <button onclick="redirectToPurchase('1')">Buy Physical Copy</button>
                <button>Read Online</button>
            </div>
        </div>
    </div>
    <br>
    <div class="module-box reveal brk active essay-module">
        <div class="content-container">
            <div class="module-text">
                <h3>Book Title 2</h3>
                <p>Lorem Ipsum 2.</p>
                <button onclick="redirectToPurchase('2')">Buy Physical Copy</button>
                <button>Read Online</button>
            </div>
        </div>
    </div>
    <br>
    <div class="module-box reveal brk active essay-module">
        <div class="content-container">
            <div class="module-text">
                <h3>Book Title 3</h3>
                <p>Lorem Ipsum 3.</p>
                <button onclick="redirectToPurchase('3')">Buy Physical Copy</button>
                <button>Read Online</button>
            </div>
        </div>
    </div>
</div>

</div>

<script>
function redirectToPurchase(bookId) {
    window.location.href = "../purchase.php?book_id=" + bookId;
}
</script>

</body>
</html>