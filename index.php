<!-- header -->
<?php
include ('partials/_header.php');
//inclure PDO pour la connexion à la BDD
require_once ("helpers/pdo.php");
$title = "Accueil";
?>
    <!-- main content -->
    <main class="mx-20 my-12">
        <div class="wrap_content-head text-center mb-20">
            <h1 class="text-blue-500 font-bold text-5xl">App-Game</h1>
            <p class="pt-3 font-medium italic">L'app qui répertorie vos jeux</p>
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
                    <!-- row 1 -->
                    <tr>
                        <th>1</th>
                        <td>Marion</td>
                        <td>Plateforme</td>
                        <td>Switch</td>
                        <td>33.99</td>
                        <td>7</td>
                        <td>
                            <a href="show.php">
                                <img src="images/loupe-private-eye.png" alt="loupe" class="w-4">
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    <!-- end main content -->
    
<!-- footer -->
<?php
include ('partials/_footer.php');
?>