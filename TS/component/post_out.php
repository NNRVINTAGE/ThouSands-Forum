<?php
require_once '../../processes/database.php';
$errors = array();
session_start();
if (isset($_SESSION['profileTags'])) {
    $aidis = $_SESSION['profileTags'];
    if (isset($_POST['submit'])) {
        $initReq = $_POST['submit'];
        $initReq = htmlspecialchars($initReq, ENT_QUOTES, 'UTF-8');
        if ($initReq === "comment") {
            $cmids = random_bytes(100);
            $fids = $_POST['fids'];
            $cmterTags = $_POST['usrIds'];
            $commenter = $_POST['cmtUser'];
            $comment = $_POST['cmtContnt'];
            $stmt_cmtPost = $connects->prepare("INSERT INTO forumcomments (CommentIds, ForumIds, profileTags, profileNames, Comments, CommentDates, CmVs) VALUES (?, ?, ?, ?, ?, NOW(), 0)");
            $stmt_cmtPost->bind_param("sssss", $cmids, $fids, $cmterTags, $commenter, $comment);
            if($stmt_cmtPost->execute()){
                $_SESSION['corsmsg'] = 'comment got posted';
                header ('location: ../forum/forum.php?ids=' . $fids);
                exit;
            }else{
                $_SESSION['corsmsg'] = 'the comment failed to get posted';
                header ('location: ../forum/forum.php?ids=' . $fids);
                exit;
            };
            $stmt_cmtPost->close();
        } else if ($initReq === "forumint") {
            $FoIds = random_bytes(100);
            $Fcreators = $_POST['ForumsCreators'];
            $Ftitles = $_POST['ForumTitles'];
            $Ftopics = $_POST['ForumTopics'];
            $Fdescs = $_POST['ForumDescs'];
            if (isset($_POST['ForumAttachs'])) {
                $Fattach = $_POST['ForumAttachs'];
            } else {
                $Fattach = "empty.png";
            };
            $targetdir = "../ArchFiles/";
            $filenames = basename($_FILES["file"]["name"]);
            $tarfilepath = $targetdir . $filenames;
            $fileType = pathinfo($tarfilepath, PATHINFO_EXTENSION);
            $allowTypes = array('jpg', 'png', 'jpeg', 'webp', 'gif');
            if(!empty($_FILES["file"]["name"])) {
                if(in_array($fileType, $allowTypes)) {
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $tarfilepath)) {
                        $stmt_frmPost = $connects->prepare("INSERT INTO forums (ForumIds, ForumTitles, ForumCreators, ForumAttachs, ForumDates) VALUES (?, ?, ?, ?, NOW())");
                        $stmt_frmPost->bind_param("sss", $FoIds, $Ftitles, $Fcreators, );
                        if($stmt_frmPost->execute()){
                            $_SESSION['corsmsg'] = 'Forum got posted';
                            header ('location: ../forum/forum.php?ids=' . $FoIds);
                            exit;
                        } else {
                            $_SESSION['corsmsg'] = 'The Forum failed to post';
                            header ('location: ../forum/dashboard.php');
                            exit;
                        };
                        $stmt_frmPost->close();
                    } else {
                        $_SESSION['corsmsg'] = 'An error occured when uploading forum attachment';
                        header ('location: ../forum/dashboard.php');
                        exit;
                    };
                } else {
                    $_SESSION['corsmsg'] = 'only jpg, jpeg, png, webp, & gif format allowed for the forum attachment';
                    header ('location: ../forum/dashboard.php');
                    exit;
                };
            } else {
                $_SESSION['corsmsg'] = 'Missing File, please choose the file to be the forum attachment';
                header ('location: ../forum/dashboard.php');
                exit;
            };
        $stmt_frmPost->close();
        };
    } else {
        header ('location: ../forum/dashboard.php');
        exit;
    };
} else {
    header ('location: ../../index.php');
    exit;
}
?>