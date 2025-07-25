<?php
require_once '../../processes/database.php';
$UploadEnabled = "nope";
$page = "category";
$State = "publics";
$requestedItem = "empty";
$errors = array();
session_start();
if (isset($_SESSION['profileTags'])) {
    $aidis = $_SESSION['profileTags'];
    $name = $_SESSION['username'];
    $UploadEnabled = "no";
} else {
    header ('location: libs.php');
    exit;
};
if (isset($_GET['category'])) {
    $requestedItem = $_GET['category'];
    $requestedItem = htmlspecialchars($requestedItem, ENT_QUOTES, 'UTF-8');
} else {
    $requestedItem = "empty";
    $requestedItem = htmlspecialchars($requestedItem, ENT_QUOTES, 'UTF-8');
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category list</title>
</head>
<body>
    <!-- navbar -->
    <?php include_once '../component/nav.php';?>
    <!-- the category listing -->
    <section class="category-lister">
        <?php
        $categoryState = "Publics";
        if (isset($requestedItem) || $requestedItem != "empty") {
        $stmt_check_category = $connects->prepare("SELECT * FROM categorys WHERE categoryState = ? AND categoryTitles LIKE '%$requestedItem%' ORDER BY categoryTitles DESC;");
        $stmt_check_category->bind_param("s", $categoryState);
        } else {
        $stmt_check_category = $connects->prepare("SELECT * FROM categorys WHERE categoryState = ?;");
        $stmt_check_category->bind_param("s", $categoryState);
        }
        $stmt_check_category->execute();
        $result_check_category = $stmt_check_category->get_result();
        if ($result_check_category->num_rows > 0) {
            $uniqueItem = [];
            while ($value = $result_check_category->fetch_assoc()) {
                $ids = $value['categoryIds'];
                $titles = $value['categoryTitles'];
                if (!in_array($ids, $uniqueItem)) {
        ?>
        <div class="category-container">
                    <?php
                    if ($attachs != "empty.png" && isset($attachs)) {
                    ?>
            <img src="../libsImg/<?php echo $attachs;?>" alt="<?php echo $attachs;?>" class="category-banner">
                    <?php
                    };
                    ?>
            <h2 class="category-title"><?php echo $titles;?></h2>
            <p class="category-desc"><?php echo $contents;?></p>
            <a href="viewcategory.php?categoryIds=<?php echo $ids;?>" class="category-link">.</a>
        </div>
        <?php
                };
            };
        } else {
        ?>
            <h2 class="zthing">category data fetching failed</h2>
        <?php
        };
        ?>
    </section>
</body>
</html>