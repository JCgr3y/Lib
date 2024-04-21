<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <link rel="stylesheet" href="style/home.css">
</head>
<body>
<header>
<nav role="navigation">
    <ul>
        <li><a href="registration.php">Registration</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="home.php">Home</a></li>
        <li><a href="purchase.php">Cart</a></li>
    </ul>
</nav>
</header>
<div class="container">
    <h2>Gratam nostram bibliothecam</h2>

    <h3>Genres</h3>
    <div class="modules">
    <div class="module-box reveal brk active fiction-module" data-module-type="fiction" onclick="checkLink('modules/fiction.php')">
        <div class="content-container">
            <div class="module-text">

            </div>
        </div>
    </div>

    <div class="module-box reveal brk active non-fiction-module" data-module-type="non-fiction" onclick="checkLink('modules/non-fiction.php')">
        <div class="content-container">
            <div class="module-text">

            </div>
        </div>
    </div>

    <div class="module-box reveal brk active education-module" data-module-type="education" onclick="checkLink('modules/education.php')">
        <div class="content-container">
            <div class="module-text">

            </div>
        </div>
    </div>

    <div class="module-box reveal brk active essay-module" data-module-type="essay" onclick="checkLink('modules/essay.php')">
        <div class="content-container">
            <div class="module-text">

            </div>
        </div>
    </div>

    <div class="module-box reveal brk active poetry-module" data-module-type="poetry" onclick="checkLink('modules/poetry.php')">
        <div class="content-container">
            <div class="module-text">

            </div>
        </div>
    </div>

    <div class="module-box reveal brk active blank-module" data-module-type="blank" onclick="checkLink('modules/blank.php')">
        <div class="content-container">
            <div class="module-text">

            </div>
        </div>
    </div>

    </div>
</div>

<script>
    function checkLink(moduleType) {
      window.location.href = moduleType + '';
    }
</script>

</body>
</html>