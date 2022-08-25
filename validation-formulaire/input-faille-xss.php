<?php
$nom = clear_xss($_POST["name"]);
$price = clear_xss($_POST["price"]);
// clear array genre with foreach
$genres = !empty($_POST["genre"]) ? $_POST["genre"] : [];
$genre_clear = [];
foreach ($genres as $genre) {  
    //je lave chaque élément et je l'insère dans le nouveau tableau
    $genre_clear [] = clear_xss($genre);
}
$note = clear_xss($_POST["note"]);
// clear array genre with foreach
$plateforms = !empty($_POST["genre"]) ? $_POST["plateforms"] : [];
$plateform_clear = [];
foreach ($plateforms as $plateform){
    //je lave chaque élément et je l'insère dans le nouveau tableau
     $plateform_clear [] = clear_xss($plateform);
}
$description = clear_xss($_POST["description"]);
$pegi = !empty($_POST["pegi"]) ? clear_xss($_POST["pegi"]) : [] ;
$url_img = $GLOBALS["img_upload_path"] ;