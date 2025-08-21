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
<body class="h100 bg-2 flex fld gap10">
    <section class="posf lt0 pad-s w20 h100 bg-4 flex fld">
        <h2 class="txt-n">Manage Software</h2>
    </section>
    <section class="leftMg pad-n w75p h25 flex fld gap-s">
        <div class="rightMg pad-s w33p h100p bg-5 flex fld acjc bora-n">
            <h2 class="txt-b">Add Software/Game</h2>
        </div>
    </section>
    <section class="leftMg w75p flex gap-s">
        <div class="rightMg w30p flex fld">
            <img src="" alt="" class="w100p r16-9">
            <h2 class="txt-n">Published Software</h2>
            <div class="sideMg w100p flex">
                <h2 class="autoMg txt-s">View</h2>
                <h2 class="autoMg txt-s">Edit</h2>
                <h2 class="autoMg txt-s">Archive</h2>
            </div>
        </div>
    </section>
</body>
</html>