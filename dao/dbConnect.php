<?php
    $servername = "remotemysql.com";
    $username = "5QMueXiug5";
    $password = "kXv6fSysfJ";
    $dbName = "5QMueXiug5";
    $conn = new mysqli($servername, $username, $password, $dbName);

    if ($conn -> connect_error) {
        die("Connection failed: ".$conn -> connect_error);
    }

