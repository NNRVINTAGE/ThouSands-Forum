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

$page = "dashboard";
$UploadEnabled = "yes";
$ForumState = "Publics";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styling/forum_univ.css">
    <link rel="stylesheet" href="../../styling/connect_univ.css">
    <link rel="stylesheet" href="../../styling/connect_forms.css">
    <title>Dashboard</title>
</head>
<body class="container_again">
<!-- nav get moved for modularity -->
<?php include_once '../component/nav.php';?>
<!-- topic aon right of the page -->
    <section class="mitol-container">
        <?php
        $topicState = "publics";
        $stmt_check_topic = $connects->prepare("SELECT * FROM topics WHERE topicState = ?");
        $stmt_check_topic->bind_param("s", $topicState);
        $stmt_check_topic->execute();    
        $result_check_topic = $stmt_check_topic->get_result();

        if ($result_check_topic->num_rows > 0) {
            $uniques = [];
            while ($value = $result_check_topic->fetch_assoc()) {
                $ids = $value['topicIds'];
                $titles = $value['topicTitles'];
                if (!in_array($ids, $uniques)) {
        ?>
        <div class="mini-topic-list">
            <a href="viewtopic.php?idtopic=<?php echo $titles;?>" class="mitol-title"><?php echo $titles;?></a>
        </div>
        <?php
                }
            }
        } else {
        ?>
            <p class="unknown">No topic found, somethings wrong in here</p>
        <?php
        }
        ?>
    </section>
<!-- forum -->
    <section class="Hforum-display">
        <?php
        $stmt_check_HForum = $connects->prepare("SELECT * FROM forums WHERE ForumState = ? AND ForumHighlight = 'YES' ORDER BY ForumDates ASC");
        $stmt_check_HForum->bind_param("s", $ForumState);
        $stmt_check_HForum->execute();
        $result_check_HForum = $stmt_check_HForum->get_result();
        if ($result_check_HForum->num_rows > 0) {
            $uniques = [];
            while ($value = $result_check_HForum->fetch_assoc()) {
                $Hids = $value['ForumIds'];
                $Hcreators = $value['ForumCreator'];
                $Htitles = $value['ForumTitles'];
                $Htopics = $value['Forumtopics'];
                $Hdates = $value['ForumDates'];
                $Hcontents = $value['ForumContents'];
                if (!in_array($Hids, $uniques)) {
        ?>
        <div class="highligthed-forum-container">
            <h2 class="forum-title"><?php echo $Htitles;?></h2>
            <p class="forum-username"><?php echo $Hcreators;?></p>
            <div class="detail-wrap">
                <p class="topic"><?php echo $Htopics;?></p>
                <p class="dates"><?php echo $Hdates;?></p>
            </div>
            <p class="forum-content"><?php echo $Hcontents;?>
            </p>
            <a href="forum.php?ids=<?php echo $Hids;?>" class="forum-link">Open Forum</a>
        </div>
        <?php
                }
            }
        };
        ?>
    </section>
    <section class="forum-display">
        <?php
        $stmt_check_Forum = $connects->prepare("SELECT * FROM forums WHERE ForumState = ? AND ForumHighlight = 'NOs'");
        $stmt_check_Forum->bind_param("s", $ForumState);
        $stmt_check_Forum->execute();
        $result_check_Forum = $stmt_check_Forum->get_result();
        if ($result_check_Forum->num_rows > 0) {
            $uniques = [];
            while ($value = $result_check_Forum->fetch_assoc()) {
                $ids = $value['ForumIds'];
                $creators = $value['ForumCreator'];
                $titles = $value['ForumTitles'];
                $topics = $value['Forumtopics'];
                $dates = $value['ForumDates'];
                $contents = $value['ForumContents'];
                if (!in_array($ids, $uniques)) {
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
            <a href="forum.php?ids=<?php echo $ids;?>" class="forum-link">Open Forum</a>
        </div>
        <?php
                }
            }
        } else {
        ?>
            <p class="unknown">No topic found, somethings wrong in there</p>
        <?php
        }
        ?>
    </section>
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