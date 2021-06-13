<?php
    session_start();
    include "dbConnect.php";


    function checkLogin() {

        $email = $_POST["email"];
        $password = $_POST["password"];
        $queryString = "select * from tbl_account where username = '$email' and password = '$password'";
        $_SESSION["email"] = $email;
        $result = $GLOBALS['conn']->query($queryString);
        $resultSet = $result -> fetch_all(MYSQLI_ASSOC) ;
//        print_r($resultSet);
        echo sizeof($resultSet);
        if (sizeof($resultSet) == 1) {
            header('location:http://localhost/staffmanagement/view/backend/home.php');
            echo "ok";
        }
        else {
            header('location:http://localhost/staffmanagement/view/backend/login.php');
        }
    }
    checkLogin();
    $GLOBALS['conn'] -> close();
?>
