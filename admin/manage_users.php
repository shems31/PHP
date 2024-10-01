<?php
// admin/manage_users.php
include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/db.php';
session_start();

// Vérifier si l'utilisateur est admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

// Gestion des utilisateurs
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    // Supprimer un utilisateur
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    echo "<script>alert('Utilisateur supprimé avec succès.');</script>";
}

// Récupérer tous les utilisateurs
$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();
?>

<div class="container">
    <h2>Gestion des utilisateurs</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['first_name']) ?></td>
                <td><?= htmlspecialchars($user['last_name']) ?></td>
                <td><?= htmlspecialchars($user['role']) ?></td>
                <td>
                    <a href="manage_users.php?action=delete&id=<?= $user['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
                    <!-- Vous pouvez ajouter d'autres actions comme l'édition -->
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
include '../includes/footer.php';
?>
