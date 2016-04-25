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
    <h3>Connexion</h3>
    <?php
      if(isset($_GET['error'])){
        echo 'Un ou plusieurs champs sont incorrects';
      }

     ?>
    <article>
      <form method="post" action="check-signin.php">
        <input name="email" type="text" placeholder="Email" required /><br>
        <input name="passwd" type="password" placeholder="Password" required /><br>
        <input type="submit" value="Connexion" />
      </form>
  </article>
  </section>

</div>
<?php include("template/footer.php"); ?>
</body>
</html>
