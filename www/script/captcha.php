<?php

header("Content-type: image/png");

$image = imagecreate(400, 200);

$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);



//Générer une chaîne aléatoire d'une longueur aléatoire entre 6 et 8
//Afficher cette chaîne dans l'image
//	-> avec une police aléatoire par caractère au format ttf se trouvant dans le dossier fonts
//	-> si je rajoute un fichier ttf il doit être automatiquement pris en compte
//	-> avec une position aléatoire par caractère
//	-> avec un angle aléatoire par caractère
//	-> avec une couleur aléatoire par caractère
//	-> avec une taille aléatoire par caractère
//	-> la couleur de fond doit être aléatoire
// 	-> ajouter par dessus une nombre aléatoire de formes géométriques aléatoires de couleurs déjà utilisées par le texte sur des positions aléatoires

//ATTENTION DOIT ÊTRE LISIBLE






imagepng($image);