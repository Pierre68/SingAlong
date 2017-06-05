<?php
  session_start(); //permet de démarrer la session pour avoir accès à $_SESSION

  include '../lib/dbh.php'; //importe l'acces a la base de données

  $newUserScore = $_POST['score']; //récupération des information nécessaire
  $songId = $_POST['songId'];
  $userId = $_SESSION['id'];

  // récupère un ancien score si il existe
  $sql = "SELECT userId FROM score WHERE userId=$userId AND songId=$songId";
  $result = mysqli_query($conn, $sql); // fait la requête auprès du serveur SQL
  // $conn est la variable stockée dans lib/dhb.php et contient les identifiants
  $scorecheck = mysqli_num_rows($result); //compte le nombre de résultats

  if ($scorecheck > 0) { //Teste si la base de données contient déjà un score pour cet utilisateur

    $sql = "SELECT * FROM score WHERE userId='$userId' AND songId='$songId'"; //récupération ancien score
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result); // permet de transformer le résultat de la requete en une liste de valeures
    $oldScore = $row['score'];
    $tries = $row['tries'] + 1;

    if($oldScore < $newUserScore){ //Si il a fait un meilleur score // on met à jour son score

      $sql = "UPDATE score SET score = '$newUserScore', tries = '$tries' WHERE userId = '$userId' AND songId='$songId'";
      $result = mysqli_query($conn, $sql);// envoi des informations à la base de données
    }else{// comme il n'a pas fait mieux on ne change pas
      $sql = "UPDATE score SET tries = '$tries' WHERE userId = '$userId' AND songId='$songId'";
      $result = mysqli_query($conn, $sql);// envoi des informations à la base de données
      // on met juste à jour son nombre d'essais
    }

  }else{ // comme il n'a pas encore de score on crée la ligne dans la table "score"
    $sql = "INSERT INTO score (userId, songId, score, tries)
    VALUES ('$userId', '$songId', '$newUserScore', 1)";
    $result = mysqli_query($conn, $sql); // envoi des informations à la base de données
  }

?>
