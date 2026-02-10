<?php
session_start();
include_once('../../functions/functions.php');

$pdo = dbLink();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ships | Star Wars Trilogy</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

<header>
    <h1>Star Wars Trilogy Database</h1>
    <?php navi('inner'); ?>
</header>

<main>

    <h2>Ships</h2>

    <img src="../../images/p3.jpg" alt="Star Wars Ships">

    <section class="ships-section">
        <p>
            Explore the iconic starships from the Star Wars universe.
            All ships listed below are dynamically loaded from the database.
        </p>

        <?php listShips($pdo); ?>
    </section>

</main>

<footer>
    <p>© 2025 Star Wars Database Project | Created by Willy Pessoa</p>
</footer>

</body>
</html>
