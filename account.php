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
    <section class="note">
      <h3>Votre compte</h3>
      <article>
        <p>
          <?php
            if(!isset($_SESSION['pseudo'])) {
              header('Location: index.php');
            }
            echo 'ID : '.$_SESSION['id'].'<br>';
            echo 'Pseudo : '.$_SESSION['pseudo'].'<br>';
            echo 'Email : '.$_SESSION['email'].'<br>';
            echo 'Pass hash : '.$_SESSION['passwd'].'<br>';
            echo 'Statut : ';
              if(isset($_SESSION['status']) AND $_SESSION['status']==0) {
                echo "Administrateur";
              }
              else {
                echo "Membre";
              }
              echo '<br>';
           ?>
        </p>
      </article>
    </section>


</div>
<?php include("template/footer.php"); ?>
</body>
</html>
