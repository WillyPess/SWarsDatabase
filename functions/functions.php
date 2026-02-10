<?php
// ===============================
// DATABASE CONNECTION (PDO)
// ===============================
function dbLink(){
    $db_user = 'mri';
    $db_pass = 'password';
    $db_host = 'localhost';
    $db      = 'star_wars_ot';

    try {
        $db = new PDO("mysql:host=$db_host;dbname=$db", $db_user, $db_pass);
    } catch (Exception $e){
        echo 'Unable to access database';
        exit;
    }

    error_reporting(0);
    return $db;
}


// =====================================
// LOGIN VALIDATION
// =====================================
function validate($pdo, $user, $pass) {

    $sql = "SELECT * FROM users WHERE username = :u LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':u', $user);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        if ($pass === $row['password']) {
            $_SESSION['auth'] = true;
            $_SESSION['id']   = $row['id'];
            return true;
        }
    }

    $_SESSION['auth'] = false;
    return false;
}


// =====================================
// NAVIGATION BAR
// =====================================
function navi(string $page = ''): void {

    $auth = !empty($_SESSION['auth']);
    $isInner = ($page === 'inner');

    $pre  = $isInner ? "../"  : "pages/";
    $home = $isInner ? "../../index.php" : "index.php";

    echo "<nav><ul>";

    echo "<li><a href='{$home}'>Home</a></li>";
    echo "<li><a href='{$pre}Generic Public Pages/movies.php'>Movies</a></li>";
    echo "<li><a href='{$pre}Generic Public Pages/characters.php'>Characters</a></li>";
    echo "<li><a href='{$pre}Generic Public Pages/ships.php'>Ships</a></li>";
    echo "<li><a href='{$pre}Generic Public Pages/planets.php'>Planets</a></li>";
    echo "<li><a href='{$pre}Generic Public Pages/force.php'>The Force</a></li>";
    echo "<li><a href='{$pre}Generic Public Pages/jedi.php'>Jedi</a></li>";
    echo "<li><a href='{$pre}Generic Public Pages/sith.php'>Sith</a></li>";
    echo "<li><a href='{$pre}Generic Public Pages/alienraces.php'>Alien Races</a></li>";

    if ($auth) {
        echo "<li><a href='{$pre}Generic Private Admin Pages/admin-dashboard.php'>Dashboard</a></li>";
        echo "<li><a href='{$pre}Generic Private Admin Pages/logout.php'>Logout</a></li>";
    } else {
        echo "<li><a href='{$pre}Generic Public Pages/admin-login.php'>Admin/Login</a></li>";
    }

    echo "</ul></nav>";
}


// -------------------------------
// MOVIES
// -------------------------------
function listMovie($dbConnect){
    $sql = "SELECT * FROM movies";

    foreach ($dbConnect->query($sql) as $row)
    {
        echo "<br>" . $row['title'] . " ";
    }
}

function showInformation($dbConnect, $id){
    $sql = "SELECT * FROM movies WHERE id = :id";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        echo "<h3>" . $row['title'] . "</h3>";
        echo "<p>Year: " . $row['release_year'] . "</p>";
        echo "<p>Director: " . $row['director'] . "</p>";
        echo "<p>Producer: " . $row['producer'] . "</p>";
        echo "<p>Runtime: " . $row['runtime_min'] . " minutes</p>";
        echo "<p>Summary: " . $row['summary'] . "</p>";
    }
}

function delItem($dbConnect, $id){
    $sql = "DELETE FROM movies WHERE id = :id";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

function updateDetails($dbConnect, $id, $details, $field){
    if ($field === 'title') {
        $sql = "UPDATE movies SET title = :det WHERE id = :edid";
    } elseif ($field === 'release_year') {
        $sql = "UPDATE movies SET release_year = :det WHERE id = :edid";
    } elseif ($field === 'director') {
        $sql = "UPDATE movies SET director = :det WHERE id = :edid";
    } elseif ($field === 'producer') {
        $sql = "UPDATE movies SET producer = :det WHERE id = :edid";
    } elseif ($field === 'runtime_min') {
        $sql = "UPDATE movies SET runtime_min = :det WHERE id = :edid";
    } elseif ($field === 'synopsis') {
        $sql = "UPDATE movies SET synopsis = :det WHERE id = :edid";
    } elseif ($field === 'summary') {
        $sql = "UPDATE movies SET summary = :det WHERE id = :edid";
    } else {
        return;
    }

    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':det', $details);
    $stmt->bindValue(':edid', $id, PDO::PARAM_INT);
    $stmt->execute();
} 

