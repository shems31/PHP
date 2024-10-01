<?php
// includes/navbar.php
session_start();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Mon Site</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="cv.php">CV</a></li>
            <li class="nav-item"><a class="nav-link" href="projects.php">Projets</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        </ul>
        <ul class="navbar-nav">
            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item"><a class="nav-link" href="profile.php"><?= htmlspecialchars($_SESSION['first_name']) ?></a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Déconnexion</a></li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="login.php">Connexion</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
