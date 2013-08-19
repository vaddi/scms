<div class="sidenav">
  <ul>
    <li><span>Menu</span></li>
    
    <?php 
      
      $table = "content";
      $mydb->subquery("SELECT * FROM " . $table . ";" );
      $pages = $mydb->count();
            
      for ($i = 0; $i < $pages; $i++) {
        $mydb->query("SELECT content_url FROM " . $table . " WHERE ". $table ."_id = ".$i.";" );
          
        foreach($mydb->fetchArr() as $key => $value) { 
          if ($key == 'content_url') { $content_id = $value; }
#          echo $content_id . "<br />\n";
          if ($key == '0') {
            // Link current 
            if ( (!isset( $_GET['page']) && $value == 'start') || (isset( $_GET['page']) && $_GET['page'] == $value) )
            {
              echo '<li><a class="current" href="./index.php?page='.$value.'">'.$value.'</a></li>' . "\n";
            }
            // Link normal
            else if (isset( $_GET['page']) ) 
            {
              echo '<li><a href="./index.php?page='.$value.'">'.$value.'</a></li>' . "\n";
            }
            // Link default
            else 
            {
              echo '<li><a href="./index.php?page='.$value.'">'.$value.'</a></li>' . "\n";
            }
          }
        }
      }
      
    ?>
      
  </ul>
</div>

