<?php
require_once '../../processes/database.php';
$errors = array();
session_start();
if (isset($_SESSION['thouSandsIds'])) {
    $aidis = $_SESSION['thouSandsIds'];
    $name = $_SESSION['username'];
} else {
    header ('location: ../../index.php');
    exit;
};
$UploadEnabled = 'no';
$page = 'topic';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styling/forum_univ.css">
    <link rel="stylesheet" href="../../styling/connect_univ.css">
    <link rel="stylesheet" href="../../styling/connect_forms.css">
    <title>Topics</title>
</head>
<body>
    <!-- modular dnavbar -->
    <?php include_once '../component/nav.php';?>
    <section class="topic-lister">
        <?php
        $topicState = "publics";
        $stmt_check_topic = $connects->prepare("SELECT * FROM topics WHERE topicState = ?;");
        $stmt_check_topic->bind_param("s", $topicState);
        $stmt_check_topic->execute();    
        $result_check_topic = $stmt_check_topic->get_result();

        if ($result_check_topic->num_rows > 0) {
            $uniqueItem = [];
            while ($value = $result_check_topic->fetch_assoc()) {
                $ids = $value['topicIds'];
                $titles = $value['topicTitles'];
                $dates = $value['topicDates'];
                $contents = $value['topicContents'];
                if (!in_array($ids, $uniqueItem)) {
        ?>
        <div class="topic-container">
            <h2 class="topic-title"><?php echo $titles;?></h2>
            <div class="detail-wrap">
                <p class="topic-id"><?php echo $ids;?></p>
                <p class="dates"><?php echo $dates;?></p>
            </div>
            <p class="topic-desc"><?php echo $contents;?></p>
        </div>
        <?php
                }
            }
        } else {
        ?>
            <h2 class="zthing">No data</h2>
        <?php
        }
        ?>
    </section>
    
<!-- another lil bit of messages passer -->
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
    if (!empty($_SESSION['corsmsg'])) {
        $corsmsg = $_SESSION['corsmsg'];
        echo "<script> ";
        echo "alerter('" . $corsmsg . "')";
        echo "</script>";
        $_SESSION['corsmsg'] = "";
    }
    ?>
</body>
</html>