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
    <link rel="stylesheet" href="Library/libsImg/libs.ico" type="image/x-icon">
    <link rel="stylesheet" href="styling/pallate.css">
    <link rel="stylesheet" href="styling/Mindex.css">
    <link rel="stylesheet" href="styling/libs.css">
    <link rel="stylesheet" href="styling/footer.css">
    <title>ThouSands Library</title>
</head>
<body class="wh100p flex fld">
    <div class="bg flex">.</div>
    <header>
        <nav id="nav">
            <?php
            if ($isLogged == true) {
            ?>
            <a href="home.php" class="linkie dashb">Library</a>
            <?php
            } else {
            ?>
            <a href="forum-connect/connect_it.php?state=login" class="linkie">LOGIN</a>
            <a href="forum-connect/connect_it.php?state=register" class="linkie">JOIN</a>
            <?php
            };
            ?>
            </nav>
        </header>
    <section class="leftMg w90 h80 flex fld">
        <h1 class="topMg">ThouSands Library</h1>
        <h2>Open library collection platform for softwares & games</h2>
        <div class="bottomMg flex gap5">
            <a href="home.php#softwarelist?type=apps" class="Apps">Search Apps</a>
            <a href="home.php#sofwarelist?type=games" class="Games">Discover Games</a>
        </div>
    </section>
    <section class="leftMg w90 flex fld">
        <h2>Recently Added to Library</h2>
        <div class="map-container"> 
            <?php
            $stmt_check_libs = $connects->prepare("SELECT * FROM libslist WHERE libsState = ? ORDER BY addedDates DESC LIMIT 8;");
            $stmt_check_libs->bind_param("s", $State);
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
                <p class="libs-desc">there's a problem retrieving data</p>
            </div>
            <?php
            }
            ?>
        </div>
    </section>
    <section class="leftMg w90 flex fld">
        <h2>Most collected software from the Library</h2>
        <p>see current top collected software from the library</p>
        <div class="libs-container">
            <?php
            $stmt_check_libs = $connects->prepare("SELECT * FROM libslist WHERE libsState = ? ORDER BY cltNumbs DESC LIMIT 8;");
            $stmt_check_libs->bind_param("s", $State);
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
    <?php include_once 'footer.php';?>
</body>
</html>