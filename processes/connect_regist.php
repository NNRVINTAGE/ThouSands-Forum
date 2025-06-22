<?php
require_once 'database.php';
$errors = array();

if (isset($_POST['Register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $Email = $_POST['Email'];
    $errors = [];
    if (empty($username)) {
        $errors[] = "Username empty dummy";
    }
    if (empty($password)) {
        $errors[] = "You can't have an account without using password";
    }
    if (empty($Email)) {
        $errors[] = "Email is empty, how will I notice you about your account later :(";
    }
    if (empty($errors)) {
        $stmt_check = $connect->prepare("SELECT * FROM user WHERE username = ?");
        $stmt_check->bind_param("s", $username);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows == 0) {
            $stmt_insert = $connect->prepare("INSERT INTO user (username, password, Email) VALUES (?, MD5(?), ?)");
            $stmt_insert->bind_param("sssss", $username, $password, $Email);
            if ($stmt_insert->execute()) {
                $_SESSION['corsmsg'] = 'Your registered data have been uploaded';
                echo "<script>window.location.replace('connect_it.php?state=login')</script>";
            } else {
                $errors[] = "Registration failed: " . $stmt_insert->error;
            }
            $stmt_insert->close();
        } else {
            $errors[] = "Username taken, choose another";
        }

        $stmt_check->close();
    }
}

?>