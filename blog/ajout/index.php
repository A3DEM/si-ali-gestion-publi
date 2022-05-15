<?php
session_start();
if (!isset($_SESSION['connectedId'])) {
    header("Location: ../../index.html");
    exit();
}

$database = new mysqli("localhost", "root", "", "si_gestion_publi");
if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
}

if (isset($_POST["submit"])) {
$request = $database->prepare("INSERT INTO publication(`titre`, `publishedAt`, `content`, `origine`, `volume`, `issue`, `pages`, `publisher`, `idType`)");
VALUES ($_POST['titre'], $_POST['titre'], $_POST['publishedAt'],$_POST['content'],$_POST['origine'],$_POST['volume'],$_POST['issue'],$_POST['pages'],$_POST['publisher']));

}


if (isset($_GET['submit'])) {
    echo "GeeksforGeeks";
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
    <title>Ajouter un article</title>
</head>

<body>

    <header>
        <ul>
            <li>Ajouter un article</li>
            <li>
                <a href="../index.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#166053" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H6M12 5l-7 7 7 7" />
                    </svg>
                </a>
            </li>
        </ul>
    </header>

    <main>
        <form action="./index.php" method="post">
            <div>
                <label for="titre">Titre :</label>
                <input type="text" id="titre" name="titre">
            </div>
            <div>
                <label for="auteurs">Auteurs :</label>
                <select name="auteurs[]" id="auteurs" multiple="multiple">
                    <?php

                    $requestAuthours = $database->prepare("SELECT idMembre, nom, prenom FROM `membres`");
                    $requestAuthours->execute();
                    $requestAuthours->bind_result($idMembre, $nom, $prenom);

                    while ($requestAuthours->fetch()) {
                    ?>
                        <option value="<?php echo $idMembre; ?>"><?php echo $prenom . " " . $nom; ?></option>
                    <?php
                    }

                    $requestAuthours->close();
                    ?>
                </select>
            </div>
            <div>
                <label for="types">Types :</label>
                <?php
                $database->set_charset("UTF8");
                header('Content-type: text/html; charset=utf-8');
                $requestTypes = $database->prepare("SELECT * FROM `type`");
                $requestTypes->execute();
                ?>
                <select name="types" id="types" onchange="changeType()">
                    <?php
                    $requestTypes->bind_result($idType, $nomType);
                    while ($requestTypes->fetch()) {
                    ?>
                        <option value="<?php echo $idType; ?>"><?php echo $nomType; ?></option>
                    <?php
                    }
                    $requestTypes->close();
                    ?>
                </select>
            </div>
            <div>
                <label for="publishedAt">Date de publication :</label>
                <input type="text" id="publishedAt" name="publishedAt">
            </div>
            <div>
                <label for="origine" id="origine">Revue :</label>
                <input type="text" id="origine" name="origine">
            </div>
            <div>
                <label for="volume">Volume :</label>
                <input type="text" id="volume" name="volume">
            </div>
            <div>
                <label for="numero">Numéro :</label>
                <input type="text" id="numero" name="numero">
            </div>
            <div>
                <label for="pages">Pages :</label>
                <input type="text" id="pages" name="pages">
            </div>
            <div>
                <label for="editeur">Éditeur :</label>
                <input type="text" id="editeur" name="editeur">
            </div>
            <div>
                <label for="content">Contenu :</label>
                <textarea name="content" id="content" cols="30" rows="10"></textarea>
            </div>
            <div>
                <input type="submit" value="Ajouter" name="submit">
            </div>
        </form>
    </main>


    <script src="script.js"></script>
</body>

</html>