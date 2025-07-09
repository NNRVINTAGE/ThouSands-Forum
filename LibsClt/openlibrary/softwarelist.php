<?php
require_once '../../processes/database.php';
$errors = array();
session_start();
if (isset($_SESSION['thouSandsIds'])) {
    $aidis = $_SESSION['thouSandsIds'];
    $name = $_SESSION['username'];
    $UploadEnabled = "yes";
} else {
    header ('location: libs.php');
    $UploadEnabled = "nope";
    exit;
};
if (isset($_GET['state'])) {
    if ($_GET['state'] === 'apps') {
        $states = 'scapps'
    } else if ($_GET['state'] === 'games') {
        $states = 'ltgames'
    } else {
        $state = 'ltgames'
    }
};

$page = "softwarelist";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../libsImg/oplico.ico" type="image/x-icon">
    <link rel="stylesheet" href="softwarelist.css">
    <title>the collections</title>
</head>
<body>
    
</body>
</html>