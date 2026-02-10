<?php
session_start();
include_once('functions/functions.php');
error_reporting(0);
?>
<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Star Wars Original Trilogy</title>
  <link rel='stylesheet' href='css/style.css'>
  <script src='js/script.js' defer></script>
</head>

<body>
  <header>
    <h1>Star Wars: The Original Trilogy (1977–1983)</h1>
    <?php navi(); ?>
  </header>

  <main>
    <h2>Welcome to the Star Wars Universe</h2>
    <p>Explore the galaxy far, far away — discover the heroes, villains, planets, and ships that shaped the greatest
      saga in cinema history.</p>

    <div class="carousel">
      <div class="slides" id="slides">
        <img src="images/slide1.jpg" alt="A New Hope">
        <img src="images/slide2.jpg" alt="The Empire Strikes Back">
        <img src="images/slide3.jpg" alt="Return of the Jedi">
      </div>

      <button class="prev" onclick="changeSlide(-1)">❮</button>
      <button class="next" onclick="changeSlide(1)">❯</button>
    </div>


    <a href="Generic Public Pages/movies.html" style="color:#ffe81f; text-decoration:underline;">Enter the Database</a>
  </main>


  <footer>
    <p>© 2025 Star Wars Database Project | Designed by Willy Pessoa</p>
  </footer>
</body>

</html>