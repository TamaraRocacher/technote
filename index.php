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
  <?php
    $bdd = new PDO('mysql:host=localhost;dbname=Technote', 'root', 'theo030911');
    $requete = $bdd->query('SELECT * FROM Users;');

    while($data = $requete->fetch()) {
      echo ' Bienvenue '.$data['pseudo'];
    }
    $requete->closeCursor();
  ?>
  <section class="note">
    <h3>Titre a la con</h3>
    <div class="wysiwyg">
      <nav>
        <ul>
          <li>gras</li>
          <li>code</li>
          <li>autre</li>
        </ul>
      </nav>
    </div>
    <article>
      <p>
    Au cleal'c sur ajout note, apparait ici une technote vide, avec une barre d'outils
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
