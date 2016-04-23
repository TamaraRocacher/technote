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
<?php include("template/bdd.php"); ?>

<div id="fenetre"> <!-- bordure et fond couleur diff -->
  <?php
    if(isset($_SESSION['pseudo']) AND strlen($_SESSION['pseudo']) > 2) {
      echo 'Bonjour '.$_SESSION['pseudo'].'. Nous avons inséré un cookie bienveillant dans votre PC. Bon appétit.';
    }
  ?>
  <section class="note">
    <h3>Titre a la con</h3>
    <article>
      <p>
    Au clic sur ajout note, apparait ici une technote vide, avec une barre d'outils
    wiziwig en vert degradé sous le titre .<br>
    options: gras, titre, code source
  </p>
  </article>
    <button id ="commentaire" >+</button>
  </section>

  <?php
  $requeteNote = $bdd->query('SELECT * FROM Notes;');

  while($data = $requeteNote->fetch()) {
    ?>
    <section class="note">
      <h3><?php echo $data['title']; ?></h3>
      <article>
        <p>
          <?php echo $data['texte']; ?>
        </p>
      </article>
      <button id ="commentaire" >+</button>
    </section>
  <?php
  }
  $requeteNote->closeCursor();
  ?>


</div>
<?php include("template/footer.php"); ?>
</body>
</html>
