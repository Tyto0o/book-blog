<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opinie o książkach - Blog o książkach</title>
    <link rel="stylesheet" href="/styles.css">
</head>

<body>
    <?php include '../components/nav.php'; ?>

    <main class="container">
        <h1>Opinie o książkach</h1>

        <div class="books-grid">
            <?php
            $books = [
                ['id' => 1, 'title' => 'Atomic Habits', 'author' => 'James Clear', 'desc' => 'Rewolucyjna metoda budowania dobrych nawyków i przełamywania złych', 'image' => 'atomic-habits.jpg'],
                ['id' => 2, 'title' => 'Thinking, Fast and Slow', 'author' => 'Daniel Kahneman', 'desc' => 'Laureat Nagrody Nobla wyjaśnia, jak myślimy i podejmujemy decyzje', 'image' => 'thinking-fast-and-slow.jpg'],
                ['id' => 3, 'title' => 'The Power of Now', 'author' => 'Eckhart Tolle', 'desc' => 'Praktyczny przewodnik po życiu w teraźniejszości', 'image' => 'the-power-of-now.jpeg'],
                ['id' => 4, 'title' => 'Man\'s Search for Meaning', 'author' => 'Viktor Frankl', 'desc' => 'Lekcje przetrwania i sensu życia z obozu koncentracyjnego', 'image' => 'mans-search-for-meaning.jpg'],
                ['id' => 5, 'title' => 'The 5am Club', 'author' => 'Robin Sharma', 'desc' => 'Rewolucyjna metoda poranka, która zmieni Twoje życie', 'image' => 'the-5am-club.jpg'],
            ];

            foreach ($books as $book): ?>
                <div class="book-card">
                    <img src="/images/<?= $book['image'] ?>" alt="<?= htmlspecialchars($book['title']) ?>" class="book-cover">
                    <h3><?= htmlspecialchars($book['title']) ?></h3>
                    <p class="author"><?= htmlspecialchars($book['author']) ?></p>
                    <p class="desc"><?= htmlspecialchars($book['desc']) ?></p>
                    <a href="/pages/book.php?id=<?= $book['id'] ?>" class="btn">Zobacz opinie</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>

</html>