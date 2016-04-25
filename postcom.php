<?php
session_start();

include("template/bdd.php");

if(empty($_POST['noteId']) || empty($_POST['comment'])) {
  $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
  header('Location: ' . $referer.'?error=6');
}
if(!isset($_SESSION['id']) || empty($_SESSION['id'])) {
  $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
  header('Location: signin.php');
}
else {
  $commentaire = $_POST['comment'];
  $noteId = $_POST['noteId'];
  $userId = $_SESSION['id'];

  $req = $bdd->prepare('INSERT INTO Comments (texte,note_id, user_id, date)
    VALUES (?, ?, ?, NOW());');
  $req->execute(array($commentaire, $noteId, $userId));

  $req->closeCursor();

  $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
  header('Location: ' . $referer);
}


 ?>
