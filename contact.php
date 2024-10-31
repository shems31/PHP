<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="css/contact.css">
</head>
<body>
    <h1>Contact</h1>
    <p>Voici la page de contact.</p>

    <?php
    // Inclure PHPMailer via Composer
    require 'vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if (isset($_POST['submit'])) {
        if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['message'])) {
            echo "<p class='infos'>Veuillez remplir tous les champs.</p>";
        } else {
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $email = htmlspecialchars($_POST['email']);
            $message = htmlspecialchars($_POST['message']);

            // Utiliser PHPMailer pour envoyer l'email
            $mail = new PHPMailer(true);

            try {
                // Configuration du serveur SMTP
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';           // Serveur SMTP
                $mail->SMTPAuth   = true;
                $mail->Username   = 'ynovynov504@gmail.com';    // Adresse email de l'expéditeur
                $mail->Password   = 'epkw unid lnht qdmf';      // Mot de passe d'application Gmail
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                // Expéditeur et destinataire
                $mail->setFrom($email, $nom . ' ' . $prenom);   // Expéditeur (saisi par l'utilisateur)
                $mail->addAddress('ynovynov504@gmail.com');      // Destinataire (toi)

                // Contenu de l'email
                $mail->isHTML(true);
                $mail->Subject = 'Nouveau message de contact';
                $mail->Body    = "
                    <html><body>
                    <p><strong>Nom :</strong> $nom</p>
                    <p><strong>Prénom :</strong> $prenom</p>
                    <p><strong>Email :</strong> $email</p>
                    <p><strong>Message :</strong> $message</p>
                    </body></html>
                ";
                $mail->AltBody = "Nom: $nom\nPrénom: $prenom\nEmail: $email\nMessage: $message"; // Pour les clients qui ne supportent pas HTML

                // Envoi de l'email
                $mail->send();
                echo "<p class='success'>Votre message a bien été envoyé.</p>";
            } catch (Exception $e) {
                echo "<p class='error'>Une erreur est survenue lors de l'envoi : {$mail->ErrorInfo}</p>";
            }
        }
    }
    ?>

    <form action="" method="POST">
        <label for="nom">Nom:</label><br>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="prenom">Prénom:</label><br>
        <input type="text" id="prenom" name="prenom" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="5" required></textarea><br><br>

        <input type="submit" name="submit" value="Envoyer">
    </form>

</body>
</html>
