<?php

    if(isset($_GET)) {
        $database = new mysqli("localhost", "root", "", "si_gestion_publi");

        if ($database->connect_error) {
            die("Connection failed: " . $database->connect_error);
        }
        
        $request = $database->prepare("SELECT * FROM `publication` INNER JOIN type ON publication.idType = type.idType WHERE idPublication=$_GET['idPublication']");
        
        $request->execute();
        $request->bind_result($idPublication, $titre, $publishedAt);
    }



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
    <title>Single</title>
</head>
<body>

    <header>
            <ul>
                <li>Votre article</li>
                <li>
                    <a href="../index.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#166053" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H6M12 5l-7 7 7 7"/></svg>
                    </a>
                </li>
            </ul>
        </header>

    <h1>Application des mathematiques a la medecine</h1>
    <main>
        <div class="information">
            <div class="date">
                Publié le 01/05/2022
            </div>
            <div class="origine">
               <strong>Origine</strong> : Sciences et vie junior
            </div>
            <div class="volume">
            <strong>Volume</strong> : Edition matématiques (4), pages 4 à 8
            </div>
            <div class="publisher">
            <strong>Editeur</strong> : Reworld Media
            </div>
            <div class="type">
            <strong>Type</strong> : Mathématiques
            </div>
        </div>
        <div class="content">
            L'application des mathématiques à la médecine est de plus en plus importante. D'autant plus qu'il est nécessaire au mathématiciens de développer leurs recherches autour du secteur de la santé étant donné les futurs enjeux majeurs des prochaines crises pandémiques auxquelles le monde pourrait être confronté.
        </div>
    </main>

</body>
</html>