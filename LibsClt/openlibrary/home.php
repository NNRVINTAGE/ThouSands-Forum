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
$UploadEnabled = "no";
$SearchEnabled = "yes";
$page = "home";
$State = "publics";
$requestedItem = "empty";
if (isset($_GET['item'])) {
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
    <link rel="stylesheet" href="../libsImg/libs.ico" type="image/x-icon">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="../../styling/nav.css">
    <link rel="stylesheet" href="../../styling/pallate.css">
    <title>Library Homepage</title>
</head>
<body>
<!-- the nav of course -->
<?php include_once '../libsSys/nav.php';?>
<!-- category on the right of the page -->
    <section class="category-container">
        <?php
        $stmt_check_category = $connects->prepare("SELECT * FROM categorys WHERE categoryState = ?;");
        $stmt_check_category->bind_param("s", $State);
        $stmt_check_category->execute();
        $result_check_category = $stmt_check_category->get_result();
        if ($result_check_category->num_rows > 0) {
            $uniqueItem = [];
            while ($value = $result_check_category->fetch_assoc()) {
                $ids = $value['categoryIds'];
                $titles = $value['categoryTitles'];
                if (!in_array($ids, $uniqueItem)) {
        ?>
        <div class="category-unit">
            <a href="viewcategory.php?categoryIds=<?php echo $titles;?>" class="category-title"><?php echo $titles;?></a>
        </div>
        <?php
                };
            };
        } else {
        ?>
            <p class="zthing">nothing found from the category list</p>
        <?php
        };
        ?>
    </section>
<!-- banner stuff -->
    <section class="banner-display">
        <?php
        $stmt_check_banner = $connects->prepare("SELECT * FROM banners WHERE bannerState = ? ORDER BY bannerDates ASC;");
        $stmt_check_banner->bind_param("s", $State);
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
            <a href=" home.php?RefIds=<?php echo $Bids;?>" class="banner-link">.</a>
        </div>
        <?php
                };
            };
        } else {
        ?>
            <p class="zthing">No banner there, someone's hiding it :p</p>
        <?php
        };
        ?>
    </section>
<!-- software list -->
    <section class="software-list" id="softwarelist">
        <?php
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
                $category = $value['libsCategorys'];
                if (!in_array($ids, $uniqueItem)) {
        ?>
        <div class="software-container">
            <img src="../libsimg/<?php echo $attachs;?>" alt="<?php echo $attachs;?>" class="software-banner">
            <h2 class="software-titles"><?php echo $titles;?></h2>
            <a href="viewsoftware.php?softwareTitles=<?php echo $titles;?>" class="software-link">.</a>
        </div>
        <?php
                };
            };
        } else {
        ?>
            <p class="zthing">No software on the list</p>
        <?php
        };
        ?>
    </section>
<!-- another messages passer -->
    <div id="alertcard">
        <p id="alertcontent"></p>
        <div id="borderanimate"></div>
    </div>
    <script src="../../scriptstuff/script.js"></script>
    <script src="../libsSys/IntakeSFT.js"></script>
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