
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription - Kim Event</title>
  <link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="./inscription.css">
</head>
<body>

  <div class="form-container">
    <h2>Inscription</h2>
    <p>Créez un compte client</p>
    <form action="traitement_inscription.php" method="POST">
      <input type="text" name="nom" placeholder="Nom" required>
      <input type="email" name="email" placeholder="Adresse e-mail" required>
      <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
      <input type="password" name="confirm_mot_de_passe" placeholder="Confirmer le mot de passe" required>
      <input type="tel" name="telephone" placeholder="Téléphone (+225)" required>
      <button type="submit">S'inscrire</button>
    </form>
    <div class="link">
      Déjà un compte ? <a href="connexion.html">Connexion</a>
    </div>
  </div>

</body>
</html>
