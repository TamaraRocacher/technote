<?php
if(!isset($_GET['search'])) {
  header('Location: ../index.php');
}
else if(strlen($string=$_GET['search']) > 3 AND $string[0]='q' AND $string[1]=':') {
  header('Location: searchQ.php?search="'.strtolower($string).'"');
}
else {
  $string=$_GET['search'];
  header('Location: searchN.php?search="'.strtolower($string).'"');
}

 ?>
