<?php
require_once "../processes/database.php";
$state = $_GET['state'];
$errors = array();
session_start();
// if (isset($_SESSION['state']) === 'login' || isset($_SESSION['state']) === 'register') {
//   $states = $_SESSION['state'];
//   header ('location: connect_it.php?state=' . $states);
//   $_SESSION['state'] = '.';
// };
if (isset($_SESSION['thouSandsIds'])) {
    header ('location: ../TS/forum/dashboard.php');
    exit;
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styling/pallate.css">
    <link rel="stylesheet" href="../styling/connect_univ.css">
    <link rel="stylesheet" href="../styling/connect_forms.css">
<?php
if ($state === 'login') {
// $_SESSION['state'] = 'login';
?>
    <title>Connect Login</title>
</head>
<body class="LRContainer">
  <form class="EntryPanel" action="../processes/connect_login.php" method="post">
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
// $_SESSION['state'] = 'register';
?>
  <title>Connect Register</title>
</head>
<body class="LRContainer">
    <form class="EntryPanel" action="../processes/connect_regist.php" method="post">
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
  <div id="alertcard">
     <p id="alertcontent"></p>
    <div id="borderanimate"></div>
  </div>
  <script src="../scriptstuff/alert.js"></script>
  <?php
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