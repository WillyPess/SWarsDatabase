<?php
session_start();
include_once('../../functions/functions.php');

$pdo = dbLink();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>The Force | Star Wars Trilogy</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

<header>
    <h1>Star Wars Trilogy Database</h1>
    <?php navi('inner'); ?>
</header>

<main>

    <h2>The Force</h2>

    <img src="../../images/p5.jpg" alt="The Force">

    <section class="force-section">
        <p>
            The Force is a mystical energy field that connects all living things.
            Below is information dynamically loaded from the database.
        </p>

        <?php listTheForce($pdo); ?>
    </section>

</main>

<footer>
    <p>© 2025 Star Wars Database Project | Created by Willy Pessoa</p>
</footer>

</body>
</html>
