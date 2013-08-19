<!DOCTYPE html>
<html lang="de">
<?php 

$conf = "../config.php";
include($conf);
if ( (SQL_PATH == "") || (SQL_USER == "") || (SQL_PASSWD == "") || (SQL_NAME == "")) {
  $error = "Die Kofigurationsdatei '$conf' wurde noch nicht bearbeitet oder enth&auml;lt leere Eintr&auml;ge. <br />Der Datenbank-Connector wurde nicht geladen, sehen Sie bitte noch mal genauer unter den Datenbankeintr&auml;gen in der '$conf' nach.<br /><br />\n";
} else {
  include('../inc/functions/database.php');
  $mydb = new database(SQL_PATH,SQL_USER,SQL_PASSWD,SQL_NAME);
}

include('../inc/head.php');

$mydb->query('SELECT * FROM user');

?>

<body onload="ladezeit()">

<div id="wrap">

<?php include('../inc/header_admin.php'); ?>  
  
<div id="content_area">

<div id="sidebar">
<?php include('../inc/nav_admin.php'); ?>
</div>

  <div class="content_item">

<?php

if ($mydb->count() == 0) echo '<p class="invalid fade-in">Kein Benutzer in Datenbank angelegt !!!! <br />Wollen sie das <a href="CREATOR.php">Setup</a> ausf&uuml;hren?</p>';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  session_start();

  // http oder https?
  if($_SERVER["SERVER_PORT"] == 80) {
    $http = "http";
  } else if ($_SERVER["SERVER_PORT"] == 443) {
    $http = "https";
  } else {
    // Fallback
    $http = "http";
  }

  $request = $_REQUEST['s'];
  $username = $_POST['username'];
  $passwort = $_POST['passwort'];
  
#  echo "input <br />\n";
#  echo $username . "<br />\n";
#  echo $passwort . "<br />\n";
  
  $mydb->query("SELECT * FROM user WHERE user_name = '" . $username . "' ;");
  $userArr = $mydb->fetchArr();
  
  $validuser = $userArr[1]; // Spalte 1 name
  $validpasswd = $userArr[2]; // Spalte 3 passwd
  
#  echo "db <br />\n";
#  echo $validuser . "<br />\n";
#  echo $validpasswd . "<br />\n";

  $hostname = $_SERVER['HTTP_HOST'];
  $path = dirname($_SERVER['PHP_SELF']);

  // Benutzername und Passwort werden überprüft
  if ($username == $validuser && $passwort == $validpasswd) {
    $_SESSION['angemeldet'] = true;

    // Weiterleitung zur geschützten Startseite
    if ($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1') {
      if (php_sapi_name() == 'cgi') {
        header('Status: 303 See Other');
      } else {
        header('HTTP/1.1 303 See Other');
      }
    }
    header('Location: '.$http.'://'.$hostname.($path == '/' ? '' : $path).'/index.php');
    exit;
  }
}

?>

<div id="login_wrap">
  <h3>Login</h3>
  <form action="login.php" method="post">
   <input name="username" placeholder="Benutzername" />
   <input type="password" name="passwort" placeholder="Passwort" /> <br /><br />
   <input type="hidden" name="s" value="<?= $request; ?>" />
   <input type="submit" value="Anmelden" />
  </form>
</div>

</div><!-- close #content_item -->
  
  
</div><!-- close #content -->

<?php include('../inc/footer.php'); ?>  

</div><!-- close #wrap -->
  
</body>
</html>
