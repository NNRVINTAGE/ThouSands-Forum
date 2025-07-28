<?php
require_once "processes/database.php";
$errors = array();
session_start();
if (isset($_SESSION['profileTags'])) {
    $isLogged = true;
} else {
    $isLogged = false;
};
$State = "Publics";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="img/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="styling/pallate.css">
    <link rel="stylesheet" href="styling/Mindex.css">
    <title>ThouSands Gateway</title>
</head>
<body>
    <header>
        <nav>
            <?php
            if ($isLogged != true) {
            ?>
            <a href="libs.php" class="nav-button">Library</a>
            <a href="ThouSands.php" class="nav-button">Forums</a>
            <?php
            };
            ?>
            <a href="#about" class="nav-button">About</a>
            <a href="gatewayclient.php" class="nav-button">Project</a>
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
    <section id="about">
        <h2 class="titles">ThouSands Gateways</h2>
        <p class="desc">Gateway to ThouSands Ecosystem, Opening the Endless Potential.
            <br>ThouSands Gateway act as an central hub for every Project ThouSands software and games</p>
    </section>
    <script src="scriptstuff/Mindex.js"></script>
</body>
</html>