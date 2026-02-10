<?php
session_start();
include_once("../../functions/functions.php");

if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header("Location: ../Generic Public Pages/admin-login.php");
    exit;
}

if (!isset($_POST['table'])) {
    die("No table selected.");
}

$table = $_POST['table'];
$pdo   = dbLink();

$redirect_target = '';

if ($table === 'movies') {
    addMovie($pdo, $_POST['title'], $_POST['release_year'], $_POST['director'], $_POST['producer'], $_POST['runtime_min'], $_POST['synopsis'], $_POST['summary']);
    $redirect_target = 'movies';
} elseif ($table === 'characters') {
    addCharacter($pdo, $_POST['name'], $_POST['affiliation'], $_POST['homeworld'], $_POST['biography']);
    $redirect_target = 'characters';
} elseif ($table === 'ships') {
    addShip($pdo, $_POST['name'], $_POST['model'], $_POST['manufacturer'], $_POST['ship_class'], $_POST['crew'], $_POST['description']);
    $redirect_target = 'ships';
} elseif ($table === 'planets') {
    addPlanet($pdo, $_POST['name'], $_POST['region'], $_POST['climate'], $_POST['population'], $_POST['description']);
    $redirect_target = 'planets';
} elseif ($table === 'jedi') {
    addJedi($pdo, $_POST['name'], $_POST['rank'], $_POST['lightsaber_color'], $_POST['biography']);
    $redirect_target = 'jedi';
} elseif ($table === 'sith') {
    addSith($pdo, $_POST['name'], $_POST['title'], $_POST['apprentice'], $_POST['power'], $_POST['description']);
    $redirect_target = 'sith';
} elseif ($table === 'alien_races') {
    addAlienrace($pdo, $_POST['name'], $_POST['average_height_cm'], $_POST['homeworld'], $_POST['language'], $_POST['description']);
    $redirect_target = 'alien_races';
} else {
    // invalid table - stop silently
    exit;
}

// Redirect back to the admin listing for the table
$filename = str_replace('_', '', $redirect_target);
header("Location: admin-$filename.php");
exit;
