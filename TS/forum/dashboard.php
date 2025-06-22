<?php
require_once '../../processes/database.php';
$errors = array();
session_start();
if (isset($_SESSION['thouSandsIds'])) {
    $aidis = $_SESSION['thouSandsIds'];
    $name = $_SESSION['username'];
} else {
    header ('location: ../GM/forum/dashboards.php');
    exit;
};
$page = "dashboard";
$UploadEnabled = "yes";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styling/forum_univ.css">
    <link rel="stylesheet" href="../../styling/connect_univ.css">
    <link rel="stylesheet" href="../../styling/connect_forms.css">
    <title>Dashboard</title>
</head>
<body>
<!-- nav -->
    <div id="Navigation_Panel">
        <img src="../../img/home.png" alt="" class="Navigation_Button" onclick="linker('home')">
        <?php
            if ($UploadEnabled === "yes") {
        ?>
                <img src="../../img/search.png" alt="" class="Navigation_Button" onclick="search()">
                <img src="../../img/upload.png" alt="" class="Navigation_Button" onclick="SetDialog('add')">
        <?php
            }
        ?>
        <img src="../../img/topic.png" alt="" class="Navigation_Button" onclick="linker('topic')">
        <img src="../../img/settings.png" alt="" class="Navigation_Button" onclick="settings()">
    </div>
    <img src="../../img/hide.png"  id="HideNav_Button" onclick="Navigation()">
    <div id="Settings_Panel" style="transform: translateY(100vh) translateX(-50%);">
        <div class="RowGroup">
            <h2>User : <?php echo isset($name) ? $name : 'Unidentified';?></h2>
            <img src="../../img/information.png" alt="" class="Settings_Action" onclick="linker('profile')">
        </div>
        <div class="RowGroup">
            <h2>Log-Out</h2>
            <img src="../../img/log-out.png" alt="" class="Settings_Action" onclick="linker('logout')">
        </div>
    </div>
    <form id="Search_Panel" style="transform: translateY(100vh) translateX(-50%);" action="./<?php echo isset($page) ? $page : 'dashboard';?>.php">
        <input type="text" name="search" placeholder="search stuff..." id="searchbox" class="inputext" tabindex="1">
        <button type="submit" name="onsearch" class="searchbtn" tabindex="2">Search</button>
        <button class="searchbtn" onclick="linker('dashboard')" tabindex="3">Reset</button>
    </form>
<!-- forum -->
    <section class="forum-display">
        <div class="highligthed-forum-container">
            <h2 class="forum-title">title of the highlighted forum</h2>
            <p class="username">forum starter username</p>
            <div class="detail-wrap">
                <p class="topic">forum topic</p>
                <p class="forum-dates">31/12/9696</p>
            </div>
            <p class="forum-content">forum content which the rest of the word 
                will be faded if reach the content word limit... 
            </p>
        </div>
        <div class="forum-container">
            <h2 class="forum-title">le title</h2>
            <p class="username">da forum starter username</p>
            <div class="detail-wrap">
                <p class="topic">forum topic</p>
                <p class="forum-dates">31/12/6969</p>
            </div>
            <p class="forum-content">forum content which the rest of the word 
                will be faded if reach the content word limit... 
            </p>
        </div>
    </section>

<!-- lil bit of messages passer -->
    <div class="extraBanner"></div>
    <div id="alertcard">
        <p id="alertcontent"></p>
        <div id="borderanimate"></div>
    </div>
    <script src="../../scriptstuff/script.js"></script>
    <script src="../../scriptstuff/alert.js"></script>
    <?php
    if (!empty($errors)) {
        echo "<script> ";
        echo "alerter('"; foreach ($errors as $error) {echo $error .";";} echo "')";
        echo "</script>";
    }
    ?>
</body>
</html>