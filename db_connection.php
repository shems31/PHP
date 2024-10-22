<?php
$host = 'localhost';  // Serveur MySQL
$db = 'mon_projet';  // Nom de ta base de données
$user = 'root';  // Nom d'utilisateur MySQL (par défaut 'root' sur XAMPP)
$pass = '';  // Mot de passe MySQL (par défaut vide sur XAMPP)

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit();
}
