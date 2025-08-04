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
            <a href="gatewayclient.php" class="nav-button">Shores</a>
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
        <h1 class="title">ThouSands Gateway</h1>
        <p class="desc">Gateway to the endless potential for every developer.
            <br>ThouSands Gateway act as the central hub connecting every developer along with the potential enjoyer alike to not only discuss and communicate feedback but also contribute directly on their project development</p>
    </section>
    <section class="connected-unit">
        <div class="software">
            <img src="" alt="" class="attachs">
            <h2 class="titles">Alcyoneus Sueno Alcy</h2>
        </div>
        <div class="software">
            <img src="" alt="" class="attachs">
            <h2 class="titles">ThouSands Forum</h2>
        </div>
        <div class="software">
            <img src="" alt="" class="attachs">
            <h2 class="titles">ThouSands Library</h2>
        </div>
        <div class="software">
            <img src="" alt="" class="attachs">
            <h2 class="titles">CrossGate</h2>
        </div>
    </section>
    <script src="scriptstuff/Mindex.js"></script>
    <footer>
        <div class="footer-group">
            <h2 class="footer-title">ThouSands Series</h2>
            <h3 class="footer-subtitle">by <img src="img/vdsl.png" alt="" class="footer_logo"><h3>
        </div>
        <div class="footer-group">
            <h2 class="footer-title">Menus</h2>
            <div class="footer-menu_group">
                <a href="#" class="menu_button">Documentation</a>
                <a href="https://github.com/NNRVINTAGE" class="menu_button">Github</a>
                <a href="forum-connect/connect_it.php?state=login" class="menu_button">Forum</a>
            </div>
        </div>
        <div class="copyright">
            <p>Copyright © 2025 VODSOL - All right reserved</p>
            <h2 class="things">VODSOL</h2>
        </div>
    </footer>
</body>
</html>