function addMovie($dbConnect, $title, $release_year, $director, $producer, $runtime_min, $synopsis, $summary){
    $sql = "INSERT INTO movies (title, release_year, director, producer, runtime_min, synopsis, summary) VALUES (:title, :ry, :dir, :prod, :rt, :syn, :sum)";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':title', $title);
    $stmt->bindValue(':ry', $release_year);
    $stmt->bindValue(':dir', $director);
    $stmt->bindValue(':prod', $producer);
    $stmt->bindValue(':rt', $runtime_min);
    $stmt->bindValue(':syn', $synopsis);
    $stmt->bindValue(':sum', $summary);
    $stmt->execute();
} 

function adminListMovies($dbConnect){
    $sql = "SELECT * FROM movies";
    echo "<table class='admin-table'><thead><tr><th>Title</th><th>Year</th><th>Director</th><th>Actions</th></tr></thead><tbody>";
    foreach ($dbConnect->query($sql) as $row){
        echo "<tr>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['release_year'] . "</td>";
        echo "<td>" . $row['director'] . "</td>";
        echo "<td class='actions'><a href='admin-edit.php?table=movies&id=" . $row['id'] . "' class='edit-btn'>Edit</a> <a href='admin-resolvedelete.php?table=movies&id=" . $row['id'] . "' class='delete-btn'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}

// -------------------------------
// CHARACTERS
// -------------------------------
function listCharacters($dbConnect){
    $sql = "SELECT * FROM characters";
    foreach ($dbConnect->query($sql) as $row){
        echo "<br>" . $row['name'] . " ";
        echo '<a href="viewcharacter.php?id=' . $row['id'] . '">[View Details]</a>';
    }
}

function showCharacterInformation($dbConnect, $id){
    $sql = "SELECT * FROM characters WHERE id = :id";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row){
        echo "<h3>" . $row['name'] . "</h3>";
        echo "<p>Affiliation: " . $row['affiliation'] . "</p>";
        echo "<p>Homeworld: " . $row['homeworld'] . "</p>";
        echo "<p>Bio: " . $row['biography'] . "</p>";
    }
}

function delCharacter($dbConnect, $id){
    $sql = "DELETE FROM characters WHERE id = :id";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
} 

function updateCharacterDetails($dbConnect, $id, $details, $field){
    if ($field === 'name') {
        $sql = "UPDATE characters SET name = :det WHERE id = :edid";
    } elseif ($field === 'affiliation') {
        $sql = "UPDATE characters SET affiliation = :det WHERE id = :edid";
    } elseif ($field === 'homeworld') {
        $sql = "UPDATE characters SET homeworld = :det WHERE id = :edid";
    } elseif ($field === 'biography') {
        $sql = "UPDATE characters SET biography = :det WHERE id = :edid";
    } else {
        return;
    }
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':det', $details);
    $stmt->bindValue(':edid', $id, PDO::PARAM_INT);
    $stmt->execute();
} 

function addCharacter($dbConnect, $name, $affiliation, $homeworld, $biography){
    $sql = "INSERT INTO characters (name, affiliation, homeworld, biography) VALUES (:n, :a, :h, :b)";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':n', $name);
    $stmt->bindValue(':a', $affiliation);
    $stmt->bindValue(':h', $homeworld);
    $stmt->bindValue(':b', $biography);
    $stmt->execute();
} 

