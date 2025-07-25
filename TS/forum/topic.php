<?php
require_once '../../processes/database.php';
$errors = array();
session_start();
if (isset($_SESSION['profileTags'])) {
    $aidis = $_SESSION['profileTags'];
    $name = $_SESSION['username'];
} else {
    header ('location: ../../index.php');
    exit;
};
$page = 'topic';
$UploadEnabled = 'no';
$SearchEnabled = "no";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styling/pallate.css">
    <link rel="stylesheet" href="../../styling/nav.css">
    <link rel="stylesheet" href="../../styling/forum_univ.css">
    <link rel="stylesheet" href="../../styling/connect_univ.css">
    <link rel="stylesheet" href="../../styling/connect_forms.css">
    <title>Topics</title>
</head>
<body>
    <!-- modular navbar -->
    <?php include_once '../component/nav.php';?>
    <!-- the list goes on -->
    <section class="topic-lister">
        <?php
        $topicState = "Publics";
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
                $attachs = $value['topicAttachs'];
                if (!in_array($ids, $uniqueItem)) {
        ?>
        <div class="topic-container">
                    <?php
                    if ($attachs != "empty.png" && isset($attachs)) {
                    ?>
            <img src="../libsImg/<?php echo $attachs;?>" alt="<?php echo $attachs;?>" class="topic-banner">
                    <?php
                    };
                    ?>
            <h2 class="topic-title"><?php echo $titles;?></h2>
            <div class="detail-wrap">
                <p class="topic-id"><?php echo $ids;?></p>
                <p class="dates"><?php echo $dates;?></p>
            </div>
            <p class="topic-desc"><?php echo $contents;?></p>
            <a href="viewtopic.php?topicIds=<?php echo $ids;?>" class="topic-link">.</a>
        </div>
        <?php
                };
            };
        } else {
        ?>
            <h2 class="zthing">topic fetching failed</h2>
        <?php
        };
        ?>
    </section>
<!-- another messages passer --> 
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