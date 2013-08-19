<?php
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

     $hostname = $_SERVER['HTTP_HOST'];
     $path = dirname($_SERVER['PHP_SELF']);

     if (!isset($_SESSION['angemeldet']) || !$_SESSION['angemeldet']) {
      header('Location: '.$http.'://'.$hostname.($path == '/' ? '' : $path).'/login.php');
      exit;
      }
?>

