<?php function sendMail($pseudo, $mail) {
  if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
  {
  	$passage_ligne = "\r\n";
  }
  else
  {
  	$passage_ligne = "\n";
  }
  //=====Déclaration des messages au format texte et au format HTML.
  $message_txt = "Bonjour ".$pseudo.", \nBienvenue sur Technote. Voici vos identifiants de connexion :\n\t-email: ".$mail."\n\t-pseudo: ".$pseudo." - celui ci sera visible par les autres internautes.\n\t- Mot de passe : par mesure de sécurité, vous seul le connaissez.\nNous mettons tout en oeuvre pour que vos données restent en sécurité et vous souhaitons une bonne visite.\nL'équipe TechNote.\n";
  $message_html = "<html><head></head><body>Bonjour ".$pseudo.", <br>Bienvenue sur Technote. Voici vos identifiants de connexion :<br>&nbsp;&nbsp;&nbsp;-email: ".$mail."<br>&nbsp;&nbsp;&nbsp;-pseudo: ".$pseudo." - celui ci sera visible par les autres internautes.<br>&nbsp;&nbsp;&nbsp;- Mot de passe : par mesure de sécurité, vous seul le connaissez.<br>Nous mettons tout en oeuvre pour que vos données restent en sécurité et vous souhaitons une bonne visite.<br>L'équipe TechNote.<br></body></html>";
  //==========

  //=====Création de la boundary
  $boundary = "-----=".md5(rand());
  //==========

  //=====Définition du sujet.
  $sujet = "Inscription TechNote";
  //=========

  //=====Création du header de l'e-mail.
  $header = "From: \"WeaponsB\"<admin@rocacher.com>".$passage_ligne;
  $header.= "Reply-to: \"WeaponsB\" <".$mail.">".$passage_ligne;
  $header.= "MIME-Version: 1.0".$passage_ligne;
  $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
  //==========

  //=====Création du message.
  $message = $passage_ligne."--".$boundary.$passage_ligne;
  //=====Ajout du message au format texte.
  $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
  $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
  $message.= $passage_ligne.$message_txt.$passage_ligne;
  //==========
  $message.= $passage_ligne."--".$boundary.$passage_ligne;
  //=====Ajout du message au format HTML
  $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
  $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
  $message.= $passage_ligne.$message_html.$passage_ligne;
  //==========
  $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
  $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
  //==========

  //=====Envoi de l'e-mail.
  mail($mail,$sujet,$message,$header);
  //==========

  }

?>
