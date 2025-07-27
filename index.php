<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="img/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="styling/Mindex.css">
    <title>ThouSands Gateway</title>
</head>
<body>
    <header>
        <nav>
            <a href="libs.php" class="nav-button">Library</a>
            <a href="ThouSands.php" class="nav-button">Forums</a>
            <a href="#about" class="nav-button">About</a>
            <a href="gatewayclient.php" class="nav-button">Download Client</a>
        </nav>
        <div class="linkie-button">
            <?php
            if ($isLogged == true) {
            ?>
            <a href="TS/forum/dashboard.php" class="linkie dashb">Dashboard</a>
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
    <section class="TFL_LinkContainer">
        <img src="img/mindex_libs.png" alt="Banner" class="ContainerBanner">
        <a href="libs.php" class="entitle">Library</a>
    </section>
    <section class="TFS_LinkContainer">
        <img src="img/mindex_frms.png" alt="Banner" class="ContainerBanner">
        <a href="ThouSands.php" class="entitle">Forums</a>
    </section>
    <section class="main-banner">
        <img src="bannerimage" alt="" class="banner">
    </section>
    <section id="about">
        <h2 class="titles">ThouSands Gateways</h2>
        <p class="desc">Gateway to ThouSands of Potential</p>
    </section>
    <script src="scriptstuff/Mindex.js"></script>
</body>
</html>