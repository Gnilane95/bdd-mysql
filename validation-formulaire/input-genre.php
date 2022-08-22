<?php
 if (!empty ($genre_clear)){
        #debug_array ($genre_clear);
			if ($genre_clear == "Aventure" || $genre_clear == "Course" || $genre_clear == "FPS" || $genre_clear == "RPG") {
				echo "cool";
			}else {
				$error["genre"] = "Les éléments ne sont pas dans le tableau.";
			}
    }else{
        $error["genre"] = $errorMessage;
    }