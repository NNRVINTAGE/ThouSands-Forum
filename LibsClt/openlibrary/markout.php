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
<body class="w100p flex">
<!-- the nav -->
<?php include_once '../libsSys/nav.php';?>
    <section class="posf lt0 pad-s h100 flex fld gap-s marked-software-container">
        <div class="flex fld markout-software">
            <h2 class="txt-n software-title">test</h2>
            <p class="txt-n software-desc">test</p>
        </div>
    </section>
    <section class="pad-s w88 h60 flex recently-used-software">
        <div class="autoMg h100p bg-1 flex fld  gap-s generic-container">
            <img src="" alt="" class="icon-b">
            <h2 class="sideMg software-title">test</h2>
            <p class="sideMg bottomMg software-desc">test</p>
        </div>
    </section>
    <section class="w88 flex achievement-container">
        <div class="autoMg h100p bg-1 flex generic-container">
            <h2 class="titles"></h2>
            <p class="acheived-dataes"></p>
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