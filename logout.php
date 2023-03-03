<?php
   session_start();
   // $_SESSION['users']['user'] = null;
   // $_SESSION['users']['user']['username'] = null;
   // $_SESSION['users']['user']['email'] = null;
   // $_SESSION['users']['user']['tel'] = null;
   // $_SESSION['users']['user']['avatar'] = null;
   // unset($_SESSION['users']['user']);
   session_destroy();
   header("Location: login.php");
?>