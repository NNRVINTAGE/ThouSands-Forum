<?php
require_once '../../processes/database.php';
$UploadEnabled = "nope";
$page = "category";
$State = "publics";
$errors = array();
session_start();
if (isset($_SESSION['profileTags'])) {
    $aidis = $_SESSION['profileTags'];
    $name = $_SESSION['username'];
    $UploadEnabled = "no";
} else {
    header ('location: libs.php');
    exit;
};
?>