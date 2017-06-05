function setPlayerScore(song_id,player_score) {
  // fonction a appelée pour changer le score du joueur actuellement connecté
  player_score = Math.round(player_score*10) /10
  //arrondit le score à un chiffre apres la virgule
  $.ajax({
      url: 'ajax.php', //Page qui va recevoir les informations
      type: "POST", //Permet de passer les valeures de facon "discrète" et aussi de les récupérer
      // avec $_POST['songId'];
      dataType:'json', // permet de définir le type de "data" "valeurs" à envoyer
      data: ({score: player_score, songId: song_id}), // valeures qui pourront etre récupéré par la page de sauvegarde
      });
      document.getElementById("lyrics_main").innerHTML = "Vous avez fait " + player_score + "% !"
      // indique le score du joueur a la place des paroles (car musqieu finie)

      console.log(songId + " / " + player_score);
      // permet de vérifier si la fonction a bien été appelée et donne ses valeurs
}

var lyricsStatus = 0 // position actuelle de lecture de la liste
var lyricsTime = 0 // temps au moment de la derniere mise a jour

function updateLyrics() { // est appelé une fois au début de la musique (par Justin) puis ce gère tout seul

  var text = lyrics[lyricsStatus] // paroles en grand
  var time = lyrics[lyricsStatus+1] // temps pour les prochaines paroles
  var textPreview = lyrics[lyricsStatus+2] // paroles en petit

  var timeUntilNext = time - lyricsTime //temps jusqu'à la prochaine mise a jour

  lyricsTime+= timeUntilNext //temps actuel
  lyricsStatus+=2 // position actuelle dans la liste

  if((textPreview + "") == "undefined") // detecte quand on arrive a la fin des paroles
    return;

  if (text == "(nothing)") { // permet de mettre un vide par exemple durant les solo d'instruments
    document.getElementById("lyrics_main").innerHTML = "<br>"
  }else {
    document.getElementById("lyrics_main").innerHTML = text
  }
  if (textPreview == "(nothing)") { // idem mais pour les paroles en petit
    document.getElementById("lyrics_sub").innerHTML = "<br>"
  }else {
    document.getElementById("lyrics_sub").innerHTML = textPreview
  }
  setTimeout(updateLyrics, timeUntilNext) // fonction, temps en millisecondes
}
