<?php
// login.php
include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Traitement du formulaire de connexion
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérification dans la base de données
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Connexion réussie
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        header('Location: index.php');
        exit();
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
?>

<div class="container">
    <h2>Connexion</h2>
    <?php if (isset($error)): ?>
        <p><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST" action="login.php">
        <input type="email" name="email" placeholder="Votre email" required>
        <input type="password" name="password" placeholder="Votre mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>
</div>

<?php
include 'includes/footer.php';
?>
