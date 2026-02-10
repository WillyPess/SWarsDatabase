<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include_once("../../functions/functions.php");

$dbConnect = dbLink();

if (!isset($_POST['table'])) {
	die('No table specified.');
}

$table = $_POST['table'];
$id = (int) $_POST['id'];

if ($table === 'movies') {
	updateDetails($dbConnect, $id, $_POST['title'], 'title');
	updateDetails($dbConnect, $id, $_POST['release_year'], 'release_year');
	updateDetails($dbConnect, $id, $_POST['director'], 'director');
	updateDetails($dbConnect, $id, $_POST['producer'], 'producer');
	updateDetails($dbConnect, $id, $_POST['runtime_min'], 'runtime_min');
	updateDetails($dbConnect, $id, $_POST['synopsis'], 'synopsis');
	updateDetails($dbConnect, $id, $_POST['summary'], 'summary');
} elseif ($table === 'characters') {
	updateCharacterDetails($dbConnect, $id, $_POST['name'], 'name');
	updateCharacterDetails($dbConnect, $id, $_POST['affiliation'], 'affiliation');
	updateCharacterDetails($dbConnect, $id, $_POST['homeworld'], 'homeworld');
	updateCharacterDetails($dbConnect, $id, $_POST['biography'], 'biography');
} elseif ($table === 'ships') {
	updateShipDetails($dbConnect, $id, $_POST['name'], 'name');
	updateShipDetails($dbConnect, $id, $_POST['model'], 'model');
	updateShipDetails($dbConnect, $id, $_POST['manufacturer'], 'manufacturer');
	updateShipDetails($dbConnect, $id, $_POST['ship_class'], 'ship_class');
	updateShipDetails($dbConnect, $id, $_POST['crew'], 'crew');
	updateShipDetails($dbConnect, $id, $_POST['description'], 'description');
} elseif ($table === 'planets') {
	updatePlanetDetails($dbConnect, $id, $_POST['name'], 'name');
	updatePlanetDetails($dbConnect, $id, $_POST['region'], 'region');
	updatePlanetDetails($dbConnect, $id, $_POST['climate'], 'climate');
	updatePlanetDetails($dbConnect, $id, $_POST['population'], 'population');
	updatePlanetDetails($dbConnect, $id, $_POST['description'], 'description');
} elseif ($table === 'jedi') {
	updateJediDetails($dbConnect, $id, $_POST['name'], 'name');
	updateJediDetails($dbConnect, $id, $_POST['rank'], 'rank');
	updateJediDetails($dbConnect, $id, $_POST['lightsaber_color'], 'lightsaber_color');
	updateJediDetails($dbConnect, $id, $_POST['biography'], 'biography');
} elseif ($table === 'sith') {
	updateSithDetails($dbConnect, $id, $_POST['name'], 'name');
	updateSithDetails($dbConnect, $id, $_POST['title'], 'title');
	updateSithDetails($dbConnect, $id, $_POST['apprentice'], 'apprentice');
	updateSithDetails($dbConnect, $id, $_POST['power'], 'power');
	updateSithDetails($dbConnect, $id, $_POST['description'], 'description');
} elseif ($table === 'alien_races') {
	updateAlienraceDetails($dbConnect, $id, $_POST['name'], 'name');
	updateAlienraceDetails($dbConnect, $id, $_POST['average_height_cm'], 'average_height_cm');
	updateAlienraceDetails($dbConnect, $id, $_POST['homeworld'], 'homeworld');
	updateAlienraceDetails($dbConnect, $id, $_POST['language'], 'language');
	updateAlienraceDetails($dbConnect, $id, $_POST['description'], 'description');
}

header('Location: index.php');
exit;
?>
