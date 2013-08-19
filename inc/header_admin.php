<header>
  <h1 id="headline"><a href="<?= BASE ?>"><?= SITE_NAME ?></a></h1>
  <ul id="headnav">
  
    <?php if (HEADER_LOGIN == "1") {
      
      if ( (isset($_SESSION['angemeldet'])) && ($_SESSION['angemeldet'] == true) )
      {
        echo '<li><a href="./logout.php">Logout</a></li>';          
      } else {
        echo '<li><a href="./login.php">Login</a></li>';
      }
    } ?>
    
    <?php if (HEADER_USER == "1") {
      if ( (isset($_SESSION['angemeldet'])) && ($_SESSION['angemeldet'] == true) )
      {
        echo '<li><a href="./user.php?user='.$_SESSION['uid'].'">Profil</a></li>';          
      } 
    } ?>
    
    
    <?php if ( HEADER_ADMIN == "1" ) {
      if ($banned != true) {
        if ( (isset($_SESSION['angemeldet'])) && ($_SESSION['angemeldet'] == true) ) {
          echo '<li><a href="../index.php">Website</a></li>';
        } else {
          echo '<li><a href="./index.php">Admin</a></li>';
        }
      } 
    }
    ?>
    
  </ul>
  
  <div class="clear"></div>
  
</header>

