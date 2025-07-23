<?php
require_once '../../processes/database.php';
if (isset($_GET['requestInit'])) {
    $initReq = $_GET['requestInit'];
    $initReq = htmlspecialchars($initReq, ENT_QUOTES, 'UTF-8');
    if ($initReq === "comment") {
        $cmids = random_bytes(100);
        $fids = $_POST['fids'];
        $commenter = $_POST['cmtUser'];
        $comment = $_POST['cmtContnt'];
        $stmt_cmtPost = $connect->prepare("INSERT INTO forumcomments (CommentIds, ForumIds, CommentNames, Comments, CommentDates, CmVs) VALUES (?, ?, ?, NOW(), 0)");
        $stmt_cmtPost->bind_param("ssss", $cmids, $fids, $commenter, $comment);
        if($stmt_cmtPost->execute()){
            $_SESSION['corsmsg'] = 'Yo comment get posted';
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
        $Fattach = $_POST['ForumAttachs'];
        $targetdir = "../ArchFiles/";
        $filenames = basename($_FILES["file"]["name"]);
        $tarfilepath = $targetdir . $filenames;
        $fileType = pathinfo($tarfilepath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg', 'webp', 'gif');
        if(!empty($_FILES["file"]["name"])) {
            if(in_array($fileType, $allowTypes)) {
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $tarfilepath)) {
                    $stmt_frmPost = $connect->prepare("INSERT INTO forums (ForumIds, ForumTitles, ForumCreators, ForumAttachs, ForumDates) VALUES (?, ?, ?, ?, NOW())");
                    $stmt_frmPost->bind_param("sss", $FoIds, $Ftitles, $Fcreators, );
                    if($stmt_frmPost->execute()){
                        $_SESSION['corsmsg'] = 'Forum got posted';
                        header ('location: ../forum/dashboard.php');
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
?>