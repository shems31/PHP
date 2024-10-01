<?php
// admin/dashboard.php
include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/db.php';
session_start();

// Vérifier si l'utilisateur est admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

?>

<div class="container">
    <h2>Panneau d'administration</h2>
    <ul>
        <li><a href="manage_users.php">Gérer les utilisateurs</a></li>
        <li><a href="manage_projects.php">Gérer les projets</a></li>
    </ul>
</div>

<?php
include '../includes/footer.php';
?>
