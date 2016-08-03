<?php
   session_start();
   unset($_SESSION["user"]);
   unset($_SESSION['userName']);
   //echo 'You have cleaned session';
   header('Refresh: 0; URL = index.html');
?>