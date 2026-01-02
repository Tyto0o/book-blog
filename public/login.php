<?php session_start();
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
if ($_POST) {
    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        $_SESSION['user'] = $_POST['login'];
        header("Location: index.php");
        exit;
    }
} ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    <form method="POST"><input type="text" name="login" placeholder="Login" required><input type="password" name="password" placeholder="Hasło" required><button type="submit">Zaloguj</button></form>
</body>

</html>