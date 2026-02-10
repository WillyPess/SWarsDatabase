<?php
session_start();
include_once('../../functions/functions.php');

$pdo = dbLink();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Characters | Star Wars Trilogy</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

<header>
    <h1>Star Wars Trilogy Database</h1>
    <?php navi('inner'); ?>
</header>

<main>

    <h2>Characters</h2>

    <img src="../../images/p2.jpg" alt="Star Wars Characters">

    <section class="characters-section">
        <p>
            Explore the most iconic characters from the original Star Wars trilogy.
            All information below is dynamically loaded from the database.
        </p>

        <?php listCharacters($pdo); ?>
    </section>

</main>

<footer>
    <p>© 2025 Star Wars Database Project | Created by Willy Pessoa</p>
</footer>

</body>
</html>
