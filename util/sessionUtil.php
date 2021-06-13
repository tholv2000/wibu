<?php

    session_start();
    function checkSession()
    {


        if (isset($_SESSION["email"]) == false) {
            header('location:https://wibuweb.herokuapp.com/view/backend/login.php');
        }
    }
    checkSession();
?>