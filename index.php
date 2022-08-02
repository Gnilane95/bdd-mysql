<!-- header -->
<?php
session_start();
$title = "Accueil";
include ('partials/_header.php');
include ('helpers/functions.php');
//inclure PDO pour la connexion à la BDD
require_once ("helpers/pdo.php");

//1-Requête pour récupérer mes jeux
$sql = "SELECT * FROM jeux";

//2-on prépare la requête (preformatter une requête)
$query = $pdo->prepare($sql);
//3-Execute ma requête
$query->execute();
//4-On stock le résultat dans une variable
$games = $query->fetchAll();
#debug_array($games);


?>
    <!-- main content -->
    <main class="mx-20 my-12">
        <div class="wrap_content-head text-center mb-10">
            <h1 class="text-blue-500 font-black text-5xl">App-Game</h1>
            <p class="pt-3 font-medium italic">L'app qui répertorie vos jeux</p>
            
            <?php
            //Vérifier si la session error est vide ou pas
            if ($_SESSION ["error"]) { ?>
                <div class="bg-red-400 py-3 mt-3 mx-72 text-lg font-bold text-white">
                    <?= $_SESSION ["error"] ?>
                </div>
            <?php } else {
                echo "";
            }
            $_SESSION["error"] = [];
            ?>
        </div>

        <div class="overflow-x-auto">
            <table class="table w-full">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Genre</th>
                        <th>Plateforme</th>
                        <th>Prix</th>
                        <th>Pegi</th>
                        <th>Voir</th>
                    </tr>
                </thead>
                <tbody>
                           <?php
                                if (count($games) == 0) {
                                    echo "<tr><td class=text-center>Pas de jeux disponibles actuellement.</td></tr>";
                                } else { ?>
                                    <?php foreach ($games as $game) : ?>
                                    <tr>
                                        <th><?= $game ['id'] ?></th>
                                        <td><?= $game ['name'] ?></td>
                                        <td><?= $game ['genre'] ?></td>
                                        <td><?= $game ['plateforms'] ?></td>
                                        <td><?= $game ['price'] ?></td>
                                        <td><?= $game ['PEGI'] ?></td>
                                        <td>
                                            <a href="show.php?id=<?= $game['id']?>&name=<?= $game['name']?>">
                                                <img src="images/loupe-private-eye.png" alt="loupe" class="w-4">
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                    
                            <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
    <!-- end main content -->
    
<!-- footer -->
<?php
include ('partials/_footer.php');
?>