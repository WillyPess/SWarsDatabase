<?php
session_start();
include_once("../../functions/functions.php");

if (empty($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header("Location: ../Generic Public Pages/admin-login.php");
    exit;
}

$pdo = dbLink();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Planets | Star Wars Trilogy</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

<header>
    <h1>Manage Planets</h1>
    <?php navi('inner'); ?>
</header>

<main>

    <h2>Planets – Admin Area</h2>

    <div class="admin-add-btn">
        <a href="admin-add.php?table=planets">+ Add New Planet</a>
    </div>

    <?php adminListPlanets($pdo); ?>

</main>

<footer>
    <p>© 2025 Star Wars Database Project | Created by Willy Pessoa</p>
</footer>

</body>
</html>
