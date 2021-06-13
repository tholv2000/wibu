<?php
    session_start();
    unset($_SESSION['email']);
    header("location:http://localhost/staffmanagement/view/backend/login.php");
?>
