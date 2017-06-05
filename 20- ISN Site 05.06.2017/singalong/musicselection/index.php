<?php
  session_start(); //permet de demarer la session pour avoir acces a $_SESSION
  $isHome = false;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Exds | Karaoke</title>
    <link rel="icon" href="../images/favicon.png">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
  </head>


  <body>

    <?php include '../lib/header.php';?>

    <section>

<?php
$sql = "SELECT * FROM music";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){

    $time_min = intval($row["length"]/60);
    $time_sec = $row["length"] - $time_min * 60;
    if($time_sec < 10){
      $time_sec = "0".$time_sec;
    }

    if(!$row["display"])continue;

    echo "<div id='".$row["id"]."' class='music' onclick='openMiniMenu(".$row["id"].")'>";
      echo "<img src='../images/music/".$row["id"].".jpg' alt='".$row["title"]."'>";

      echo "<div class='music_text'>";
        echo "<p class='music_title'>".$row["title"]."</p>";
        echo "<p class='music_artist'>- ".$row["artist"]."</p>";

        echo "<hr>";

        echo "<p class='music_album'>".$row["album"]."</p>";
        echo "<p class='music_year'>- ".$row["year"]."</p>";
        echo "<p class='music_length'>".$time_min.":".$time_sec."</p>";
      echo "</div>";
    echo "</div>";

  }
}else{
  echo "<p>Pas de résultats</p>";
}

 ?>

    </section>

    <span id='button' onclick='openGamePage()'>Jouer</span>

    <object id="scoreboard" type="text/html" data="highscores/highscores.php?2"></object>
    <p id="loading">Chargement ...</p>

    <footer>
      Projet étudiant | Exds © 2017
    </footer>

  </body>
</html>
