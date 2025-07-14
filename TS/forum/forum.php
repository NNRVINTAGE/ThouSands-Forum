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
$page = "forums";
$UploadEnabled = "no";
$ForumState = "Publics";

$ids = $_GET['ids'];
$stmt_check_HForum = $connects->prepare("SELECT * FROM forums WHERE ForumState = ? AND ForumIds = ? ORDER BY ForumDates ASC;");
$stmt_check_HForum->bind_param("ss", $ForumState, $ids);
$stmt_check_HForum->execute();
$result_check_HForum = $stmt_check_HForum->get_result();
if ($result_check_HForum->num_rows == 1) {
    $value = $result_check_HForum->fetch_assoc();
    $Hids = $value['ForumIds'];
    $Hcreators = $value['ForumCreator'];
    $Htitles = $value['ForumTitles'];
    $Htopics = $value['Forumtopics'];
    $Hdates = $value['ForumDates'];
    $Hdescs = $value['ForumContents'];
    $Hattachs = $value['ForumAttachment'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styling/forum_univ.css">
    <link rel="stylesheet" href="../../styling/connect_univ.css">
    <link rel="stylesheet" href="../../styling/connect_forms.css">
    <style>
        * {
            color: black;
        }
    </style>
    <title>Forums</title>
</head>
<body>
<?php include_once '../component/nav.php';?>
    <div class="forum-capsule">
        <h1 class="forum-titles"><?php echo $Htitles;?></h1>
        <?php
        $getUser = $connects->query("SELECT publicIds FROM user WHERE username = '$Hcreators'");
        if($getUser){
            $take = $getUser->fetch_assoc();
        ?>
            <a href="profile.php?user=<?php echo $take['publicIds']; ?>" class="forumStarter"><?php echo $Hcreators;?> | <?php echo $Hdates; ?></a>
        <?php
        };
        ?>
        <h2 class="comment-desc"><?php echo $Hdescs;?></h2>
        <div class="forum-comment">
        <?php
        $stmt_check_HForum = $connects->prepare("SELECT * FROM forumcomments WHERE ForumIds = ? ORDER BY CommentDates DESC;");
        $stmt_check_HForum->bind_param("s", $ids);
        $stmt_check_HForum->execute();
        $result_check_HForum = $stmt_check_HForum->get_result();
        if ($result_check_HForum->num_rows > 0) {
            $uniques = [];
            while ($value = $result_check_HForum->fetch_assoc()) {
                $Cids = $value['CommentIds'];
                $Names = $value['CommentNames'];
                $Comments = $value['Comments'];
                $Cdates = $value['CommentDates'];
                if (!in_array($Cids, $uniques)) {
        ?>
                <div class="PostedComment">
                    <h2><?php echo $Names;?> | <?php echo $Cdates;?></h2>
                    <p><?php echo $Comments;?></p>
                </div>
        <?php
                }
            }
        }else{
        ?>
                <h2 class="0thing">no data got fetched</h2>
        <?php
        }
        ?>
        </div>
    </div>
</div>
<!-- input for comment -->
<!-- <form class="Comment-Form" action="../component/comment.php?FotoID=<?php echo $Hids;?>" method="post">
    <input type="text" name="IsiKomentar" class="CommentInp" placeholder="Leave a Comment..." auto-complete="off" maxlength="255" required>
    <input class="SendBtn" type="submit" name="submit" value="">
</form> -->
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