<div class="sidenav">
  <ul>
    <li><span>Menu</span></li>
    
    <?php 
      
      $table = "content";
      $mydb->query("SELECT * FROM " . $table . ";" );
      $pages = $mydb->count();
      for ($i = 0; $i < $pages; $i++) {
        $mydb->query("SELECT " . $table . "_url FROM " . $table . " WHERE ". $table ."_id = '".$i."' ;" );
          
        foreach($mydb->fetchArr() as $key => $value) { 
          if ($key != '0') {
            // Link current 
            if (isset( $_GET['page']) && $_GET['page'] == $value )
            {
              echo '<li><a class="current" href="../index.php?page='.$value.'">'.$value.'</a></li>' . "\n";
              
            }
            // Link normal
            else if (isset( $_GET['page'])) 
            {
              echo '<li><a href="../index.php?page='.$value.'">'.$value.'</a></li>' . "\n";
              
            }
            // Link default
            else 
            {
              echo '<li><a href="../index.php?page='.$value.'">'.$value.'</a></li>' . "\n";
            }
          }
        }
      }
      
    ?>
      
  </ul>
  
  <?php
  
  session_start();
  if ($_SESSION['angemeldet'] == true)
  {
  
    $val_url1 = str_replace('.php','', (basename(basename(__FILE__))));
    $val_url2 = str_replace('.php','', (basename($_SERVER['PHP_SELF'])));
    
    echo "<ul>";
    echo '<li><span>Admin-Menu</span></li>';
    echo '<li><a href="content.php">Content Manager</a></li>';
    echo '<li><a href="user.php">User Manager</a></li>';
    echo "</ul>";       
  } else {
    session_destroy();
  }
  
  ?> 
  
  
    
    
    
  
  
</div>

