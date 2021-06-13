<?php

    session_start();
    function checkSession()
    {


        if (isset($_SESSION["email"]) == false) {
            header('location:http://localhost/staffmanagement/view/backend/login.php');
        }
    }
    checkSession();
?>