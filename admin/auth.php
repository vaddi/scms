<?php
    session_start();
    if ($_SERVER["SERVER_PORT"] == 80) { $http = "http"; } 
    else if ($_SERVER["SERVER_PORT"] == 443) { $http = "https"; } 
    else { $http = "http"; }
    
    $hostname = $_SERVER['HTTP_HOST']; 
    $path = dirname($_SERVER['PHP_SELF']);

    if (!isset($_SESSION['angemeldet']) || !$_SESSION['angemeldet']) {
      header('Location: '.$http.'://'.$hostname.($path == '/' ? '' : $path).'/login.php');
      exit;
    }
    
    if ($_SESSION['sid'] == session_id())
    {
        $user_sid = $_SESSION['sid'];
        $user_id = $_SESSION['uid'];
        $user_name = $_SESSION['name'];
        $user_role = $_SESSION['role'];
#        echo $user_id . "<br />\n";
#        echo $user_name . "<br />\n";
#        echo $user_sid . "<br />\n";
#        echo $user_role . "<br />\n";
    } else {
#        echo '<meta http-equiv="refresh" content="6; url=login.php" />';
        $error[] = '<p class="warning fade-in">Ihre SessionID weist Annomalien auf, Sie werden automatisch abgemeldet.<br /> Um Ihre SessionID zu erneuern Logen Sie sich einfach erneut ein!! </p>'.'<meta http-equiv="refresh" content="6; url=login.php" />'."\n";
    }
     
?>

