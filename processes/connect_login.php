<?php
require_once 'database.php';
$errors = array();

if (isset($_POST['Login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $errors = [];
    if (empty($username)) {
        $errors[] = "Username empty, wtf";
    }
    if (empty($password)) {
        $errors[] = "Where's yo password?";
    }
    if (empty($errors)) {
        $stmt_check_username = $connect->prepare("SELECT * FROM user WHERE username = ?");
        $stmt_check_username->bind_param("s", $username);
        $stmt_check_username->execute();    
        $result_check_username = $stmt_check_username->get_result();

        if ($result_check_username->num_rows == 1) {
            $stmt_check_password = $connect->prepare("SELECT * FROM user WHERE username = ? AND password = MD5(?)");
            $stmt_check_password->bind_param("ss", $username, $password);
            $stmt_check_password->execute();
            $result_check_password = $stmt_check_password->get_result();

            if ($result_check_password->num_rows == 1) {
                $value = $result_check_password->fetch_assoc();
                $id = $value['UserID'];
                $user = $value['username'];
                session_start();
                $_SESSION['thouSandsIds'] = $id;
                $_SESSION['username'] = $user;
                $_SESSION['corsmsg'] = 'Login Successful';
                header('location: ../TS/forum/dashboard.php');
                exit;
            } else {
                $errors[] = "Password Invalid, try again";
            }
            $stmt_check_password->close();
        } else {
            $errors[] = "User data inaccessible";
        }
        $stmt_check_username->close();
    }
}
?>
