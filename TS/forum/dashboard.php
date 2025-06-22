<?php
require_once 'database.php';
$errors = array();
session_start();
if (isset($_SESSION['thouSandsIds'])) {
    $aidis = $_SESSION['thouSandsIds'];
    $name = $_SESSION['username'];
} else {
    header ('location: ../GM/forum/dashboards.php');
    exit;
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <header>
        <nav id="nav">
            <a href="forum-connect/connect_it.php?state=login" class="linkie">Log-Out</a>
        </nav>
    </header>
    <section class="forum-display">
        <div class="forum-container">
            <h2 class="forum-title">the title yo</h2>
            <p class="forum-dates">31/12/6969(nice)</p>
        </div>
    </section>
</body>
</html>