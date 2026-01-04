<!-- sprawdzenie czy użytkownik jest zalogowany -->
<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
header("Location: /pages/home.php");
exit;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    Zalogowany: <b><?php echo htmlspecialchars($_SESSION['user']); ?></b> | <a href="logout.php">Wyloguj się</a>
    <hr>
    <form id="mainForm" method="POST" action="submit.php">
        <input name="message" id="mainMessage" required></textarea>
        <button type="submit">Wyślij</button>
    </form>
    <hr>
    <div id="comments">
        <?php
        $conn = new mysqli("localhost", "root", "", "messages", 3306, "/opt/lampp/var/mysql/mysql.sock");

        function displayComments($conn, $parent_id = NULL)
        {
            $sql = "SELECT id, name, message, created_at FROM messages WHERE " .
                ($parent_id === NULL ? "parent_id IS NULL" : "parent_id = ?") . " ORDER BY created_at DESC";
            $stmt = $conn->prepare($sql);
            if ($parent_id !== NULL) $stmt->bind_param("i", $parent_id);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                echo "<div style='margin-left:" . ($parent_id ? "30px" : "0") . "'>";
                echo "<p><b>" . htmlspecialchars($row['name']) . "</b> <small>(" . $row['created_at'] . ")</small><br>" . htmlspecialchars($row['message']) . "</p>";
                echo "<form class='replyForm' method='POST' action='submit.php' style='display:inline'>
              <input type='hidden' name='parent_id' value='{$row['id']}'>
              <input type='text' name='message' size='30' required>
              <button type='submit'>Odpowiedz</button>
              </form>";
                displayComments($conn, $row['id']);
                echo "</div>";
            }
        }

        displayComments($conn);
        $conn->close();
        ?>
    </div>
    <script src="script.js"></script>
</body>

</html>