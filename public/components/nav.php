<nav class="navbar">
    <div class="nav-container">
        <a href="/pages/home.php" class="logo">📚 BookBlog</a>
        <ul class="nav-menu">
            <li><a href="/pages/home.php">Dlaczego warto?</a></li>
            <li><a href="/pages/opinions.php">Opinie</a></li>
            <li><a href="/pages/authors.php">Autorzy</a></li>
            <li><a href="/pages/quotes.php">Cytaty</a></li>
        </ul>
        <div class="nav-user">
            <span><?= htmlspecialchars($_SESSION['user']) ?></span>
            <a href="/logout.php" class="btn-logout">Wyloguj</a>
        </div>
    </div>
</nav>