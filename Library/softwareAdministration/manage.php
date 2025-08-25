<?php
require_once '../../processes/database.php';
$errors = array();
session_start();
if (isset($_SESSION['profileTags'])) {
    $aidis = $_SESSION['profileTags'];
    // $TmpKeys = $_SESSION['TmpKeys'];
    $name = $_SESSION['username'];
} else {
    header ('location: ../../libs.php');
    exit;
};
$State = "publics";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styling/nav.css">
    <link rel="stylesheet" href="../../styling/pallate.css">
    <link rel="stylesheet" href="../../styling/Mindex.css">
    <link rel="stylesheet" href="../../styling/footer.css">
    <title>Management Dashboard</title>
</head>
<body class="h100 flex fld gap10 z1">
    <section class="posf lt0 w20 h100 bg-semiwhite flex fld z2">
        <h2 class="pad-n txt-b border-b">Management Tab</h2>
        <div class="pad-n-s pad-st w100p flex fld border-b">
            <h2 class="pad-sb w100p txt-n">product</h2>
            <a href="#" class="pad-s-s pad-r pad-sb txt-s">Published</a>
            <a href="#" class="pad-s-s pad-r pad-sb txt-s">Annoucement</a>
        </div>
        <div class="pad-n-s pad-st w100p flex fld border-b">
            <h2 class="pad-sb w100p txt-n">record</h2>
            <a href="#" class="pad-s-s pad-r pad-sb txt-s">Statistic</a>
            <a href="#" class="pad-s-s pad-r pad-sb txt-s">Feedbacks</a>
        </div>
        <div class="pad-n-s pad-st w100p flex fld border-b">
            <h2 class="pad-sb w100p txt-n">utility</h2>
            <a href="#" class="pad-s-s pad-r pad-sb txt-s">Achievement</a>
            <a href="#" class="pad-s-s pad-r pad-sb txt-s">CG Connect</a>
        </div>
    </section>
    <section class="leftMg w79p flex gap-s z2">
    <?php
    // 
    $stmt_check_software = $connects->prepare("SELECT * FROM libslist WHERE libsPublisher = ? AND libsState = ?;");
    $stmt_check_software->bind_param("ss", $aidis, $State);
    $stmt_check_software->execute();
    $result_check_software = $stmt_check_software->get_result();
    if ($result_check_software->num_rows > 0) {
        $uniqueItem = [];
        while ($value = $result_check_software->fetch_assoc()) {
            $ids = $value['libsIds'];
            $attachs = $value['libsAttachs'];
            $titles = $value['libsTitles'];
            if (!in_array($ids, $uniqueItem)) {
    ?>
        <div class="rightMg w30p flex fld bg-5 bora-s gap-s">
            <img src="../libsImg/<?php echo $attachs;?>" alt="<?php echo $attachs;?>" class="w100p r16-9">
            <h2 class="pad-s txt-n"><?php echo $titles;?></h2>
            <div class="sideMg w100p flex">
                <a href="#" class="autoMg pad-s w40p txt-s txtc bg-blue points z4">View</a>
                <a href="#" class="autoMg pad-s w40p txt-s txtc bg-red points z4">Edit</a>
                <a href="#" class="autoMg pad-s w40p txt-s txtc bg-green points z4">Archive</a>
            </div>
        </div>
    <?php
            };
        };
    } else {
    ?>
        <p class="w100p txtn txt-n">Publish software & games now!</p>
    <?php
    };
    ?>
    </section>
    <script src="../libsSys/mng7.js"></script>
</body>
</html>