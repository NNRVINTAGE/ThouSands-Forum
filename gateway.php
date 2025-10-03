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
    <link rel="shortcut icon" href="logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="styling/pallate.css">
    <link rel="stylesheet" href="styling/Mindex.css">
    <link rel="stylesheet" href="styling/footer.css">
    <title>Gateway to Endless Potential</title>
</head>
<body>
    <img src="img/gatebg.PNG" alt="" class="posf ins0 wh100p opacity7 z0">
    <header class="z1">
        <nav>
            <a href="CrossGate.php" class="nav-button">CrossGate</a>
            <a href="thousands.php" class="nav-button">Shores</a>
        </nav>
        <div class="linkie-button">
            <?php
            if ($isLogged == true) {
            ?>
            <a href="TS/forum/dashboard.php" class="linkie dashb">Forum</a>
            <a href="index.php" class="linkie dashb">Library</a>
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
    <section class="section-type-1 z1">
        <h1 class="title">ThouSands Gateway</h1>
        <p class="desc">Open Source Platform, opening gateway to the endless potential</p>
    </section>
    <section class="connected-unit acjc z1">
        <h2 class="title-2 w100 txtc">Connecting software and service in one platform</h2>
        <div class="software posr">
            <img src="" alt="" class="attachs">
            <h2 class="titles">ThouSands Forum</h2>
            <a href="TS/forum/dashboard.php" class="link-cover">.</a>
        </div>
        <div class="software posr">
            <img src="" alt="" class="attachs">
            <h2 class="titles">ThouSands Library</h2>
            <a href="index.php" class="link-cover">.</a>
        </div>
        <div class="software posr">
            <img src="" alt="" class="attachs">
            <h2 class="titles">CrossGate</h2>
            <a href="CrossGate.php#client" class="link-cover">.</a>
        </div>
    </section>
    <section class="section-type-2 z1">
        <h2 class="title-2">About Gateway</h2>
        <p>ThouSands Gateway is an central hub connecting every developer along with the potential enjoyer alike to 
            not only try and discuss but also communicate feedback directly on their project development</p>
    </section>
    <script src="scriptstuff/Mindex.js"></script>
    <?php include_once 'footer.php';?>
</body>
</html>