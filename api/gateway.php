<?php
require_once "../processes/database.php";
session_start();

$connect_token = $_GET['tokens'];
if (isset($connect_token)) {
    header("Content-Type:application/json");
    $method = $_SERVER['REQUEST_METHOD'];
    $input = json_decode(file_get_contents('php://input'), true);
    switch ($method) {
        case 'GET':
            if (isset($_GET['libsIds'])) {
                $libsIds = $_GET['libsIds'];
                $result = $connects->query("SELECT * FROM achievement WHERE libsIds=$libsIds ;");
                $data = $result->fetch_assoc();
                echo json_encode($data);
            } else {
                $throwback = "error missing prequisite";
                echo json_encode($throwback);
            }
            break;
        case 'POST':
            $libsIds = $input['libsIds'];
            $achievementIds = $input['achievementIds'];
            $userIds = $input['userIds'];
            $connects->query("INSERT INTO achieverlist (libsIds, achievementIds, userIds, dates) VALUES ('$libsIds', '$achievementIds', $userIds, NOW();)");
            echo json_encode(["message" => "achievement added successfully"]);
            break;
        case 'PUT':
            $id = $_GET['id'];
            $libsIds = $input['libsIds'];
            $achievementIds = $input['achievementIds'];
            $userIds = $input['userIds'];
            $connects->query("UPDATE achieverlist SET libsIds='$libsIds', achievementIds='$achievementIds' WHERE userIds=$userIds ;");
            echo json_encode(["messages" => "achievement updated successfully"]);
            break;
        default:
            echo json_encode(["message" => "Invalid request"]);
            break;
    }
    $connects->close();
} else {
    $throwback = "ERROR";
    echo json_encode($throwback);
}
?>