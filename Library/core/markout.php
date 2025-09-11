<?php
require_once '../../processes/database.php';
$errors = array();
session_start();
if (isset($_SESSION['profileTags'])) {
    $aidis = $_SESSION['profileTags'];
    $name = $_SESSION['username'];
    $UploadEnabled = "yes";
} else {
    header ('location: ../../libs.php');
    exit;
};
$UploadEnabled = "nope";
$SearchEnabled = "yes";
$page = "markout";
$State = "publics";
$requestedItem = "empty";
if (isset($_GET['item'])) {
    $requestedItem = $_GET['item'];
} else {
    $requestedItem = "empty";
};
$requestedItem = htmlspecialchars($requestedItem, ENT_QUOTES, 'UTF-8');
$tempLibsArr = array();
$stmt_check_software = $connects->prepare("SELECT * FROM libslist WHERE libsState = ? LIMIT 10;");
$stmt_check_software->bind_param("s", $State);
$stmt_check_software->execute();
$result_check_software = $stmt_check_software->get_result();
if ($result_check_software->num_rows > 0) {
    $uniqueItem = [];
    while ($value = $result_check_software->fetch_assoc()) {
        $ids = $value['libsIds'];
        $attachs = $value['libsAttachs'];
        $titles = $value['libsTitles'];
        $Desc = $value['libsDesc'];
        $addedDates = $value['addedDates'];
        $cltNumbs = $value['cltNumbs'];
        $category = $value['libsCategorys'];
        $fdrLibs = $value['fdrLibs'];
        if (!in_array($ids, $uniqueItem)) {
            $tempLibsArr[$ids] = [
            "libsIds"        => "$ids",
            "libsAttachs"    => "$attachs",
            "libsTitles"     => "$titles",
            "libsDesc"       => "$Desc",
            "libsCategorys"  => "$category",
            "addedDates"     => "$addedDates",
            "cltNumbs"       =>  $cltNumbs,
            "fdrLibs"        => "$fdrLibs"
            ];
        };
    };
};
$retrieve = "../../drx/$aidis.json";
$jsonData = file_get_contents($retrieve);
$data = json_decode($jsonData, true);
$profileTag = $data['profileTags'];
$markedData = $data['marked'];
$marked = [];
foreach ($markedData as $markedIndex => $info) {
    $marked[$markedIndex] = [
        "libsIds"  => $info['libsIds'],
        "Hours"    => (int)$info['Hours'],
        "lastLog"  => $info['lastLog'],
    ];
}
$usrDatTemp[] = [
    "profileTags" => $profileTag,
    "marked"      => $marked
];

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
    <title>MarkOut Software</title>
</head>
<body class="wh100p bg-2 flex fld">
<!-- the nav -->
<?php include_once '../libsSys/nav.php';?>
    <section class="posf lt0 pad-s w20 h100 bg-2 flex fld gap-s">
        <h2 class="pad-n txt-b border-b">MarkOut</h2>
        <div class="pad-n-s pad-st w100p flex fld border-b">
            <h2 class="pad-sb w100p txt-n">Titles</h2>
            <?php
            foreach ($tempLibsArr as $id => $value) {
                $attachs = $value['libsAttachs'];
                $titles = $value['libsTitles'];
                ?>
            <div class="posr pad-s-s pad-r pad-sb w100p flex">
                <img src="../libsimg/<?php echo $attachs;?>" alt="<?php echo $attachs;?>" class="vertiMg rightMg-s10 icon-rs objfit">
                <h2 class="w100p txt-s"><?php echo $titles;?></h2>
                <a href="view.php?idSft=" class="link-cover">.</a>
            </div>
            <?php
            };
            ?>
        </div>
    </section>
    <section class="leftMg pad-s w79 h40 bg-4 flex fld">
        <h2 class="leftMg w100p">recently opened</h2>
        <div class="h100p flex gap-s ovs-s ovh-v">
        <?php
        $tempCopy = $usrDatTemp;
        uasort($tempCopy[0]['marked'], function ($b, $a) {
            $timeA = strtotime($a['lastLog']);
            $timeB = strtotime($b['lastLog']);
            return $timeB <=> $timeA;
        });
        foreach ($tempCopy[0]['marked'] as $id => $value) {
            $LibIds = $value['libsIds'];
            $hour = $value['Hours'];
            foreach ($tempLibsArr as $lid => $values) {
                if ($LibIds === $ids) {
                    $ids = $values['libsIds'];
                    $titles = $values['libsTitles'];
                    $attachs = $values['libsAttachs'];
                }
            }
        ?>
            <div class="posr vertiMg pad-s h30 r16-9 bg-1 flex fld border-1 gap10 z1">
                <img src="../libsimg/<?php echo $attachs;?>" alt="<?php echo $attachs;?>" class="posa ins0 wh100p bg-3 z2">
                <h2 class="topMg rightMg txt-s z3"><?php echo $titles;?></h2>
                <p class="rightMg txt-s z3">Total time: <?php echo $hour;?> hrs</p>
                <a href="view.php?type=clts&ids=<?php echo $titles;?>" class="link-cover">.</a>
            </div>
        <?php
        };
        ?>
    </section>
    <section class="leftMg pad-s w79 h40 flex wrap gap10">
        <h2 class="leftMg w100p">Publisher Announcement</h2>
        <div class="posr rightMg vertiMg pad-s w30 r16-9 bg-1 flex fld border-2 z1">
            <img src="" alt="" class="posa ins0 r16-9 wh100p bg-3 z2">
            <h2 class="topMg txt-n z3">Recent Publisher Announcement</h2>
            <p class="txt-s z3">the first few line cut of the announcement in there</p>
            <a href="../../TS/forum/viewtopic.php?topicIds=" class="link-cover">.</a>
        </div>
    </section>
    <section class="leftMg pad-s w79 h40"></section>
<!-- messages passer --> 
    <div id="alertcard">
        <p id="alertcontent"></p>
        <div id="borderanimate"></div>
    </div>
    <?php include_once '../../extra/footer.php';?>
    <script src="../../scriptstuff/script.js"></script>
    <script src="../libsSys/IntakeSFT.js"></script>
    <script src="../../scriptstuff/alert.js"></script>
    <?php
    if (!empty($errors)) {
        echo "<script> ";
        echo "alerter('"; foreach ($errors as $error) {echo $error .";";} echo "')";
        echo "</script>";
    };
    if (!empty($_SESSION['corsmsg'])) {
        $corsmsg = $_SESSION['corsmsg'];
        echo "<script> ";
        echo "alerter('" . $corsmsg . "')";
        echo "</script>";
        $_SESSION['corsmsg'] = "";
    };
    ?>
</body>
</html>