<?php
require_once 'processes/database.php';
$errors = array();
session_start();
if (isset($_SESSION['profileTags'])) {
    $aidis = $_SESSION['profileTags'];
    $name = $_SESSION['username'];
    $UploadEnabled = "yes";
};
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="styling/nav.css">
    <link rel="stylesheet" href="styling/pallate.css">
    <link rel="stylesheet" href="styling/footer.css">
    <link rel="stylesheet" href="styling/Mindex.css">
    <link rel="stylesheet" href="styling/slides.css">
    <title>Welcome</title>
</head>
<body class="wh100p bg-2 gap-s flex fld ovh-s ovs-v">
<!-- category on the right of the page -->
    <section class="posa lt0 pad-s w20 h100p flex fld gap-s blurbg z2">
        <h2 class="pad-n txt-b border-b semibold">Gateways Library</h2>
        <div class="pad-n-s pad-st w100p flex fld border-b">
            <a href="library/core/category.php" class="pad-sb w100p txt-n semibold">Categories</a>
            <?php
            $tempCatgArray = [];
            $stmt_check_category = $connects->prepare("SELECT * FROM categorys WHERE categorytype = 'games' AND categoryState = ?;");
            $stmt_check_category->bind_param("s", $State);
            $stmt_check_category->execute();
            $result_check_category = $stmt_check_category->get_result();
            if ($result_check_category->num_rows > 0) {
                $uniqueItem = [];
                while ($value = $result_check_category->fetch_assoc()) {
                    $ids = $value['categoryIds'];
                    $titles = $value['categoryTitles'];
                    if (!in_array($ids, $uniqueItem)) {
                        $tempCatgArray[$ids] = $titles;
            ?>
            <div class="posr pad-s-s pad-r pad-sb w100p flex fld">
                <h2 class="w100p txt-s"><?php echo $titles;?></h2>
                <a href="#" class="link-cover">.</a>
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
        <div class="pad-s w100p flex fld border-b gap5">
            <div class="posr pad-s-s pad-r pad-sb w100p flex fld">
                <h2 class="w100p txt-s">MarkOut</h2>
                <a href="library/core/markout.php" class="link-cover">.</a>
            </div>
            <div class="posr pad-s-s pad-r pad-sb w100p flex fld">
                <h2 class="w100p txt-s">Forum</h2>
                <a href="TS/forum/dashboard.php" class="link-cover">.</a>
            </div>
            <div class="posr pad-s-s pad-r pad-sb w100p flex fld">
                <h2 class="w100p txt-s">Profile</h2>
                <a href="TS/forum/profile.php?user=self" class="link-cover">.</a>
            </div>
        </div>
    </section>
<!-- banner stuff -->
    <section class="posr leftMg pad-sl w79 h60 flex">
        <div class="posa t0 r0 wh100p flex" id="slides">
        </div>
        <button class="prev">&#10094;</button>
        <button class="next">&#10095;</button>
    </section>
<!-- trending software -->
    <section class="leftMg pad-n w79 flex fld gap5">
        <h2 class="leftMg pad-s-s w100p">Popular Releases</h2>
        <div class="pad-s h100p flex gap5 ovh-v ovs-s">
        <?php
        $tempLibsArrCopy = $tempLibsArr;
        uasort($tempLibsArrCopy, function ($a, $b) {
            return $b['cltNumbs'] <=> $a['cltNumbs'];
        });
        foreach ($tempLibsArrCopy as $id => $value) {
            $ids = $value['libsIds'];
            $attachs = $value['libsAttachs'];
            $titles = $value['libsTitles'];
            $Desc = $value['libsDesc'];
            $addedDates = $value['addedDates'];
            $cltNumbs = $value['cltNumbs'];
            $category = $value['libsCategorys'];
            $fdrLibs = $value['fdrLibs'];
            $catgList = $tempCatgArray[$category] ?? null;
        ?>
            <div class="posr vertiMg pad-s h30 r16-9 bg-1 flex fld border-1 gap10 z1">
                <img src="Library/libsImg/<?php echo $attachs;?>" alt="<?php echo $attachs;?>" class="posa ins0 wh100p bg-3 z2">
                <h2 class="topMg rightMg txt-s z3"><?php echo $titles;?></h2>
                <a href="#" class="link-cover">.</a>
            </div>
        <?php
        };
        ?>
        </div>
        <!-- library/core/view.php?type=clts&ids= -->
    </section>
<!-- software list -->
    <section class="topMg-5 leftMg pad-s-v w79 h100 flex fld" id="softwarelist">
        <?php
        foreach ($tempLibsArr as $id => $value) {
            $ids = $value['libsIds'];
            $attachs = $value['libsAttachs'];
            $titles = $value['libsTitles'];
            $Desc = $value['libsDesc'];
            $addedDates = $value['addedDates'];
            $cltNumbs = $value['cltNumbs'];
            $category = $value['libsCategorys'];
            $fdrLibs = $value['fdrLibs'];
            $catgList = $tempCatgArray[$category] ?? null;
            ?>
        <div class="posr sideMg pad-s w88p flex bg-semiwhite gap5 border-1">
            <img src="Library/libsImg/<?php echo $attachs;?>" alt="<?php echo $attachs;?>" class="h10 r16-9 objfit">
            <div class="h100p flex fld">
                <h2 class="rightMg txt-n"><?php echo $titles;?></h2>
                <p class="topMg rightMg txt-s c-semiwhite"><?php
                    if (isset($catgList)) {
                        echo $catgList;
                    } else {
                        echo "Undefined";
                    };
                    ?></p>
                <a href="#" class="link-cover">.</a>
            </div>
            <div class="leftMg h100p flex fld">
                <p class="topMg leftMg txt-s c-semiwhite"><?php echo $addedDates;?></p>
            </div>
        </div>
        <?php
        };
        ?>
    </section>
    <?php include_once 'footer.php';?>
<!-- another messages passer -->
    <div id="alertcard">
        <p id="alertcontent"></p>
        <div id="borderanimate"></div>
    </div>
    <script src="scriptstuff/script.js"></script>
    <script src="scriptstuff/slide.js"></script>
    <script src="scriptstuff/alert.js"></script>
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