function openGamePage() {
  window.location.replace("../game/index.php?" + songIdSave);
}

var songIdSave = 0

function openMiniMenu(songId) {

  document.getElementById("button").style = "display: block;"
  document.getElementById("loading").style = "display: block;"

  if(songIdSave != 0)
    document.getElementById(songIdSave).style = ""
  document.getElementById(songId).style = "background-color: rgb(240, 240, 240);"

  songIdSave = songId
  document.getElementById("scoreboard").style = "display: block;"
  document.getElementById("scoreboard").data = "highscores/highscores.php?" + songId
}
