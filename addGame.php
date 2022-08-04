<!-- header -->
<?php
//Démarrage de la session
session_start();
$title = "addGame";
include ('partials/_header.php');
include ('helpers/functions.php');
//inclure PDO pour la connexion à la BDD
require_once ("helpers/pdo.php");
//debug_array($_GET)

//Traitement du formulaire
//Création du formulaire
$error = [];
$errorMessage = "<span class=text-red-500>Ce champs est obligatoire</span>";
$success = false ;

if (!empty($_POST["submited"])) {
    //2-Faille xss
    	$nom = clear_xss($_POST["name"]);
        $prix = clear_xss($_POST["price"]);
        // clear array genre with foreach
        $genres = !empty($_POST["genre"]) ? $_POST["genre"] : [];
        $genre_clear = [];
        foreach ($genres as $genre) {  
            //je lave chaque élément et je l'insère dans le nouveau tableau
            $genre_clear = clear_xss ($genre);
        }
        $note = clear_xss($_POST["note"]);
        // clear array genre with foreach
        $plateforms = $_POST["plateforms"];
        $plateform_clear = [];
        foreach ($plateforms as $plateform){
            //je lave chaque élément et je l'insère dans le nouveau tableau
             $plateform_clear = clear_xss ($plateform);
        }
        $description = clear_xss($_POST["description"]);
        $pegi = clear_xss($_POST["pegi"]);

        #debug_array ($_POST);

        //3-Validation de chaque input
    //////////////////////////////////
    //name
    if (!empty ($nom)){
			if (strlen($nom)<=3) {
				$error["name"] = "<span class=text-red-500>3 caractères minimum</span>";
			}elseif (strlen($nom)>100) {
				$error["name"] = "<span class=text-red-500>100 caractères maximun</span>";
			}
    }else{
      $error["name"] = $errorMessage;
    }

    //price
    if (!empty ($prix)){
			if (is_numeric($prix) && is_float($prix)) {
				$error["price"] = "<span class=text-red-500>Veuillez rentrez un nombre</span>";
			}elseif (($prix)<0) {
				$error["price"] = "<span class=text-red-500>Veuillez rentrez un chiffre supérieur à 0</span>";
			}elseif (($prix)>200) {
				$error["price"] = "<span class=text-red-500>Veuillez rentrez un chiffre inférieur à 200</span>";
			}
    }else{
        $error["price"] = $errorMessage;
    }

    //note
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

    //genre
    if (!empty ($genre_clear)){
        debug_array ($genre_clear);
			if ($genre_clear == "Aventure" || $genre_clear == "Course" || $genre_clear == "FPS" || $genre_clear == "RPG") {
				echo "cool";
			}else {
				$error["genre"] = "Les éléments ne sont pas dans le tableau.";
			}
    }else{
        $error["genre"] = $errorMessage;
    }

    //description
		if (!empty($description)) {
			if (strlen($description)<=30) {
				$error["description"] = "<span class=text-danger>30 caractères minimum</span>";
			}elseif (strlen($nom)>300) {
				$error["description"] = "<span class=text-danger>120 caractères maximun</span>";
			}
		}else{
			$error["description"] = $errorMessage;
		}
        debug_array ($error);
}

?>

