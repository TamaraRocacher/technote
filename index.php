<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="theme-color" content="#005D4B">
  <link rel="stylesheet" href="css/style.css" />
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/styles/default.min.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/highlight.min.js"></script>
</head>
<body>


<?php include("template/header.php"); ?>
<?php include("template/menu.php"); ?>
<?php include("template/bdd.php"); ?>

<div id="fenetre"> <!-- bordure et fond couleur diff -->
  <?php
  $page = $_GET['page'];
  if($page < 0) {
    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
    header('Location: ' . $referer);
  }

  $limite = 5;

  $debut = ($page) * $limite;

  $requeteNote = $bdd->prepare('SELECT * FROM Notes ORDER BY timestamp(date) DESC LIMIT :limite OFFSET :debut;');
  $requeteNote->bindValue('limite', $limite, PDO::PARAM_INT);
  $requeteNote->bindValue('debut', $debut, PDO::PARAM_INT);
  $requeteNote->execute();

  $date = new DateTime(substr($data['date'],0,10));

  while($data = $requeteNote->fetch()) {
    ?>
    <section class="note">
      <h3><?php echo $data['title'];
      $reqauthor = $bdd->prepare('SELECT pseudo FROM Users WHERE id=?;');
      $reqauthor->execute(array($data['user_id']));
      if($author = $reqauthor->fetch()) {
        ?><span><?php
        echo ' par '.$author['pseudo'].' le '.$date->format('d/m/Y');

      }

      ?></span></h3>
      <h6>Keywords:
        <?php
          $reqKeyword = $bdd->prepare('SELECT * FROM KeywordN WHERE note_id=?;');
          $reqKeyword->execute(array($data['note_id']));
          $taille = 0;

          if($keyw = $reqKeyword->fetch()) {
            $taille += strlen($keyw['texte']);
            echo $keyw['texte'];
          }
          while($keyw = $reqKeyword->fetch()) {
            $taille += strlen($keyw['texte']);
            if($taille > 80) {
              echo ', ...';
              break;
            }
            echo ', '.$keyw['texte'];
          }

          $reqKeyword->closeCursor();
         ?>
      </h6>
      <article>
        <p>
          <?php
              echo $data['texte'];
              ?>
        </p>
      </article>
        <form class="envoiCommentaire" method="post" action="postcom.php">
          <input type="submit" value="+" id="commentaire" />
          <input type="hidden" name="noteId" value="<?php echo $data['note_id'];?>" />
          <textarea required class="comment" name="comment" cols="30" rows="3" placeholder="Votre commentaire"></textarea>
        </form>
      <aside>
        <?php
          $requeteComment = $bdd->prepare('SELECT * FROM Comments WHERE note_id=:idd ORDER BY date DESC;');
          $requeteComment->bindValue('idd',$data['note_id'], PDO::PARAM_INT);
          $requeteComment->execute();
          while($commentFound = $requeteComment->fetch()) {

            $requser = $bdd->prepare('SELECT pseudo FROM Users WHERE id=:idd;');
            $requser->bindValue('idd', $commentFound['user_id'], PDO::PARAM_INT);
            $requser->execute();
            if($pseudo = $requser->fetch()) {
         ?>
        <div class="com">
          <h5>par <?php echo $pseudo['pseudo']; ?> le <?php echo $commentFound['date']; ?></h5>
          <p class="texteCom"><?php echo htmlspecialchars($commentFound['texte']); ?></p>
        </div>
        <?php
            }
            $requser->closeCursor();
          }
          $requeteComment->closeCursor();
         ?>
      </aside>
    </section>
  <?php
  }
  $requeteNote->closeCursor();
  ?>

  <p class="precsuiv"><a href="?page=<?php echo $page - 1; ?>">Précédent</a>
  -
<a href="?page=<?php echo $page + 1; ?>">Suivant</a></p>

</div>
<?php include("template/footer.php"); ?>

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<script>
  hljs.initHighlightingOnLoad();

</script>
</body>
</html>
