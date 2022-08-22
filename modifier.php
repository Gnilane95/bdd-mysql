<!-- header -->
<?php
//Démarrage de la session
session_start();
$title = "Accueil";
include ('partials/_header.php');
include ('helpers/functions.php');
//inclure PDO pour la connexion à la BDD
require_once ("helpers/pdo.php");
//debug_array($_GET)

//1- on vérifie que id existant du jeu
    //a-On vérifie que l'id existe (ou pas vide) et qu'il est numérique
if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
//2-Je nettoie mon id contre xss
    $id = clear_xss($_GET['id']);
//3-faire la requête vers BDD
    $sql = "SELECT * FROM jeux WHERE id=:id";
//4-Préparation de la requête
    $query = $pdo->prepare($sql);
//5-Sécuriser la requête contre les injections sql
    $query->bindValue(':id',$id, PDO::PARAM_INT);
//6-Exécuter la requête
    $query->execute();
//7-On stock tout dans une variable
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
}

?>

<!-- main content -->
    <main class="mx-20 my-12">
       
    </main>
<!-- end main content -->
    
<!-- footer -->
<?php
include ('partials/_footer.php');
?>

<div class="pt-16">
    
</div>