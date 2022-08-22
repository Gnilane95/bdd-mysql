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
        require_once("validation-formulaire/include.php");
        if (count($error) == 0){
            require_once("sql/addGame-sql.php");
        }
        var_dump (count($error));
}

?>

<section>
    <div class="wrap_content-head my-3">
        <a href="index.php" class="mx-10 text-blue-800"><-Retour</a>
        <h1 class=" text-center text-blue-500 font-bold text-5xl">Ajouter un jeu</h1>
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
                <input type="checkbox" name="genre[]" class="checkbox" value="<?= $genre ["name"]?>" <?php 
                if (!empty($_POST["genre"])){
                    if (in_array($genre["name"], $_POST["genre"])) echo "checked" ;
                } ?>/>
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
                <input type="checkbox" name="plateforms[]" class="checkbox" value="<?= $plateform ["name"]?>" <?php if (!empty($_POST["plateforms"])){
                    if (in_array($plateform["name"], $_POST["plateforms"])) echo "checked" ;
                }
                ?>/>
            </div>
            <?php endforeach ?>
        </div>
        <p>
            <?php
			if(!empty($error["plateforms"])){
				echo $error["plateforms"];
			} ?>
        </p>
        <!-- input description -->
        <div class="mb-3">
            <label for="description" class="block font-semibold text-blue-900">Description</label>
            <textarea type="text" name="description" placeholder="" class="textarea textarea-bordered h-48 w-full max-w-sm"> <?php if(!empty($_POST["description"])){echo $_POST["description"];} ?> </textarea>
            <p>
                <?php
				if(!empty($error["description"])){
					echo $error["description"];
				} ?>
            </p>
        </div>
        <!-- input pegi -->
        <?php
        $pegiArray = [
            ["name" => 3],
            ["name" => 7],
            ["name" => 12],
            ["name" => 16],
            ["name" => 18],
        ];
        
        ?>
        <div class="mb-3">
            
            <select class="select select-bordered w-full max-w-sm" name="pegi">
                <option disabled selected>Choose</option>
                <?php foreach ($pegiArray as $pegi) : ?>
                <option value="<?= $pegi ["name"]?>" <?php
                    //Je sauvegarde en mémoire ce que le user a choisi
                    if (!empty($_POST["pegi"])) {
                        if($_POST["pegi"] == $pegi["name"]) echo 'selected="selected"';
                    } ?> > <?= $pegi ["name"] ?> </option>
                <?php endforeach ?>
            </select>
            <p>
                <?php
				if(!empty($error["pegi"])){
					echo $error["pegi"];
				} ?>
            </p>
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