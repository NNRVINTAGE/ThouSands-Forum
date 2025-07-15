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
$page = "Topics";
$UploadEnabled = "no";
$TopicState = "Publics";

$topicIds = $_GET['topicIds'];
$stmt_check_Topic = $connects->prepare("SELECT * FROM topics WHERE TopicState = ? AND TopicIds = ? ORDER BY TopicTitles ASC;");
$stmt_check_Topic->bind_param("ss", $TopicState, $ids);
$stmt_check_Topic->execute();
$result_check_Topic = $stmt_check_Topic->get_result();
if ($result_check_Topic->num_rows == 1) {
    $value = $result_check_Topic->fetch_assoc();
    $ids = $value['TopicIds'];
    $creators = $value['TopicCreator'];
    $titles = $value['TopicTitles'];
    $descs = $value['TopicContents'];
    $attachs = $value['TopicAttachment'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titles;?></title>
</head>
<body>
<?php include_once '../component/nav.php';?>
    <div class="topic-capsule">
        <h1 class="topic-titles"><?php echo $Htitles;?></h1>
        <?php
        $getUser = $connects->query("SELECT publicIds FROM user WHERE username = '$Hcreators'");
        if($getUser){
            $take = $getUser->fetch_assoc();
        ?>
            <a href="profile.php?user=<?php echo $take['publicIds']; ?>" class="topicStarter"><?php echo $Hcreators;?> | <?php echo $Hdates; ?></a>
        <?php
        };
        ?>
        <h2 class="topic-desc"><?php echo $Hdescs;?></h2>
        <div class="topic-Forum">
        <?php
        $stmt_check_Htopic = $connects->prepare("SELECT * FROM Forums WHERE topicIds = ? ORDER BY ForumDates DESC;");
        $stmt_check_Htopic->bind_param("s", $ids);
        $stmt_check_Htopic->execute();
        $result_check_Htopic = $stmt_check_Htopic->get_result();
        if ($result_check_Htopic->num_rows > 0) {
            $uniqueItem = [];
            while ($value = $result_check_Htopic->fetch_assoc()) {
                $Cids = $value['ForumIds'];
                $Names = $value['ForumNames'];
                $Forums = $value['Forums'];
                $Cdates = $value['ForumDates'];
                if (!in_array($Cids, $uniqueItem)) {
        ?>
                <div class="Forum">
                    <a href="prof.php?dt=<?php echo $Names;?>" class=""><?php echo $Names;?></a><p><?php echo $Cdates;?></p>
                    <p><?php echo $Forums;?></p>
                </div>
        <?php
                }
            }
        }else{
        ?>
                <h2 class="0thing">no forum post yet</h2>
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