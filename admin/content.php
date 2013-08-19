<!DOCTYPE html>
<html lang="de">
<?php 
include('./auth.php');
$conf = "../config.php";
include($conf);
if ( (SQL_PATH == "") || (SQL_USER == "") || (SQL_PASSWD == "") || (SQL_NAME == "")) {
  $error = "Die Kofigurationsdatei '$conf' wurde noch nicht bearbeitet oder enth&auml;lt leere Eintr&auml;ge. <br />Der Datenbank-Connector wurde nicht geladen, sehen Sie bitte noch mal genauer unter den Datenbankeintr&auml;gen in der '$conf' nach.<br /><br />\n";
} else {
  include('../inc/functions/database.php');
  $mydb = new database(SQL_PATH,SQL_USER,SQL_PASSWD,SQL_NAME);
}

include('../inc/head.php');



?>

<body onload="ladezeit()">

<div id="wrap">

<?php include('../inc/header_admin.php'); ?>

<div id="content_area">

<div id="sidebar">
<?php include('../inc/nav_admin.php'); ?>
</div>

  <div class="content_item">

  <h3>Content Manager</h3>
  
  <?php
    
#    echo $http . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']. "<br />\n";
#    echo BASE . basename(basename(getcwd())) . "/" . basename($_SERVER['PHP_SELF']) . "<br />\n";
#    echo $_SERVER['REQUEST_URI'] . "<br />\n";
#    echo basename(basename(getcwd())) . "<br />\n";
    
#    $securl = basename(basename(__FILE__));
#    echo str_replace('.php','', $securl) .  "<br />\n";
#    $tmpurl = basename($_SERVER['PHP_SELF']);
#    echo str_replace('.php','', $tmpurl) . "<br /><br />\n";
    
    
    
    echo "<div>\n";
    
    $mydb_tab = "content";
    $mydb->query('SELECT * FROM '.$mydb_tab );
    
    // Anzahl Felder (Attribute) in $AttrArr[]
    $i = 0;
    $AttrArr = array();
    $res = $mydb->mysql_num_fields();
    while ($i < $res) 
    {
        $AttrArr[] =  $mydb->mysql_field_name($i);
        $i++;
    }

    $evod = "even";
    // Anzahl der Zeilen/Rows
    $count = $mydb->count();

    $itemArr = array();
    
    echo "<ul>\n";
    
    for ($i = 0; $i < $count; $i++ )
    {
        
        // Simlpe Evenodd
        if ($evod == "even") { $evod = "odd"; } else { $evod = "even"; }
    
        echo "<li class=".$evod.">\n";
     
        foreach($mydb->fetchRow() as $key => $item)
        {
            if($key == 'id')
            {
              $keyvar = $item;
            }
            
            if ($key == 'content_content')
            {
                # <![CDATA[   text   ]]>
#                $item = "<![CDATA[ " . $item . " ]]>";
            }
            
            //echo "<span>".$item." </span>\n";
            echo $item." <br />\n";
            
            //if(($key % $res) == 0)
#            if ($key == 'date')
#            {
#                echo '<td><input type="checkbox" name="'.$keyvar.'" value="'.$keyvar.'" /><span> '.$keyvar.'</span></td>'."\n";
#            
#            }
        }
    
        echo "</li>\n";
    }
    
    echo "</ul>\n";
    
    echo "</div>\n";


// Disconnect DB
$mydb->disconnect();

?>

</div><!-- close #content_item -->
  
  
</div><!-- close #content -->

<?php include('../inc/footer.php'); ?>  

</div><!-- close #wrap -->
  
</body>
</html>
