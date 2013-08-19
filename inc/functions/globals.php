<?php

$error = array();
$request = 0;

if ( (SQL_PATH == "") || (SQL_USER == "") || (SQL_PASSWD == "") || (SQL_NAME == "")) {
  $error[] = "<p class='warning fade-in'>Die Kofigurationsdatei <b>'$conf'</b> wurde noch nicht bearbeitet oder enth&auml;lt leere Eintr&auml;ge. <br />Der Datenbank-Connector wurde daher nicht geladen, bitte sehen Sie bitte noch mal genauer unter den Datenbankeintr&auml;gen in der Datei <b>'$conf'</b> nach.</p>\n";
  } else {
    // Adminview braucht eine anderes including
    if(preg_match('/admin/',$_SERVER['PHP_SELF'])) {
        include_once('../inc/functions/database.php');
    } else {
        include_once('./inc/functions/database.php');
    }
    $mydb = new database(SQL_PATH,SQL_USER,SQL_PASSWD,SQL_NAME);
}

# visitor count & ban
$visitordb = "visitor";
$HOST_IP = $_SERVER['REMOTE_ADDR'];
$mydb->query("SELECT * FROM " . $visitordb . " WHERE " . $visitordb . "_ip = '".$HOST_IP."' ;");
$visitorArr = $mydb->fetchArr();

$visitor_id = $visitorArr[0]; // Spalte 0 id
$visitor_ip = $visitorArr[1]; // Spalte 1 ip
$visitor_banned = $visitorArr[2]; // Spalte 2 banned
$visitor_counter = $visitorArr[3]; // Spalte 3 counter
$visitor_rndtime = $visitorArr[4]; // Spalte 4 rndtime
$visitor_lastsite = $visitorArr[5]; // Spalte 5 lastsite
$visitor_lastdate = $visitorArr[5]; // Spalte 6 lastdate
$visitor_browser = $visitorArr[7]; // Spalte 7 browser

// Check if visitor is banned
if ( $visitorArr[2] >= '1' ) { 
  // Banned User
  $query = "UPDATE " . $visitordb . " SET 
    " . $visitordb . "_ip = '" . $HOST_IP . "', 
    " . $visitordb . "_counter = '" . ($visitor_counter + 1) . "', 
    " . $visitordb . "_lastsite = '" . $_SERVER['PHP_SELF'] . "', 
    " . $visitordb . "_lastdate = '" . date('Y-m-d H:i:s') . "', 
    " . $visitordb . "_browser = '" . $_SERVER['HTTP_USER_AGENT'] . "' 
    WHERE " . $visitordb . "_ip = '" . $HOST_IP . "' ;";
  $mydb->query($query);
  
  $error[] = '<p class="invalid fade-in">Ihre IP-Adresse <b>'.$HOST_IP.'</b> wurde auf unserem Server gesperrt!!!</p>';
  $banned = true;       
         
} else if ($visitorArr[3] >= '1') {
  // Wiederkehrender Besucher
  $query = "UPDATE " . $visitordb . " SET 
    " . $visitordb . "_ip = '" . $HOST_IP . "', 
    " . $visitordb . "_counter = '" . ($visitor_counter + 1) . "', 
    " . $visitordb . "_lastsite = '" . $_SERVER['PHP_SELF'] . "', 
    " . $visitordb . "_lastdate = '" . date('Y-m-d H:i:s') . "', 
    " . $visitordb . "_browser = '" . $_SERVER['HTTP_USER_AGENT'] . "' 
    WHERE " . $visitordb . "_ip = '" . $HOST_IP . "' ;";
  $mydb->query($query);
} else {
  // Wiederkehrender Besucher
  $query = "INSERT INTO " . $visitordb . " ( 
    " . $visitordb . "_ip, 
    " . $visitordb . "_banned,
    " . $visitordb . "_counter, 
    " . $visitordb . "_rndtime, 
    " . $visitordb . "_lastsite, 
    " . $visitordb . "_lastdate, 
    " . $visitordb . "_browser 
    ) VALUES ( 
    '" . $HOST_IP . "', 
    '" . 0 . "',
    '" . 1 . "', 
    '0.983',
    '" . $_SERVER['PHP_SELF'] . "', 
    '" . date('Y-m-d H:i:s') . "', 
    '" . $_SERVER['HTTP_USER_AGENT'] ."' ) ;";
  $mydb->query($query);
}

?>
