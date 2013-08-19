<!DOCTYPE html>
<html lang="de">
<?php 

$conf = "../config.php";
include($conf);
include('../inc/functions/globals.php');
#if ( (SQL_PATH == "") || (SQL_USER == "") || (SQL_PASSWD == "") || (SQL_NAME == "")) {
#  $error[] = "Die Kofigurationsdatei '$conf' wurde noch nicht bearbeitet oder enth&auml;lt leere Eintr&auml;ge. <br />Der Datenbank-Connector wurde nicht geladen, sehen Sie bitte noch mal genauer unter den Datenbankeintr&auml;gen in der '$conf' nach.<br /><br />\n";
#} else {
#  include('../inc/functions/database.php');
#  $mydb = new database(SQL_PATH,SQL_USER,SQL_PASSWD,SQL_NAME);
#}

include('../inc/head.php');

// Sind Benutzer in der Datenbank angelegt?
$mydb->query('SELECT * FROM user');
  if ($mydb->count() == 0) $error[] = '<p class="invalid fade-in">Kein Benutzer in Datenbank angelegt !!!! <br />Wollen sie das <b><a href="setup.php">Setup</a></b> Skript ausf&uuml;hren?</p>';

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  session_start();
  
  // Request zähler
  if ( (isset($_REQUEST['s'])) && ( ($_REQUEST['s'] != '') || ($_REQUEST['s'] != null) ) ) {
    $request = $_REQUEST['s'];
    $request++;
    
    if ($request > SITE_BAN)
    {
        # userban
        $visitordb = "visitor";
        $HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT']; 
        $HOST_IP = $_SERVER['REMOTE_ADDR'];
        $HOST_NAME = $_SERVER['PHP_SELF'];
        
        $mydb->query("SELECT * FROM " . $visitordb . " WHERE " . $visitordb . "_ip = '".$HOST_IP."' ;");
        $visitorArr = $mydb->fetchArr();
#        $visitor_id = $visitorArr[0]; // Spalte 0 id
#        $visitor_ip = $visitorArr[1]; // Spalte 1 ip
#        $visitor_banned = $visitorArr[2]; // Spalte 2 banned
#        $visitor_counter = $visitorArr[3]; // Spalte 3 counter
#        $visitor_rndtime = $visitorArr[4]; // Spalte 4 rndtime
#        $visitor_lastsite = $visitorArr[5]; // Spalte 5 lastsite
#        $visitor_lastdate = $visitorArr[5]; // Spalte 6 lastdate
#        $visitor_browser = $visitorArr[7]; // Spalte 7 browser
       
        $query = "UPDATE " . $visitordb . " SET 
            " . $visitordb . "_ip = '" . $HOST_IP . "', 
            " . $visitordb . "_banned = '1', 
            " . $visitordb . "_counter = '" . ($visitorArr[3] + 1) ."', 
            " . $visitordb . "_rndtime = '0.973', 
            " . $visitordb . "_lastsite = '" . $HOST_NAME . "', 
            " . $visitordb . "_lastdate = '" . date('Y-m-d H:i:s') ."', 
            " . $visitordb . "_browser = '" . $HTTP_USER_AGENT ."' 
            WHERE " . $visitordb . "_ip = '" . $HOST_IP . "' ;";
        $mydb->query($query);
            
        
    }
  } else {
    $request++;
  } 
  
  if ( (isset($_REQUEST['username'])) && ( ($_REQUEST['username'] != '') || ($_REQUEST['username'] != null) ) ) 
  { $username = $_POST['username']; }
  else if ($banned != true) { $error[] = '<p class="warning fade-in">Kein Benutzername angegeben, Anmeldung Fehlgeschlagen</p>'; } 
  
  if ( (isset($_REQUEST['passwort'])) && ( ($_REQUEST['passwort'] != '') || ($_REQUEST['passwort'] != null) ) ) 
  { $passwort = $_POST['passwort']; }
  else if ($banned != true) { $error[] = '<p class="warning fade-in">Kein Passwort angegeben, Anmeldung Fehlgeschlagen</p>'; } 
  
#  echo "input <br />\n";
#  echo $username . "<br />\n";
#  echo $passwort . "<br />\n";
  
  // http oder https?
  if($_SERVER["SERVER_PORT"] == 80) {
    $http = "http";
  } else if ($_SERVER["SERVER_PORT"] == 443) {
    $http = "https";
  } else {
    // Fallback
    $http = "http";
  }

  $mydb->query("SELECT * FROM user WHERE user_name = '" . $username . "' ;");
  $userArr = $mydb->fetchArr();
  
  $user_id = $userArr[0]; // Spalte 0 id
  $validuser = $userArr[1]; // Spalte 1 name
  $validpasswd = $userArr[2]; // Spalte 2 passwd
  $forename = $userArr[3]; // Spalte 3 forename
  $surename = $userArr[4]; // Spalte 4 surename
  $email = $userArr[5]; // Spalte 5 email
  $bdate = $userArr[6]; // Spalte 6 bdate
  $valid = $userArr[7]; // Spalte 7 valid
  $role = $userArr[8]; // Spalte 8 role
  
#  echo "db <br />\n";
#  echo $validuser . "<br />\n";
#  echo $validpasswd . "<br />\n";

  $hostname = $_SERVER['HTTP_HOST'];
  $path = dirname($_SERVER['PHP_SELF']);

  // Benutzername und Passwort werden verschlüsselt und "salted" überprüft
  $password = base64_encode( sha1($passwort . SITE_SALT, true) . SITE_SALT ); 
  //$validpassword = base64_encode( sha1($validpasswd . SITE_SALT, true) . SITE_SALT );
  
  //if ($username == $validuser && $passwort == $validpasswd && $valid != 0 ) {
  if ($username == $validuser && $password == $validpasswd && $valid != 0 ) {
    
    $_SESSION['angemeldet'] = true;
    $_SESSION['sid'] = session_id();
    $_SESSION['uid'] = $user_id ;
    $_SESSION['name'] = $validuser ;
    $_SESSION['role'] = $role ;
    
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
#  else {
#    $error[] = "<p class='warning fade-in'>Login Fehlgeschlagen</p>";
#  }
  
}

// Exceptions
if ( (count($error) > 0) )
{
  foreach ($error as $item)
  {
    echo $item;
  }
}

if ($banned != true) { ?>

<div id="login_wrap">
  <h3>Login</h3>
  <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
   <input name="username" id="uname" placeholder="Benutzername" />
   <input type="password" name="passwort" placeholder="Passwort" /> <br /><br />
   <input type="hidden" name="s" value="<?= $request; ?>" />
   <input type="submit" value="Anmelden" />
  </form>
</div>      
        
<?php } ?>

</div><!-- close #content_item -->
  
  
</div><!-- close #content -->

<?php include('../inc/footer.php'); ?>  

</div><!-- close #wrap -->
  
</body>
</html>
