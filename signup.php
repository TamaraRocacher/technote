<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="theme-color" content="#005D4B">
  <link rel="stylesheet" href="css/style.css" />
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
</head>
<body>


<?php include("template/header.php"); ?>
<?php include("template/menu.php"); ?>

<div id="fenetre"> <!-- bordure et fond couleur diff -->
  <section class="note">
    <h3>Inscription</h3>
    <?php
      if(isset($_GET['error'])){
        echo 'Un ou plusieurs champs sont incorrects';
      }

     ?>
    <article>
      <form method="post" action="check-signup.php">
        <input name="email" type="text" placeholder="Email"/><br>
        <input name="pseudo" type="text" placeholder="Pseudonyme"/><br>
        <input name="passwd" type="password" placeholder="Password"/><br>
        <input type="submit" value="S'inscrire" />
      </form>
  </article>
  </section>
</div>

<?php include("template/footer.php"); ?>
</body>
</html>
