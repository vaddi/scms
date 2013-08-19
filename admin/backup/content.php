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
  
    $mydb_tab = "content";
    $mydb->query('SELECT * FROM '.$mydb_tab );
    
    
    
    
    
  ?>
  
  
  
  
  
  
#<?php
#// DB use table
#$mydb_tab = "content";

#// DB Query
#$mydb->query('SELECT * FROM '.$mydb_tab );

#$cboxArr = array();
#if(isset($_POST['submitted'])) {
#foreach($mydb->fetchRow() as $key => $item)
#    {
#        $cboxArr[] = $_POST[$key];
#        echo $_POST[$key] . "<br />\n";
#    }
#}
#?>


<form >
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">

<?php


// Anzahl Felder
$res = $mydb->mysql_num_fields();
// Attribute Array befüllen
$i = 0;
$AttrArr = array();
while ($i < $res) 
{
    $AttrField = $mydb->mysql_field_name($i);
    $AttrArr[] = $AttrField;
    $i++;
}

// Attribute Array ausgeben
echo "<thead>\n";
echo "<tr>\n";

foreach($AttrArr as $item)
{
    echo "<th>".$item." </th>\n";
}

echo "<th> + </th>\n";

echo "</tr>\n";
echo "</thead>\n";

echo "<tbody>\n";

$evod = "even";
// Anzahl der Zeilen/Rows
$count = $mydb->count();

$itemArr = array();


for ($i = 0; $i < $count; $i++ )
{
    
    // Simlpe Evenodd
    if ($evod == "even") 
    {
        $evod = "odd";
    } else {
        $evod = "even";
    }
    
    echo "<tr class=".$evod.">\n";
 
    foreach($mydb->fetchRow() as $key => $item)
    {
        echo "<td>".$item." </td>\n";
        
        if($key == 'id')
        {
          $keyvar = $item;
        }
        
        //if(($key % $res) == 0)
        if ($key == 'date')
        {
            echo '<td><input type="checkbox" name="'.$keyvar.'" value="'.$keyvar.'" /><span> '.$keyvar.'</span></td>'."\n";
        
        }
    }
    
       
            
    
    echo "</tr>\n";
}

echo "</tbody>\n";

?>

</table>

  <div style="clear:both;margin:18px 0 0 0;">
	<button name="submit" type="submit" class="subbutton">Markieren</button>
	<input type="hidden" name="submitted" id="submitted" value="true" />
  </div>


</form>

<?php 

// Disconnect DB
$mydb->disconnect();

?>

</div><!-- close #content_item -->
  
  
</div><!-- close #content -->

<?php include('../inc/footer.php'); ?>  

</div><!-- close #wrap -->
  
</body>
</html>
