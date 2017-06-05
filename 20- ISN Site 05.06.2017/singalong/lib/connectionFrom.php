<div id="connectionBackground">



<form id="login" action="../lib/login.php" method="POST">
  <span onclick="loginClose()" class="closeButton">✖</span>
  <br><br>
  <input class="textboxes" type="email" name="email" value="" placeholder="Adresse mail">
  <span style="font-size: 1.1em;margin-left:0.6em;margin-right:0.3em;font-family:sans-serif;">@</span><br>
  <input class="textboxes" type="password" name="password" value="" placeholder="Mot de passe"><i class="material-icons">lock_outline</i><br>
  <br><br><br><br>
  <input class="validationButton" type="submit" name="" value="connexion"><br><br>
  <span onclick="registerOpen()" class="changeButton">créer un compte</span>
</form>

<form id="register" action="../lib/register.php" method="POST">
  <span onclick="registerClose()" class="closeButton">✖</span>
  <br><br>
  <input class="textboxes" type="email" name="email" value="" placeholder="Adresse mail">
  <span style="font-size: 1.1em;margin-left:0.8em;margin-right:0.3em;font-family:sans-serif;">@</span><br>
  <input class="textboxes" type="text" name="username" value="" placeholder="Nom d'utilisateur"><i class="material-icons">perm_identity</i><br>
  <input class="textboxes" type="password" name="password" value="" placeholder="Mot de passe"><i class="material-icons">lock_outline</i>
  <br><br><br><br><br>
  <input class="validationButton" type="submit" name="" value="créer compte">
  <br><br>
  <span onclick="loginOpen()" class="changeButton" type="button" name="button">se connecter</span>
</form>


<?php
  $info = "".$_SERVER['REQUEST_URI'];
  $errorMessage = "";

  //==================[register errors]========================

  if(strpos($info, 'register')){
    $errorMessage = $errorMessage."<i class='material-icons'>warning</i> veuillez completer toutes les cases !<br>";
  }
  if(strpos($info, 'emailtaken')){
    $errorMessage = $errorMessage."<i class='material-icons'>warning</i> cette adresse email est déjà utilisée !<br>";
  }
  if(strpos($info, 'length')){
    $errorMessage = $errorMessage."<i class='material-icons'>warning</i> le mot de passe et le nom d'utilisateur doivent etre compris entre 3 et 14 caractères !<br>";
  }

  //==================[login errors]========================

  if(strpos($info, 'login')){
    $errorMessage = $errorMessage."<i class='material-icons'>warning</i> le mot de passe ne correspond pas !<br>";
  }


  //==================[display errors]======================

  if($errorMessage !== ""){
    echo "<br><div id='errorMessage'>".$errorMessage."</div><br><br>";
  }
  //Pour reouvrir la fenetre automatiquement en cas d'erreur. TODO ajouter les nouvelles erreures
  if(strpos($info, 'register')||strpos($info, 'length')||strpos($info, 'emailtaken')){
    echo '<script type="text/javascript">','registerOpen();','</script>';
  }
  if(strpos($info, 'login')){
    echo '<script type="text/javascript">','loginOpen();','</script>';
  }
  //Bulle info pour erreur de connection
  if(strpos($info, 'connection')){
    echo '<script type="text/javascript">','loginOpen();alert("Veuillez vous connecter pour acceder a cette page");','</script>';
  }

?>

<style>
  #errorMessage{
    display: block;
    padding: 0.5em;
    color: red;
    font-family:sans-serif;
    background-color: rgb(54, 149, 212);
    border-radius: 5px;
    width: 20em;
    margin: auto;
  }

  #connectionBackground{
    position: fixed;
    display: none;

    background-color: rgba(60, 60, 60, 0.8);
    padding-top: 9em;
    bottom: -9em;
    width: 100%;
    height: 100%;
  }

</style>

</div>
