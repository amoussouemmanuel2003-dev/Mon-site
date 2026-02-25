<?php
session_start();

// Connexion à la base
try {
    $bd = new PDO('mysql:host=localhost;dbname=kim_event;charset=utf8;', 'root', '');
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if (isset($_POST['Envoyer'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $mot_de_passe = $_POST['mot_de_passe'];
    $confirm_mot_de_passe = $_POST['confirm_mot_de_passe'];

    // Vérifier si tous les champs sont remplis
    if (!empty($nom) && !empty($email) && !empty($telephone) && !empty($mot_de_passe) && !empty($confirm_mot_de_passe)) {

        // Vérifier si les mots de passe correspondent
        if ($mot_de_passe !== $confirm_mot_de_passe) {
            die("❌ Les mots de passe ne correspondent pas.");
        }

        // Vérifier si l'email existe déjà
        $checkEmail = $bd->prepare("SELECT * FROM client WHERE email = ?");
        $checkEmail->execute([$email]);
        if ($checkEmail->rowCount() > 0) {
            die("❌ Cet email est déjà utilisé.");
        }

        // Hacher le mot de passe
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        // Insertion en base
        $insertClient = $bd->prepare("INSERT INTO client (nom, email, telephone, mot_de_passe) VALUES (?, ?, ?, ?)");
        $insertClient->execute([$nom, $email, $telephone, $mot_de_passe_hash]);

        // Récupération des infos pour session
        $recupClient = $bd->prepare("SELECT * FROM client WHERE email = ?");
        $recupClient->execute([$email]);
        $clientData = $recupClient->fetch();

        $_SESSION['id'] = $clientData['id'];
        $_SESSION['nom'] = $clientData['nom'];
        $_SESSION['email'] = $clientData['email'];

        echo "✅ Inscription réussie ! Bienvenue " . $_SESSION['nom'];
        // Redirection si besoin
        // header("Location: espace_client.php");
    } else {
        echo "❌ Veuillez remplir tous les champs.";
    }
}
?>
4
