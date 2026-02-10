<?php
session_start();
include_once('../../functions/functions.php');

$pdo = dbLink();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Planets | Star Wars Trilogy</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

<header>
    <h1>Star Wars Trilogy Database</h1>
    <?php navi('inner'); ?>
</header>

<main>

    <h2>Planets</h2>

    <img src="../../images/p4.jpg" alt="Star Wars Planets">

        <section class="planets-section">
            <?php listPlanets($pdo); ?>
        </section>

</main>

<footer>
    <p>© 2025 Star Wars Database Project | Created by Willy Pessoa</p>
</footer>

</body>
</html>
