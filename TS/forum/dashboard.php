<?php
require_once '../../processes/database.php';
session_start();
if (isset($_SESSION['profileTags'])) {
    $aidis = $_SESSION['profileTags'];
    $name = $_SESSION['username'];
} else {
    header ('location: ../../index.php');
    exit;
}
$requestedItem = "empty";
$page = "dashboard";
$UploadEnabled = "yes";
$ForumState = "Publics";
$topicState = "Publics";
if (isset($_GET['item']) && isset($_GET['onsearch'])) {
    $searchTrigger = $_GET['onsearch'];
    $requestedItem = $_GET['item'];
} else {
    $requestedItem = "empty";
};
$requestedItem = htmlspecialchars($requestedItem, ENT_QUOTES, 'UTF-8');
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
    <link rel="stylesheet" href="../../styling/Mindex.css">
    <title>Dashboard</title>
</head>
<body class="container_again">
<!-- nav get moved since the day it become generic -->
<?php include_once '../component/nav.php';?>
<!-- forum create dialog -->
    <dialog id="add-dialog">
        <div class="dialog-nav"><h2>Add New Forum</h2><p onclick="SetDialog('add')">X</p></div>
        <form class="univ-form" action="../component/post_out.php" method="post" enctype="multipart/form-data">
            <div class="special-form-input">
                <img id="prev">
                <input style="margin: 0 auto;" type="file" name="file" accept="image/*" onchange="loadFile(event)">
            </div>
            <div class="form-input-container">
                <div class="form-input-row">
                    <label for="ForumTitles">Forum Titles</label>
                    <input type="text" name="ForumTitles" class="inptxt" placeholder="Make title for the forum" auto-complete="off" maxlength="255" required>
                </div>
                <div class="form-input-row">
                    <label for="ForumDescription">Forum Description</label>
                    <input type="text" name="ForumDescription" class="inptxt" placeholder="The description for the why or what start this forum " auto-complete="off" maxlength="255" required>
                </div>
                <div class="form-input-row">
                    <label for="ForumTopics">Topic</label>
                    <select name="ForumTopics" class="inpselect" required>
                        <option value="" selected disabled>Select Topic</option>
                        <?php
                        $stmt_get_topics = $connects->prepare("SELECT * FROM topics WHERE topicState = ?;");
                        $stmt_get_topics->bind_param("s", $topicState);
                        $stmt_get_topics->execute();
                        $result_get_topics = $stmt_get_topics->get_result();
                        if ($result_get_topics->num_rows > 0) {
                            $uniqueT = [];
                            while ($values =  $result_get_topics->fetch_assoc()) {
                                $ForumTopics = $values['topicIds'];
                                $topicTitles = $values['topicTitles'];
                                if (!in_array($ForumTopics, $uniqueT)) {
                                    echo "<option name='ForumTopics' value='$ForumTopics' required>$topicTitles</option>";
                                    $uniqueT[] = $ForumTopics;
                                };
                            };
                        };
                        ?>
                    </select>
                </div>
                <div class="form-input-row">
                    <input class="post-button" type="submit" name="submit" value="Post">
                </div>
            </div>
        </form>
    </dialog>
