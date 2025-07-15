<?php
require_once "processes/database.php";
$errors = array();
session_start();
if (isset($_SESSION['thouSandsIds'])) {
    $isLogged = true;
} else {
    $isLogged = false;
};
$raceds = "{[FATAL_ERR:0_]}";
$daState = "Publics";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="img/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="styling/index.css">
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
            }
            ?>
            </nav>
        </header>
    <section class="sect_1">
        <h1>Project <span>ThouSands</span></h1>
        <h2>Thousand of journeys among the Desert Oasis</h2>
        <div class="linkie-button">
            <a href="forum-connect/connect_it.php?state=login" class="Forum">Open Forum</a>
            <a href="LibsClt/openlibrary/libs.php" class="Libs">Library Collection</a>
        </div>
    </section>
    <section>
        <h2>About ThouSands Forum & Library</h2>
        <p>ThouSands Forum is a feedback and topic discussion forum where anyone can 
        <br>ThouSands Library were a software distribution platform open for anyone to share their works and try others shared software too</p>
    </section>
    <section>
        <h2>About Project ThouSands</h2>
        <P>In a strange place where the desert and the seas are all eyes can see.
            an seemingly endless archaic tunnels appearing everywhere filled with frequent faint roar from the depth is yet to be investigated,
            it is an <?php echo $raceds;?> duty to uncover the source of the terror and ensuring the colony safety.
        </P>
        <p>
            ThouSands Shores is part of the Project <span>ThouSands</span> series, made as foundation to have as much feedback for the next release.
        </p>
    </section>
    <section class="map_main_container">
        <h2>the roadmap</h2>
        <p>displayed in here is timeline of the future goal for the project</p>
        <div class="map-container">
            <div class="map-road"></div>
            <?php
            $stmt_check_dvlog = $connects->prepare("SELECT * FROM acvs WHERE acvState = ? ORDER BY acvDates DESC LIMIT 4;");
            $stmt_check_dvlog->bind_param("s", $daState);
            $stmt_check_dvlog->execute();
            $result_check_dvlog = $stmt_check_dvlog->get_result();
            if ($result_check_dvlog->num_rows > 0) {
                $uniqueItem = [];
                while ($value = $result_check_dvlog->fetch_assoc()) {
                    $acvIds = $value['acvIds'];
                    $acvBannerDitc = $value['acvBannerDitc'];
                    $acvTitles = $value['acvTitles'];
                    $acvDates = $value['acvDates'];
                    if (!in_array($acvIds, $uniqueItem)) {
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
        <p>an updated daily devlog of the project progress</p>
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
        <h2>Downloads</h2>
        <div class="os_container">
            <div class="os selected">
                <img src="" alt="" class="logo">
                <h2 class="os_name">Windows</h2>
            </div>
            <div class="os">
                <img src="" alt="" class="logo">
                <h2 class="os_name">Linux(Unavailable)</h2>
            </div>
        </div>
        <div class="download_container">
            <table class="downloadlist">
                <tr>
                    <td>batch</td>
                    <td>version</td>
                    <td>release</td>
                    <td>date</td>
                    <td>key</td>
                </tr>
                <tr>
                    <td>ThouSands_Shores_20J7AS.rar</td>
                    <td>20J7AS</td>
                    <td>Stable-Alpha</td>
                    <td>20-7-2025</td>
                    <td>901yfu82mj-c814tgx5-92j52fd3269</td>
                </tr>
            </table>
            <div class="detail_info">
                <img src="#" alt="#" class="banners">
                <h2>Windows</h2>
                <p>Tested in windows 10 & 11</p>
            </div>
        </div>
    </section>
    <script src="scriptstuff/thousandsStuff.js"></script>
    <footer>
        <div class="footer-group">
            <h2 class="footer-title">ThouSands</h2>
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
            <p>© 2025 VODSOL - All right reserved</p>
            <h2 class="things">VODSOL</h2>
        </div>
    </footer>
</body>
</html>