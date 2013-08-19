<?php

function kill_session()
{
$_SESSION = array();
if (isset($_COOKIE[session_name()]))
{
setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();
}

     session_start();
     kill_session();

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

     header('Location: '.$http.'://'.$hostname.($path == '/' ? '' : $path).'/login.php');
?>

