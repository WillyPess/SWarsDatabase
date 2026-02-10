<?php
session_start();
include_once("../../functions/functions.php");

if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header("Location: ../Generic Public Pages/admin-login.php");
    exit;
}

if (!isset($_GET['table'])) {
    die("No table selected.");
}

$table = $_GET['table'];

$pdo = dbLink();
$cols = [];

// Explicit column lists per table (no dynamic injection)
if ($table === 'movies') {
    $cols = ['title','release_year','director','producer','runtime_min','synopsis','summary'];
} elseif ($table === 'characters') {
    $cols = ['name','affiliation','homeworld','biography'];
} elseif ($table === 'ships') {
    $cols = ['name','model','manufacturer','ship_class','crew','description'];
} elseif ($table === 'planets') {
    $cols = ['name','region','climate','population','description'];
} elseif ($table === 'jedi') {
    $cols = ['name','rank','lightsaber_color','biography'];
} elseif ($table === 'sith') {
    $cols = ['name','title','apprentice','power','description'];
} elseif ($table === 'alien_races') {
    $cols = ['name','average_height_cm','homeworld','language','description'];
} else {
    die('Invalid table selected.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Record</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

<header>
    <h1>Add Record</h1>
    <?php navi('inner'); ?>
</header>

<main>

<div class="admin-form">

<form method="post" action="admin-resolveadd.php">

    <input type="hidden" name="table" value="<?php echo $table; ?>">

    <?php foreach ($cols as $col): ?>
        <label><?php echo ucfirst(str_replace("_", " ", $col)); ?></label>
        <input type="text" name="<?php echo $col; ?>" required>
    <?php endforeach; ?>

    <button class="admin-submit-btn">Save</button>

</form>

</div>

</main>

<footer>
    <p>© 2025 Star Wars Database Project | Created by Willy Pessoa</p>
</footer>

</body>
</html>
