<!-- header -->
<?php
//Démarrage de la session
session_start();
$title = "Accueil";
include ('partials/_header.php');
include ('helpers/functions.php');
//inclure PDO pour la connexion à la BDD
require_once ("helpers/pdo.php");
//Traitement du formulaire
//Création du formulaire
$error = [];
$errorMessage = "<span class=text-red-500>Ce champs est obligatoire</span>";
$success = false ;

//1- Je récupère le jeu avec le bon id
    //a-On vérifie que l'id existe (ou pas vide) et qu'il est numérique
if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
//b-Je nettoie mon id contre xss
    $id = clear_xss($_GET['id']);
//c-faire la requête vers BDD
    $sql = "SELECT * FROM jeux WHERE id=:id";
//d-Préparation de la requête
    $query = $pdo->prepare($sql);
//e-Sécuriser la requête contre les injections sql
    $query->bindValue(':id',$id, PDO::PARAM_INT);
//f-Exécuter la requête
    $query->execute();
//g-On stock dans une variable le jeu récupéré
    $game= $query->fetch();
    #debug_array($game);
    #$game=[];
    if (!$game) {
        $_SESSION["error"]="Ce jeu est indisponible !";
        header("Location: index.php");
    }
} else {
    $_SESSION["error"]="URL invalide !";
    header("Location: index.php");
};
//2-J'envoie vers la BDD
if (!empty($_POST["submited"]) && isset($_FILES["url_img"]) && $_FILES["url_img"]["error"] == 0) {
    //2-Faille xss
        require_once("validation-formulaire/include.php");
        if (count($error) == 0){
            require_once("sql/updateGame-sql.php");
        }
}

?>

<section>
    <div class="wrap_content-head my-3">
        <a href="index.php" class="mx-10 text-blue-800"><-Retour</a>
        <?php 
            $main_title = "Modifier le jeu";
            include('partials/_h1.php');
        ?>
    </div>
    <form action="" method="POST" class="mx-48">
        <!-- input name -->
        <div class="mb-3">
            <label for="name" class="block font-semibold text-blue-900">Name</label>
            <input type="text" name="name" placeholder="" class="input input-bordered w-full max-w-sm" value="<?= $game["name"] ?>"/>
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
            <input type="number" step="any" name="price" placeholder="" class="input input-bordered w-full max-w-sm" value="<?= $game ["price"] ?>"/>
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

        // On crée un nvo tableau la valeur de la BDD en utilisant la méthode explode
        $arr_genre = explode ("|",$game["genre"]);
        #debug_array ($arr_genre)
        ?>
        <h2 class="mt-5 mb-2 font-semibold text-blue-900">Genre</h2>
        <div class="flex items-center space-x-8 mb-5">
            <?php foreach ($genreArray as $genre) : ?>
            <div class="flex items-center space-x-2 ">
                <label for="genre" class="block font-semibold"><?= $genre ["name"]?></label>
                <input type="checkbox" name="genre[]" class="checkbox" value="<?= $genre ["name"]?>" <?php 
                if (in_array($genre["name"], $arr_genre)) echo "checked" ;
                ?>/>
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
            value="<?= $game ["note"] ?>"/>
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
        $arr_plateform = explode ("|",$game["plateforms"]);
        ?>
        <h2 class="mt-5 mb-2 font-semibold text-blue-900">Plateforme</h2>
        <div class="flex items-center space-x-8 mb-5">
            <?php foreach ($plateformArray as $plateform) : ?>
            <div class="flex items-center space-x-2 ">
                <label for="plateforms" class="block  font-semibold"><?= $plateform ["name"]?></label>
                <input type="checkbox" name="plateforms[]" class="checkbox" value="<?= $plateform ["name"]?>" <?php
                    if (in_array($plateform["name"], $arr_plateform)) echo "checked" ;
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
            <textarea type="text" name="description" placeholder="" class="textarea textarea-bordered h-48 w-full max-w-sm"> <?= $game ["description"] ?> </textarea>
            <p>
                <?php
				if(!empty($error["description"])){
					echo $error["description"];
				} ?>
            </p>
        </div>
        <!-- input pegi -->
        <?php $pegiArray = [
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
                <option value="<?= $pegi ["name"]?>"<?php if ($game["PEGI"] == $pegi["name"]) echo 'selected = "selected"'; ?> > <?= $pegi ["name"] ?></option>
                <?php endforeach ?>
            </select>
            <p>
                <?php
				if(!empty($error["pegi"])){
					echo $error["pegi"];
				} ?>
            </p>
        </div>
        <!-- input id -->
        <input type="hidden" name="id" value="<?= $game["id"]?>">

        <!-- upload img -->
        <div class="py-5">
            <label for="url_img" class="block font-bold text-blue-900">Votre image</label>
            <input type="file" name="url_img" id="url_img" class="pt-3">
            <p>
                <?php
				if(!empty($error["url_img"])){
					echo $error["url_img"];
				} ?>
            </p>
        </div>

        <!-- submit btn -->
        <div>
          <input type="submit" name="submited" value="Modifier" class="btn btn-primary bg-blue-600">  
        </div>
    </form>
</section>
    
<!-- footer -->
<?php
include ('partials/_footer.php');
?>