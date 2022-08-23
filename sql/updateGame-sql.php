<?php
//1- Ecriture de la requête
$sql = "UPDATE jeux SET name = :name, price = :price, genre = :genre, note = :note, plateforms = :plateforms, description = :description, PEGI = :PEGI, updated_at = NOW() WHERE id= :id";

//2- On prépare la requête
$query = $pdo->prepare($sql);

//3- On associe chaque requête à sa valeur et on protège contre les injections sql
$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->bindValue(':name', $nom, PDO::PARAM_STR);
$query->bindValue(':price', $price, PDO::PARAM_STMT);
$query->bindValue(':genre', implode("|", $genre_clear), PDO::PARAM_STR);
$query->bindValue(':plateforms', implode("|", $plateform_clear), PDO::PARAM_STR);
$query->bindValue(':note', $note, PDO::PARAM_STMT);
$query->bindValue(':description', $description, PDO::PARAM_STR);
$query->bindValue(':PEGI', $pegi, PDO::PARAM_STR);

//4- On exécute la requête
$query->execute();

//5- Redirection
$_SESSION["success"] = "Le jeu a bien été modifié";
header("Location: index.php");