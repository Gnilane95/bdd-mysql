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
    echo "Tu as cliqué !";
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
            <input type="text" name="name" placeholder="" class="input input-bordered w-full max-w-sm" />
        </div>
        <!-- input price -->
        <div class="mb-3">
            <label for="price" class="block font-semibold text-blue-900">Prix</label>
            <input type="number" step="any" name="price" placeholder="" class="input input-bordered w-full max-w-sm" />
        </div>
        <!-- input genre -->
        <?php
        $genreArray = [
            ["name" => "Aventure"],
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
                <input type="checkbox" name="genre" class="checkbox" value="<?php $genre ["name"]?>"/>
            </div>
            <?php endforeach ?>
        </div>
        <!-- input note -->
        <div class="mb-3">
            <label for="note" class="block font-semibold text-blue-900">Note</label>
            <input type="number" step="0.1" name="note" placeholder="" class="input input-bordered w-full max-w-sm" />
        </div>
        <!-- input plateforms -->
        <?php
        $plateformArray = [
            ["name" => "Switch"],
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
                <input type="checkbox" name="plateforms" class="checkbox" value="<?php $plateform ["name"]?>"/>
            </div>
            <?php endforeach ?>
        </div>
        <!-- input description -->
        <div class="mb-3">
            <label for="description" class="block font-semibold text-blue-900">Description</label>
            <textarea type="text" name="description" placeholder="" class="textarea textarea-bordered h-48 w-full max-w-sm"> </textarea>
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
            
            <select class="select select-bordered w-full max-w-sm">
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