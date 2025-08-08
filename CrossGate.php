<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styling/pallate.css">
    <link rel="stylesheet" href="styling/Mindex.css">
    <link rel="stylesheet" href="styling/footer.css">
    <title>CrossGate</title>
</head>
<body>
    <header>
        <nav>
            <?php
            if ($isLogged != true) {
            ?>
            <a href="libs.php" class="nav-button">Library</a>
            <a href="Forum.php" class="nav-button">Forums</a>
            <?php
            };
            ?>
            <a href="index.php" class="nav-button">Gateways</a>
            <a href="thousands.php" class="nav-button">:Shores</a>
        </nav>
        <div class="linkie-button">
            <?php
            if ($isLogged == true) {
            ?>
            <a href="TS/forum/dashboard.php" class="linkie dashb">Forum</a>
            <a href="LibsClt/openlibrary/home.php" class="linkie dashb">Library</a>
            <?php
            } else {
            ?>
            <a href="forum-connect/connect_it.php?state=login" class="linkie">LOGIN</a>
            <a href="forum-connect/connect_it.php?state=register" class="linkie">JOIN</a>
            <?php
            };
            ?>
        </div>
    </header>
    <section class="section-type-1">
        <h1 class="title">CrossGate</h1>
        <p class="desc">an desktop client software designed to organize ThouSands Library software & games
            <br>an interactive enviroment for user and developer receive convinience whether for productivity or gaming 
        </p>
    </section>
</body>\
</html>