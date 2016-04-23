<header>
  <a id="logo" href="../../index.php" ><img src="../img/logoTN.png" border=0 /> </a>
  <h1>TechNote</h1>
  <nav class="right">
  	  <ul>
        <?php
          if(!isset($_SESSION['pseudo'])) {
          ?>
        <li><a href="../signin.php"><img class="logs" src="../img/signin.png" /></a></li>
        <li><a href="../signup.php"><img class="logs" src="../img/signup.png" /></a></li>
        <?php
          }
          else {
         ?>
         <li><p class="pseudonyme"><?php echo $_SESSION['pseudo']; ?></p></li>
  	    <li><img class="logs" src="../img/tele.png" /></li>
  	    <li><img class="logs" src="../img/config.png" /></li>
        <li><a href="../signout.php"><img class="logs" src="../img/deco.png" /></a></li>
        <?php
          }
         ?>
  	  </ul>
  	</nav>
</header>