function adminListCharacters($dbConnect){
    $sql = "SELECT * FROM characters";
    echo "<table class='admin-table'><thead><tr><th>Name</th><th>Affiliation</th><th>Homeworld</th><th>Actions</th></tr></thead><tbody>";
    foreach ($dbConnect->query($sql) as $row){
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['affiliation'] . "</td>";
        echo "<td>" . $row['homeworld'] . "</td>";
        echo "<td class='actions'><a href='admin-edit.php?table=characters&id=" . $row['id'] . "' class='edit-btn'>Edit</a> <a href='admin-resolvedelete.php?table=characters&id=" . $row['id'] . "' class='delete-btn'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}

// -------------------------------
// SHIPS
// -------------------------------
function listShips($dbConnect){
    $sql = "SELECT * FROM ships";
    foreach ($dbConnect->query($sql) as $row){
        echo "<br>" . $row['name'] . " - " . $row['model'];
    }
}

function showShipInformation($dbConnect, $id){
    $sql = "SELECT * FROM ships WHERE id = :id";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row){
        echo "<h3>" . $row['name'] . "</h3>";
        echo "<p>Model: " . $row['model'] . "</p>";
        echo "<p>Manufacturer: " . $row['manufacturer'] . "</p>";
    }
}

function delShip($dbConnect, $id){
    $sql = "DELETE FROM ships WHERE id = :id";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
} 

function updateShipDetails($dbConnect, $id, $details, $field){
    if ($field === 'name') {
        $sql = "UPDATE ships SET name = :det WHERE id = :edid";
    } elseif ($field === 'model') {
        $sql = "UPDATE ships SET model = :det WHERE id = :edid";
    } elseif ($field === 'manufacturer') {
        $sql = "UPDATE ships SET manufacturer = :det WHERE id = :edid";
    } elseif ($field === 'ship_class') {
        $sql = "UPDATE ships SET ship_class = :det WHERE id = :edid";
    } elseif ($field === 'crew') {
        $sql = "UPDATE ships SET crew = :det WHERE id = :edid";
    } elseif ($field === 'description') {
        $sql = "UPDATE ships SET description = :det WHERE id = :edid";
    } else {
        return;
    }
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':det', $details);
    $stmt->bindValue(':edid', $id, PDO::PARAM_INT);
    $stmt->execute();
} 

function addShip($dbConnect, $name, $model, $manufacturer, $ship_class, $crew, $description){
    $sql = "INSERT INTO ships (name, model, manufacturer, ship_class, crew, description) VALUES (:n, :m, :man, :class, :crew, :desc)";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':n', $name);
    $stmt->bindValue(':m', $model);
    $stmt->bindValue(':man', $manufacturer);
    $stmt->bindValue(':class', $ship_class);
    $stmt->bindValue(':crew', $crew);
    $stmt->bindValue(':desc', $description);
    $stmt->execute();
} 

function adminListShips($dbConnect){
    $sql = "SELECT * FROM ships";
    echo "<table class='admin-table'><thead><tr><th>Name</th><th>Model</th><th>Manufacturer</th><th>Actions</th></tr></thead><tbody>";
    foreach ($dbConnect->query($sql) as $row){
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['model'] . "</td>";
        echo "<td>" . $row['manufacturer'] . "</td>";
        echo "<td class='actions'><a href='admin-edit.php?table=ships&id=" . $row['id'] . "' class='edit-btn'>Edit</a> <a href='admin-resolvedelete.php?table=ships&id=" . $row['id'] . "' class='delete-btn'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}

// -------------------------------
// PLANETS
// -------------------------------
function listPlanets($dbConnect){
    $sql = "SELECT * FROM planets";
    foreach ($dbConnect->query($sql) as $row){
        echo "<br>" . $row['name'] . " - " . $row['region'];
    }
}

function showPlanetInformation($dbConnect, $id){
    $sql = "SELECT * FROM planets WHERE id = :id";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row){
        echo "<h3>" . $row['name'] . "</h3>";
        echo "<p>Region: " . $row['region'] . "</p>";
        echo "<p>Climate: " . $row['climate'] . "</p>";
    }
}

function delPlanet($dbConnect, $id){
    $sql = "DELETE FROM planets WHERE id = :id";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
} 

function updatePlanetDetails($dbConnect, $id, $details, $field){
    if ($field === 'name') {
        $sql = "UPDATE planets SET name = :det WHERE id = :edid";
    } elseif ($field === 'region') {
        $sql = "UPDATE planets SET region = :det WHERE id = :edid";
    } elseif ($field === 'climate') {
        $sql = "UPDATE planets SET climate = :det WHERE id = :edid";
    } elseif ($field === 'population') {
        $sql = "UPDATE planets SET population = :det WHERE id = :edid";
    } elseif ($field === 'description') {
        $sql = "UPDATE planets SET description = :det WHERE id = :edid";
    } else {
        return;
    }
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':det', $details);
    $stmt->bindValue(':edid', $id, PDO::PARAM_INT);
    $stmt->execute();
} 

function addPlanet($dbConnect, $name, $region, $climate, $population, $description){
    $sql = "INSERT INTO planets (name, region, climate, population, description) VALUES (:n, :r, :c, :p, :d)";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':n', $name);
    $stmt->bindValue(':r', $region);
    $stmt->bindValue(':c', $climate);
    $stmt->bindValue(':p', $population);
    $stmt->bindValue(':d', $description);
    $stmt->execute();
} 

