<?php
session_start();

include("template/bdd.php");
include("admin/mail.php");


if(empty($_POST['email']) || empty($_POST['passwd']) || empty($_POST['pseudo']))
{
  header('Location: signup.php?error=1');
}
else if(strlen($_POST['pseudo']) > 20 || strlen($_POST['pseudo']) < 3) {
  header('Location: signup.php?error=2');
}
else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  header('Location: signup.php?error=3');
}
else {

  $mail = htmlspecialchars($_POST['email']);
  $pass = sha1($_POST['passwd']);
  $pseudo = htmlspecialchars($_POST['pseudo']);

  $checkBDD = $bdd->prepare("SELECT * FROM Users WHERE email=? OR pseudo=?");
  $checkBDD->execute(array($mail,$pseudo));
  if($existSomebodyWithName = $checkBDD->fetch()) {
    header('Location: signup.php?error=4');
    exit();
  }

  $insertNewMember = $bdd->prepare("INSERT INTO Users (email, password, pseudo, status) VALUES (?,?,?,1);");
  $insertNewMember->execute(array($mail, $pass, $pseudo));

  $_SESSION['id'] = $bdd->lastInsertId();
  $_SESSION['email'] = $mail;
  $_SESSION['passwd'] = $pass;
  $_SESSION['pseudo'] = $pseudo;
  $_SESSION['status'] = 1;

  //sendMail($pseudo,$mail);


  header('Location: index.php');
}


?>
