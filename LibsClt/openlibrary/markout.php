<?php
require_once '../../processes/database.php';
$errors = array();
session_start();
if (isset($_SESSION['profileTags'])) {
    $aidis = $_SESSION['profileTags'];
    $name = $_SESSION['username'];
    $UploadEnabled = "yes";
} else {
    header ('location: ../../libs.php');
    exit;
};
$UploadEnabled = "nope";
$SearchEnabled = "yes";
$page = "markout";
$State = "publics";
$requestedItem = "empty";
if (isset($_GET['item'])) {
    $requestedItem = $_GET['item'];
} else {
    $requestedItem = "empty";
};
$requestedItem = htmlspecialchars($requestedItem, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styling/nav.css">
    <link rel="stylesheet" href="../../styling/pallate.css">
    <link rel="stylesheet" href="../../styling/Mindex.css">
    <link rel="stylesheet" href="../../styling/footer.css">
    <title>MarkOut Software</title>
</head>
<body class="wh100p flex fld">
<!-- the nav -->
<?php include_once '../libsSys/nav.php';?>
    <section class="posf lt0 pad-s w20 h100 bg-2 flex fld gap-s marked-software-container">
        <div class="flex fld markout-software">
            <h2 class="txt-ms software-title">marked software</h2>
            <a href="view.php?idSft=" class="link-cover">.</a>
        </div>
    </section>
    <section class="leftMg pad-s w75 h50 flex recently-used-software">
        <div class="posr rightMg vertiMg pad-s icon-b bg-1 flex fld border-1 gap10 z1 generic-container">
            <img src="" alt="" class="posa ins0 wh100p bg-3 z2">
            <h2 class="topMg sideMg z3">title</h2>
            <p class="sideMg z3">short desc for it</p>
            <p class="sideMg z3">total playtime</p>
            <a href="view.php?idSft=" class="link-cover">.</a>
        </div>
    </section>
    <section class="leftMg pad-s w75 h40 flex achievement-container">
        <div class="posr rightMg vertiMg pad-s r16-9 bg-1 flex fld border-2 z1 generic-container">
            <h2 class="txt-n z2">Recent Publisher Announcement</h2>
            <p class="txt-s z2">the actual Announcement text put and cut there</p>
            <a href="../../TS/forum/viewtopic.php?topicIds=" class="link-cover">.</a>
        </div>
    </section>
    <?php include_once '../../footer.php';?>
<!-- messages passer --> 
    <div id="alertcard">
        <p id="alertcontent"></p>
        <div id="borderanimate"></div>
    </div>
    <script src="../../scriptstuff/script.js"></script>
    <script src="../libsSys/IntakeSFT.js"></script>
    <script src="../../scriptstuff/alert.js"></script>
    <?php
    if (!empty($errors)) {
        echo "<script> ";
        echo "alerter('"; foreach ($errors as $error) {echo $error .";";} echo "')";
        echo "</script>";
    };
    if (!empty($_SESSION['corsmsg'])) {
        $corsmsg = $_SESSION['corsmsg'];
        echo "<script> ";
        echo "alerter('" . $corsmsg . "')";
        echo "</script>";
        $_SESSION['corsmsg'] = "";
    };
    ?>
</body>
</html>