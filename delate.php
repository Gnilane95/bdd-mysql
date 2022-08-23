<?php
//démarre session
session_start();
include ('helpers/functions.php');
//1-Connexion à ma base de donnée

//inclure PDO pour la connexion à la BDD dans mon script
require_once ("helpers/pdo.php");
require_once ("sql/delete-sql.php");

//6-redirection
$_SESSION ["success"] = "Le jeu est bien supprimé.";
header("Location:index.php");
