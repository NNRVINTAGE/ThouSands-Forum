<?php
$state = $_GET['state'];
require_once "../processes/database.php";
if ($state === 'login') {
    require_once "../processes/connect_login.php";
} else if ($state === 'register') {
    require_once "../processes/connect_regist.php";
};
$errors = array();
session_start();
if (isset($_SESSION['thouSandsIds'])) {
    header ('location: ../GM/forum/dashboards.php');
    exit;
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styling/connect_univ.css">
    <link rel="stylesheet" href="../styling/connect_forms.css">
<?php
if ($state === 'login') {
?>
    <title>Connect Login</title>
</head>
<body class="LRContainer">
  <form class="EntryPanel" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <h1 class="EntryPanelTitle">Connect Login</h1>
    <div class="form-input-row">
      <label for="username">Username</label>
      <input class="inptxt" type="text" id="username" name="username" placeholder="Use registered username" autocomplete="off" tabindex="1" required>
    </div>
    <div class="form-input-row">
      <label for="password">Password</label>
      <input class="inptxt" type="password" id="password" name="password" placeholder="Give the correct password" autocomplete="off" tabindex="2" required>
    </div>
    <div class="form-input-row">
      <button type="submit" class="ActionButton" name="Login" tabindex="3">Sign in</button>
    </div>
    <div class="form-input-row">
      <p class="promptText">Don't have an Account? <a href="connect_it.php?state=register" class="LRredirect" tabindex="4">Register here</a></p>
    </div>
  </form>
<?php
} else if ($state === 'register') {
require_once "../processes/connect_regist.php";
?>
  <title>Connect Register</title>
</head>
<body class="LRContainer">
    <form class="EntryPanel" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h1 class="EntryPanelTitle">Connect Register</h1>
        <div class="form-input-row">
        <label for="Email">Email</label>
        <input class="inptxt" type="text" id="Email" name="Email" placeholder="Your Email for validation" autocomplete="off" tabindex="1" required>
        </div>
        <div class="form-input-row">
        <label for="username">Username</label>
        <input class="inptxt" type="text" id="username" name="username" placeholder="Write the desired username" autocomplete="off" tabindex="2" required>
        </div>
        <div class="form-input-row">
        <label for="password">Password</label>
        <input class="inptxt" type="password" id="password" name="password" placeholder="Choose a good password" autocomplete="off" tabindex="3" required>
        </div>
        <div class="form-input-row">
        <button type="submit" class="ActionButton" name="Register" tabindex="4">Register</button>
        </div>
        <div class="form-input-row">
        <p class="promptText">Already have Account? <a href="connect_it.php?state=login" class="LRredirect" tabindex="7">Login here</a></p>
        </div>
    </form>
<?php
} else {
    echo "<p>wtf?</p>";
}
?>
  <div class="extraBanner"></div>
  <div id="alertcard">
    <p id="alertcontent"></p>
    <div id="borderanimate"></div>
  </div>
  <script src="../scriptstuff/alert.js"></script>
  <?php
  if (!empty($errors)) {
    echo "<script> ";
    echo "alerter('"; foreach ($errors as $error) {echo $error .";";} echo "')";
    echo "</script>";
  }
  ?>
</body>
</html>