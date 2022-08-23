<!-- header -->
<?php
session_start();
$title = "Accueil";
include ('partials/_header.php');
include ('helpers/functions.php');
//inclure PDO pour la connexion à la BDD
require_once ("helpers/pdo.php");

require_once ("sql/selectAll-sql.php");
#debug_array($games);


?>
    <!-- main content -->
    <main class="mx-20 my-12">
        <div class="wrap_content-head text-center mb-10">
            <?php 
            $main_title = "App Game";
            include('partials/_h1.php');
            ?>
            <p class="pt-3 font-medium italic">L'app qui répertorie vos jeux</p>
            <!-- button ajouter un jeu-->
            <div class="mt-10">
                <a href="addGame.php" class="btn btn-primary">Ajouter un jeu</a>
            </div>
            <?php require_once('partials/_alert.php') ?>
        </div>

        <div class="overflow-x-auto">
            <table class="table w-full">
                <!-- head -->
                <thead>
                    <tr>
                        <th></th>
                        <th>Nom</th>
                        <th>Genre</th>
                        <th>Plateforme</th>
                        <th>Prix</th>
                        <th>Pegi</th>
                        <th>Voir</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                            $index = 1 ;
                            if (count($games) == 0) {
                                echo "<tr><td class=text-center>Pas de jeux disponibles actuellement.</td></tr>";
                            } else { ?>
                                <?php foreach ($games as $game) : ?>
                                <tr class="hover:text-blue-500 hover:font-bold">
                                    <th class="text-red-500"><?= $index++ ?></th>
                                    <td><a href="show.php?id=<?= $game['id']?>&name=<?= $game['name']?>"><?= $game ['name'] ?></a></td>
                                    <td><a href="show.php?id=<?= $game['id']?>&name=<?= $game['name']?>"><?= $game ['genre'] ?></a></td>
                                    <td><a href="show.php?id=<?= $game['id']?>&name=<?= $game['name']?>"><?= $game ['plateforms'] ?></a></td>
                                    <td><a href="show.php?id=<?= $game['id']?>&name=<?= $game['name']?>"><?= $game ['price'] ?></a></td>
                                    <td><a href="show.php?id=<?= $game['id']?>&name=<?= $game['name']?>"><?= $game ['PEGI'] ?></a></td>
                                    <td>
                                        <a href="show.php?id=<?= $game['id']?>&name=<?= $game['name']?>">
                                            <img src="images/loupe-private-eye.png" alt="loupe" class="w-4">
                                        </a>
                                    </td>
                                    <td>
                                        <?php include ('partials/_modal.php') ?>
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