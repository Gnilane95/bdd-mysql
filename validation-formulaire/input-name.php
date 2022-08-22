<?php
 if (!empty ($nom)){
			if (strlen($nom)<=3) {
				$error["name"] = "<span class=text-red-500>3 caractères minimum</span>";
			}elseif (strlen($nom)>100) {
				$error["name"] = "<span class=text-red-500>100 caractères maximun</span>";
			}
    }else{
      $error["name"] = $errorMessage;
    }