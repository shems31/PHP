<?php
// contact.php
include 'includes/header.php';
include 'includes/navbar.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Traitement du formulaire et envoi de l'email
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Envoi de l'email (simplifié)
    mail('votre-email@example.com', 'Nouveau message de contact', $message, "From: $email");

    echo "<script>alert('Votre message a été envoyé avec succès.');</script>";
}
?>

<div class="container">
    <h2>Contactez-moi</h2>
    <form method="POST" action="contact.php">
        <!-- Formulaire de contact -->
        <input type="text" name="name" placeholder="Votre nom" required>
        <input type="email" name="email" placeholder="Votre email" required>
        <textarea name="message" placeholder="Votre message" required></textarea>
        <button type="submit">Envoyer</button>
    </form>

    <!-- Affichage d'une carte de la ville -->
    <div id="map"></div>
</div>

<script>
// Code JavaScript pour afficher une carte (par exemple, avec l'API Google Maps)
</script>

<?php
include 'includes/footer.php';
?>
