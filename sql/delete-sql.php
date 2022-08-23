<?php
//2- Je récupère l'id dans URL et je nettoie
$id = clear_xss($_GET["id"]);

//3-requête vers BDD
$sql = "DELETE FROM jeux WHERE id=?";

//4-je prépare ma requête
$query = $pdo->prepare ($sql);

//5-on exécute la requête
$query->execute([$id]);