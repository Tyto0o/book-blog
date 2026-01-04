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
    <title>Popularni autorzy - Blog o książkach</title>
    <link rel="stylesheet" href="/styles.css">
</head>

<body>
    <?php include '../components/nav.php'; ?>

    <main class="container">
        <h1>Popularni autorzy książek o samorozwoju</h1>

        <div class="authors-list">
            <div class="author-card">
                <h2>James Clear</h2>
                <p>Ekspert w dziedzinie budowania nawyków. Autor bestsellerowego "Atomic Habits", który sprzedał się w ponad 15 milionach egzemplarzy. Jego praca koncentruje się na małych zmianach prowadzących do wielkich rezultatów.</p>
            </div>

            <div class="author-card">
                <h2>Daniel Kahneman</h2>
                <p>Psycholog i ekonomista, laureat Nagrody Nobla w dziedzinie ekonomii. Pionier psychologii poznawczej i ekonomii behawioralnej. Jego książka "Pułapki myślenia" rewolucjonizuje rozumienie procesów decyzyjnych.</p>
            </div>

            <div class="author-card">
                <h2>Brené Brown</h2>
                <p>Badaczka, profesor i autorka bestselerów o odwadze, wrażliwości i empatii. Jej wystąpienie TED Talk o wrażliwości obejrzano ponad 60 milionów razy. Specjalizuje się w tematyce autentyczności i całościowego życia.</p>
            </div>

            <div class="author-card">
                <h2>Cal Newport</h2>
                <p>Profesor informatyki i autor książek o produktywności i głębokiej pracy. Znany z koncepcji "Deep Work" i krytycznego spojrzenia na media społecznościowe. Propaguje skupienie i minimalizm cyfrowy.</p>
            </div>

            <div class="author-card">
                <h2>Carol Dweck</h2>
                <p>Psycholog z Stanford University, pionierka badań nad "growth mindset" (nastawieniem na rozwój). Jej teoria udowadnia, że inteligencja i talenty można rozwijać poprzez ciężką pracę i wytrwałość.</p>
            </div>

            <div class="author-card">
                <h2>Viktor Frankl</h2>
                <p>Psychiatra i neurolog, ocalały z Holokaustu. Twórca logoterapii - metody psychoterapeutycznej skupionej na poszukiwaniu sensu życia. Jego książka "Człowiek w poszukiwaniu sensu" to klasyka literatury psychologicznej.</p>
            </div>
        </div>
    </main>
</body>

</html>