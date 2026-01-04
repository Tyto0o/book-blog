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
    <link rel="stylesheet" href="/styles.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-box {
            background: #fff;
            padding: 3rem;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-box h1 {
            margin-bottom: 2rem;
        }

        .login-box input {
            display: block;
            margin: 1rem auto;
            width: 250px;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <h1>📚 BookBlog</h1>
        <form method="POST">
            <input type="text" name="login" placeholder="Login" required>
            <input type="password" name="password" placeholder="Hasło" required>
            <button type="submit" class="btn">Zaloguj</button>
        </form>
    </div>
</body>

</html>