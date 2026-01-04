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
    <title>Cytaty - Blog o książkach</title>
    <link rel="stylesheet" href="/styles.css">
</head>

<body>
    <?php include '../components/nav.php'; ?>

    <main class="container">
        <h1>Inspirujące cytaty z książek</h1>

        <div class="quotes-list">
            <blockquote class="quote">
                <p>"Nie możesz kontrolować okoliczności, ale możesz kontrolować swoją reakcję na nie."</p>
                <cite>— Viktor Frankl, Man's Search for Meaning</cite>
            </blockquote>

            <blockquote class="quote">
                <p>"Nie jesteś swoimi myślami. Jesteś świadomością obserwującą te myśli."</p>
                <cite>— Eckhart Tolle, The Power of Now</cite>
            </blockquote>

            <blockquote class="quote">
                <p>"Nie wznosimy się do poziomu naszych celów. Spadamy do poziomu naszych systemów."</p>
                <cite>— James Clear, Atomic Habits</cite>
            </blockquote>

            <blockquote class="quote">
                <p>"Dążenie do szczęścia jest poważnym problemem filozoficznym. To pytanie o to, jak żyć."</p>
                <cite>— Daniel Kahneman, Thinking, Fast and Slow</cite>
            </blockquote>

            <blockquote class="quote">
                <p>"Odwaga to nie brak strachu. To raczej osąd, że coś innego jest ważniejsze niż strach."</p>
                <cite>— Brené Brown, Daring Greatly</cite>
            </blockquote>

            <blockquote class="quote">
                <p>"Głęboka praca to superpower w naszej coraz bardziej konkurencyjnej ekonomii wiedzy."</p>
                <cite>— Cal Newport, Deep Work</cite>
            </blockquote>

            <blockquote class="quote">
                <p>"W nastawieniu na rozwój wyzwania są ekscytujące, a nie groźne. Więc nie martw się, że coś się nie uda."</p>
                <cite>— Carol Dweck, Mindset</cite>
            </blockquote>

            <blockquote class="quote">
                <p>"Nie chodzi o to, co ci się przydarza, ale o to, jak na to reagujesz."</p>
                <cite>— Epiktet, Enchiridion</cite>
            </blockquote>

            <blockquote class="quote">
                <p>"Jedyną drogą do szczęścia jest przestać się martwić o rzeczy, które są poza kontrolą naszej woli."</p>
                <cite>— Marek Aureliusz, Rozmyślania</cite>
            </blockquote>

            <blockquote class="quote">
                <p>"Bycie wrażliwym nie jest słabością. To największa miara odwagi."</p>
                <cite>— Brené Brown</cite>
            </blockquote>
        </div>
    </main>
</body>

</html>