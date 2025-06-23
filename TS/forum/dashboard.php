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
<body>
<!-- nav get moved for modularity -->
<?php include_once '../component/nav.php';?>
<!-- forum -->
    <section class="forum-display">
        <?php
        $HForumState = "publics";
        $stmt_check_HForum = $connects->prepare("SELECT * FROM forums WHERE ForumState = ? AND ForumHighlight = 'YES'");
        $stmt_check_HForum->bind_param("s", $HForumState);
        $stmt_check_HForum->execute();    
        $result_check_HForum = $stmt_check_HForum->get_result();

        if ($result_check_HForum->num_rows > 0) {
            $Hvalue = $result_check_HForum->fetch_assoc();
            $Hids = $value['ForumIds'];
            $Hcreators = $value['ForumCreator'];
            $Htitles = $value['ForumTitles'];
            $Htopics = $value['Forumtopics'];
            $Hdates = $value['ForumDates'];
            $Hcontents = $value['ForumContents'];
        ?>
        <div class="highligthed-forum-container">
            <h2 class="forum-title"><?php echo $Htitles;?>title of the highlighted forums</h2>
            <div class="detail-wrap">
                <p class="topic"><?php echo $Htopics;?>forum topic</p>
                <p class="forum-dates"><?php echo $Hdates;?>22/6/2025</p>
            </div>
            <p class="username"><?php echo $Hcreators;?>usually me or forum admins</p>
            <p class="forum-content"><?php echo $Hcontents;?>
                highlighted forum content which ussually only for the
                project ThouSands or some trending forum, nah later i'll explain.
            </p>
        </div>
        <?php
        } 
        $ForumState = "publics";
        $stmt_check_Forum = $connects->prepare("SELECT * FROM forums WHERE ForumState = ?");
        $stmt_check_Forum->bind_param("s", $ForumState);
        $stmt_check_Forum->execute();    
        $result_check_Forum = $stmt_check_Forum->get_result();

        if ($result_check_Forum->num_rows > 0) {
            $value = $result_check_Forum->fetch_assoc();
            $ids = $value['ForumIds'];
            $creators = $value['ForumCreator'];
            $titles = $value['ForumTitles'];
            $topics = $value['Forumtopics'];
            $dates = $value['ForumDates'];
            $contents = $value['ForumContents'];
        ?>
        <div class="forum-container">
            <h2 class="forum-title">le titles</h2>
            <p class="username">forum starter username</p>
            <div class="detail-wrap">
                <p class="topic">forum topic</p>
                <p class="forum-dates">23/6/2025</p>
            </div>
            <p class="forum-content">forum content which the rest of the word 
                will be faded if reach the content word limit
            </p>
        </div>
        <?php
        } else {
        ?>
            <p class="unknown">No topic found, somethings wrong in here</p>
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