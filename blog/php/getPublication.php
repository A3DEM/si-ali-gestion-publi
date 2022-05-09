<?php

$database = new mysqli("localhost", "root", "", "si_gestion_publi");

if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
}

$request = $database->prepare("SELECT * FROM publication");

$request->execute();
$request->bind_result($idPublication, $titre, $publishedAt, $content, $origine, $volume, $issue, $pages, $ublisher, $idType);
$request->fetch();
