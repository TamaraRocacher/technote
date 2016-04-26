<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="theme-color" content="#005D4B">
  <link rel="stylesheet" href="../css/style.css" />
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>


<?php include("../template/header.php"); ?>
<?php include("../template/menu.php"); ?>
<?php include("../template/bdd.php"); ?>

<div id="fenetre"> <!-- bordure et fond couleur diff -->
  <?php
  if($_SESSION['status']!=0) { //On redirige les non admin de la page
    header('Location: index.php');
  }

  $page = $_GET['page'];
  if($page < 0) {
    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
    header('Location: ' . $referer);
  }

  $limite = 5;

  $debut = ($page) * $limite;

  $requeteUser = $bdd->prepare('SELECT * FROM Users LIMIT :limite OFFSET :debut;');
  $requeteUser->bindValue('limite', $limite, PDO::PARAM_INT);
  $requeteUser->bindValue('debut', $debut, PDO::PARAM_INT);
  $requeteUser->execute();

  ?>
  <section class="note">
    <h3>Administration</h3>
    <article>
      <table>
        <tr>
          <th>Pseudo</th>
          <th>Email</th>
          <th>Password Hash</th>
          <th>Supprimer le compte</th>
        </tr>
  <?php

  while($data = $requeteUser->fetch()) {
    ?>

          <tr>
            <td>
              <?php echo $data['pseudo']; ?>
            </td>
            <td>
              <?php echo $data['email']; ?>
            </td>
            <td>
              <?php echo $data['password']; ?>
            </td>
            <td>
              <a class="delete" href="delete.php?id=<?php
              echo $data['id']; ?>">-</a>
            </td>
          </tr>

  <?php
  }
  $requeteUser->closeCursor();
  ?>
  </table>
  </article>
  </section>
  <p class="precsuiv"><a href="?page=<?php echo $page - 1; ?>">Précédent</a>
  -
<a href="?page=<?php echo $page + 1; ?>">Suivant</a></p>


</div>
<?php include("template/footer.php"); ?>
</body>
</html>
