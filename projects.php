<?php
// projects.php
include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/db.php';

// Récupérer les projets validés depuis la base de données
$search = $_GET['search'] ?? '';
$query = "SELECT * FROM projects WHERE is_validated = 1";

if ($search) {
    $query .= " AND title LIKE :search";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['search' => "%$search%"]);
} else {
    $stmt = $pdo->query($query);
}

$projects = $stmt->fetchAll();
?>

<div class="container">
    <h2>Projets</h2>
    <form method="GET" action="projects.php">
        <input type="text" name="search" placeholder="Rechercher un projet">
        <button type="submit">Rechercher</button>
    </form>
    <div class="projects-list">
        <?php foreach ($projects as $project): ?>
            <div class="project">
                <h3><?= htmlspecialchars($project['title']) ?></h3>
                <p><?= htmlspecialchars($project['description']) ?></p>
                <img src="assets/images/<?= htmlspecialchars($project['image']) ?>" alt="<?= htmlspecialchars($project['title']) ?>">
                <!-- Bouton pour ajouter aux favoris -->
                <button>Ajouter aux favoris</button>
                <!-- Zone de commentaires -->
                <div class="comments">
                    <!-- Afficher les commentaires du projet -->
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
include 'includes/footer.php';
?>