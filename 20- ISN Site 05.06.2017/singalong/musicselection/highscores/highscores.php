<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
    <script src="../script.js"></script>
  </head>
  <body>

    <br>
    <h1>Higscores</h1>
    <hr>
    <p class='rankTop'>#</p>
    <p class='nameTop'>Name</p>
    <p class='scoreTop'>score</p>
    <br>


    <?php

    session_start(); //permet de demarer la session pour avoir acces a $_SESSION

    if(isset($_SESSION['id'])){

      include '../../lib/dbh.php';

      $songId = substr($_SERVER['REQUEST_URI'], -1);
      $userId = $_SESSION['id'];

      $sql = "SELECT * FROM score WHERE songId = $songId ORDER BY score DESC";
      $result = mysqli_query($conn, $sql);

      $rank = 0;

      $isInTop = false;

      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){

          $rank = $rank + 1;

          $userIdScore = $row['userId'];

          if($userIdScore != $userId && $rank <= 10){

            $sql = "SELECT username FROM user WHERE id = $userIdScore";
            $userName = mysqli_fetch_assoc(mysqli_query($conn, $sql))["username"];

            echo "<p class='rank'>".$rank."</p>";
            echo "<p class='name'>".$userName."</p>";
            echo "<p class='score'>".$row["score"]."</p><br>";

          }else if($rank <= 10 && $userIdScore == $userId){

            echo "<p class='rank'>".$rank."</p>";
            echo "<p class='you'>"."Vous"."</p>";
            echo "<p class='score'>".$row["score"]."</p><br>";
            $isInTop = true;

          }elseif ($rank > 10 && $userIdScore == $userId) {

            echo "<hr>";
            echo "<p class='rank'>".$rank."</p>";
            echo "<p class='you'>"."Vous"."</p>";
            echo "<p class='score'>".$row["score"]."</p><br>";


          }elseif ($rank > 10 && $isInTop) {
            break;
          }


        }


      }else{
        echo "<p class='rank'>Pas de résultats</p>";
      }


    }


     ?>

  </body>
</html>
