<?php
session_start();
unset($_SESSION['CODE']);
unset($_SESSION['user']);
unset($_SESSION["userId"]);
unset(  $_SESSION['center']);
    unset($_SESSION['centerMail']);
    unset(   $_SESSION['sender']);
     unset( $_SESSION['centerN']);
      unset( $_SESSION['userEmail']);
      
      
   header("location:login.php");

    ?>