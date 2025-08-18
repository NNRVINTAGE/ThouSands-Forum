<?php
require_once '../../processes/database.php';
$errors = array();
session_start();
if (isset($_SESSION['profileTags']) && isset($_SESSION['TmpKeys'])) {
    $aidis = $_SESSION['profileTags'];
    $TmpKeys = $_SESSION['TmpKeys'];
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
<body class="w100p flex fld gap10">
    <section class="posf lt0 pad-s w20 flex fld"></section>
    <section class="leftMg w75p flex gap-s">
        <div class="flex"></div>
    </section>
    <section class="w75p flex fld gap-s">
        <div class="w100p flex ovs"></div>
        <div class="w100p flex"></div>
    </section>
</body>
</html>