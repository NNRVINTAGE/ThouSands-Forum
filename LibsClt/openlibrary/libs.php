<?php
require_once "../../processes/database.php";
$errors = array();
session_start();
if (isset($_SESSION['profileTags'])) {
    $isLogged = true;
} else {
    $isLogged = false;
};
$daState = "Publics";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../libsImg/libs.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../styling/pallate.css">
    <link rel="stylesheet" href="libs.css">
    <title>ThouSands Library</title>
</head>
<body>
    <div class="bg">.</div>
    <header>
        <nav id="nav">
            <?php
            if ($isLogged == true) {
            ?>
            <a href=" home.php" class="linkie dashb">Homepage</a>
            <?php
            } else {
            ?>
            <a href="../../forum-connect/connect_it.php?state=login" class="linkie">LOGIN</a>
            <a href="../../forum-connect/connect_it.php?state=register" class="linkie">JOIN</a>
            <?php
            };
            ?>
            </nav>
        </header>
    <section class="sect_1">
        <h1>ThouSands Library</h1>
        <h2>Open library collection platform of software & games</h2>
        <div class="linkie-button">
            <a href=" home.php#softwarelist?type=apps" class="Apps">Search Apps</a>
            <a href=" home.php#sofwarelist?type=games" class="Games">Discover Games</a>
        </div>
    </section>
    <section class="map_main_container">
        <h2>Recently Added to Library</h2>
        <div class="map-container">
            <?php
            $stmt_check_libs = $connects->prepare("SELECT * FROM libslist WHERE libsState = ? ORDER BY addedDates DESC LIMIT 8;");
            $stmt_check_libs->bind_param("s", $daState);
            $stmt_check_libs->execute();
            $result_check_libs = $stmt_check_libs->get_result();
            if ($result_check_libs->num_rows > 0) {
                $uniques = [];
                while ($value = $result_check_libs->fetch_assoc()) {
                    $libsIds = $value['libsIds'];
                    $libsBannerDitc = $value['libsAttachs'];
                    $libsTitles = $value['libsTitles'];
                    $libsDesc = $value['libsDesc'];
                    $addedDates = $value['addedDates'];
                    if (!in_array($libsIds, $uniques)) {
            ?>
            <div class="mile-container">
                <img class="libs-banner" src="../libsImg/<?php echo $libsBannerDitc;?>" alt="logos_banner">
                <h3 class="libs-title"><?php echo $libsTitles;?></h3>
                <p class="libs-dates"><?php echo $addedDates;?></p>
                <a class="libs-link" href="viewCollection.php?viewID=<?php echo $libsIds;?>">.</a>
            </div>
            <?php
                    }
                }
            } else {
            ?>
            <div class="mile-container">
                <p class="libs-desc">We have some problem retrieving data</p>
            </div>
            <?php
            }
            ?>
        </div>
    </section>
    <section class="libs_main_container">
        <h2>Most collected software from the Library</h2>
        <p>see current top collected software from the library</p>
        <div class="libs-container">
            <?php
            $stmt_check_libs = $connects->prepare("SELECT * FROM libslist WHERE libsState = ? ORDER BY cltNumbs DESC LIMIT 8;");
            $stmt_check_libs->bind_param("s", $daState);
            $stmt_check_libs->execute();
            $result_check_libs = $stmt_check_libs->get_result();
            if ($result_check_libs->num_rows > 0) {
                $uniques = [];
                while ($value = $result_check_libs->fetch_assoc()) {
                    $libsids = $value['libsIds'];
                    $libstitles = $value['libsTitles'];
                    $addedDates = $value['addedDates'];
                    $libsdesc = $value['libsDesc'];
                    $libstags = $value['libsCategorys'];
                    if (!in_array($libsids, $uniques)) {
            ?>
            <div class="libs">
                <h3 class="libs-title"><?php echo $libstitles;?></h3>
                <p class="libs-dates"><?php echo $addedDates;?></p>
                <p class="libs-desc"><?php echo $libsdesc;?></p>
                <p class="libs-tag"><?php echo $libstags;?></p>
                <a class="libs-link" href=" home.php?viewID=<?php echo $Dids;?>">.</a>
            </div>
            <?php
                    }
                }
            } else {
            ?>
            <div class="libs">
                <p class="libs-desc">No data retrieved</p>
            </div>
            <?php
            }
            ?>
        </div>
    </section>
    <footer>
        <div class="footer-group">
            <h2 class="footer-title">ThouSands Series</h2>
            <h3 class="footer-subtitle">by <img src="../../img/vdsl.png" alt="" class="footer_logo"><h3>
        </div>
        <div class="footer-group">
            <h2 class="footer-title">Menus</h2>
            <div class="footer-menu_group">
                <a href="#" class="menu_button">Documentation</a>
                <a href="https://github.com/NNRVINTAGE" class="menu_button">Github</a>
                <a href="../../forum-connect/connect_it.php?state=login" class="menu_button">Forum</a>
            </div>
        </div>
        <div class="copyright">
            <p>Copyright © 2025 VODSOL - All right reserved</p>
            <h2 class="things">VODSOL</h2>
        </div>
    </footer>
</body>
</html>