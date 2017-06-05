<header>
  <img id="header_logo" src="../images/header_logo.png" alt="loading error" onclick="openHomePage()">
  <span class="title" onclick="openHomePage()">SingAlong</span>

    <?php
        include 'dbh.php';

        if(isset($_SESSION['id'])){
          $sql = "SELECT * FROM user WHERE id=".$_SESSION['id'];
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);

          echo "<span onclick='headerMenuButton()' class='header_login'><span class='user'>".$row['username']."</span>";
        }else{

          if($isHome){ //Empeche les utilisateurs d'acceder aux autres pasges que le home quand ils sont deco
            echo "<span onclick='loginOpen()' class='header_login'><span class='user'>login</span>";
          }else{
            //header("Location: ../home/index.php?error=connection");
            $_SESSION['id'] = 12; // connection auto
            echo "<span onclick='headerMenuButton()' class='header_login'><span class='user'>"."Guest"."</span>";
          }
        }
     ?>
    <i class="material-icons" style="font-size:2em;">perm_identity</i>
  </span>

  <div id="headerMenu">
    <ul>
      <li>
        <form action="../lib/logout.php">
          <button class="headerMenuButton" type="submit" name="button"><span>Se déconnecter</span></button>
        </form>
      </li>
    </ul>
  </div>


  <script type="text/javascript">
    //buttons
    function loginOpen() {
      document.getElementById("connectionBackground").style.display = "block";
      document.getElementById("login").style.display = "block";
      document.getElementById("register").style.display = "none";
    }
    function loginClose() {
      document.getElementById("connectionBackground").style.display = "none";
      document.getElementById("login").style.display = "none";
      document.getElementById("errorMessage").style.display = "none";
    }
    function registerOpen() {
      document.getElementById("connectionBackground").style.display = "block";
      document.getElementById("register").style.display = "block";
      document.getElementById("login").style.display = "none";
    }
    function registerClose() {
      document.getElementById("connectionBackground").style.display = "none";
      document.getElementById("register").style.display = "none";
      document.getElementById("errorMessage").style.display = "none";
    }
    function openHomePage() {
      window.location.replace("../home/index.php?");
    }
    var headerMenuOpen = false;
    function headerMenuButton() {
      if(headerMenuOpen){
        document.getElementById("headerMenu").style.display = "none";
        headerMenuOpen = false;
      }else{
        document.getElementById("headerMenu").style.display = "block";
        headerMenuOpen = true;
      }
    }
  </script>

  <style>

  *{
    margin: 0;
    padding: 0;
  }

  ::-webkit-input-placeholder{
    color: lightblue;
  }

  @font-face {
      font-family: "Sketch";
      src: url(../fonts/Sketch.ttf) format("truetype");
  }

  header{
    background-color: rgb(54, 149, 212);
    height: 3.9em;
  }

  .title{
    color: white;
    cursor: default;
    position: absolute;
    font-family: "Sketch";
    font-size: 3.5em;
    top: 0.2em;
    left: 43vw;
    text-shadow: 4px 4px darkblue;
    cursor: pointer;
  }

  .user{
    font-size: 1.1em;
    font-family: sans-serif;
    vertical-align: super;
  }

  .header_login{
    cursor: pointer;
    color: white;
    border: none;
    background: none;
    position: absolute;
    right: 1em;
    top: 1vh;
    transition: 0.2s;
  }
  .header_login:hover{
    color: lightblue;
  }

  #header_logo{
    height: 3em;
    margin-left: 1vw;
    margin-top: 1vh;
    cursor: pointer;
  }

  #headerMenu{
    display: none;
    background-color: rgb(60,60,60);
    width: 11em;
    position: absolute;
    right: 0;
    top: 3.9em;
    z-index: 2;
  }
  #headerMenu ul{
    list-style: none;
    width: inherit;
  }


  .headerMenuButton{
    text-align: left;
    width: 11em;
    padding: 0.4em 2em;
    font-size: inherit;
    cursor: pointer;
    background-color: transparent;
    color: gray;
    border: none;
    transition: 0.2s;
  }
  .headerMenuButton:hover{
    background-color: rgb(100,150,200);
    color: white;
    transition: 0.2s;
  }
  .headerMenuButton span{
    font-size: 0.8em;
  }

  </style>



</header>
