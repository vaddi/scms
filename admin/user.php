<!DOCTYPE html>
<html lang="de">
<?php 
include('./auth.php');
$conf = "../config.php"; 
include($conf);

include('../inc/functions/globals.php');

if ( (SQL_PATH == "") || (SQL_USER == "") || (SQL_PASSWD == "") || (SQL_NAME == "")) {
  $error[] = "<p class='warning fade-in'>Die Kofigurationsdatei <b>'$conf'</b> wurde noch nicht bearbeitet oder enth&auml;lt leere Eintr&auml;ge. <br />Der Datenbank-Connector wurde daher nicht geladen, bitte sehen Sie bitte noch mal genauer unter den Datenbankeintr&auml;gen in der Datei <b>'$conf'</b> nach.</p>\n";
  } else {
  include_once('../inc/functions/database.php');
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
    
    <?php 
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Code on submit
        
        $submit_err = array();
        
        if ( (isset($_REQUEST['id'])) && ( ($_REQUEST['id'] != '') || ($_REQUEST['id'] != null) ) ) 
        { $id = $_POST['id']; } 
        if ( (isset($_REQUEST['username'])) && ( ($_REQUEST['username'] != '') || ($_REQUEST['username'] != null) ) ) 
        { $username = $_POST['username']; } // else { $submit_err[] = "Benutzername"; }
        if ( (isset($_REQUEST['old_passwort'])) && ( ($_REQUEST['old_passwort'] != '') || ($_REQUEST['old_passwort'] != null) ) ) 
        { $old_passwort = $_POST['old_passwort']; } // else { $submit_err[] = "Altes Passwort"; }
        if ( (isset($_REQUEST['valid_old_passwort'])) && ( ($_REQUEST['valid_old_passwort'] != '') || ($_REQUEST['valid_old_passwort'] != null) ) ) 
        { $valid_old_passwort = $_POST['valid_old_passwort']; }
        if ( (isset($_REQUEST['new_passwort'])) && ( ($_REQUEST['new_passwort'] != '') || ($_REQUEST['new_passwort'] != null) ) ) 
        { $new_passwort = $_POST['new_passwort']; } // else { $submit_err[] = "Neues Passwort"; }
        if ( (isset($_REQUEST['valid_new_passwort'])) && ( ($_REQUEST['valid_new_passwort'] != '') || ($_REQUEST['valid_new_passwort'] != null) ) ) 
        { $valid_new_passwort = $_POST['valid_new_passwort']; } else { $submit_err[] = "Passwort Wiederholung"; }
        if ( (isset($_REQUEST['forename'])) && ( ($_REQUEST['forename'] != '') || ($_REQUEST['forename'] != null) ) ) 
        { $forename = $_POST['forename']; } // else { $submit_err[] = "forename"; }
        if ( (isset($_REQUEST['surename'])) && ( ($_REQUEST['surename'] != '') || ($_REQUEST['surename'] != null) ) ) 
        { $surename = $_POST['surename']; } // else { $submit_err[] = "surename"; }
        if ( (isset($_REQUEST['email'])) && ( ($_REQUEST['email'] != '') || ($_REQUEST['email'] != null) ) ) 
        { $email = $_POST['email']; } // else { $submit_err[] = "E-Mail"; }
        if ( (isset($_REQUEST['bdate'])) && ( ($_REQUEST['bdate'] != '') || ($_REQUEST['bdate'] != null) ) ) 
        { $bdate = $_POST['bdate']; } // else { $submit_err[] = "bdate"; }
        if ( (isset($_REQUEST['role'])) && ( ($_REQUEST['role'] != '') || ($_REQUEST['role'] != null) ) ) 
        { $role = $_POST['role']; } // else { $submit_err[] = "Rolle"; }
        
        // Passwort prüfung
        if ( (count($submit_err)) == 0 )
        {
          
          // Altes eingegebenes Passwort 
          $old_passwort = base64_encode( sha1($old_passwort . SITE_SALT, true) . SITE_SALT );
          
          if ( $old_passwort == $valid_old_passwort )
          {
              if ($new_passwort == $valid_new_passwort)
              {
                  $passwd = true;
              } else {
                  $error[] = '<p class="warning fade-in">Neue Passw&ouml;rter stimmen nicht &uuml;berein!</p>';
              }
          } else {
              $error[] = '<p class="warning fade-in">Altes Passwort aus Datenbank stimmt nicht!</p>';
          }
          
          // Schreiben
          if ( (count($submit_err)) == 0 )
          { 
              $userdb = "user";
              
              // Benutzername schreiben
              if ($username != '')
              {
                  $query = "UPDATE " . $userdb . " SET " . $userdb . "_name = '" . $username . "' WHERE " . $userdb . "_id = '" . $id . "' ;";
                  $mydb->query($query);
              }
              
              // Passwort schreiben
              if ($passwd == true)
              {
                  $new_passwort = base64_encode( sha1($new_passwort . SITE_SALT, true) . SITE_SALT );
                  $query = "UPDATE " . $userdb . " SET " . $userdb . "_passwd = '" . $new_passwort . "' WHERE " . $userdb . "_id = '" . $id . "' ;";
                  $mydb->query($query);
              }
              
              // Vornamen schreiben 
              if ($forename != '')
              {
                  $query = "UPDATE " . $userdb . " SET " . $userdb . "_forename = '" . $forename . "' WHERE " . $userdb . "_id = '" . $id . "' ;";
                  $mydb->query($query);
              }
              
              // Nachnamen schreiben 
              if ($surename != '')
              {
                  $query = "UPDATE " . $userdb . " SET " . $userdb . "_surename = '" . $surename . "' WHERE " . $userdb . "_id = '" . $id . "' ;";
                  $mydb->query($query);
              }
              
              // Geburtsdatum schreiben 
              if ($bdate != '')
              {
                  $bdate = date('Y-m-d', strtotime($bdate));
                  $query = "UPDATE " . $userdb . " SET " . $userdb . "_bdate = '" . $bdate . "' WHERE " . $userdb . "_id = '" . $id . "' ;";
                  $mydb->query($query);
              }
              
              // E-Mail schreiben
              if ($email != '')
              {
                  $query = "UPDATE " . $userdb . " SET " . $userdb . "_email = '" . $email . "' WHERE " . $userdb . "_id = '" . $id . "' ;";
                  $mydb->query($query);
              }
              
              // Rolle schreibn
              if ($role != '')
              {
                  $query = "UPDATE " . $userdb . " SET " . $userdb . "_role = '" . $role . "' WHERE " . $userdb . "_id = '" . $id . "' ;";
                  $mydb->query($query);
              }
            
            echo '<meta http-equiv="refresh" content="3; url=" />';
              
          }
          
          $error[] = '<p class="valid fade-in">Benutzerdaten erfolgreich geschrieben</p>';
        }
        
        foreach ($submit_err as $value)
        {
            $error[] = '<p class="warning fade-in"><b>'.$value.'</b> ist Leer oder fehlerhaft!</p>';
        }
    } // Submit ende
    
    
    
    
    
    
    // Exceptions
    if ((count($error) > 0))
    {
        foreach ($error as $item)
        {
            echo $item;
        }
    }
    
    if ($banned != true) { 
    
    $mydb->query("SELECT * FROM user WHERE user_name = '" . $user_name . "' ;");
    $userArr = $mydb->fetchArr();
    
    ?>
    
    <div id="user_wrap">
      <h3>User Manager</h3>
      
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
          Benutzername <input type="text" name="username" placeholder="<?= $userArr[1]; ?>" /><br />
          Altes-Passwort<span class="pflicht">*</span> <input type="password" name="old_passwort" placeholder="" /> <br />
          Neues-Passwort<span class="pflicht">*</span> <input type="password" name="new_passwort" placeholder="" /> <br />
          Neues-Passwort<span class="pflicht">*</span> <input type="password" name="valid_new_passwort" placeholder="" /> <br />
          Vorname <input type="text" name="forename" placeholder="<?= $userArr[3]; ?>" /> <br /> 
          Nachname <input type="text" name="surename" placeholder="<?= $userArr[4]; ?>" /> <br /> 
          Email <input type="email" name="email" placeholder="<?= $userArr[5]; ?>" /> <br />
         <!-- Geburtsdatum <input type="date" name="bdate" placeholder="<?= date('d.m.Y', strtotime($userArr[6])); ?>" /> <br />  -->
          Geburtsdatum <input type="text" name="bdate" placeholder="<?= date('d.m.Y', strtotime($userArr[6])); ?>" /> <br /> 
          Rolle <input type="text" name="role" placeholder="<?= $userArr[8]; ?>" /> <br />
          <br />
          <input type="hidden" name="s" value="<?= $request; ?>" />
          <input type="hidden" name="id" value="<?= $userArr[0]; ?>" />
          <input type="hidden" name="valid_old_passwort" value="<?= $userArr[2]; ?>" />
          <input type="submit" value="Absenden" />
          <div style="float:left;"><span class="pflicht">*</span> Pflichteingabe-Felder</div>
          
      </form><br />
      
      <div class="user_element">
      <?php 

    echo "Datenbank:<br />\n";
    echo $userArr[0] . "<br />\n"; // Spalte 0 id
    echo $userArr[1] . "<br />\n"; // Spalte 1 name
#    echo $userArr[2] . "<br />\n"; // Spalte 2 passwd
    echo $userArr[3] . "<br />\n"; // Spalte 3 forename
    echo $userArr[4] . "<br />\n"; // Spalte 4 surename
    echo $userArr[5] . "<br />\n"; // Spalte 5 email
    echo $userArr[6] . "<br />\n"; // Spalte 6 bdate
    echo $userArr[7] . "<br />\n"; // Spalte 7 valid
    echo $userArr[8] . "<br />\n"; // Spalte 8 role
    echo "<br />\n";
       
    echo "Sessiondaten:<br />\n";
    echo $user_id . "<br />\n";
    echo $user_name . "<br />\n";
    echo $user_sid . "<br />\n";
    echo $user_role . "<br />\n";
    echo "<br />\n";
    
    ?>
      </div> 
    </div>      
    <?php } ?>
    
  </div><!-- close #content_item -->
  
  
</div><!-- close #content -->

<?php include('../inc/footer.php'); ?>  

</div><!-- close #wrap -->
  
</body>
</html>
