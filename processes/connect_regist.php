<?php
require_once 'database.php';
$errors = '';

if (isset($_POST['Register'])) {
    $profileTags = $_POST['tags'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $Email = $_POST['email'];
    $errors = [];
    if (empty($profileTags)) {
        $errors[] = "nobody can see you without your profile tags";
        $_SESSION['corsmsg'] = $errors;
    }
    if (empty($username)) {
        $errors[] = "Username empty dummy";
        $_SESSION['corsmsg'] = $errors;
    }
    if (empty($password)) {
        $errors[] = "You can't have an account without using password";
        $_SESSION['corsmsg'] = $errors;
    }
    if (empty($Email)) {
        $errors[] = "Email is empty, how will I notice you about your account later :(";
        $_SESSION['corsmsg'] = $errors;
    }
    if (empty($errors)) {
        $stmt_check = $connects->prepare("SELECT * FROM user WHERE username = ?");
        $stmt_check->bind_param("s", $username);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        if ($result_check->num_rows == 0) {
            $stmt_insert = $connects->prepare("INSERT INTO user (profileTags, username, password, Email) VALUES (?, ?, MD5(?), ?)");
            $stmt_insert->bind_param("ssss", $profileTags, $username, $password, $Email);
            if ($stmt_insert->execute()) {
                $_SESSION['corsmsg'] = 'Your registered data have been uploaded';
                header('location: ../forum-connect/connect_it.php?state=login');
            } else {
                $errors = "Registration failed: " . $stmt_insert->error;
            $_SESSION['corsmsg'] = $errors;
                header('location: ../forum-connect/connect_it.php?state=register');
            }
            $stmt_insert->close();
        } else {
            $errors = "Username taken, choose another";
            $_SESSION['corsmsg'] = $errors;
            header('location: ../forum-connect/connect_it.php?state=register');
        }

        $stmt_check->close();
    }
}

?>