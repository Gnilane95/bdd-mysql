<?php
if (!empty($plateform_clear)) {
    if(in_array("Switch", $plateform_clear) || in_array("Xbox", $plateform_clear) || in_array("PS4", $plateform_clear) || in_array("PS5", $plateform_clear) || in_array("PC", $plateform_clear)){

    }else {
        $error["plateforms"] = "<span class=text-red-500>Ces valeurs n'existent pas.</span>";
    }
    } else {
        $error["plateforms"] = $errorMessage;
    }