function adminListPlanets($dbConnect){
    $sql = "SELECT * FROM planets";
    echo "<table class='admin-table'><thead><tr><th>Name</th><th>Region</th><th>Climate</th><th>Actions</th></tr></thead><tbody>";
    foreach ($dbConnect->query($sql) as $row){
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['region'] . "</td>";
        echo "<td>" . $row['climate'] . "</td>";
        echo "<td class='actions'><a href='admin-edit.php?table=planets&id=" . $row['id'] . "' class='edit-btn'>Edit</a> <a href='admin-resolvedelete.php?table=planets&id=" . $row['id'] . "' class='delete-btn'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}

// -------------------------------
// JEDI
// -------------------------------
function listJedi($dbConnect){
    $sql = "SELECT * FROM jedi";
    foreach ($dbConnect->query($sql) as $row){
        echo "<br>" . $row['name'] . " - " . $row['rank'];
    }
}

function showJediInformation($dbConnect, $id){
    $sql = "SELECT * FROM jedi WHERE id = :id";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row){
        echo "<h3>" . $row['name'] . "</h3>";
        echo "<p>Rank: " . $row['rank'] . "</p>";
    }
}

function delJedi($dbConnect, $id){
    $sql = "DELETE FROM jedi WHERE id = :id";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
} 

function updateJediDetails($dbConnect, $id, $details, $field){
    if ($field === 'name') {
        $sql = "UPDATE jedi SET name = :det WHERE id = :edid";
    } elseif ($field === 'rank') {
        $sql = "UPDATE jedi SET rank = :det WHERE id = :edid";
    } elseif ($field === 'lightsaber_color') {
        $sql = "UPDATE jedi SET lightsaber_color = :det WHERE id = :edid";
    } elseif ($field === 'biography') {
        $sql = "UPDATE jedi SET biography = :det WHERE id = :edid";
    } else {
        return;
    }
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':det', $details);
    $stmt->bindValue(':edid', $id, PDO::PARAM_INT);
    $stmt->execute();
} 

function addJedi($dbConnect, $name, $rank, $lightsaber_color, $biography){
    $sql = "INSERT INTO jedi (name, rank, lightsaber_color, biography) VALUES (:n, :r, :lc, :b)";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':n', $name);
    $stmt->bindValue(':r', $rank);
    $stmt->bindValue(':lc', $lightsaber_color);
    $stmt->bindValue(':b', $biography);
    $stmt->execute();
} 

function adminListJedi($dbConnect){
    $sql = "SELECT * FROM jedi";
    echo "<table class='admin-table'><thead><tr><th>Name</th><th>Rank</th><th>Actions</th></tr></thead><tbody>";
    foreach ($dbConnect->query($sql) as $row){
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['rank'] . "</td>";
        echo "<td class='actions'><a href='admin-edit.php?table=jedi&id=" . $row['id'] . "' class='edit-btn'>Edit</a> <a href='admin-resolvedelete.php?table=jedi&id=" . $row['id'] . "' class='delete-btn'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}

// -------------------------------
// SITH
// -------------------------------
function listSith($dbConnect){
    $sql = "SELECT * FROM sith";
    foreach ($dbConnect->query($sql) as $row){
        echo "<br>" . $row['name'] . " - " . $row['title'];
    }
}

function showSithInformation($dbConnect, $id){
    $sql = "SELECT * FROM sith WHERE id = :id";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row){
        echo "<h3>" . $row['name'] . "</h3>";
        echo "<p>Title: " . $row['title'] . "</p>";
    }
}

function delSith($dbConnect, $id){
    $sql = "DELETE FROM sith WHERE id = :id";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
} 

function updateSithDetails($dbConnect, $id, $details, $field){
    if ($field === 'name') {
        $sql = "UPDATE sith SET name = :det WHERE id = :edid";
    } elseif ($field === 'title') {
        $sql = "UPDATE sith SET title = :det WHERE id = :edid";
    } elseif ($field === 'apprentice') {
        $sql = "UPDATE sith SET apprentice = :det WHERE id = :edid";
    } elseif ($field === 'power') {
        $sql = "UPDATE sith SET power = :det WHERE id = :edid";
    } elseif ($field === 'description') {
        $sql = "UPDATE sith SET description = :det WHERE id = :edid";
    } else {
        return;
    }
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':det', $details);
    $stmt->bindValue(':edid', $id, PDO::PARAM_INT);
    $stmt->execute();
} 

