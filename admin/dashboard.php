<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container">
    <h1>Bienvenue, <?= htmlspecialchars($_SESSION['first_name']) ?>!</h1>
    <p>Vous êtes connecté en tant que <?= htmlspecialchars($_SESSION['role']) ?>.</p>
    <!-- Ici, vous pouvez ajouter du contenu spécifique au tableau de bord -->
</div>

<?php include 'includes/footer.php'; ?>
