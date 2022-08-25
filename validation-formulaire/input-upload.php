<?php
//nom des variables
    $files_name = $_FILES["url_img"] ["name"];
    $files_size = $_FILES["url_img"] ["size"];
    $files_tmp = $_FILES["url_img"] ["tmp_name"];
    $files_type = $_FILES["url_img"] ["type"];

//2-on vérifie la taille de l'image
    $sizeMax = 2000000; //2mo
    if ($files_size <= $sizeMax) {
        //3-on vérifie l'extension du ficher
            //a-Je récupère le chemin du fichier à uploader
        $fileInfo = pathinfo($files_name);
            //b-Je récupère l'extension du fichier
        $extension = $fileInfo ["extension"];
            //c- je choisis les extensions autorisées
        $allowed_extensions = ["jpg","jpeg","png"];
            //d- je vérifie que l'extension du fichier uploader est dans le tableau allowed_extensions
        if (in_array($extension, $allowed_extensions)) {
        //4-je valide l'upload
            $new_img_name = uniqid('IMG-', true) . "." . $extension;
            $img_upload_path = 'image_uploads/' . $new_img_name;
            move_uploaded_file($files_tmp, $img_upload_path);
        } else {
            $error["url_img"] = "<span class=text-red-500>Veuillez télécharger des fichiers de formats jpeg, jpg ou png.</span>" ;
        }
        
    }else {
        $error["url_img"] = "<span class=text-red-500>Fichier volumineux</span>" ;      
    }
