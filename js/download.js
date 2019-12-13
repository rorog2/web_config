//Création d'un lien
var download = document.createElement('a');

//Contenu
dowload.setAttribute('href',"data:text/plain;charset=utf-8,"+encodeURIComponent("coucou c'est moi !!!"));

//Nom du fichier
download.setAttribute('download',"test.txt");

//Simulation d'un click
download.click();