<?php
session_start();

include("template/bdd.php");

if(empty($_POST['questionId']) || empty($_POST['comment'])) {
  $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
  header('Location: ' . $referer.'?error=6');
}
if(!isset($_SESSION['id']) || empty($_SESSION['id'])) {
  header('Location: signin.php');
}
else {
  $commentaire = $_POST['comment'];
  $questionId = $_POST['questionId'];
  $userId = $_SESSION['id'];

  $req = $bdd->prepare('INSERT INTO Answers (texte,question_id, user_id, date)
    VALUES (?, ?, ?, NOW());');
  $req->execute(array($commentaire, $questionId, $userId));

  $req->closeCursor();

  $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
  header('Location: ' . $referer);
}


 ?>
