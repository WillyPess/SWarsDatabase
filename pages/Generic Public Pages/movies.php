<?php
session_start();
include_once('../../functions/functions.php');

$pdo = dbLink();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Movies | Star Wars Trilogy</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

<header>
    <h1>Star Wars Trilogy Database</h1>
    <?php navi('inner'); ?>
</header>

<main>

    <h2>Movies</h2>

    <img src="../../images/slide3.jpg" alt="Star Wars Movies">

    <section class="movies-section">
        <?php listMovie($pdo); ?>
    </section>

</main>

<footer>
    <p>© 2025 Star Wars Database Project | Created by Willy Pessoa</p>
</footer>

</body>
</html>
