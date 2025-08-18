<?php
require_once '../../processes/database.php';
$errors = array();
session_start();
if (isset($_SESSION['profileTags'])) {
    $aidis = $_SESSION['profileTags'];
    $name = $_SESSION['username'];
    $UploadEnabled = "no";
} else {
    header ('location: ../../libs.php');
    exit;
};
$UploadEnabled = "nope";
$SearchEnabled = "yes";
$page = "category";
$State = "publics";
$requestedItem = "empty";
if (isset($_GET['item']) && isset($_GET['onsearch'])) {
    $searchTrigger = $_GET['onsearch'];
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
    <link rel="stylesheet" href="category.css">
    <link rel="stylesheet" href="../../styling/nav.css">
    <link rel="stylesheet" href="../../styling/pallate.css">
    <title>Category list</title>
</head>
<body>
    <!-- navbar -->
    <?php include_once '../libsSys/nav.php';?>
    <!-- the category list -->
    <section class="category-list">
        <?php
        if (isset($requestedItem) && isset($searchTrigger)) {
        $stmt_check_category = $connects->prepare("SELECT * FROM categorys WHERE categoryState = ? AND categoryTitles LIKE '%$requestedItem%' ORDER BY categoryTitles DESC;");
        $stmt_check_category->bind_param("s", $State);
        } else {
        $stmt_check_category = $connects->prepare("SELECT * FROM categorys WHERE categoryState = ?;");
        $stmt_check_category->bind_param("s", $State);
        };
        $stmt_check_category->execute();
        $result_check_category = $stmt_check_category->get_result();
        if ($result_check_category->num_rows > 0) {
            $uniqueItem = [];
            while ($value = $result_check_category->fetch_assoc()) {
                $cgids = $value['categoryIds'];
                $titles = $value['categoryTitles'];
                if (!in_array($cgids, $uniqueItem)) {
        ?>
        <div class="category-container">
            <p class="category-title"><?php echo $titles;?></p>
            <a href="viewcategory.php?categoryIds=<?php echo $cgids;?>" class="category-link">.</a>
        </div>
        <?php
                };
            };
        } else {
        ?>
            <h2 class="zthing">nothing found on the category list</h2>
        <?php
        };
        ?>
    </section>
    <script src="../../scriptstuff/script.js"></script>
    <script src="../../scriptstuff/alert.js"></script>
</body>
</html>