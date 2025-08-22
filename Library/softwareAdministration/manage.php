<?php
require_once '../../processes/database.php';
$errors = array();
session_start();
if (isset($_SESSION['profileTags'])) {
    $aidis = $_SESSION['profileTags'];
    // $TmpKeys = $_SESSION['TmpKeys'];
    $name = $_SESSION['username'];
} else {
    header ('location: ../../libs.php');
    exit;
};
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
    <title>Management Dashboard</title>
</head>
<body class="h100 flex fld gap10 z1">
    <section class="posf lt0 pad-s w20 h100 bg-semiwhite flex fld z2">
        <h2 class="pad-s txt-b">Management Tab</h2>
        <div class="pad-s w100p flex fld">
            <h2 class="w100p txt-n">your software</h2>
            <a href="#" class="pad-s txt-s">Published</a>
            <a href="#" class="pad-s txt-s">Statistic</a>
            <a href="#" class="pad-s txt-s">Feedbacks</a>
        </div>
    </section>
    <section class="leftMg pad-nt pad-nb w75p h20 flex fld gap-s z2">
        <div class="rightMg pad-s w33p h100p bg-5 flex fld acjc bora-n">
            <h2 class="">Add Collection</h2>
        </div>
    </section>
    <section class="leftMg w75p flex gap-s z2">
        <div class="rightMg w30p flex fld bg-5 bora-s gap-s">
            <img src="" alt="" class="w100p r16-9">
            <h2 class="pad-s txt-n">Published Software</h2>
            <div class="sideMg w100p flex">
                <a href="#" class="autoMg pad-s w40p txt-s txtc bg-blue points z4">View</a>
                <a href="#" class="autoMg pad-s w40p txt-s txtc bg-red points z4">Edit</a>
                <a href="#" class="autoMg pad-s w40p txt-s txtc bg-green points z4">Archive</a>
            </div>
        </div>
    </section>
    <script src="../libsSys/mng7.js"></script>
</body>
</html>