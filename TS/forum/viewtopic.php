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
}
$page = "topic";
$UploadEnabled = "no";
$State = "Publics";

$topicIds = $_GET['topicIds'];
$topicIds = htmlspecialchars($topicIds, ENT_QUOTES, 'UTF-8');
$stmt_check_Topic = $connects->prepare("SELECT * FROM topics WHERE TopicState = ? AND TopicIds = ? ORDER BY TopicTitles ASC;");
$stmt_check_Topic->bind_param("ss", $State, $topicIds);
$stmt_check_Topic->execute();
$result_check_Topic = $stmt_check_Topic->get_result();
if ($result_check_Topic->num_rows == 1) {
    $value = $result_check_Topic->fetch_assoc();
    $ids = $value['topicIds'];
    $Ttitles = $value['topicTitles'];
    $dates = $value['topicDates'];
    $descs = $value['topicContents'];
    $attachs = $value['topicAttachs'];
}
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
    <link rel="stylesheet" href="../../styling/topic_internal.css">
    <style>
        * {
            color: black;
        }
    </style>
    <title><?php echo $Ttitles;?></title>
</head>
<body>
<!-- da navbar -->
<?php include_once '../component/nav.php';?>
<!-- topic container -->
    <div class="topic-capsule">
        <h1 class="topic-titles"><?php echo $Ttitles;?></h1>
        <p class="topic-dates">last updated: <?php echo $dates;?></p>
        <?php
        if($attachs != "empty" && isset($attachs)){
        ?>
        <img src="../libsImg/<?php echo $attachs;?>" alt="<?php echo $attachs;?>" class="topic-img">
        <?php
        }
        ?>
        <h2 class="topic-desc"><?php echo $descs;?></h2>
        <div class="forum-display">
        <?php
        $stmt_check_forumtopics = $connects->prepare("SELECT * FROM forums WHERE ForumTopics = ? ORDER BY ForumDates DESC;");
        $stmt_check_forumtopics->bind_param("s", $Ttitles);
        $stmt_check_forumtopics->execute();
        $result_check_forumtopics = $stmt_check_forumtopics->get_result();
        if ($result_check_forumtopics->num_rows > 0) {
            $uniqueItem = [];
            while ($value = $result_check_forumtopics->fetch_assoc()) {
                $ids = $value['ForumIds'];
                $creators = $value['ForumCreator'];
                $titles = $value['ForumTitles'];
                $topics = $value['ForumTopics'];
                $dates = $value['ForumDates'];
                $contents = $value['ForumContents'];
                if (!in_array($ids, $uniqueItem)) {
        ?>
            <div class="forum-container">
                <h2 class="forum-title"><?php echo $titles;?></h2>
                <p class="forum-username"<?php echo $creators;?>></p>
                <div class="detail-wrap">
                    <p class="topic"><?php echo $topics;?></p>
                    <p class="dates"><?php echo $dates;?></p>
                </div>
                <p class="forum-content"><?php echo $contents;?>
                </p>
                <a href="forum.php?ids=<?php echo $ids;?>" class="forum-link">.</a>
            </div>
        <?php
                }
            }
        }else{
        ?>
                <h2 class="zthing">no forum for this topic yet</h2>
        <?php
        }
        ?>
        </div>
    </div>
</div>
<!-- lil bit of messages passer -->
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