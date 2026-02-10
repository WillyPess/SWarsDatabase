<?php
session_start();
include_once("../../functions/functions.php");

if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header("Location: ../Generic Public Pages/admin-login.php");
    exit;
}

if (!isset($_GET['table']) || !isset($_GET['id'])) {
    die("Invalid edit request.");
}

$table = $_GET['table'];
$id    = (int) $_GET['id'];

$pdo = dbLink();

// Select record using an explicit table reference (no dynamic injection)
if ($table === 'movies') {
    $stmt = $pdo->prepare("SELECT * FROM movies WHERE id = :id");
} elseif ($table === 'characters') {
    $stmt = $pdo->prepare("SELECT * FROM characters WHERE id = :id");
} elseif ($table === 'ships') {
    $stmt = $pdo->prepare("SELECT * FROM ships WHERE id = :id");
} elseif ($table === 'planets') {
    $stmt = $pdo->prepare("SELECT * FROM planets WHERE id = :id");
} elseif ($table === 'jedi') {
    $stmt = $pdo->prepare("SELECT * FROM jedi WHERE id = :id");
} elseif ($table === 'sith') {
    $stmt = $pdo->prepare("SELECT * FROM sith WHERE id = :id");
} elseif ($table === 'alien_races') {
    $stmt = $pdo->prepare("SELECT * FROM alien_races WHERE id = :id");
} else {
    die("Invalid table selected.");
}

$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$stmt->execute();

$record = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$record) {
    die("Record not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Record</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

<header>
    <h1>Edit Record</h1>
    <?php navi('inner'); ?>
</header>

<main>

<div class="admin-form">

    <form method="post" action="admin-resolveupdate.php">

        <input type="hidden" name="table" value="<?php echo $table; ?>">
        <input type="hidden" name="id"    value="<?php echo $id; ?>">

        <?php foreach ($record as $col => $val): ?>
            <?php if ($col === "id") continue; ?>

            <label><?php echo ucfirst(str_replace("_", " ", $col)); ?></label>
            <input type="text" name="<?php echo $col; ?>" value="<?php echo htmlspecialchars($val); ?>" required>
        <?php endforeach; ?>

        <button class="admin-submit-btn">Update Record</button>

    </form>

</div>

</main>

<footer>
    <p>© 2025 Star Wars Database Project | Created by Willy Pessoa</p>
</footer>

</body>
</html>
