<?php
// cv.php
include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/db.php';
session_start();

$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    // Récupérer les informations du CV depuis la base de données
    $stmt = $pdo->prepare("SELECT * FROM cv WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $cv = $stmt->fetch();

    // Traitement du formulaire de mise à jour du CV
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        // Mise à jour dans la base de données
        $stmt = $pdo->prepare("UPDATE cv SET title = ?, description = ? WHERE user_id = ?");
        $stmt->execute([$title, $description, $user_id]);
        echo "<script>alert('CV mis à jour avec succès.');</script>";
    }
}
?>

<div class="container">
    <h2>Mon CV</h2>

    <?php if ($user_id): ?>
        <form method="POST" action="cv.php">
            <input type="text" name="title" value="<?= htmlspecialchars($cv['title']) ?>" required>
            <textarea name="description" required><?= htmlspecialchars($cv['description']) ?></textarea>
            <button type="submit">Mettre à jour</button>
        </form>
    <?php else: ?>
        <p>Veuillez vous connecter pour voir et modifier votre CV.</p>
    <?php endif; ?>
</div>

<?php
include 'includes/footer.php';
?>