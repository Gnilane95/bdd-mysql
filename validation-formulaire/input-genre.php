<?php
 if (!empty ($genre_clear)){
    if(in_array("Aventure", $genre_clear) || in_array("Course", $genre_clear) || in_array("FPS", $genre_clear) || in_array("RPG", $genre_clear)){

    }else {
        $error["genre"] = "<span class=text-red-500>Ces valeurs n'existent pas.</span>";
    }

    }else{
        $error["genre"] = $errorMessage;
    }