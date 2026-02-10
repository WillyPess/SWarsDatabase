<?php
session_start();
include_once("../../functions/functions.php");

if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    exit("Not allowed");
}

if (!isset($_GET['table'])) {
    exit("No table selected.");
}

$table = preg_replace('/[^a-zA-Z0-9_]/', '', $_GET['table']);

$pdo = dbLink();

// Call a table-specific admin list function (no generic helpers)
if ($table === 'movies') {
    $pageTitle = 'Movies';
} elseif ($table === 'characters') {
    $pageTitle = 'Characters';
} elseif ($table === 'ships') {
    $pageTitle = 'Ships';
} elseif ($table === 'planets') {
    $pageTitle = 'Planets';
} elseif ($table === 'jedi') {
    $pageTitle = 'Jedi';
} elseif ($table === 'sith') {
    $pageTitle = 'Sith';
} elseif ($table === 'alien_races') {
    $pageTitle = 'Alien Races';
} else {
    exit('Invalid table');
}

?>
    <title>Manage <?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

<header>
    <h1>Manage <?php echo ucfirst($table); ?></h1>
    <?php navi('inner'); ?>
</header>

<main>

    <h2><?php echo ucfirst($table); ?> – Admin Area</h2>

    <div class="admin-add-btn">
        <a href="admin-add.php?table=<?php echo $table; ?>">+ Add New</a>
    </div>

    <?php
        if ($table === 'movies') adminListMovies($pdo);
        if ($table === 'characters') adminListCharacters($pdo);
        if ($table === 'ships') adminListShips($pdo);
        if ($table === 'planets') adminListPlanets($pdo);
        if ($table === 'jedi') adminListJedi($pdo);
        if ($table === 'sith') adminListSith($pdo);
        if ($table === 'alien_races') adminListAlienraces($pdo);
    ?>

</main>

<footer>
    <p>© 2025 Star Wars Database Project | Created by Willy Pessoa</p>
</footer>

</body>
</html>
