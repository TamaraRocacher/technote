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

  $requeteQuestion = $bdd->prepare('SELECT * FROM Questions ORDER BY timestamp(date) DESC LIMIT :limite OFFSET :debut ;');
  $requeteQuestion->bindValue('limite', $limite, PDO::PARAM_INT);
  $requeteQuestion->bindValue('debut', $debut, PDO::PARAM_INT);
  $requeteQuestion->execute();

  $date = new DateTime(substr($data['date'],0,10));

  while($data = $requeteQuestion->fetch()) {
    ?>
    <section class="question">
      <h3 class="<?php
        if($data['status'] == 0) {
          echo 'titreQuestion1';
        }
        else {
          echo 'titreQuestion2';
        }
      ?>"><?php echo $data['title'];
      $reqauthor = $bdd->prepare('SELECT pseudo FROM Users WHERE id=?;');
      $reqauthor->execute(array($data['user_id']));


      ?></h3>
      <h6>Keywords:
        <?php
          $reqKeyword = $bdd->prepare('SELECT * FROM KeywordQ WHERE question_id=?;');
          $reqKeyword->execute(array($data['question_id']));
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
      <article id="artQuest">
        <h5><?php if($author = $reqauthor->fetch()) {
          echo $author['pseudo'].' le '.$date->format('d/m/Y');
        }
        ?></h5>
        <p>
          <?php
              echo $data['texte'];
              ?>
        </p>
      </article>
        <?php
          $requeteComment = $bdd->prepare('SELECT * FROM Answers WHERE question_id=:idd ORDER BY date ASC;');
          $requeteComment->bindValue('idd',$data['question_id'], PDO::PARAM_INT);
          $requeteComment->execute();
          while($commentFound = $requeteComment->fetch()) {

            $requser = $bdd->prepare('SELECT pseudo FROM Users WHERE id=:idd;');
            $requser->bindValue('idd', $commentFound['user_id'], PDO::PARAM_INT);
            $requser->execute();
            if($pseudo = $requser->fetch()) {
         ?>
        <article>
          <h5><?php echo $pseudo['pseudo']; ?> le <?php echo $commentFound['date']; ?></h5>
          <p class="texteQuest"><?php echo htmlspecialchars($commentFound['texte']); ?></p>
        </article>
        <?php
            }
            $requser->closeCursor();
          }
          $requeteComment->closeCursor();
         ?>
      <form class="envoiCommentaire" method="post" action="postanswer.php">
        <input type="submit" value="+" id="commentaire" />
        <input type="hidden" name="questionId" value="<?php echo $data['question_id'];?>" />
        <textarea required class="comment" name="comment" cols="30" rows="3" placeholder="Votre question"></textarea>
      </form>
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

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<script>
  hljs.initHighlightingOnLoad();

</script>
</body>
</html>
