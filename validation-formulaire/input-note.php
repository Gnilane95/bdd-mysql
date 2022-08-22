 <?php
 if (!empty ($note)){
			if (is_numeric($note) && is_float($note)) {
				$error["note"] = "<span class=text-red-500>Veuillez rentrez un nombre</span>";
			}elseif (($note)<0) {
				$error["note"] = "<span class=text-red-500>Veuillez rentrez un chiffre supérieur à 0</span>";
			}elseif (($note)>200) {
				$error["note"] = "<span class=text-red-500>Veuillez rentrez un chiffre inférieur à 200</span>";
			}
    }else{
        $error["note"] = $errorMessage;
    }