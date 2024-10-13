<?php
// includes/db.php

$host = 'localhost';     // Hôte du serveur MySQL
$db   = 'mon_projet';    // Nom de votre base de données (selon votre script SQL)
$user = 'root';          // Nom d'utilisateur MySQL (par défaut 'root' sous XAMPP)
$pass = '';              // Mot de passe MySQL (vide par défaut sous XAMPP)
$charset = 'utf8mb4';    // Jeu de caractères

$dsn = "mysql:host=$host;dbname=$db;charset=$charset"; // Data Source Name
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Active les exceptions PDO
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Mode de fetch par défaut
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options); // Crée une instance PDO
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage(); // Affiche l'erreur
    exit();
}
