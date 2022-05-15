<?php

if ($_GET["username"] === '' || $_GET["password"] === '') {
    echo json_encode(["response" => "error", "message" => "Veuillez remplir les deux champs"]);
    die;
}

$database = new mysqli("localhost", "root", "", "si_gestion_publi");

if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
}

$request = $database->prepare("SELECT idMembre, nom, prenom, idDomaine FROM membres WHERE username=? AND password=?");
$request->bind_param('ss', $_GET['username'], $_GET['password']);

$request->execute();
$request->bind_result($userId, $nom, $prenom, $idDomaine);
$request->fetch();


if (isset($userId)) {
    echo json_encode(["response" => "success"]);
    session_start();
    $_SESSION['connectedId'] = $userId;
} else {
    echo json_encode(["response" => "error", "message" => "Nom de compte ou mot de passe incorrect"]);
}
