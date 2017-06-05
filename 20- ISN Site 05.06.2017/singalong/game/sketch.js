//Variables relatives au joueur

var mic;
var playerFft;
var playerSpectrum = [];
var playerFreq;
var convertedPlayerFreq;
var playerHist = [];
var offsetButton
var offset = 6
//Relatives à la musique analysée

var voiceSong;
var songFft;
var songFreq;
var convertedSongFreq;
var songHist = [];
//Relatives à la musique jouées en arrière plan

var playbackSong;
var audioPlayed;
var volumeSlider
//Relatives au scorevar points = 0;
var noteNumber = 0;
var score = 0;
//Relatives à la canvas

var unit;               //L'espace entre chaques "lignes"
var speed = 4;          //Vitesse de défilement en pixels par image
var steps = [98, 110, 123, 139, 156, 175, 196, 220, 247, 277, 311, 349, 392, 440, 494, 554, 622, 698, 784, 880, 1046, 1175];
//Relatives au jeu

var startButton
var gameIsRunning;
//Relatives aux données préchargées

var phpSongIdvar choosenMusicvar lyrics = []
//=================================Les fonctions majeur=================================//

function preload() {			//Précharge les données à importer
  phpSongId = document.getElementById("songId");
  choosenMusic = phpSongId.getAttribute("value");      //Récupère l'ID de la musique à charger
  voiceSong = loadSound("../musics/" + choosenMusic + "-voice.mp3");
  playbackSong = loadSound("../musics/" + choosenMusic + ".mp3");  lyrics = loadStrings("../musics/" + choosenMusic + ".txt");
}
function setup() {			//Phase d'initialisation du programme
  canvas = createCanvas(128*6, 500);
  unit = (canvas.height / steps.length) * (2/3);  // * 2/3 pour que cette grille n'occupe que les 2/3 de la canvas                                                  //=> Plus joli
  mic = new p5.AudioIn();           //On créé l'entrée audio
  mic.start();                      //On l'active
  playerFft = new p5.FFT(0.4);			//On créé un nouveau Fast Fourier Transform
  playerFft.setInput(mic);          //On lie le micro au FFT
  for (var i = 0; i < canvas.width*0.5/speed; i++) {    //speed correspond à la vitesse de défilement
    playerHist.push("nothing");                         //=> Si les points défilent 2 fois plus vite
  }                                                     //   il y en a 2 fois moins à l'écran
  songFft = new p5.FFT(0.4);
  songFft.setInput(voiceSong);
  for (var i = 0; i < canvas.width/speed; i++) {
    if (i == canvas.width/speed - 1) {		//Quand on a fini de remplir l'historique de la musique
      songHist.push("start");             //On ajoute un "start" qui permettra de synchroniser le son écouté et à chanter
    } else {
      songHist.push("nothing");
    }
  }
  startButton = createButton("Start");       //créé un bouton avec pour texte "Start"
  startButton.mousePressed(StartTheGame);    //L'assigne à une Fonction  startButton.id("startButton")              //Lui assigne une ID HTML
  offsetButton = createButton("Masculine")
  offsetButton.mousePressed(ChangeOffset)
  offsetButton.id("offsetButton")

  volumeSlider = createSlider(0, 1, 0.2, 0.05)		//Minimum, maximum, valeur initiale, pas
  volumeSlider.input(ChangeVolume)
  volumeSlider.style("width", "16em")
  volumeDiv = createDiv("Volume : ")
  volumeDiv.child(volumeSlider)               //Pour integrer le slider dans la div
  volumeDiv.id("volumeDiv")                   //La div "volumeDiv" contient à la fois le texte et le slider}

function draw() {						//Fonction qui est lancée à chaque image, par défaut le jeu tourne à 60fps

  if (!gameIsRunning) {
    background(51);
    return;
  }
  TestSynchroSongs();
  EndTest();
  playerSpectrum = playerFft.analyze();     	//Renvoie une liste d'amplitudes (Valeur entre 0 et 255)
  SmoothPlayerSpectrum(3);            // d'après le FFT du joueur (Les amplitudes à différentes fréquences)
  GetPlayerFreq();
  UpdatePlayerHist();
  GetSongFreq();
  UpdateSongHist();
  background(51);
  ShowPlayerSpectrum();
  ShowPlayerHist();
  ShowSongHist();
  DisplayScore();
  stroke(54, 149, 212);
  strokeWeight(1);
  line(0.5*canvas.width, 60, 0.5*canvas.width, canvas.height - 20);	  	 //Repère vertical du joueur


}
//=================================Joueur=================================//
SmoothPlayerSpectrum = function(n) {				//Adoucis le spectre du joueur n fois
  for (var i = 0; i < n; i++) {
    for(var j = 1; j < playerSpectrum.length - 1; j++) {      playerSpectrum[j] = (playerSpectrum[j-1] + playerSpectrum[j]+ playerSpectrum[j+1]) / 3;
    }                                                       //Fait une moyenne entre le pic précédent, actuel et suivant  }}
ShowPlayerSpectrum = function() {					//Affiche le spectre du joueur
  stroke(100);  strokeWeight(1);
  for (var i = 0; i < 128; i++) {					//On récupère les 128 premiers pics d'amplitude de l'analyse
    var spikeHeight = map(playerSpectrum[i], 0, 255, canvas.height, 0);
    line(i*(canvas.width/128), canvas.height, i*(canvas.width/128), spikeHeight);		//"canvas.width/128" car il y a 128 pics à afficher  }}
GetPlayerFreq = function() {						//Trouve la fréquence actuelle du joueur grace à son FFT  var timeDomain = playerFft.waveform(1024, 'float32');			//Calcule les amplitudes (Valeur entre -1 et 1) du FFT en fonction du temps
  var corrBuff = autoCorrelate(timeDomain);
  playerFreq = findFrequency(corrBuff).toFixed(0);					//Permet de transformer les valeurs d'amplitudes et  //console.log(playerFreq);                                //retrouver la fréquence du fondamental (la premiere harmonique)
}
UpdatePlayerHist = function() {					//Ajoute la fréquence trouvée dans l'historique de fréquence du joueur
  if(playerFreq > 0 && playerFreq < 1300 && mic.getLevel() > 0.003) {		//"mic.getLevel() > 0.003" pour ignorer les grésillements,
    convertedPlayerFreq = 0;                                            // le reste vérifie si les valeurs ne sont pas irréaliste    var difference;    var tinestdifference = abs(steps[0] - playerFreq);
    for (var i = 0; i < steps.length; i++) {				//Transforme la valeur de la fréquence en un entier compris entre 0 et la longueur de "steps"      difference = abs(steps[i] - playerFreq);			// -> Interpreter la frequence comme une note
      if (difference < tinestdifference) {
        tinestdifference = difference;
        convertedPlayerFreq = i;
      }    }
    playerHist.push(convertedPlayerFreq + offset);					//L'offset dépend de ce qu'on a indiqué par rapport à notre voix (mascule/féminine)
  } else {
    playerHist.push("nothing");
  }

  if (playerHist.length > canvas.width*0.5/speed){					//Permet à l'historique de défiller // "*0.5" car l'historique
    playerHist.splice(0,1);                                 //du joueur n'est affiché que sur la moitié de la canvas
  }}
ShowPlayerHist = function() {								//Affiche l'historique du joueur et calcule son score en même temps
  for (var i = 0; i < playerHist.length; i++) {                     //Pour chaques notes de l'historique du joueur
    if (songHist[i] != "nothing" && songHist[i] != "start") {       //Est ce que le joueur chante et qu'il faut chanter
      if (playerHist[i] != "nothing") {
        var y = canvas.height-playerHist[i]*unit;
        precisionsLevel = map(abs(playerHist[i] - songHist[i]), 0, 3, 255, 0);  //Détermine l'écart entre ce que le joueur chante et ce qu'il devait chanter
        precisionsLevel = constrain(precisionsLevel, 0, 255);
        stroke(255 - precisionsLevel, precisionsLevel, 0);          //Utilise cet écart pour colorer l'indiquateur de la fréquence du joueur
        fill(255 - precisionsLevel, precisionsLevel, 0);						//"y - unit" pour que le rectangle soit au milieu de la ligne sur laquelle il est affiché
        rect(i*speed, y - unit, speed - 1, unit*2);									//chaque rectangles sont espacés selon la vitesse de défilement
      } else {																		//Si le chanteur n'a pas chanté	alors qu'il aurait du
        var y = canvas.height-playerHist[i]*unit;
        precisionsLevel = 0;
        stroke(150);
        fill(150);        rect(i*speed, y - unit, speed - 1, unit*2);      }      if (i == playerHist.length - 1) {						//Si l'algo est en train de comparer ce que le chanteur vient de chanter il met à jour le score        points += precisionsLevel;                //Les points ajoutés du joueur sont proportionnels au niveau de précision
        noteNumber++;
        score = points / (255*noteNumber);				//Moyenne entre le total de point du joueur et le max de point obtenable sur l'instant
        //console.log(score);      }    } else if ((songHist[i] == "nothing" || songHist[i] == "start") && playerHist != "nothing") { //Sinon si le chanteur chante mais qu'il n'y a rien a chanter      var y = canvas.height-playerHist[i]*unit;
      stroke(150);                                          //La note est grisée
      fill(150);
      rect(i*speed, y - unit, speed - 1, unit*2);
    }
  }
}                                  //Permet au joueur d'indiquer si sa voix est féminine ou masculine pour que
ChangeOffset = function() {				//le jeu puisse interpreter differement la frequence à laquelle il chante
  if (offset == 0) {              //Si l'offset etait feminin
    offset = 6
    //console.log(offset)
    document.getElementById("offsetButton").innerHTML="Masculine";      //Change le texte du bouton
  } else if (offset == 6){        //Sinon si l'offset etait masculin
    offset = 0
    //console.log(offset)
    document.getElementById("offsetButton").innerHTML="Féminine";      //Change le texte du bouton
  }
}
//=================================Musique=================================//
GetSongFreq = function() {						//Trouve la fréquence actuelle de la musique grace à son FFT
  var songTimeDomain = songFft.waveform(1024, 'float32');
  var songCorrBuff = autoCorrelate(songTimeDomain);
  songFreq = findFrequency(songCorrBuff).toFixed(0);
  // console.log(songFreq);
}
UpdateSongHist = function() {					//Ajoute la fréquence trouvée dans l'historique de fréquence de la musique
  if (songFreq > 0 && songFreq < 1300) {
    convertedSongFreq = 0;
    var difference;
    var tinestdifference = abs(steps[0] - songFreq);
    for (var i = 0; i < steps.length; i++) {
      difference = abs(steps[i] - songFreq);
      if (difference < tinestdifference) {
        tinestdifference = difference;
        convertedSongFreq = i;
      }
    }
    songHist.push(convertedSongFreq);	//console.log(convertedSongFreq);	if (songHist[songHist.length - 2] != songHist[songHist.length - 1] && songHist[songHist.length - 2] != songHist[songHist.length - 3]) {		songHist.splice(songHist.length - 2, 1, "nothing")		//Permet de minimiser les valeurs incohérentes trouvées en les remplacant par du vide	}  } else {
    songHist.push("nothing");
  }
  if (songHist.length > canvas.width/speed){						//Permet à l'historique de défiller
    songHist.splice(0,1);
  }
}
ShowSongHist = function() {					//Affiche l'historique de la musique
  stroke(255);
  strokeWeight(unit*0.5);
  for (var i = 0; i < songHist.length; i++) {     //On affiche chaque notes de l'historique de musique
    var y = canvas.height-songHist[i]*unit;
    point(i*speed, y);
  }
}
TestSynchroSongs = function() {			//Pour lancer la musique écoutée au bon moment
  if (!audioPlayed) {
    if (songHist[canvas.width*0.5/speed] == "start") {      //Si l'indice "start" est sur le repère
      playbackSong.setVolume(volumeSlider.value());         //du joueur on démarre la musique playback
      playbackSong.play();	  	updateLyrics()                                        //Lance l'actualisation des paroles      audioPlayed = 1;
    }  }
}

ChangeVolume = function() {

	playbackSong.setVolume(volumeSlider.value())              //Regle le volume de la musique de fond

}
//=================================Score=================================//
DisplayScore = function() {					//Affiche le score du joueur  stroke(255);                      //Écrit le score  fill(255);  strokeWeight(1);  textSize(20)  text((score*100).toFixed(1) + "%", 35, 45);  stroke(255)                       //Contour de la jauge  noFill()  strokeWeight(1)  rect(99, 19, 201, 32)  for(var i = 0; i < score*200; i++) {			  //Le contenu de la jauge	 var color = map(i, 0, 200, 0, 255)        //Pour faire un dégradé	 stroke(255 - color, color, 0)	 strokeWeight(1)	 line(i + 100, 20, i + 100, 50)  }
}
//=================================Jeu=================================//
StartTheGame = function() {						//Lorsque le bouton "Start" est activé
  voiceSong.setVolume(0.3);
  voiceSong.play();
  voiceSong.disconnect();
  gameIsRunning = 1;                //Indice pour valider que le jeu est en route
  startButton.remove();
  offsetButton.remove();
}

EndTest = function() {								//Pour vérifier si la partie est terminée
  if (!playbackSong.isPlaying() && audioPlayed) {       //Si la musique a été lancée mais qu'elle est terminée
    gameIsRunning = 0;
    setPlayerScore(choosenMusic, (score * 100))         //On envoie le score et on arrete le jeu
  }}