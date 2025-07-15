<?php
require_once '../../processes/database.php';
$UploadEnabled = "nope";
$errors = array();
session_start();
if (isset($_SESSION['thouSandsIds'])) {
    $aidis = $_SESSION['thouSandsIds'];
    $name = $_SESSION['username'];
    $UploadEnabled = "yes";
} else {
    header ('location: libs.php');
    exit;
};
if (isset($_GET['state'])) {
    if ($_GET['state'] === 'apps') {
        $states = 'scapps';
    } else if ($_GET['state'] === 'games') {
        $states = 'ltgames';
    } else {
        $state = 'ltgames';
    }
};

$page = "softwarelist";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../libsImg/libs.ico" type="image/x-icon">
    <link rel="stylesheet" href="softwarelist.css">
    <title>The Library</title>
</head>
<body>
<!-- nav of course -->
<?php include_once '../libsSys/nav.php';?>
<!-- category on the right of the page -->
    <section class="category-container">
        <?php
        $categoryState = "publics";
        $stmt_check_category = $connects->prepare("SELECT * FROM categorys WHERE categoryState = ?;");
        $stmt_check_category->bind_param("s", $categoryState);
        $stmt_check_category->execute();    
        $result_check_category = $stmt_check_category->get_result();

        if ($result_check_category->num_rows > 0) {
            $uniqueItem = [];
            while ($value = $result_check_category->fetch_assoc()) {
                $ids = $value['categoryIds'];
                $titles = $value['categoryTitles'];
                if (!in_array($ids, $uniqueItem)) {
        ?>
        <div class="mini-category-list">
            <a href="viewcategory.php?categoryIds=<?php echo $titles;?>" class="category-title"><?php echo $titles;?></a>
        </div>
        <?php
                }
            }
        } else {
        ?>
            <p class="zthing">No retrieved data</p>
        <?php
        };
        ?>
    </section>
<!-- banner stuff -->
    <section class="banner-display">
        <?php
        $stmt_check_banner = $connects->prepare("SELECT * FROM banners WHERE bannerState = ? ORDER BY bannerDates ASC;");
        $stmt_check_banner->bind_param("s", $bannerState);
        $stmt_check_banner->execute();
        $result_check_banner = $stmt_check_banner->get_result();
        if ($result_check_banner->num_rows > 0) {
            $uniqueItem = [];
            while ($value = $result_check_banner->fetch_assoc()) {
                $Bids = $value['bannerIds'];
                $bannerRefImg = $value['bannerRefImg'];
                if (!in_array($ids, $uniqueItem)) {
        ?>
        <div class="banner-container">
            <img src="../libsImg/<?php echo $bannerRefImg;?>" alt="<?php echo $bannerRefImg;?>" class="banner-img">
            <a href="softwarelist.php?ids=<?php echo $Bids;?>" class="banner-link">.</a>
        </div>
        <?php
                }
            }
        } else {
        ?>
            <p class="zthing">No banner found, someone hiding it :p</p>
        <?php
        };
        ?>
    </section>
<!-- software list -->
    <section class="software-list">
        <?php
        $softwareState = "publics";
        $stmt_check_software = $connects->prepare("SELECT * FROM softwares WHERE softwareState = ? LIMIT 10;");
        $stmt_check_software->bind_param("s", $softwareState);
        $stmt_check_software->execute();    
        $result_check_software = $stmt_check_software->get_result();

        if ($result_check_software->num_rows > 0) {
            $uniqueItem = [];
            while ($value = $result_check_software->fetch_assoc()) {
                $ids = $value['softwareIds'];
                $titles = $value['softwareTitles'];
                $publishers = $value['softwarePublishers'];
                $category = $value['softwareCategory'];
                $dates = $value['softwareDates'];
                $descs = $value['softwareDescs'];
                $attachs = $value['softwareAttachs'];
                if (!in_array($ids, $uniqueItem)) {
        ?>
        <div class="software-container">
            <h2 class="forum-title"><?php echo $titles;?></h2>
            <p class="forum-username"><?php echo $publishers;?></p>
            <div class="detail-wrap">
                <p class="topic"><?php echo $topics;?></p>
                <p class="dates"><?php echo $dates;?></p>
            </div>
            <p class="forum-content"><?php echo $descs;?>
            </p>
            <a href="viewsoftware.php?softwareTitles=<?php echo $titles;?>" class="software-link">Open</a>
        </div>
        <?php
                }
            }
        } else {
        ?>
            <p class="zthing">No software listed</p>
        <?php
        }
        ?>
    </section>
<!-- another lil bit of messages passer -->
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