<!-- topic on right of the page -->
    <section class="posf lt0 pad-s w20 h100 bg-2 flex fld gap-s z2">
        <h2 class="pad-n txt-b border-b semibold">Dashboard</h2>
        <div class="pad-n-s pad-st w100p flex fld border-b">
            <h2 class="pad-sb w100p txt-n semibold">Trendings</h2>
            <?php
            $TempTopic = [];
            $stmt_check_topic = $connects->prepare("SELECT * FROM topics WHERE topicState = ?;");
            $stmt_check_topic->bind_param("s", $topicState);
            $stmt_check_topic->execute();
            $result_check_topic = $stmt_check_topic->get_result();
            if ($result_check_topic->num_rows > 0) {
                $uniqueItem = [];
                while ($value = $result_check_topic->fetch_assoc()) {
                    $ids = $value['topicIds'];
                    $titles = $value['topicTitles'];
                    if (!in_array($ids, $uniqueItem)) {
                        $TempTopicArray[$ids] = $titles;
            ?>
            <div class="posr pad-s-s pad-r pad-sb w100p flex fld">
                <h2 class="w100p txt-s ovh"><?php echo $titles;?></h2>
                <a href="viewtopic.php?topicIds=<?php echo $ids;?>" class="link-cover">.</a>
            </div>
            <?php
                    };
                };
            } else {
            ?>
            <div class="posr pad-s-s pad-r pad-sb w100p flex fld">
                <h2 class="w100p txt-s">Error retrieving</h2>
                <a href="#" class="link-cover">.</a>
            </div>
            <?php
            };
            ?>
        </div>
        <div class="pad-n-s pad-st w100p flex fld border-b">
            <h2 class="pad-sb w100p txt-n semibold points" onclick="linker('topic')">Topic</h2>
            <?php
            $stmt_check_topic = $connects->prepare("SELECT * FROM topics WHERE topicState = ?;");
            $stmt_check_topic->bind_param("s", $topicState);
            $stmt_check_topic->execute();
            $result_check_topic = $stmt_check_topic->get_result();
            if ($result_check_topic->num_rows > 0) {
                $uniqueItem = [];
                while ($value = $result_check_topic->fetch_assoc()) {
                    $ids = $value['topicIds'];
                    $titles = $value['topicTitles'];
                    if (!in_array($ids, $uniqueItem)) {
            ?>
            <div class="posr pad-s-s pad-r pad-sb w100p flex fld">
                <h2 class="w100p txt-s ovh"><?php echo $titles;?></h2>
                <a href="viewtopic.php?topicIds=<?php echo $ids;?>" class="link-cover">.</a>
            </div>
            <?php
                    };
                };
            } else {
            ?>
            <div class="posr pad-s-s pad-r pad-sb w100p flex fld">
                <h2 class="w100p txt-s">Error retrieving</h2>
                <a href="#" class="link-cover">.</a>
            </div>
            <?php
            };
            ?>
        </div>
    </section>
    <!-- forum there -->
    <?php
    if ($requestedItem === "empty") {
    ?>
    <section class="Hforum-display">
        <?php
        $stmt_check_HForum = $connects->prepare("SELECT * FROM forums WHERE ForumState = ? AND ForumHighlight = 'YES' ORDER BY ForumDates ASC;");
        $stmt_check_HForum->bind_param("s", $ForumState);
        $stmt_check_HForum->execute();
        $result_check_HForum = $stmt_check_HForum->get_result();
        if ($result_check_HForum->num_rows > 0) {
            $uniqueItem = [];
            while ($value = $result_check_HForum->fetch_assoc()) {
                $Hids = $value['ForumIds'];
                $Htitles = $value['ForumTitles'];
                $Htopics = $value['ForumTopics'];
                $Hdates = $value['ForumDates'];
                $Hcontents = $value['ForumContents'];
                if (!in_array($Hids, $uniqueItem)) {
                    $Htopic = $TempTopicArray[$Htopics] ?? null;
        ?>
        <div class="highligthed-forum-container">
            <h2 class="forum-title"><?php echo $Htitles;?></h2>
            <div class="detail-wrap">
                <p class="topic"><?php echo $Htopic;?></p>
                <p class="dates"><?php echo $Hdates;?></p>
            </div>
            <p class="forum-content"><?php echo $Hcontents;?></p>
            <a href="forum.php?ids=<?php echo $Hids;?>" class="forum-link">.</a>
        </div>
        <?php
                };
            };
        };
        ?>
    </section>
    <?php
    };
    ?>
    <section class="forum-display">
        <?php
        if (isset($requestedItem) && isset($searchTrigger)) {
        $stmt_check_Forum = $connects->prepare("SELECT * FROM forums WHERE ForumState = ? AND ForumTitles LIKE '%$requestedItem%' ORDER BY ForumTitles DESC;");
        $stmt_check_Forum->bind_param("s", $ForumState);
        } else {
        $stmt_check_Forum = $connects->prepare("SELECT * FROM forums WHERE ForumState = ? AND ForumHighlight = 'NOs';");
        $stmt_check_Forum->bind_param("s", $ForumState);
        };
        $stmt_check_Forum->execute();
        $result_check_Forum = $stmt_check_Forum->get_result();
        if ($result_check_Forum->num_rows > 0) {
            $uniqueItem = [];
            while ($value = $result_check_Forum->fetch_assoc()) {
                $ids = $value['ForumIds'];
                $creators = $value['ForumCreator'];
                $titles = $value['ForumTitles'];
                $topics = $value['ForumTopics'];
                $dates = $value['ForumDates'];
                $contents = $value['ForumContents'];
                if (!in_array($ids, $uniqueItem)) {
                    $topic = $TempTopicArray[$topics] ?? null;
        ?>
        <div class="forum-container">
            <h2 class="forum-title"><?php echo $titles;?></h2>
            <p class="forum-username"<?php echo $creators;?>></p>
            <div class="detail-wrap">
                <p class="topic"><?php echo $topic;?></p>
                <p class="dates"><?php echo $dates;?></p>
            </div>
            <p class="forum-content"><?php echo $contents;?>
            </p>
            <a href="forum.php?ids=<?php echo $ids;?>" class="forum-link">.</a>
        </div>
        <?php
                }
            }
        } else {
        ?>
            <p class="unknown">No forum got found, something wrong in there</p>
        <?php
        };
        ?>
    </section>
<!-- lil bit of messages passer --> 
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