<section>
    <div class="wrap_content-head text-center my-3">
        <h1 class="text-blue-500 font-bold text-5xl">Ajouter un jeu</h1>
    </div>
    <form action="" method="POST" class="mx-48">
        <!-- input name -->
        <div class="mb-3">
            <label for="name" class="block font-semibold text-blue-900">Name</label>
            <input type="text" name="name" placeholder="" class="input input-bordered w-full max-w-sm" value="<?php if(!empty($_POST["name"])){echo $_POST["name"];} ?>"/>
            <p>
                <?php
				if(!empty($error["name"])){
					echo $error["name"];
				} ?>
            </p>
        </div>
        <!-- input price -->
        <div class="mb-3">
            <label for="price" class="block font-semibold text-blue-900">Prix</label>
            <input type="number" step="any" name="price" placeholder="" class="input input-bordered w-full max-w-sm" value="<?php if(!empty($_POST["price"])){echo $_POST["price"];} ?>"/>
            <p>
                <?php
				if(!empty($error["price"])){
					echo $error["price"];
				} ?>
            </p>
        </div>
        <!-- input genre -->
        <?php
        $genreArray = [
            ["name" => "Aventure", "checked"=>"checked"],
            ["name" => "Course"],
            ["name" => "FPS"],
            ["name" => "RPG"],
        ];
        ?>
        <h2 class="mt-5 mb-2 font-semibold text-blue-900">Genre</h2>
        <div class="flex items-center space-x-8 mb-5">
            <?php foreach ($genreArray as $genre) : ?>
            <div class="flex items-center space-x-2 ">
                <label for="genre" class="block font-semibold"><?= $genre ["name"]?></label>
                <input type="checkbox" name="genre[]" class="checkbox" value="<?= $genre ["name"]?>" <?= !empty ($genre ["checked"]) ? "checked" : ""; ?> />
            </div>
            <?php endforeach ?>
        </div>
        <p class="">
                <?php
				if(!empty($error["genre"])){
					echo $error["genre"];
				} ?>
            </p>
        <!-- input note -->
        <div class="mb-3">
            <label for="note" class="block font-semibold text-blue-900">Note</label>
            <input type="number" step="0.1" name="note" placeholder="" class="input input-bordered w-full max-w-sm" 
            value="<?php if(!empty($_POST["note"])){echo $_POST["note"];} ?>"/>
            <p>
                <?php
				if(!empty($error["note"])){
					echo $error["note"];
				} ?>
            </p>
        </div>
        <!-- input plateforms -->
        <?php
        $plateformArray = [
            ["name" => "Switch", "checked"=>"checked"],
            ["name" => "Xbox"],
            ["name" => "PS4"],
            ["name" => "PS5"],
            ["name" => "PC"],
        ];
        ?>
        <h2 class="mt-5 mb-2 font-semibold text-blue-900">Plateforme</h2>
        <div class="flex items-center space-x-8 mb-5">
            <?php foreach ($plateformArray as $plateform) : ?>
            <div class="flex items-center space-x-2 ">
                <label for="plateforms" class="block  font-semibold"><?= $plateform ["name"]?></label>
                <input type="checkbox" name="plateforms[]" class="checkbox" value="<?= $plateform ["name"]?>" <?= !empty ($plateform ["checked"]) ? "checked" : ""; ?>/>
            </div>
            <?php endforeach ?>
        </div>
        <!-- input description -->
        <div class="mb-3">
            <label for="description" class="block font-semibold text-blue-900">Description</label>
            <textarea type="text" name="description" placeholder="" class="textarea textarea-bordered h-48 w-full max-w-sm"><?php if(!empty($_POST["description"])){echo $_POST["description"];} ?> </textarea>
            <p>
                <?php
				if(!empty($error["description"])){
					echo $error["description"];
				} ?>
            </p>
        </div>
        <!-- input pegi -->
        <?php
        $peggiArray = [
            ["name" => 3],
            ["name" => 7],
            ["name" => 12],
            ["name" => 16],
            ["name" => 18],
        ];
        ?>
        <div class="mb-3">
            
            <select class="select select-bordered w-full max-w-sm" name="pegi">
                <option disabled selected>Choose PEGI</option>
                <?php foreach ($peggiArray as $peggi) : ?>
                <option value="<?= $peggi ["name"]?>"><?= $peggi ["name"]?></option>
                <?php endforeach ?>
            </select>
        </div>
        <!-- submit btn -->
        <div>
          <input type="submit" name="submited" value="Ajouter" class="btn btn-primary bg-blue-600">  
        </div>
    </form>
</section>
<!-- footer -->
<?php
include ('partials/_footer.php');
?>