<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
include 'db_connection.php';


$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV</title>
    <link rel="stylesheet" href="./css/cv.css">
</head>
<body>
    <h1>Mon CV</h1>
    <p>Voici la page de mon CV.</p>

    <form action="save_cv.php" method="POST" enctype="multipart/form-data">
        <label for="cv_file">Télécharger votre CV (PDF) :</label>
        <input type="file" name="cv_file" accept="application/pdf" required><br>

        <input type="submit" value="Publier/Mettre à jour CV">
    </form>

    <?php
    if (!empty($user['cv_file'])) {
        echo '<a href="uploads/' . htmlspecialchars($user['cv_file']) . '" target="_blank">Voir le CV PDF</a>';
    } else {
        echo 'Aucun CV PDF disponible.';
    }
    ?>
</body>
</html>
