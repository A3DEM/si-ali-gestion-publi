<?php

$database = new mysqli("localhost", "root", "", "si_gestion_publi");

if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
}

$request = $database->prepare("SELECT idPublication, titre, publishedAt FROM `publication`");

$request->execute();
$request->bind_result($idPublication, $titre, $publishedAt);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <title>Blog</title>
</head>

<body>
    <header>
        <ul>
            <li>Bienvenue sur votre blog</li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                    stroke="#166053" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path>
                    <line x1="12" y1="2" x2="12" y2="12"></line>
                </svg>
            </li>
        </ul>
    </header>

    <main>
        <div class="content">
            <h2>Filtres et ajout</h2>
            <div class="search">
                <form action="#">
                    <h3>Chercheur</h3>
                    <select name="chercheur" id="chercheur">
                        <option value="1">Adem Duran</option>
                        <option value="2">Fares Abdelkrim</option>
                        <option value="3">Elon Musk</option>
                    </select>
                    <h3>Année de publication</h3>
                    <select name="annee" id="annee">
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                    </select>
                    <h3>Type de publication</h3>
                    <select name="type" id="type">
                        <option value="1">Revue</option>
                        <option value="2">Conférence</option>
                        <option value="3">Chapitre</option>
                        <option value="4">Livre</option>
                        <option value="5">Thèse</option>
                        <option value="6">Brevet</option>
                        <option value="7">Document judiciaire</option>
                        <option value="8">Autre</option>
                    </select>
                </form>
            </div>
            <div class="add">
                <a href="./ajout/index.php">Ajouter un article</a>
            </div>
        </div>
        <div class="content">
            <h2>Articles</h2>
            <div class="articles">

            <?php
            
            while($request->fetch()) {
                // $requestAuthors = $database->prepare("SELECT nom, prenom FROM `membres` INNER JOIN `publie` ON membres.idMembre = publie.idMembre WHERE publie.idPublication = $idPublication");
                // $requestAuthors->execute();
                // $requestAuthors->bind_result($idPublication, $titre, $publishedAt);
            ?>
                <a href="./single/index.php?idPublication=1">
                    <div class="article">
                        <h3 class="title"><?php echo $titre; ?></h3>
                        <hr>
                        <div class="authors">
                        </div>
                        <div class="year"><?php echo substr($publishedAt, 0, 4); ?></div>
                    </div>
                </a>

            <?php
            }
            ?>
            </div>
            <div class="pagination">
                <a class="active" href="#">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
            </div>
        </div>
    </main>


</body>

</html>