function addSith($dbConnect, $name, $title, $apprentice, $power, $description){
    $sql = "INSERT INTO sith (name, title, apprentice, power, description) VALUES (:n, :t, :a, :p, :d)";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':n', $name);
    $stmt->bindValue(':t', $title);
    $stmt->bindValue(':a', $apprentice);
    $stmt->bindValue(':p', $power);
    $stmt->bindValue(':d', $description);
    $stmt->execute();
} 

function adminListSith($dbConnect){
    $sql = "SELECT * FROM sith";
    echo "<table class='admin-table'><thead><tr><th>Name</th><th>Title</th><th>Actions</th></tr></thead><tbody>";
    foreach ($dbConnect->query($sql) as $row){
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td class='actions'><a href='admin-edit.php?table=sith&id=" . $row['id'] . "' class='edit-btn'>Edit</a> <a href='admin-resolvedelete.php?table=sith&id=" . $row['id'] . "' class='delete-btn'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}

// -------------------------------
// ALIEN RACES
// -------------------------------
function listAlienraces($dbConnect){
    $sql = "SELECT * FROM alien_races";
    foreach ($dbConnect->query($sql) as $row){
        echo "<br>" . $row['name'] . " - " . $row['homeworld'];
    }
}

function showAlienraceInformation($dbConnect, $id){
    $sql = "SELECT * FROM alien_races WHERE id = :id";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row){
        echo "<h3>" . $row['name'] . "</h3>";
        echo "<p>Average Height: " . $row['average_height_cm'] . " cm</p>";
        echo "<p>Homeworld: " . $row['homeworld'] . "</p>";
    }
}

function delAlienrace($dbConnect, $id){
    $sql = "DELETE FROM alien_races WHERE id = :id";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
} 

function updateAlienraceDetails($dbConnect, $id, $details, $field){
    if ($field === 'name') {
        $sql = "UPDATE alien_races SET name = :det WHERE id = :edid";
    } elseif ($field === 'average_height_cm') {
        $sql = "UPDATE alien_races SET average_height_cm = :det WHERE id = :edid";
    } elseif ($field === 'homeworld') {
        $sql = "UPDATE alien_races SET homeworld = :det WHERE id = :edid";
    } elseif ($field === 'language') {
        $sql = "UPDATE alien_races SET language = :det WHERE id = :edid";
    } elseif ($field === 'description') {
        $sql = "UPDATE alien_races SET description = :det WHERE id = :edid";
    } else {
        return;
    }
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':det', $details);
    $stmt->bindValue(':edid', $id, PDO::PARAM_INT);
    $stmt->execute();
} 

function addAlienrace($dbConnect, $name, $average_height_cm, $homeworld, $language, $description){
    $sql = "INSERT INTO alien_races (name, average_height_cm, homeworld, language, description) VALUES (:n, :hcm, :hw, :lang, :d)";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindValue(':n', $name);
    $stmt->bindValue(':hcm', $average_height_cm);
    $stmt->bindValue(':hw', $homeworld);
    $stmt->bindValue(':lang', $language);
    $stmt->bindValue(':d', $description);
    $stmt->execute();
} 

function adminListAlienraces($dbConnect){
    $sql = "SELECT * FROM alien_races";
    echo "<table class='admin-table'><thead><tr><th>Name</th><th>Homeworld</th><th>Language</th><th>Actions</th></tr></thead><tbody>";
    foreach ($dbConnect->query($sql) as $row){
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['homeworld'] . "</td>";
        echo "<td>" . $row['language'] . "</td>";
        echo "<td class='actions'><a href='admin-edit.php?table=alien_races&id=" . $row['id'] . "' class='edit-btn'>Edit</a> <a href='admin-resolvedelete.php?table=alien_races&id=" . $row['id'] . "' class='delete-btn'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}

// -------------------------------
// THE FORCE (public simple list)
// -------------------------------
function listTheForce($dbConnect){
    $sql = "SELECT * FROM the_force";
    foreach ($dbConnect->query($sql) as $row){
        echo "<h3>" . $row['topic'] . "</h3>";
        echo "<p>" . $row['description'] . "</p>";
    }
}
?>
