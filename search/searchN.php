<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="theme-color" content="#005D4B">
  <link rel="stylesheet" href="../css/style.css" />
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/styles/default.min.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/highlight.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>


<?php include("../template/header.php"); ?>
<?php include("../template/menu.php"); ?>
<?php include("../template/bdd.php"); ?>

<div id="fenetre"> <!-- bordure et fond couleur diff -->

  <?php
  //Traitement recherche
  $search = $_GET['search'];

  if($search[0]=='@'){
    $search = substr($search,1);
    $requeteNote = $bdd->prepare('SELECT * FROM Notes WHERE note_id IN (SELECT note_id FROM Users WHERE pseudo=?) ORDER BY timestamp(date) DESC;');
    $requeteNote->execute(array($search));

    while($data = $requeteNote->fetch()) {

          $date = new DateTime(substr($data['date'],0,10));
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

  }
  else{
  $keywords = preg_split('/[\s,]+/', $search);

  $obl = array();
  for ($key = 0; $key<sizeof($keywords);$key++) {
    if($keywords[$key][0]== '+') {
      $obl[] = $key;
      array_shift($keywords[$key]);
    }
  }
  $nb_key = sizeof($keywords);
  $nb_obl = sizeof($obl);




  for($i = 0; $i < $nb_key; $i++) {

    $requeteNote = $bdd->prepare('SELECT * FROM Notes WHERE note_id IN (SELECT note_id FROM KeywordN WHERE texte=?) ORDER BY timestamp(date) DESC;');
    $requeteNote->execute(array($keywords[$i]));

    while($data = $requeteNote->fetch()) {

          $date = new DateTime(substr($data['date'],0,10));
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
}
}
  ?>

  <p class="precsuiv"><a href="?page=<?php echo $page - 1; ?>">Précédent</a>
  -
<a href="?page=<?php echo $page + 1; ?>">Suivant</a></p>

</div>
<?php include("../template/footer.php"); ?>

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<script>
  hljs.initHighlightingOnLoad();

</script>
</body>
</html>
