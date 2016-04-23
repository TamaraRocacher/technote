<?php
session_start();

include("template/bdd.php");

if(empty($_POST['email']) || empty($_POST['passwd']))
{
  header('Location: signin.php?error=1');
}
else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  header('Location: signin.php?error=3');
}
else {

  $mail = htmlspecialchars($_POST['email']);
  $pass = sha1($_POST['passwd']);

  $lookForMember = $bdd->prepare("SELECT * FROM Users WHERE email = ? AND password = ?");
  $lookForMember->execute(array($mail, $pass));

  if($foundUser = $lookForMember->fetch()) {
    $_SESSION['id'] = $foundUser['id'];
    $_SESSION['email'] = $mail;
    $_SESSION['passwd'] = $pass;
    $_SESSION['pseudo'] = $foundUser['pseudo'];
    $_SESSION['status'] = $foundUser['status'];
    header('Location: index.php');
  }
  else {
    header('Location: signin.php?error=4');
  }


}
?>
