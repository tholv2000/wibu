<?php
    session_start();
    unset($_SESSION['email']);
    header("location:https://wibuweb.herokuapp.com/view/backend/login.php");
?>
