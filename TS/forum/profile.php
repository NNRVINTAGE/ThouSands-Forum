<?php
require_once '../../processes/database.php';
$errors = array();
session_start();
$uDs = $_GET['user'];
if (isset($_SESSION['profileTags'])) {
    $aidis = $_SESSION['profileTags'];
    $name = $_SESSION['username'];
    if (!isset($_GET['user'])) {
        $_SESSION['corsmsg'] = "user account does not exist";
        header ('location: dashboard.php');
        exit;
    } 
} else {
    header ('location: ../../index.php');
    exit;
}
if ($uDs === "self") {
    $uDs = $_SESSION['profileTags'];
}
$page = "profiles";
$UploadEnabled = "no";
$uDs = htmlspecialchars($uDs, ENT_QUOTES, 'UTF-8');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styling/pallate.css">
    <link rel="stylesheet" href="../../styling/nav.css">
    <link rel="stylesheet" href="../../styling/forum_univ.css">
    <link rel="stylesheet" href="../../styling/prfl_extra.css">
    <title>Profile</title>
</head>
<body>
<!-- navbar -->
<?php include_once '../component/nav.php';?>
<!-- the main stuff -->
    <div class="profile-display">
        <?php
        // some profile data fetch
        $stmt_check_profile = $connects->prepare("SELECT * FROM profiles WHERE profileTags = ? ;");
        $stmt_check_profile->bind_param("s", $uDs);
        $stmt_check_profile->execute();
        $result_check_profile = $stmt_check_profile->get_result();
        if ($result_check_profile->num_rows == 1) {
            while ($value = $result_check_profile->fetch_assoc()) {
                $Tags = $value['profileTags'];
                $Names = $value['profileNames'];
                $Bios = $value['profileBios'];
                $JDates = $value['profileJDates'];
                $uFolws = $value['uFolw'];
        ?>
            <div class="profile-container">
                <h2 class="profile-names"><?php echo $Names;?></h2>
                <div class="detail-wrap">
                    <p class="uFolws">Nums: <?php echo $uFolws;?></p>
                    <p class="JDates">Joined Since: <?php echo $JDates;?></p>
                </div>
                <h2 class="profile-bios"><?php echo $Bios;?></h2>
            </div>
        <?php
            };
        } else {
            $_SESSION['corsmsg'] = "user account does not exist or on a temporary ban";
            header ('location: dashboard.php');
            exit;
        };
        ?>
    </div>
    <div class="publication-display">
        <?php
        // fetching user publishes
        $stmt_check_publishes = $connects->prepare("SELECT * FROM libslist WHERE libsPublisher = ? AND libsState = 'Publics';");
        $stmt_check_publishes->bind_param("s", $uDs);
        $stmt_check_publishes->execute();
        $result_check_publishes = $stmt_check_publishes->get_result();
        if ($result_check_publishes->num_rows > 0) {
            $uniqueItem = [];
            while ($value = $result_check_publishes->fetch_assoc()) {
                $lAttachs = $value['libsAttachs'];
                $libsIds = $value['libsIds '];
                $libsTitles = $value['libsTitles'];
                $libsDescs = $value['libsDescs'];
                $libsCategorys = $value['libsCategorys'];
                $addedDates = $value['addedDates'];
                if (!in_array($Ids, $uniqueItem)) {
        ?>
            <div class="publishes">
                <img src="../ArchFiles/<?php echo $lAttachs;?>" class="publish-attachs">
                <h2 class="libs-titles"><?php echo $libsTitles;?></h2>
                <div class="detail-wrap">
                    <p class="libs-ctgry"><?php echo $libsCategorys;?></p>
                    <p class="libs-dates"><?php echo $addedDates;?></p>
                </div>
                <h2 class="libs-descs" onclick="expand('expandDescs')"><?php echo $libsDescs;?></h2>
            </div>
        <?php
                };
            };
        }else{
        ?>
            <div class="publishes">
                <h2 class="zthing">no project publishes found</h2>
            </div>
        <?php
        };
        ?>
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