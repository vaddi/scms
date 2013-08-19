<header>
  <h1 id="headline"><a href="<?= BASE ?>"><?= SITE_NAME ?></a></h1>
  <ul id="headnav">
  
    <?php if (HEADER_LOGIN == "1") {
      session_start();
      if ( (isset($_SESSION['angemeldet'])) && ($_SESSION['angemeldet'] == true) )
      {
        echo '<li><a href="./admin/logout.php">Logout</a></li>';          
      } else {
        //session_destroy();
        echo '<li><a href="./admin/login.php">Login</a></li>';
      }
    } ?>
    
    <?php if (HEADER_USER == "1") {
      // session_start();
      if ( (isset($_SESSION['angemeldet'])) && ($_SESSION['angemeldet'] == true) )
      {
        $user_id = $_SESSION['uid'];
        echo '<li><a href="./admin/user.php?user='.$user_id.'">Profil</a></li>';          
      } else {
        //session_destroy();
      }
    } ?>
    
    <?php if ( HEADER_ADMIN == "1" ) {
      if ( !isset($banned) ) {
        if ( (isset($_SESSION['angemeldet'])) && ($_SESSION['angemeldet'] == true) ) {
          echo '<li><a href="./admin/index.php">Admin</a></li>';
        } else {
          echo '<li><a href="./index.php">Home</a></li>';
        }
      } 
    }
    ?>
    
  </ul>
  
  <div class="clear"></div>
  
</header>

