<?php
include_once('../../functions/functions.php');

$pdo = dbLink();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Alien Races | Star Wars Trilogy</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

<header>
    <h1>Star Wars Trilogy Database</h1>
    <?php navi('inner'); ?>
</header>

<main>

    <h2>Alien Races</h2>

    <img src="../../images/p1.jpg" alt="Alien Races">

    <section class="alien-section">
        <?php listAlienraces($pdo); ?>
    </section>

</main>

<footer>
    <p>© 2025 Star Wars Database Project | Created by Willy Pessoa</p>
</footer>

</body>
</html>
