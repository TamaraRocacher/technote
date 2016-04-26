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
      <article>
        <p>
          <?php
            $req = $bdd->prepare('SELECT * FROM Questions WHERE user_id=? ORDER BY date DESC;');
            $req->execute(array($_SESSION['id']));
           ?>
          <table>
            <tr>
              <th>Titre Question</th>
              <th>Marquer comme résolu</th>
              <th>Supprimer</th>
            </tr><?php
            while($data = $req->fetch()) {
              ?>
                    <tr <?php
                      if($data['status'] = 1) {
                        echo 'class="resolved"';
                      }
                      ?>>
                      <td>
                        <?php echo $data['title']; ?>
                      </td>
                      <td>
                        <a class="delete" href="admin/resolved.php?id=<?php
                        echo $data['question_id']; ?>">+</a>
                      </td>
                      <td>
                        <a class="delete" href="admin/deletePost.php?id=<?php
                        echo $data['question_id']; ?>">+</a>
                      </td>
                    </tr>
                    <?php
                    }
                    $req->closeCursor();
                    ?>
          </table>
        </p>
      </article>
    </section>


</div>
<?php include("template/footer.php"); ?>
</body>
</html>
