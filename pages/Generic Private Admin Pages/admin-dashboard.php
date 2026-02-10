<?php
session_start();
include_once("../../functions/functions.php");

if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header("Location: ../Generic Public Pages/admin-login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Star Wars Trilogy</title>
    <link rel="stylesheet" href="../../css/style.css">
    <script src="../js/script.js" defer></script>
</head>

<body>

<header>
    <h1>Star Wars Trilogy Admin Dashboard</h1>
    <?php navi('inner'); ?>
</header>

<main>

    <h2>Welcome, Admin</h2>

    <section class="admin-links">
        <a href="admin-movies.php">Manage Movies</a>
        <a href="admin-characters.php">Manage Characters</a>
        <a href="admin-ships.php">Manage Ships</a>
        <a href="admin-planets.php">Manage Planets</a>
        <a href="admin-jedi.php">Manage Jedi</a>
        <a href="admin-sith.php">Manage Sith</a>
        <a href="admin-alienraces.php">Manage Alien Races</a>
    </section>
<section>
    <a href="logout.php" class="logout-btn">Logout</a>
</section>
</main>

<footer>
    <p>© 2025 Star Wars Database Project | Created by Willy Pessoa</p>
</footer>

</body>
</html>
