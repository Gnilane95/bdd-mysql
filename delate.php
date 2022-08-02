<?php
//démarre session
session_start();
include ('helpers/functions.php');
//1-Connexion à ma base de donnée

//inclure PDO pour la connexion à la BDD dans mon script
require_once ("helpers/pdo.php");

//2- Je récupère l'id dans URL et je nettoie
$id = clear_xss($_GET["id"]);

//3-requête vers BDD
$sql = "DELETE FROM jeux WHERE id=?";

//4-je prépare ma requête
$query = $pdo->prepare ($sql);

//5-on exécute la requête
$query->execute([$id]);

//6-redirection
$_SESSION ["success"] = "Le jeu est bien supprimé.";
header("Location:index.php");
