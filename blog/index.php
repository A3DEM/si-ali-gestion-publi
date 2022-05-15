<?php

$database = new mysqli("localhost", "root", "", "si_gestion_publi");

if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
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
    <title>Blog</title>
</head>

<body>
    <header>
        <ul>
            <li>Bienvenue sur votre blog</li>
            <li>
                <svg onclick="disconnect()" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                    stroke="#166053" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path>
                    <line x1="12" y1="2" x2="12" y2="12"></line>
                </svg>
            </li>
        </ul>
    </header>

    <main>
        <div class="content">
            <h2>Filtres</h2>
            <div class="search">

                <form action="./index.php" method="get">

                    <h3>Chercheur</h3>

                    <select name="chercheur" id="chercheur">
                        <option value="" selected>Tous</option>

                    <?php
                        $requestAuthours = $database->prepare("SELECT idMembre, nom, prenom FROM `membres`");     
                        $requestAuthours->execute();
                        $requestAuthours->bind_result($idMembre, $nom, $prenom);

                        while($requestAuthours->fetch()) {
                    ?>
                        <option value="<?php echo $idMembre; ?>" <?php if(!empty($_GET) && isset($_GET["chercheur"]) && $_GET["chercheur"] == $idMembre){ echo "selected"; } ?> ><?php echo $prenom." ".$nom; ?></option>
                    <?php
                        }
                        $requestAuthours->close();
                    ?>
                    </select>
                    
                    <h3>Année de publication</h3>
                    
                    <select name="annee" id="annee">
                        <option value="" selected>Tous</option>

                        <?php
                            $requestYear = $database->prepare("SELECT YEAR(publishedAt) FROM `publication` GROUP BY YEAR(publishedAt) ORDER BY YEAR(publishedAt) DESC");     
                            $requestYear->execute();
                            $requestYear->bind_result($year);

                            while($requestYear->fetch()) {
                        ?>

                            <option value="<?php echo $year; ?>" <?php if(!empty($_GET) && isset($_GET["annee"]) && $_GET["annee"] == $year){ echo "selected"; } ?> ><?php echo $year; ?></option>
                        <?php
                            }
                            $requestYear->close();
                        ?>
                    </select>

                    <h3>Type de publication</h3>

                    <select name="types" id="types">
                        <option value="" selected>Tous</option>

                    <?php                        
                        $requestTypes = $database->prepare("SELECT * FROM `type`");
                        $requestTypes->execute();
                        $requestTypes->bind_result($idType, $nomType);
                        while($requestTypes->fetch()) {
                    ?>
                    <option value="<?php echo $idType; ?>" <?php if(!empty($_GET) && isset($_GET["types"]) && $_GET["types"] == $idType){ echo "selected"; } ?> ><?php echo $nomType; ?></option>
                    <?php
                        }
                        $requestTypes->close();
                    ?>
                    </select>
                    <input type="submit" value="Filtrer">
                </form>
            </div>

            <h2>Ajouter un article</h2>

            <div class="add">
                <a href="./ajout/index.php">Ajouter</a>
            </div>

        </div>
        <div class="content">
            <h2>Articles</h2>
            <div class="articles">

            <?php

                $postsPerPage = 4;


                if(isset($_GET) && !empty($_GET) && (!empty($_GET["chercheur"]) || !empty($_GET["annee"]) || !empty($_GET["types"]))) {

                    // var_dump($_GET);
                    if(isset($_GET["chercheur"]) && $_GET["chercheur"] == "") {unset($_GET["chercheur"]);}
                    if(isset($_GET["annee"]) && $_GET["annee"] == "") {unset($_GET["annee"]);}
                    if(isset($_GET["types"]) && $_GET["types"] == "") {unset($_GET["types"]);}
                    // var_dump($_GET);                    

                    $queryFilter = "WHERE ";
                    if(isset($_GET["chercheur"]) && $_GET["chercheur"] !== "") {
                        $queryFilter.="idMembre=".$_GET["chercheur"]; 
                        (sizeof($_GET) > 1) ? $queryFilter.= " AND ": "";
                    }
                    if(isset($_GET["annee"]) && $_GET["annee"] !== "") {
                        $queryFilter.="YEAR(publishedAt)=".$_GET["annee"];
                        (sizeof($_GET) > 1 && end($_GET) !== $_GET["annee"]) ? $queryFilter.= " AND ": "";
                    }
                    (isset($_GET["types"]) && $_GET["types"] !== "") ? $queryFilter.="publication.idType=".$_GET["types"]: "";

                    $requestNumberOfPosts = $database->query("SELECT COUNT(publication.idPublication) FROM `publication` INNER JOIN type ON publication.idType = type.idType
                    INNER JOIN publie ON publication.idPublication = publie.idPublication $queryFilter GROUP BY publication.idPublication");
                    // var_dump("SELECT COUNT(publication.idPublication) FROM `publication` INNER JOIN type ON publication.idType = type.idType INNER JOIN publie ON publication.idPublication = publie.idPublication $queryFilter GROUP BY publication.idPublication");
                    // var_dump($requestNumberOfPosts->num_rows == 0);

                    foreach($requestNumberOfPosts as $response) {
                        $numberOfPosts = $response["COUNT(publication.idPublication)"];
                    }

                    if ($requestNumberOfPosts->num_rows == 0) {
                        $numberOfPosts = 0;
                    }
                    $numberOfPages = (int)ceil($numberOfPosts / $postsPerPage);
                    $currentPage = (int)($_GET['page'] ?? 1);
                    ($currentPage < 1 || $currentPage > $numberOfPages) ? $currentPage = 1: "";
                    $offset = $postsPerPage * ($currentPage - 1);
                    // var_dump($currentPage);

                    $query  = "SELECT publication.idPublication, titre, YEAR(publishedAt), type.nom as nomDomaine FROM `publication`
                    INNER JOIN type ON publication.idType = type.idType
                    INNER JOIN publie ON publication.idPublication = publie.idPublication "
                    . $queryFilter .
                    " GROUP BY publication.idPublication
                    ORDER BY publishedAt DESC LIMIT $postsPerPage OFFSET $offset";

                    // var_dump($query);

                    $requestPost = $database->query($query);
                    // var_dump($requestPost);

                } else {

                    $requestNumberOfPosts = $database->query("SELECT COUNT(idPublication) FROM `publication`");
                    foreach($requestNumberOfPosts as $response) {
                        $numberOfPosts = $response["COUNT(idPublication)"];
                    }
                    $numberOfPages = (int)ceil($numberOfPosts / $postsPerPage);
                    $currentPage = (int)($_GET['page'] ?? 1);
                    ($currentPage < 1 || $currentPage > $numberOfPages) ? $currentPage = 1: "";
                    $offset = $postsPerPage * ($currentPage - 1);
                    // var_dump($currentPage);

                    $requestPost = $database->query("SELECT idPublication, titre, YEAR(publishedAt), type.nom as nomDomaine FROM `publication` INNER JOIN type ON publication.idType = type.idType ORDER BY publishedAt DESC LIMIT $postsPerPage OFFSET $offset");
                    // var_dump($requestPost);
                }
            
                if ($requestPost->num_rows !== 0 ) {
                
                    foreach ($requestPost as $row) {
                    
                ?>
                <a href="./single/index.php?idPublication=<?php echo $row['idPublication']; ?>">
                    <div class="article">
                        <h3 class="title"><?php echo $row['titre']; ?></h3>
                        <hr>
                        <div class="authors">
                            <?php
                                $requestPostAuthours = $database->query("SELECT prenom, nom FROM `publie` INNER JOIN membres ON publie.idMembre = membres.idMembre WHERE idPublication = ".$row['idPublication']);

                                foreach($requestPostAuthours as $row2) {
                                    ?>

                                    <p><?php echo $row2["prenom"]." ".$row2["nom"]; ?></p>

                                    <?php
                                }
                            ?>
                        </div>
                        <div class="info">
                            <div class="type"><?php echo $row["nomDomaine"]; ?></div>
                            <div class="year"><?php echo $row["YEAR(publishedAt)"]; ?></div>
                        </div>
                    </div>
                </a>

            <?php
                    }                       
                } else {
                    echo "<h3>Il n'y a pas d'articles correspondant à votre recherche</h3>";
                }
            ?>
            </div>
            <div class="pagination">
                <?php
                
                    for($i = 1; $i <= $numberOfPages; $i++) {

                        $getFilters = "";
                        if(isset($_GET)) {
                            if(isset($_GET['chercheur'])) {$getFilters .= "&chercheur=".$_GET['chercheur'];}
                            if(isset($_GET['annee'])) {$getFilters .= "&annee=".$_GET['annee'];}
                            if(isset($_GET['types'])) {$getFilters .= "&types=".$_GET['types'];}
                        }
                        ?>
                            <a 
                            href="<?php echo "./index.php?page=$i$getFilters"; ?>" 
                            <?php if($currentPage == $i) { echo "class='active'";}?> 
                            ><?php echo $i; ?></a>
                        <?php
                    }

                ?>
                <!-- <a class="active" href="#">1</a>
                <a href="#">2</a>
                <a href="#">3</a> -->
            </div>
        </div>
    </main>

    <script src="script.js"></script>
</body>

</html>