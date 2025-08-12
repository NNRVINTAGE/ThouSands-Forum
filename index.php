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
    <link rel="stylesheet" href="styling/footer.css">
    <title>ThouSands Gateway</title>
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
            <a href="CrossGate.php" class="nav-button">CrossGate</a>
            <a href="thousands.php" class="nav-button">Shores</a>
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
        <h1 class="title">ThouSands Gateway</h1>
        <p class="desc">Gateway to the endless potential for every developer</p>
    </section>
    <section class="connected-unit acjc">
        <h2 class="title-2 w100 txtc">Connecting software and service in one platform</h2>
        <div class="software posr">
            <img src="" alt="" class="attachs">
            <h2 class="titles">ThouSands Forum</h2>
            <a href="Forum.php" class="link-cover">.</a>
        </div>
        <div class="software posr">
            <img src="" alt="" class="attachs">
            <h2 class="titles">ThouSands Library</h2>
            <a href="libs.php" class="link-cover">.</a>
        </div>
        <div class="software posr">
            <img src="" alt="" class="attachs">
            <h2 class="titles">CrossGate</h2>
            <a href="CrossGate.php#client" class="link-cover">.</a>
        </div>
        <div class="software posr">
            <img src="" alt="" class="attachs">
            <h2 class="titles">SandBridges</h2>
            <a href="CrossGate.php#sandbridges" class="link-cover">.</a>
        </div>
    </section>
    <section class="section-type-2">
        <h2 class="title-2">About Gateway</h2>
        <p>ThouSands Gateway is an central hub connecting every developer along with the potential enjoyer alike to 
            not only discuss and communicate feedback but also contribute directly on their project development</p>
    </section>
    <script src="scriptstuff/Mindex.js"></script>
    <?php include_once 'footer.php';?>
</body>
</html>