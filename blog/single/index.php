<?php
session_start();
if (!isset($_SESSION['connectedId'])) {
    header("Location: ../../index.html");
    Exit();
}
$database = new mysqli("localhost", "root", "", "si_gestion_publi");

if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
}

if (isset($_GET) && !empty($_GET)) {
    $idPublication = $_GET['idPublication'];

    $requestListOfId = $database->query("SELECT idPublication FROM `publication`");

    foreach ($requestListOfId as $row) {
        $listOfId[] = $row['idPublication'];
    }

    if (!in_array($idPublication, $listOfId)) {
        $idPublication = 1;
    }
} else {
    $idPublication = 1;
}

$requestPost = $database->query("SELECT * FROM `publication` INNER JOIN type ON publication.idType = type.idType WHERE publication.idPublication=$idPublication");

foreach ($requestPost as $row) {
    $postInfo = $row;
}

$requestListofAuthours = $database->query("SELECT prenom, nom FROM `membres` INNER JOIN publie ON membres.idMembre = publie.idMembre WHERE publie.idPublication = $idPublication");

foreach ($requestListofAuthours as $row) {

    $authourInfo = [];
    $authourInfo["prenom"] = $row["prenom"];
    $authourInfo["nom"] = $row["nom"];

    $listOfAuthours[] = $authourInfo;
}
// var_dump($listOfAuthours);
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
    <title><?php echo $postInfo["titre"] ?></title>
</head>

<body>

    <header>
        <ul>
            <li>Votre article</li>
            <li>
                <a href="../index.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#166053" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H6M12 5l-7 7 7 7" />
                    </svg>
                </a>
            </li>
        </ul>
    </header>

    <h1><?php echo $postInfo["titre"] ?></h1>
    <main>
        <div class="information">
            <div class="date">
                <p>Publié le <?php echo date("d/m/Y", strtotime($postInfo["publishedAt"])); ?></p>
            </div>
            <div class="origine">
                <p><strong>Origine</strong> : <?php echo $postInfo["origine"]; ?></p>
            </div>
            <div class="volume">
                <p><strong>Volume</strong> : <?php echo $postInfo["volume"] ?><?php if ($postInfo["issue"] !== null) {
                                                                                    echo " (" . $postInfo["issue"] . ")";
                                                                                } ?>, pages <?php echo $postInfo["pages"] ?></p>
            </div>
            <div class="publisher">
                <p><strong>Editeur</strong> : <?php echo $postInfo["publisher"] ?></p>
            </div>
            <div class="type">
                <p><strong>Type</strong> : <?php echo $postInfo["nom"] ?></p>
            </div>
            <div class="authours">
                <p><strong>Auteurs</strong> : <?php foreach ($listOfAuthours as $authour) {
                                                    echo $authour["prenom"] . " " . $authour["nom"] . "<span class='separator'></span>";
                                                } ?></p>
            </div>
        </div>
        <div class="content">
            <?php echo $postInfo["content"]; ?>
        </div>
    </main>

</body>

</html>