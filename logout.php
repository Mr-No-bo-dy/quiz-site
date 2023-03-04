<?php
   session_start();
   // unset($_SESSION['users']['user']);
   session_destroy();
   header("Location: login.php");
?>