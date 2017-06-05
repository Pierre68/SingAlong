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
    <!-- Mise en place de la décoration de l'onglet -->
    <link rel="stylesheet" href="style.css">
    <script src="../lib/p5/p5.js"></script>
    <script src="../lib/p5/p5.dom.js"></script>
    <script src="../lib/p5/p5.sound.js"></script>
    <script src="../lib/perso.lib.js"></script>
    <!-- Import de toutes les libraries et des pages CSS -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Import des icones de Google ainsi que de la library jQuery pour l'AJAX -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <script src="script.js"></script>

    </script>

  </head>
  <body>


    <?php include '../lib/header.php';?>

    <!-- Variables Pour que justin puisse les prendre -->
    <?php

    include '../lib/dbh.php';//importe l'acces à la base de données

      if(isset($_SESSION['id'])){//vrai si le joueur est connecté (uniquement sécurité)
        $songId = substr($_SERVER['REQUEST_URI'], -1); //permet de récupérer l'identifiant dans L'URL en prenant de dernier charactere

        $sql = "SELECT id FROM music WHERE id='$songId'";

        $result = mysqli_query($conn, $sql);
        $songCheck = mysqli_num_rows($result);

        if($songCheck > 0){ //vrai si existe car il y aura au moins une réponse
          echo "<option id='songId' style='display: none;' value='".$songId."'></option>";
        }else{
          echo "Song not found";
        }

        $sql = "SELECT * FROM music WHERE id='$songId'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $songTitle = $row['title'];
        $songArtits = $row['artist'];

      }
     ?>

     <script src="sketch.js"></script>

     <!-- <button type="button" name="button" id="test" onclick="setPlayerScore(1,20)">TEST</button> -->
     <!-- Ma permis de tester la fonction alors que la partie de Justin qui s'en sert n'etait pas finie -->

    <?php
      echo "Title : ".$songTitle."<br>";
      echo "Artist : ".$songArtits."<br>";
     ?>

     <div id="lyrics">
       <p id="lyrics_main"><br></p>
       <p id="lyrics_sub">Paroles</p>
     </div>


    <footer>
      Projet étudiant | Exds © 2017
    </footer>



  </body>
</html>
