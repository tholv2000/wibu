<?php
    include "../dao/dbConnect.php";
    $addedStar = (int)$_POST['star'];
    $id = $_POST['id'];
    $firstQuery = "select * from tbl_rating where staffid = '$id'";
    $row = $GLOBALS['conn'] -> query($firstQuery) -> fetch_assoc();
    $currentStar = (int)$row['startotal'];
    $totalStar = $addedStar + $currentStar;
    $secondQuery = "update tbl_rating set startotal = '$totalStar' where staffid = '$id'";
    if ($GLOBALS['conn'] -> query($secondQuery) == true) {
        echo "ok";
    }
    else {
        echo "error ".($totalStar);
    }
    $GLOBALS['conn'] -> close();
?>
