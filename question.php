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
  <?php
  $page = $_GET['page'];
  if($page < 0) {
    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
    header('Location: ' . $referer);
  }

  $limite = 5;

  $debut = ($page) * $limite;

  $requeteQuestion = $bdd->prepare('SELECT * FROM Questions LIMIT :limite OFFSET :debut;');
  $requeteQuestion->bindValue('limite', $limite, PDO::PARAM_INT);
  $requeteQuestion->bindValue('debut', $debut, PDO::PARAM_INT);
  $requeteQuestion->execute();

  while($data = $requeteQuestion->fetch()) {
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
  $requeteQuestion->closeCursor();
  ?>
  <p class="precsuiv"><a href="?page=<?php echo $page - 1; ?>">Précédent</a>
  -
<a href="?page=<?php echo $page + 1; ?>">Suivant</a></p>


</div>
<?php include("template/footer.php"); ?>
</body>
</html>
