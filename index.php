<?php
require_once "processes/database.php";
$errors = array();
session_start();
if (isset($_SESSION['thouSandsIds'])) {
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
    <link rel="stylesheet" href="img/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="styling/index.css">
    <title>Project ThouSands</title>
</head>
<body>
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
            }
            ?>
            </nav>
    </header>
    <section class="sect_1">
        <h1>Project <span>ThouSands</span></h1>
        <h2>Thousand journeys among the Endless Desert Oasis</h2>
        <div class="linkie-button">
            <a href="forum-connect/connect_it.php?state=login" class="Forum">Open Forum</a>
            <a href="LibsClt/openlibrary/libs.php" class="Libs">Library Collection</a>
        </div>
    </section>
    <section>
        <h2>stay tuned! and send some feedback(pls)</h2>
        <p>this is a game of a thousands hour making if you have a suggestion or want to get some alpha testing, hit me up on slack or check my github cuz in there i usually release a somewhat stable build(not promised). Awhile that pleaseee if you find some bug or have a suggestion for a feature to improve the game expreience, post it on the Wished Feature Forum in this website(i've pour my time to made it y'know)</p>
    </section>
    <section>
        <h2>What is Project ThouSands?</h2>
        <P>In the desert oasis there is... nah idk it just a multiplyer sandbox game for now i'm not good
            at making lore, if you have suggestion about it just hit me up and we discuss about it cuz
            will probably get added if most people on forum agree
        </P>
        <p>To better track what's need to be done and what have been achieved, i made some kind of
            roadmap that you can see down below and it will be updated as it progress with time    
        </p>
</section>
    <section class="map_main_container">
        <h2>the roadmap</h2>
        <p>in there you'll see what have been done and what to be achieved</p>
        <div class="map-container">
            <div class="map-road"></div>
            <?php
            $stmt_check_dvlog = $connects->prepare("SELECT * FROM acvs WHERE acvState = ? ORDER BY acvDates DESC LIMIT 4;");
            $stmt_check_dvlog->bind_param("s", $daState);
            $stmt_check_dvlog->execute();
            $result_check_dvlog = $stmt_check_dvlog->get_result();
            if ($result_check_dvlog->num_rows > 0) {
                $uniques = [];
                while ($value = $result_check_dvlog->fetch_assoc()) {
                    $acvIds = $value['acvIds'];
                    $acvBannerDitc = $value['acvBannerDitc'];
                    $acvTitles = $value['acvTitles'];
                    $acvDates = $value['acvDates'];
                    if (!in_array($acvIds, $uniques)) {
            ?>
            <div class="mile-container">
                <img class="acv-banner" src="TS/achvs/<?php echo $acvBannerDitc;?>" alt="logos_banner">
                <h3 class="acv-title"><?php echo $acvTitles;?></h3>
                <p class="acv-dates"><?php echo $acvDates;?></p>
                <a class="acv-link" href="TS/forum/ThouSands.php?milestones=<?php echo $acvIds;?>">.</a>
            </div>
            <?php
                    }
                }
            } else {
            ?>
            <div class="mile-container">
                <p class="devlog-desc">No Achievement found, no way</p>
            </div>
            <?php
            }
            ?>
        </div>
    </section>
    <section class="devlog_main_container">
        <h2>devlog</h2>
        <p>in here i will post notice to what currently im doin each day and what problem might i get stuck with</p>
        <div class="devlog-container">
            <?php
            $stmt_check_dvlog = $connects->prepare("SELECT * FROM dvlogs WHERE dvlogState = ? ORDER BY dvlogDates DESC LIMIT 4;");
            $stmt_check_dvlog->bind_param("s", $daState);
            $stmt_check_dvlog->execute();
            $result_check_dvlog = $stmt_check_dvlog->get_result();
            if ($result_check_dvlog->num_rows > 0) {
                $uniques = [];
                while ($value = $result_check_dvlog->fetch_assoc()) {
                    $Dids = $value['dvlogIds'];
                    $Dtitles = $value['dvlogTitles'];
                    $Ddates = $value['dvlogDates'];
                    $Ddesc = $value['dvlogdesc'];
                    $Dtags = $value['dvlogtags'];
                    if (!in_array($Dids, $uniques)) {
            ?>
            <div class="devlog">
                <h3 class="devlog-title"><?php echo $Dtitles;?></h3>
                <p class="devlog-dates"><?php echo $Ddates;?></p>
                <p class="devlog-desc"><?php echo $Ddesc;?></p>
                <p class="devlog-tag"><?php echo $Dtags;?></p>
                <a class="devlog-link" href="TS/forum/ThouSands.php?devlog=<?php echo $Dids;?>">.</a>
            </div>
            <?php
                    }
                }
            } else {
            ?>
            <div class="devlog">
                <p class="devlog-desc">No devlog found, somethings wrong in there</p>
            </div>
            <?php
            }
            ?>
        </div>
    </section>
    <section>
        <h2>testing and feedback</h2>
        <p>i reaaallyyy appreciate for trying my game and it will be nice if you willing to send some feedback about
            any improvement i can do even just for a smol little suggestion for more comfortable gameplay.
        </p>
        <div class="link-container">
            <div class="redirector">
                <h3 class="title">Get da Game</h3>
                <p class="desc">follow the guide and it should be able to run(hopefuly)</p>
                <p class="version">version: 0.0.0</p>
                <a href="#" class="linkie">download</a>
            </div>
            <div class="suggestion-n-smol-feedback-container">
                <h3 class="title">Some feedback plz</h3>
                <p class="desc">I made a special forum page for bug reports and your suggestions, feel free to use it!</p>
                <a href="#" class="linkie">go to da forum</a>
            </div>
        </div>
    </section>
    <section class="comes_soon">
        <h2>comes soon</h2>
        <p>shh... there's will be more to come(if i have time that is)</p>
    </section>
    <footer>
        <div class="footer-group">
            <h2 class="footer-title">Vintago</h2>
            <h3 class="footer-subtitle">From <img src="img/vdsl.png" alt="" class="footer_logo"><h3>
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
            <p>© 2025 Vintago - All right reserved</p> 
        </div>
        <h2 class="things">VINTAGO</h2>
    </footer>
</body>
</html>