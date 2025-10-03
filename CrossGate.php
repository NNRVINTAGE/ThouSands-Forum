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
    <title>CrossGate</title>
</head>
<body>
    <header>
        <nav>
            <a href="gateway.php" class="nav-button">Gateways</a>
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
    <section class="section-type-1 fld">
        <h1 class="title">CrossGate</h1>
        <p class="desc">an embedded extension for your apps & games
            <br>enabling dynamic achievement system with ThouSands Gateway authentication 
        </p>
    </section>
    <section id="features" class="flex">
        <div class="flex fld">
            <h2 class="txt-n">Feature</h2>
            <p class="txt-s"></p>
        </div>
    </section>
    <section id="sandbridges" class="flex">
        <h2 class="txt-b">SandBridges Plugin</h2>
        <p class="txt-s">For the developer to integrate CrossGate achievement system with an easy to use setup</p>
        <a href="gets/crossgate.rar" class="sideMg w50 txt-n button">Download</a>
        <a href="https://github.com/NNRVINTAGE/CrossGate" class="sideMg w50 txt-n button">Source</a>
        <p class="sideMg txt-ms">Current version only supported & tested in Godot</p>
    </section>
    <?php include_once 'footer.php';?>
</body>
</html>