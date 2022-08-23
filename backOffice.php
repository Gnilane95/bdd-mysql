<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.20.0/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Back-office</title>
</head>
<body>
    <div class="parent flex justify-between">
        <div class="nav_left bg-blue-600 text-white h-screen sticky top-0 w-[25%] px-14 pt-10">
            <ul class="">
                <li><a href="">Ajouter un nouveau jeux</a></li>
                <li><a href="">Modifier le jeu</a></li>
                <li><a href="">Liste des jeux</a></li>
                <li><a href="">Liste des users</a></li>
            </ul>
        </div>
        <div class="content_right px-14 pt-10 ">
            <?php 
            $main_title = "Ajouter des jeux"; 
            include ('partials/_h1.php');
            include('addGame.php');
            ?>
        </div>
    </div>
</body>
</html>