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
<body class="h100p flex fld gap10 z1">
    <section class="posf lt0 w20 h100 bg-semiwhite flex fld z15">
        <h2 class="pad-n txt-b border-b">Management Tab</h2>
        <div class="pad-n-s pad-s-v w100p flex fld border-b">
            <button onclick="SetDialog('add');" class="pad-s w100p txtc txt-s bg-gold c-black">New Publish</button>
        </div>
        <div class="pad-n-s pad-st w100p flex fld border-b">
            <h2 class="pad-sb w100p txt-n">product</h2>
            <a href="#" class="pad-s-s pad-r pad-sb txt-s">Published</a>
            <a href="#" class="pad-s-s pad-r pad-sb txt-s">Archived</a>
            <a href="#" class="pad-s-s pad-r pad-sb txt-s">Annoucement</a>
        </div>
        <div class="pad-n-s pad-st w100p flex fld border-b">
            <h2 class="pad-sb w100p txt-n">utility</h2>
            <a href="#" class="pad-s-s pad-r pad-sb txt-s">Statistics</a>
            <a href="#" class="pad-s-s pad-r pad-sb txt-s">Feedbacks</a>
            <a href="#" class="pad-s-s pad-r pad-sb txt-s">Achievement</a>
            <a href="#" class="pad-s-s pad-r pad-sb txt-s">CG Connect</a>
        </div>
        <div class="pad-n-s pad-st w100p flex fld border-b">
            <h2 class="pad-sb w100p txt-n">Links</h2>
            <a href="../../TS/forum/dashboard.php" class="pad-s-s pad-r pad-sb txt-s">Forum</a>
            <a href="../core/home.php" class="pad-s-s pad-r pad-sb txt-s">Library</a>
        </div>
    </section>
    <section class="leftMg w79p flex gap-s z2">
    <?php
    // the published software
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
            $desc = $value['libsDesc'];
            $categorys = $value['libsCategorys'];
            if (!in_array($ids, $uniqueItem)) {
    ?>
        <div class="rightMg w30p flex fld bg-5 bora-s gap-s">
            <img src="../libsImg/<?php echo $attachs;?>" alt="" class="w100p r16-9">
            <h2 class="pad-s txt-n"><?php echo $titles;?></h2>
            <div class="sideMg w100p flex">
                <button onclick="" class="autoMg pad-s w40p txt-s txtc bg-blue points z4">View</button>
                <button onclick="SetDialog('edit'); LoadPublishs(this);" class="autoMg pad-s w40p txt-s txtc bg-red points z4" data-titles="<?php echo $titles;?>" data-desc="<?php echo $desc;?>" data-categoryIds="<?php echo $categorys;?>">Edit</button>
                <button onclick="SetDialog('update');" class="autoMg pad-s w40p txt-s txtc bg-green points z4">Archive</button>
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
    <section class="leftMg pad-l w79p flex fld acjc">
    <!-- publish new dialog -->
        <dialog id="add-dialog" class="posr w100p h80 flex fld acjc bg-semiwhite">
            <div class="posa lt0 w100p flex"><h2 class="rightMg pad-s txt-b">Add New Software/Game</h2><p class="pad-s-v pad-n-s txt-b red-hover" onclick="SetDialog('add')">X</p></div>
            <form class="w100p flex flex-r wrap" action="../component/post_out.php" method="post" enctype="multipart/form-data">
                <div class="special-form-input w50p flex fld acjc gap5">
                    <img id="prev" class="icon-b sideMg">
                    <input class="sideMg" type="file" name="file" accept="image/*" onchange="loadFile(event)" required>
                </div>
                <div class="form-input-container pad-s-v w50p flex fld gap5">
                    <div class="form-input-row sideMg w88p flex fld">
                        <label for="titles">Title</label>
                        <input type="text" name="titles" class="inptxt" placeholder="what's title?" auto-complete="off" maxlength="255" required>
                    </div>
                    <div class="form-input-row sideMg w88p flex fld">
                        <label for="desc">Description</label>
                        <input type="text" name="desc" class="inptxt" placeholder="Your best description of it" auto-complete="off" maxlength="255" required>
                    </div>
                    <div class="form-input-row sideMg w88p flex fld">
                        <label for="categoryids">category</label>
                        <select name="categoryids" class="inpselect" required>
                            <option value="" selected disabled>Select one category</option>
                            <?php
                            $stmt_get_categoryss = $connects->prepare("SELECT * FROM categorys WHERE categoryState = ?;");
                            $stmt_get_categoryss->bind_param("s", $State);
                            $stmt_get_categoryss->execute();
                            $result_get_categoryss = $stmt_get_categoryss->get_result();
                            if ($result_get_categoryss->num_rows > 0) {
                                $uniqueT = [];
                                while ($values =  $result_get_categoryss->fetch_assoc()) {
                                    $categoryIds = $values['categoryIds'];
                                    $categoryTitles = $values['categoryTitles'];
                                    if (!in_array($categoryIds, $uniqueT)) {
                                        echo "<option name='categoryids' value='$categoryIds' required>$categoryTitles</option>";
                                        $uniqueT[] = $topicIds;
                                    };
                                };
                            };
                            ?>
                        </select>
                    </div>
                    <div class="form-input-row sideMg w88p flex fld">
                        <input class="txt-n c-black" type="submit" name="submit" value="Publish">
                    </div>
                </div>
            </form>
        </dialog>
    <!-- the edit publishes dialog -->
        <dialog id="edit-dialog" class="posr w100p h80 flex fld acjc bg-semiwhite">
            <div class="posa lt0 w100p flex"><h2 class="rightMg pad-s txt-b">Edit Publish</h2><p class="pad-s-v pad-n-s txt-b red-hover" onclick="SetDialog('edit')">X</p></div>
            <form class="w100p flex flex-r wrap" name="EDITSTUFF" action="../component/post_out.php" method="post" enctype="multipart/form-data">
                <div class="special-form-input w50p flex fld acjc gap5">
                    <img id="prev" name="prev" class="icon-b sideMg">
                    <input class="sideMg" type="file" name="file" accept="image/*" onchange="loadFile(event)" required>
                </div>
                <div class="form-input-container pad-s-v w50p flex fld gap5">
                    <div class="form-input-row sideMg w88p flex fld">
                        <label for="titles">Title</label>
                        <input type="text" name="titles" class="inptxt" placeholder="what's title?" auto-complete="off" maxlength="255" required>
                    </div>
                    <div class="form-input-row sideMg w88p flex fld">
                        <label for="desc">Description</label>
                        <input type="text" name="desc" class="inptxt" placeholder="Your best description of it" auto-complete="off" maxlength="255" required>
                    </div>
                    <div class="form-input-row sideMg w88p flex fld">
                        <label for="categoryids">category</label>
                        <select name="categoryids" class="inpselect" required>
                            <option value="" selected disabled>Select one category</option>
                            <?php
                            $stmt_get_categoryss = $connects->prepare("SELECT * FROM categorys WHERE categoryState = ?;");
                            $stmt_get_categoryss->bind_param("s", $State);
                            $stmt_get_categoryss->execute();
                            $result_get_categoryss = $stmt_get_categoryss->get_result();
                            if ($result_get_categoryss->num_rows > 0) {
                                $uniqueT = [];
                                while ($values =  $result_get_categoryss->fetch_assoc()) {
                                    $categoryIds = $values['categoryIds'];
                                    $categoryTitles = $values['categoryTitles'];
                                    if (!in_array($categoryIds, $uniqueT)) {
                                        echo "<option name='categoryids' value='$categoryIds' required>$categoryTitles</option>";
                                        $uniqueT[] = $topicIds;
                                    };
                                };
                            };
                            ?>
                        </select>
                    </div>
                    <div class="form-input-row sideMg w88p flex fld">
                        <input class="txt-n c-black" type="submit" name="submit" value="Publish">
                    </div>
                </div>
            </form>
        </dialog>
    <!-- the archiving publish dialog -->
        <dialog id="update-dialog" class="posf ins0 wh100 flex fld acjc bg-semiwhite z15">
            <div class="posa lt0 w100p flex"><h2 class="rightMg pad-s txt-b">Archive it?</h2><p class="pad-s-v pad-n-s txt-b red-hover" onclick="SetDialog('update')">X</p></div>
            <form class="w100p flex flex-r wrap" name="EDITSTUFF" action="../component/post_out.php" method="post" enctype="multipart/form-data">
                <div class="special-form-input w50p flex fld acjc gap5">
                    <img id="prev" name="prev" class="icon-b sideMg">
                    <input class="sideMg" type="file" name="file" accept="image/*" onchange="loadFile(event)" required>
                </div>
                <div class="form-input-container pad-s-v w50p flex fld gap5">
                    <div class="form-input-row sideMg w88p flex fld">
                        <label for="titles">Title</label>
                        <input type="text" name="titles" class="inptxt" placeholder="what's title?" auto-complete="off" maxlength="255" required>
                    </div>
                    <div class="form-input-row sideMg w88p flex fld">
                        <label for="desc">Description</label>
                        <input type="text" name="desc" class="inptxt" placeholder="Your best description of it" auto-complete="off" maxlength="255" required>
                    </div>
                    <div class="form-input-row sideMg w88p flex fld">
                        <label for="categoryids">category</label>
                        <select name="categoryids" class="inpselect" required>
                            <option value="" selected disabled>Select one category</option>
                            <?php
                            $stmt_get_categoryss = $connects->prepare("SELECT * FROM categorys WHERE categoryState = ?;");
                            $stmt_get_categoryss->bind_param("s", $State);
                            $stmt_get_categoryss->execute();
                            $result_get_categoryss = $stmt_get_categoryss->get_result();
                            if ($result_get_categoryss->num_rows > 0) {
                                $uniqueT = [];
                                while ($values =  $result_get_categoryss->fetch_assoc()) {
                                    $categoryIds = $values['categoryIds'];
                                    $categoryTitles = $values['categoryTitles'];
                                    if (!in_array($categoryIds, $uniqueT)) {
                                        echo "<option name='categoryids' value='$categoryIds' required>$categoryTitles</option>";
                                        $uniqueT[] = $topicIds;
                                    };
                                };
                            };
                            ?>
                        </select>
                    </div>
                    <div class="form-input-row sideMg w88p flex fld">
                        <input class="txt-n c-black" type="submit" name="submit" value="Publish">
                    </div>
                </div>
            </form>
        </dialog>
    </section>

    <script src="../libsSys/mng7.js"></script>
    <script src="../../scriptstuff/script.js"></script>
</body>
</html>