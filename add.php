<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="theme-color" content="#005D4B">
  <link rel="stylesheet" href="css/style.css" />
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>


<?php include("template/header.php"); ?>
<?php include("template/menu.php"); ?>

<div id="fenetre"> <!-- bordure et fond couleur diff -->
  <section class="note">
    <h3>Créer une Technote ou une Question</h3>
    <?php
      if(isset($_GET['error'])){
        echo 'Un ou plusieurs champs sont incorrects';
      }

     ?>
    <article>
      <form method="post" action="check-add.php">
        <label for="choix">Créer :</label>
        <select name="choix" id="choix">
          <option value="choix1">Technote</option>
          <option value="choix2">Question</option>
        </select><br>
        <label for="title">Titre :</label>
        <input id="title" name="title" type="text" placeholder="Titre"/><br>
        <label for="texte">Texte :</label>
        <textarea name="texte" rows="10" cols="70"></textarea><br>
        <label for="keywords">Mot-clés : </label>
        <input id="keywords" name="keywords" type="text" placeholder="Mot-clés séparés par une virgule"/><br>
        <input type="submit" value="Envoyer" />
      </form>
  </article>
  </section>

</div>
<?php include("template/footer.php"); ?>
</body>
</html>
