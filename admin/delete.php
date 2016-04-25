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
  $req = $bdd->prepare("DELETE FROM Users WHERE id=?;");

  if($req->execute(array($_GET[id])) === true) {
    $req->closeCursor;
    header('Location: admin.php');
  }
  else {
    $req->closeCursor;
    header('Location: ../index.php');
  }
}

 ?>
