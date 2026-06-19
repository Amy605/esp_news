<?php
$host = "localhost";
$user = "mglsi_user";
$pass = "passer";
$db   = "mglsi_news";

$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("<p style='color:red'>Erreur de connexion : " . $conn->connect_error . "</p>");
}
?>