<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$name = $_SESSION['user'];
$message = $_POST['message'];
$parent_id = isset($_POST['parent_id']) && $_POST['parent_id'] !== '' ? $_POST['parent_id'] : NULL;
$book_id = isset($_POST['book_id']) && $_POST['book_id'] !== '' ? $_POST['book_id'] : NULL;

$host = "localhost";
$user = "root";
$pass = "";
$db   = "messages";
$port = 3306;
$socket = "/opt/lampp/var/mysql/mysql.sock";

$conn = new mysqli($host, $user, $pass, $db, $port, $socket);

if ($parent_id !== NULL) {
    $stmt = $conn->prepare("INSERT INTO messages (name, message, parent_id, book_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $name, $message, $parent_id, $book_id);
} else {
    $stmt = $conn->prepare("INSERT INTO messages (name, message, book_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $message, $book_id);
}

$stmt->execute();
$new_id = $conn->insert_id;
$stmt->close();

// Pobierz utworzony komentarz
$stmt = $conn->prepare("SELECT id, name, message, created_at FROM messages WHERE id = ?");
$stmt->bind_param("i", $new_id);
$stmt->execute();
$result = $stmt->get_result();
$comment = $result->fetch_assoc();
$stmt->close();
$conn->close();

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    echo json_encode([
        'id' => $new_id,
        'name' => $comment['name'],
        'message' => $comment['message'],
        'created_at' => strtotime($comment['created_at'])
    ]);
} else {
    if ($book_id) {
        header("Location: /pages/book.php?id=" . $book_id);
    } else {
        header("Location: /pages/home.php");
    }
}
