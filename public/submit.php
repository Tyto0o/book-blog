<?php

$name = $_POST['name'];
$message = $_POST['message'];
$parent_id = isset($_POST['parent_id']) && $_POST['parent_id'] !== '' ? $_POST['parent_id'] : NULL;

$host = "localhost";
$user = "root";
$pass = "";
$db   = "messages";
$port = 3306;
$socket = "/opt/lampp/var/mysql/mysql.sock";

$conn = new mysqli($host, $user, $pass, $db, $port, $socket);

if ($parent_id !== NULL) {
    $stmt = $conn->prepare("INSERT INTO messages (name, message, parent_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $message, $parent_id);
} else {
    $stmt = $conn->prepare("INSERT INTO messages (name, message, parent_id) VALUES (?, ?, NULL)");
    $stmt->bind_param("ss", $name, $message);
}

$stmt->execute();
$new_id = $conn->insert_id;
$stmt->close();
$conn->close();

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    echo json_encode(['id' => $new_id]);
} else {
    header("Location: index.php");
}
