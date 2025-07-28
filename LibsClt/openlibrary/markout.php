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
    <link rel="stylesheet" href="../../pallate.css">
    <link rel="stylesheet" href="../../nav.css">
    <title>MarkOut Software</title>
</head>
<body>
<!-- the nav -->
<?php include_once '../libsSys/nav.php';?>
    <section class="marked-software-container">
        <div class="markout-software">
            <h2 class="software-title"></h2>
            <p class="software-desc"></p>
        </div>
    </section>
    <section class="recently-used-software">
        <div class="generic-container">
            <h2 class="software-title"></h2>
            <p class="software-desc"></p>
        </div>
    </section>
    <section class="achievement-container">
        <div class="generic-container">
            <h2 class="titles"></h2>
            <p class="acheived-dataes"></p>
        </div>
    </section>
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