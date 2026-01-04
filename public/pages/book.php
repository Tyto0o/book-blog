<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /login.php");
    exit;
}

$book_id = isset($_GET['id']) ? intval($_GET['id']) : 1;

$books = [
    1 => ['title' => 'Atomic Habits', 'author' => 'James Clear', 'image' => 'atomic-habits.jpg'],
    2 => ['title' => 'Thinking, Fast and Slow', 'author' => 'Daniel Kahneman', 'image' => 'thinking-fast-and-slow.jpg'],
    3 => ['title' => 'The Power of Now', 'author' => 'Eckhart Tolle', 'image' => 'the-power-of-now.jpeg'],
    4 => ['title' => 'Man\'s Search for Meaning', 'author' => 'Viktor Frankl', 'image' => 'mans-search-for-meaning.jpg'],
    5 => ['title' => 'The 5am Club', 'author' => 'Robin Sharma', 'image' => 'the-5am-club.jpg'],
];

$book = $books[$book_id] ?? $books[1];
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($book['title']) ?> - Opinie</title>
    <link rel="stylesheet" href="/styles.css">
</head>

<body>
    <?php include '../components/nav.php'; ?>

    <main class="container">
        <div class="book-header">
            <h1><?= htmlspecialchars($book['title']) ?></h1>
            <p class="author"><?= htmlspecialchars($book['author']) ?></p>
            <img src="/images/<?= $book['image'] ?>" alt="<?= htmlspecialchars($book['title']) ?>" class="book-cover-large">
        </div>

        <section class="comments-section">
            <h2>Dodaj swoją opinię</h2>
            <form id="mainForm" method="POST" action="/submit.php">
                <input type="hidden" name="book_id" value="<?= $book_id ?>">
                <textarea name="message" id="mainMessage" placeholder="Podziel się swoją opinią o książce..." required></textarea>
                <button type="submit" class="btn">Wyślij opinię</button>
            </form>

            <h2>Opinie czytelników</h2>
            <div id="comments">
                <?php
                $conn = new mysqli("localhost", "root", "", "messages", 3306, "/opt/lampp/var/mysql/mysql.sock");

                function countReplies($conn, $book_id, $parent_id)
                {
                    $sql = "SELECT COUNT(*) as count FROM messages WHERE book_id = ? AND parent_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ii", $book_id, $parent_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    return $row['count'];
                }

                function displayComments($conn, $book_id, $parent_id = NULL)
                {
                    $sql = "SELECT id, name, message, created_at FROM messages WHERE book_id = ? AND " .
                        ($parent_id === NULL ? "parent_id IS NULL" : "parent_id = ?") . " ORDER BY created_at DESC";
                    $stmt = $conn->prepare($sql);
                    if ($parent_id === NULL) {
                        $stmt->bind_param("i", $book_id);
                    } else {
                        $stmt->bind_param("ii", $book_id, $parent_id);
                    }
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows === 0 && $parent_id === NULL) {
                        echo "<p class='no-comments'>Brak opinii. Bądź pierwszy!</p>";
                    }

                    while ($row = $result->fetch_assoc()) {
                        $repliesCount = countReplies($conn, $book_id, $row['id']);
                        echo "<div class='comment' style='margin-left:" . ($parent_id ? "30px" : "0") . "'>";
                        echo "<div class='comment-header'>";
                        echo "<strong>" . htmlspecialchars($row['name']) . "</strong>";
                        echo "<small class='time-ago' data-time='" . strtotime($row['created_at']) . "'></small>";
                        echo "</div>";
                        echo "<p>" . nl2br(htmlspecialchars($row['message'])) . "</p>";
                        echo "<div class='comment-actions'>";
                        echo "<button class='btn-link btn-reply' onclick='toggleReplyForm(this)'>Odpowiedz</button>";
                        if ($repliesCount > 0) {
                            echo "<button class='btn-link btn-show-replies' onclick='toggleReplies(this)'>Pokaż odpowiedzi ($repliesCount)</button>";
                        }
                        echo "</div>";
                        echo "<form class='replyForm' style='display:none' method='POST' action='/submit.php'>
                            <input type='hidden' name='parent_id' value='{$row['id']}'>
                            <input type='hidden' name='book_id' value='$book_id'>
                            <input type='text' name='message' placeholder='Odpowiedz...' required>
                            <button type='submit' class='btn btn-small'>Wyślij</button>
                        </form>";
                        echo "<div class='replies' style='display:none'>";
                        displayComments($conn, $book_id, $row['id']);
                        echo "</div>";
                        echo "</div>";
                    }
                }

                displayComments($conn, $book_id);
                $conn->close();
                ?>
            </div>
        </section>
    </main>
    <script src="/script.js"></script>
</body>

</html>