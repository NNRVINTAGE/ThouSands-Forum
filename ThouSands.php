<?php
require_once "processes/database.php";
$errors = array();
session_start();
if (isset($_SESSION['profileTags'])) {
    $isLogged = true;
} else {
    $isLogged = false;
};
$daState = "Publics";
$stmt_get_topics = $connects->prepare("SELECT * FROM topics WHERE topicState = ?;");
$stmt_get_topics->bind_param("s", $topicState);
$stmt_get_topics->execute();
$result_get_topics = $stmt_get_topics->get_result();
if ($result_get_topics->num_rows > 0) {
    $uniqueT = [];
    while ($values =  $result_get_topics->fetch_assoc()) {
        $ForumTopics = $values['topicIds'];
        $topicTitles = $values['topicTitles'];
        if (!in_array($ForumTopics, $uniqueT)) {
            $uniqueT[] = $ForumTopics;
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
    <link rel="stylesheet" href="styling/pallate.css">
    <link rel="stylesheet" href="styling/Mindex.css">
    <link rel="stylesheet" href="styling/index.css">
    <link rel="stylesheet" href="styling/footer.css">
    <title>Project ThouSands</title>
</head>
<body class="gap">
    <div class="bg">.</div>
    <header>
        <nav>
            <a href="gateway.php" class="nav-button">Gateway</a>
            <a href="CrossGate.php" class="nav-button">CrossGate</a>
        </nav>
        <div class="linkie-button">
            <?php
            if ($isLogged == true) {
            ?>
            <a href="TS/forum/dashboard.php" class="linkie dashb">Forum</a>
            <a href="index.php" class="linkie dashb">Library</a>
            <?php
            } else {
            ?>
            <a href="forum-connect/connect_it.php?state=login" class="linkie">LOGIN</a>
            <a href="forum-connect/connect_it.php?state=register" class="linkie">JOIN</a>
            <?php
            };
            ?>
        </div>
    </header>
    <section class="sideMg w88p h90 flex fld">
        <h1 class="topMg title">Project ThouSands: Shores</h1>
        <h2 class="desc">Thousand of journey among the Endless Shores</h2>
        <div class="bottomMg">
            <a href="forum-connect/connect_it.php?state=login" class="uni-button-1"></a>
        </div>
    </section>
    <section class="sideMg w88p flex fld">
        <h2 class="w100p txtc">About Project ThouSands</h2>
        <P>In a place where the open desert and endless sea are all the eyes can see,
            <br>beneath the colony, frequent faint roar from the distant depth followed with ever increasing quakes
            <br>Uncover what hidden below with every journey will changes the fates and shape the world whichever direction it will be lead into
        </P>
        <p>
            ThouSands Shores is part of the Project ThouSands series, in this game you and the other player can shape the world and change event outcome of every calamity.
        </p>
    </section>
    <section class="sideMg w88p flex fld">
        <h2 class="w100p txtc">Updates</h2>
        <div class="devlog-container">
            <?php
            $stmt_check_HForum = $connects->prepare("SELECT * FROM forums WHERE ForumState = ? AND ForumTopics = 'ThouSands-02471F' ORDER BY ForumDates ASC;");
            $stmt_check_HForum->bind_param("s", $daState);
            $stmt_check_HForum->execute();
            $result_check_HForum = $stmt_check_HForum->get_result();
            if ($result_check_HForum->num_rows > 0) {
                $uniqueItem = [];
                while ($value = $result_check_HForum->fetch_assoc()) {
                    $Hids = $value['ForumIds'];
                    $Htitles = $value['ForumTitles'];
                    $Htopics = $value['ForumTopics'];
                    $Hdates = $value['ForumDates'];
                    $Hcontents = $value['ForumContents'];
                    $attachs = $value['ForumAttachment'];
                    if (!in_array($Hids, $uniqueItem)) {
                        $Htopic = $TempTopicArray[$Htopics] ?? null;
            ?>
            <div class="devlog">
                <h3 class="devlog-title"><?php echo $Htitles;?></h3>
                <p class="devlog-dates"><?php echo $Hdates;?></p>
                <p class="devlog-desc"><?php echo $Hcontents;?></p>
                <a class="devlog-link" href="TS/forum/forum.php?ids=<?php echo $Hids;?>">.</a>
            </div>
            <?php
                    };
                };
            } else {
            ?>
            <div class="devlog">
                <p class="devlog-desc">No devlog found, somethings wrong in there</p>
            </div>
            <?php
            };
            ?>
        </div>
    </section>
    <section class="section-type-2 w88p gap">
        <div class="w100p flex gap">
            <div class="pad-s-s flex fld acjc leftMg highlighted">
                <img src="img/logo-windows.svg" alt="" class="icon-s">
                <h2 class="os_name">Windows</h2>
            </div>
            <div class="pad-s-s flex fld acjc rightMg">
                <img src="img/logo-tux.svg" alt="" class="icon-s">
                <h2 class="os_name">Linux</h2>
            </div>
        </div>
        <div class="flex">
            <table class="w100p flex fld">
                <tr class="pad-n-s pad-s-v w100p flex">
                    <td class="pad-s-s w40p">batch</td>
                    <td class="pad-s-s w20p txtc">version</td>
                    <td class="pad-s-s w20p txtc">release</td>
                    <td class="pad-s-s w20p txtc">date</td>
                    <td class="pad-s-s leftMg w20p txtc">log</td>
                </tr>
                <tr class="pad-n-s w100p flex">
                    <td class="pad-s-s w40p ovh">ThouSands_Shores_16S8AS.rar</td>
                    <td class="pad-s-s w20p txtc">16S8AS</td>
                    <td class="pad-s-s w20p txtc ovh">Stable-Alpha</td>
                    <td class="pad-s-s w20p txtc">16-8-2025</td>
                    <td class="pad-s-s w20p txtc ovh">first-test</td>
                </tr>
                <tr class="pad-n-s w100p flex">
                    <td class="pad-s-s w40p ovh">ThouSands_Shores_17O9AS.rar</td>
                    <td class="pad-s-s w20p txtc">17O9AS</td>
                    <td class="pad-s-s w20p txtc ovh">Stable-Alpha</td>
                    <td class="pad-s-s w20p txtc">17-9-2025</td>
                    <td class="pad-s-s w20p txtc ovh">structures</td>
                </tr>
                <tr class="pad-n-s w100p flex">
                    <td class="pad-s-s w40p ovh">ThouSands_Shores_30O9AS.rar</td>
                    <td class="pad-s-s w20p txtc">30O9AS</td>
                    <td class="pad-s-s w20p txtc ovh">Stable-Alpha</td>
                    <td class="pad-s-s w20p txtc">30-9-2025</td>
                    <td class="pad-s-s w20p txtc ovh">save-system</td>
                </tr>
            </table>
            <div class="vertiMg container-type-2 w30p h40 bg-white border-1 gap-s bora-n">
                <img src="img/logo-windows.svg" class="topMg sideMg icon-s">
                <h2 class="w100p txtc c-black">Windows</h2>
                <p class="w100p txtc c-black">Alpha 30O9AS</p>
                <a href="gets/ThouSands_Shores_30O9AS.rar" class="bottomMg pad-s w100p bg-1 txtc">Download</a>
            </div>
        </div>
    </section>
    <script src="scriptstuff/thousandsStuff.js"></script>
    <?php include_once 'footer.php';?>
</body>
</html>