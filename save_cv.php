<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'db_connection.php';

$user_id = $_SESSION['user_id'];

if (isset($_FILES['cv_file']) && $_FILES['cv_file']['error'] == 0) {
    $file = $_FILES['cv_file'];
    $fileName = $_FILES['cv_file']['name'];
    $fileTmpName = $_FILES['cv_file']['tmp_name'];
    $fileSize = $_FILES['cv_file']['size'];
    $fileError = $_FILES['cv_file']['error'];
    $fileType = $_FILES['cv_file']['type'];

    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowed = ['pdf'];

    if (in_array($fileExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 5000000) {
                $newFileName = uniqid('', true) . "." . $fileExt;
                $fileDestination = 'uploads/' . $newFileName;
                
                // Déplacer le fichier vers le dossier uploads/
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    $sql = "UPDATE users SET cv_file = ? WHERE id = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$newFileName, $user_id]);

                    header('Location: cv.php?uploadsuccess');
                } else {
                    echo "Impossible de déplacer le fichier.";
                }
            } else {
                echo "Le fichier est trop volumineux.";
            }
        } else {
            echo "Erreur lors de l'upload du fichier.";
        }
    } else {
        echo "Seuls les fichiers PDF sont autorisés.";
    }
} else {
    echo "Aucun fichier n'a été uploadé.";
}
