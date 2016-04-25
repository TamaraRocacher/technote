<?php session_start();

include("template/bdd.php");

if(empty($_POST['title']) || empty($_POST['texte']) || empty($_POST['keywords']))
{
  header('Location: add.php?error=1');
}
else if(!isset($_SESSION['id'])) {
  header('Location: signin.php');
}

else {
  function codeHigh($a) {
    return $a[1].htmlspecialchars($a[2]).$a[3];
  }

  $title = $_POST['title'];
  $texte = preg_replace_callback('#(.*<pre>.*<code.*>)(.*)(</code></pre>.*)$#isU','codeHigh',$_POST['texte']);
  $keywords = preg_split("/[\s,]+/" , $_POST['keywords']);
  $userId = $_SESSION['id'];

  if($_POST['choix'] == choix1) { //Technote
    $req1 = $bdd->prepare("INSERT INTO Notes(title, texte, user_id, date) VALUES (?, ?, ?, NOW());");
    $req1->execute(array($title, $texte, $userId));



    $noteId = $bdd->lastInsertId();

    $req3 = $bdd->prepare("INSERT INTO KeywordN (texte, note_id) VALUES (?, ?);");
    foreach($keywords as $key) {
      $req3->execute(array($key, $noteId));
    }
  }
  else {
    $req1 = $bdd->prepare("INSERT INTO Question(title, texte, user_id, status, date) VALUES (?, ?, ?, 0, NOW());");
    $req1->execute(array($title, $texte, $userId));



    $questionId = $bdd->lastInsertId();


    $req3 = $bdd->prepare("INSERT INTO KeywordQ (texte, question_id) VALUES (?, ?);");
    foreach($keywords as $key) {
      $req3->execute(array($key, $questionId));
    }
  }
  header('Location: index.php');

}


?>
