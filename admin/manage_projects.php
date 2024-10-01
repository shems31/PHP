<?php
// admin/manage_projects.php
include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/db.php';
session_start();

// Vérifier si l'utilisateur est admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

// Gestion des projets
if (isset($_GET['action']) && isset($_GET['id'])) {
    $project_id = $_GET['id'];
    if ($_GET['action'] == 'validate') {
        // Valider un projet
        $stmt = $pdo->prepare("UPDATE projects SET is_validated = 1 WHERE id = ?");
        $stmt->execute([$project_id]);
        echo "<script>alert('Projet validé avec succès.');</script>";
    } elseif ($_GET['action'] == 'delete') {
        // Supprimer un projet
        $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
        $stmt->execute([$project_id]);
        echo "<script>alert('Projet supprimé avec succès.');</script>";
    }
}

// Récupérer tous les projets
$stmt = $pdo->query("SELECT p.*, u.first_name, u.last_name FROM projects p JOIN users u ON p.user_id = u.id");
$projects = $stmt->fetchAll();
?>

<div class="container">
    <h2>Gestion des projets</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Validé</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projects as $project): ?>
            <tr>
                <td><?= htmlspecialchars($project['id']) ?></td>
                <td><?= htmlspecialchars($project['title']) ?></td>
                <td><?= htmlspecialchars($project['first_name'] . ' ' . $project['last_name']) ?></td>
                <td><?= $project['is_validated'] ? 'Oui' : 'Non' ?></td>
                <td>
                    <?php if (!$project['is_validated']): ?>
                        <a href="manage_projects.php?action=validate&id=<?= $project['id'] ?>">Valider</a>
                    <?php endif; ?>
                    <a href="manage_projects.php?action=delete&id=<?= $project['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?');">Supprimer</a>
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
