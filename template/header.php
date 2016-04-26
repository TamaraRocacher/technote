<header>
  <a id="logo" href="../../index.php" ><img src="../img/logoTN.png" border=0 /> </a>
  <h1>TechNote</h1>
  <nav class="right">
  	  <ul>
        <?php
          if(!isset($_SESSION['pseudo'])) {
          ?>
        <li><a href="../../signin.php"><img class="logs" src="../../img/signin.png" /></a></li>
        <li><a href="../../signup.php"><img class="logs" src="../../img/signup.png" /></a></li>
        <?php
          }
          else {
         ?>
         <li><p class="pseudonyme"><?php echo $_SESSION['pseudo']; ?></p></li>
         <?php
          if(isset($_SESSION['status']) AND $_SESSION['status'] == 0) { ?>
        <li><a href="../../admin/admin.php"><img class="logs" src="../../img/tele.png" /></a></li>
        <?php } ?>
        <li><a href="../../account.php"><img class="logs" src="../../img/config.png" /></a></li>
        <li><a href="../../signout.php"><img class="logs" src="../../img/deco.png" /></a></li>
        <?php
          }
         ?>
  	  </ul>
  	</nav>
</header>
