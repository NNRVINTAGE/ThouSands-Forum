<?php
require_once '../../processes/database.php';
$errors = array();
session_start();
$uDs = $_GET['user'];
$setBios = false;
if (isset($_SESSION['profileTags'])) {
    $aidis = $_SESSION['profileTags'];
    $name = $_SESSION['username'];
    if (!isset($_GET['user'])) {
        $_SESSION['corsmsg'] = "no user tags found";
        header ('location: dashboard.php');
        exit;
    } 
} else {
    header ('location: ../../index.php');
    exit;
}
if ($uDs === "self") {
    $setBios = true;
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
    <link rel="stylesheet" href="../../styling/connect_univ.css">
    <link rel="stylesheet" href="../../styling/connect_forms.css">
    <link rel="stylesheet" href="../../styling/prfl_extra.css">
    <title>Profiles</title>
</head>
<body>
<!-- just navbar -->
<?php include_once '../component/nav.php';?>
<!-- bio dialog-->
    <dialog id="edit-dialog">
        <div class="dialog-nav"><h2>Edit Bio</h2><p onclick="SetDialog('edit')">X</p></div>
        <form class="univ-form" name="BIOS" action="../component/bionic.php" method="post">
            <div class="form-input-row">
                <textarea type="text" name="bioedits" class="inptxt" placeholder="" auto-complete="off" maxlength="2500" required></textarea>
            </div>
            <div class="form-input-row">
                <input class="edit-button edit-submit" type="submit" name="submit" value="change bio">
            </div>
        </form>
    </dialog>
<!-- the profile content and other stuff -->
    <div class="profile-display">
        <?php
        // some profile data fetching
        $stmt_check_profile = $connects->prepare("SELECT * FROM profiles WHERE profileTags = ? ;");
        $stmt_check_profile->bind_param("s", $uDs);
        $stmt_check_profile->execute();
        $result_check_profile = $stmt_check_profile->get_result();
        if ($result_check_profile->num_rows == 1) {
            $value = $result_check_profile->fetch_assoc();
            $Tags = $value['profileTags'];
            $pfAttachs = $value['profileAttachs'];
            $Names = $value['profileNames'];
            $Bios = $value['profileBios'];
            $JDates = $value['profileJDates'];
            $uFolws = $value['uFolw'];
            $iconAlt = ucfirst(substr($Names, 0, 1));
        ?>
        <div class="profile-icon">
            <?php
            if (empty($pfAttachs) || $pfAttachs === "empty") {
            ?>
            <h2 class="profile-icon-replacement"><?php echo $iconAlt;?></h2>
            <?php
            } else {
            ?>
            <img src="<?php echo $pfAttachs;?>" alt="<?php echo $Names;?>" class="profile-image">
            <?php
            };
            ?>
        </div>
        <div class="profile-container">
            <h2 class="profile-names"><?php echo $Names;?></h2>
            <div class="detail-wrap">
                <p class="uFolws">Following: <?php echo $uFolws;?></p>
                <p class="JDates">Joined since <?php echo $JDates;?></p>
            </div>
            <div class="profile-bios"><?php echo $Bios;?></div>
            <?php
            if ($setBios = true) {
            ?>
            <button class="edit-button" onclick="SetDialog('edit'); LoadBios(this);" data-bioedits="<?php echo $Bios;?>">Edit Bio</button>
            <?php
            }
            ?>
        </div>
        <?php
        } else {
            $_SESSION['corsmsg'] = "user account does not exists or on a temporary bans";
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
                $libsIds = $value['libsIds'];
                $lAttachs = $value['libsAttachs'];
                $libsTitles = $value['libsTitles'];
                $libsDescs = $value['libsDesc'];
                $libsCategorys = $value['libsCategorys'];
                $addedDates = $value['addedDates'];
                if (!in_array($libsIds, $uniqueItem)) {
        ?>
            <div class="publishes">
                <img src="../ArchFiles/<?php echo $lAttachs;?>" class="publish-attachs">
                <h2 class="libs-titles"><?php echo $libsTitles;?></h2>
                <div class="detail-wrap">
                    <p class="libs-ctgry"><?php echo $libsCategorys;?></p>
                    <p class="libs-dates"><?php echo $addedDates;?></p>
                </div>
                <h2 class="libs-descs"><?php echo $libsDescs;?></h2>
            </div>
        <?php
                };
            };
        } else {
        ?>
            <div class="publishes">
                <h2 class="zthing">no project publishes found</h2>
            </div>
        <?php
        };
        ?>
    </div>
<!-- just messages passer -->
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