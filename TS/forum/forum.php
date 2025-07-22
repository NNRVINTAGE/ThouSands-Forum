<?php
require_once '../../processes/database.php';
$errors = array();
session_start();
if (isset($_SESSION['profileTags'])) {
    $aidis = $_SESSION['profileTags'];
    $name = $_SESSION['username'];
    if (!isset($_GET['ids'])) {
        header ('location: dashboard.php');
        exit;
    }
} else {
    header ('location: ../../index.php');
    exit;
}
$page = "forums";
$UploadEnabled = "no";
$ForumState = "Publics";

$ids = $_GET['ids'];
$ids = htmlspecialchars($ids, ENT_QUOTES, 'UTF-8');
$stmt_check_forums = $connects->prepare("SELECT * FROM forums WHERE ForumState = ? AND ForumIds = ? ORDER BY ForumDates ASC;");
$stmt_check_forums->bind_param("ss", $ForumState, $ids);
$stmt_check_forums->execute();
$result_check_forums = $stmt_check_forums->get_result();
if ($result_check_forums->num_rows == 1) {
    $value = $result_check_forums->fetch_assoc();
    $creators = $value['ForumCreator'];
    $titles = $value['ForumTitles'];
    $topics = $value['ForumTopics'];
    $dates = $value['ForumDates'];
    $descs = $value['ForumContents'];
    $attachs = $value['ForumAttachment'];
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
    <link rel="stylesheet" href="../../styling/forum_internal.css">
    <title><?php echo $titles;?></title>
</head>
<body>
<?php include_once '../component/nav.php';?>
    <div class="forum-capsule">
        <h1 class="forum-titles"><?php echo $titles;?></h1>
        <?php
        $getUser = $connects->prepare("SELECT profileTags FROM user WHERE username = ?");
        $getUser->bind_param("s", $creators);
        $getUser->execute();
        $resultGetUser = $getUser->get_result();
        if($resultGetUser->num_rows == 1){
            $take = $resultGetUser->fetch_assoc();
        ?>
            <a href="profile.php?user=<?php echo $take['profileTags']; ?>" class="forum-starter"><?php echo $creators;?> | <?php echo $dates; ?></a>
        <?php
        };
        ?>
        <h2 class="forum-desc"><?php echo $descs;?></h2>
        <?php
        if ($attachs != "empty" && isset($attachs)) {    
        ?>
        <img src="../libsImg/<?php echo $attachs;?>" alt="<?php echo $titles;?>" class="forum-banner">
        <?php
        };
        ?>
        <div class="forum-comment">
        <?php
        $stmt_check_comments = $connects->prepare("SELECT * FROM forumcomments WHERE ForumIds = ? ORDER BY CommentDates DESC;");
        $stmt_check_comments->bind_param("s", $ids);
        $stmt_check_comments->execute();
        $result_check_comments = $stmt_check_comments->get_result();
        if ($result_check_comments->num_rows > 0) {
            $uniqueItem = [];
            while ($value = $result_check_comments->fetch_assoc()) {
                $Cids = $value['CommentIds'];
                $Names = $value['CommentNames'];
                $Comments = $value['Comments'];
                $Cdates = $value['CommentDates'];
                if (!in_array($Cids, $uniqueItem)) {
        ?>
            <div class="posted-comment">
                <div class="comment-detail">
                    <a href="profile.php?user=<?php echo $Names;?>"><?php echo $Names;?></a>
                    <span>|</span>
                    <p><?php echo $Cdates;?></p>
                </div>
                <p class="comment-content"><?php echo $Comments;?></p>
            </div>
        <?php
                }
            }
        }else{
        ?>
                <h2 class="zthing">be the first one to reply this</h2>
        <?php
        }
        ?>
        </div>
        <form action="../component/post_out.php" method="post" class="comment-post-bar">
            <input type="text" name="comment" class="comment-input" placeholder="Leave a Comment..." auto-complete="off" maxlength="255" required>
            <input class="send-button" type="submit" name="submit" value="">
        </form>
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