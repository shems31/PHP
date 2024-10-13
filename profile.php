<?php
// profile.php
include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/db.php';

$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    // Récupérer les informations de l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    // Traitement du formulaire de mise à jour du profil
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        // Mise à jour dans la base de données
        $stmt = $pdo->prepare("UPDATE users SET first_name = ?, last_name = ? WHERE id = ?");
        $stmt->execute([$first_name, $last_name, $user_id]);
        echo "<script>alert('Profil mis à jour avec succès.');</script>";
    }
}
?>

<div class="container">
    <h2>Mon Profil</h2>

    <?php if ($user_id): ?>
        <form method="POST" action="profile.php">
            <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>
            <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>
            <button type="submit">Mettre à jour</button>
        </form>
    <?php else: ?>
        <p>Veuillez vous connecter pour voir et modifier votre profil.</p>
    <?php endif; ?>
</div>

<?php
include 'includes/footer.php';
?>
