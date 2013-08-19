<!DOCTYPE html>
<html lang="de">
<?php 

include('./auth.php');
$conf = "../config.php";
include($conf);
include('../inc/functions/globals.php');
#if ( (SQL_PATH == "") || (SQL_USER == "") || (SQL_PASSWD == "") || (SQL_NAME == "")) {
#  $error = "Die Kofigurationsdatei '$conf' wurde noch nicht bearbeitet oder enth&auml;lt leere Eintr&auml;ge. <br />Der Datenbank-Connector wurde nicht geladen, sehen Sie bitte noch mal genauer unter den Datenbankeintr&auml;gen in der '$conf' nach.<br /><br />\n";
#} else {
#  
#  include('../inc/functions/database.php');
#  $mydb = new database(SQL_PATH,SQL_USER,SQL_PASSWD,SQL_NAME);
#}

$url = $http . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']. "<br />\n";
  $url_valid = BASE . basename(basename(getcwd())) . "/" . basename($_SERVER['PHP_SELF']) . "<br />\n";

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

    <h3>Admin Content</h3>
    
  </div><!-- close #content_item -->
  
  
</div><!-- close #content -->

<?php include('../inc/footer.php'); ?>  

</div><!-- close #wrap -->
  
</body>
</html>
