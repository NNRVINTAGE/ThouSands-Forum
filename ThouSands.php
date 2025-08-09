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
    <link rel="stylesheet" href="styling/Mindex.css">
    <link rel="stylesheet" href="styling/index.css">
    <link rel="stylesheet" href="styling/footer.css">
    <title>Project ThouSands</title>
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
    <section class="landing-banner">
        <h1 class="title">Project ThouSands: Shores</h1>
        <h2 class="desc">Thousand of journey among the Endless Shores</h2>
        <div class="linkie-button">
            <a href="forum-connect/connect_it.php?state=login" class="uni-button-1"></a>
        </div>
    </section>
    <section>
        <h2>About Project ThouSands</h2>
        <P>In a place where the endless desert and sea waves are all the eyes can see,
            <br>Multiple tunnels opening appeared out of nowhere filled with frequent distant roar from the depth.
            <br>from the past have written the sounds belong to an archaic entitys in whichsa sealed beneath by colonist to ensure it's genocidal act never repeat again but every since that time the entity start to break the seal and the faint roar becoming more louder,
            <br>Every journey will changes the fates and shape the world whichever direction it will be lead into
        </P>
        <p>
            ThouSands Shores is part of the Project <span>ThouSands</span> series, in which you and the other player can shape the world as the time progress.
        </p>
    </section>
    <section class="map_main_container">
        <h2>the roadmap</h2>
        <p>the timeline of Project ThouSands Shores development</p>
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
                <a class="acv-link" href="progression.php?pgid=<?php echo $acvIds;?>">.</a>
            </div>
            <?php
                    };
                };
            } else {
            ?>
            <div class="mile-container">
                <p class="devlog-desc">Data fetch failed</p>
            </div>
            <?php
            };
            ?>
        </div>
    </section>
    <section class="devlog_main_container">
        <h2>devlog</h2>
        <p>an series of devlog about progress on the projects</p>
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
    <section class="section-type-2">
        <div class="container-type-1 w100">
            <div class="os selected">
                <img src="" alt="" class="logo">
                <h2 class="os_name">Windows</h2>
            </div>
            <div class="os">
                <img src="" alt="" class="logo">
                <h2 class="os_name">Linux(Unavailable)</h2>
            </div>
        </div>
        <div class="container-type-2">
            <table class="table-type-1">
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
            <div class="container-type-2">
                <img src="#" alt="#" class="banners">
                <h2>Windows</h2>
                <p>Tested in windows 10</p>
            </div>
        </div>
    </section>
    <script src="scriptstuff/thousandsStuff.js"></script>
    <?php include_once 'footer.php';?>
</body>
</html>