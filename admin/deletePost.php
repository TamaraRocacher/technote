<?php
session_start();
include('../template/bdd.php');

if(!isset($_GET['id'])) {
  header('Location: admin.php');
}
else if (!isset($_SESSION['status']) && $_SESSION['status'] !=0) {
  header('Location: index.php');
}
else {
  $req = $bdd->prepare("DELETE FROM Questions WHERE question_id=?;");

  if($req->execute(array($_GET['id'])) === true) {
    $req->closeCursor();
    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
    header('Location: ' . $referer);
  }
  else {
    $req->closeCursor();
    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
    header('Location: ' . $referer.'?error=6');
  }
}

 ?>
