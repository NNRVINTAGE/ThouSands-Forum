<?php
require_once "processes/database.php";
$errors = array();
session_start();
if (isset($_SESSION['profileTags'])) {
    $isLogged = true;
} else {
    $isLogged = false;
};
$raceds = "{[FATAL_ERR:0_]}";
$raceds = htmlspecialchars($raceds, ENT_QUOTES, 'UTF-8');
$daState = "Publics";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="img/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="styling/pallate.css">
    <link rel="stylesheet" href="styling/index.css">
    <!-- <link rel="stylesheet" href="styling/Mindex.css"> -->
    <link rel="stylesheet" href="styling/footer.css">
    <title>ThouSands Forums</title>
</head>
<body>
    <div class="bg">.</div>
    <header>
        <nav id="nav">
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
            </nav>
        </header>
    <section class="sect_1">
        <h1>ThouSands Forums</h1>
        <h2>Open Source community forum connecting developer sharing work with everyone</h2>
        <div class="linkie-button">
            <?php
            if ($isLogged == true) {
            ?>
            <a href="forum-connect/connect_it.php?state=login" class="Forum">Open Forum Tabs</a>
            <?php
            } else {
            ?>
            <a href="forum-connect/connect_it.php?state=login" class="Forum">Join a new community</a>
            <?php
            };
            ?>
        </div>
    </section>
    <section class="devlog_main_container">
        <h2>Trending Forum & Topic</h2>
        <div class="devlog-container">
            <?php
            $stmt_check_dvlog = $connects->prepare("SELECT * FROM dvlogs WHERE dvlogState = ? ORDER BY dvlogDates DESC LIMIT 4;");
            $stmt_check_dvlog->bind_param("s", $daState);
            $stmt_check_dvlog->execute();
            $result_check_dvlog = $stmt_check_dvlog->get_result();
            if ($result_check_dvlog->num_rows > 0) {
                $uniqueItem = [];
                while ($value = $result_check_dvlog->fetch_assoc()) {
                    $Dids = $value['dvlogIds'];
                    $Dtitles = $value['dvlogTitles'];
                    $Ddates = $value['dvlogDates'];
                    $Ddesc = $value['dvlogdesc'];
                    $Dtags = $value['dvlogtags'];
                    if (!in_array($Dids, $uniqueItem)) {
            ?>
            <div class="devlog">
                <h3 class="devlog-title"><?php echo $Dtitles;?></h3>
                <p class="devlog-dates"><?php echo $Ddates;?></p>
                <p class="devlog-desc"><?php echo $Ddesc;?></p>
                <p class="devlog-tag"><?php echo $Dtags;?></p>
                <a class="devlog-link" href="TS/forum/ThouSands.php?devlog=<?php echo $Dids;?>">.</a>
            </div>
            <?php
                    };
                };
            } else {
            ?>
            <div class="devlog">
                <p class="devlog-desc">No devlog found, somethings wrong in there</p>
            </div>
            <?php
            };
            ?>
        </div>
    </section>
    <section>
        <h2>ThouSands Forums Background</h2> 
        <h2>Thousand of journey among the Endless Shores</h2>
    </section>
    <?php include_once 'footer.php';?>
</body>
</html>