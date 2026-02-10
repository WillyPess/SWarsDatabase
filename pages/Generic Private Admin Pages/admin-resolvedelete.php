<?php
session_start();
include_once("../../functions/functions.php");

$table = $_GET['table'];
$id    = (int) $_GET['id'];

$pdo = dbLink();

if ($table === 'movies') {
	delItem($pdo, $id);
} elseif ($table === 'characters') {
	delCharacter($pdo, $id);
} elseif ($table === 'ships') {
	delShip($pdo, $id);
} elseif ($table === 'planets') {
	delPlanet($pdo, $id);
} elseif ($table === 'jedi') {
	delJedi($pdo, $id);
} elseif ($table === 'sith') {
	delSith($pdo, $id);
} elseif ($table === 'alien_races') {
	delAlienrace($pdo, $id);
} else {
	// unknown table
}

// Convert table name for filename (remove underscores)
$filename = str_replace('_', '', $table);
header("Location: admin-$filename.php?deleted=1");
exit;
