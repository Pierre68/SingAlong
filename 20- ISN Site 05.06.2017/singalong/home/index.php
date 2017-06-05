<?php
  session_start(); //permet de demarer la session pour avoir acces a $_SESSION
  $isHome = true;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Exds | Karaoke</title>
    <link rel="icon" href="../images/favicon.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleForms.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <script src="script.js"></script>


  </head>
  <body>

    <?php include '../lib/header.php';?>



    <section>

      <div class="bienvenue">
        <table>
          <tr>
            <td><img src="../images/accueil_notes.png" alt=""></td>
            <td><p>Bienvenue sur SingAlong le site qui vous permet de chanter vos chanson préférées et d'affronter vos amis pour savoir qui est le meilleur chanteur !</p></td>
          </tr>

        </table>
        <br><br>

      </div>


      <div class="play">
        <button id="button_play" onclick="buttonPlay()">Commencer à chanter !</button>
      </div>
      <table>
        <tr>
          <td>
            <p>Attention si vous n'etes pas connecté vos scores ne serons pas pris en compte !</p>
            <p>Site créé en temps que projet pour l'épreuve d'ISN au lycée JJH par Pierre H. et Justin G.</p>
            <p>Aucun des titres présents sur ce site ne nous appartient</p>
          </td>
          <td class="vide33"></td>
        </tr>
      </table>

       <br><br>

       <br><br>

    </section>

    <footer>
      Projet étudiant | Exds © 2017
    </footer>

    <?php include '../lib/connectionFrom.php';?>

  </body>
</html>
