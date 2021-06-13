<?php
include  "dbConnect.php";
$activity = $_GET['action'];
function insert() {
    $name = $_POST["name"];
    $img = $_POST["img"];
    $phone = $_POST["phone"];
    $dob = $_POST["dob"];
    $level = $_POST["level"];
    $pos = $_POST["pos"];
    $query = "insert into tbl_staff (name,img,phone,dob,level,position) value ('$name','$img','$phone',$dob,'$level','$pos')";
    if ($GLOBALS['conn']->query($query) == true) {
        $query = "select * from tbl_staff where name = '$name' order by id DESC";
        $result = $GLOBALS['conn'] -> query($query);
        $row = $result -> fetch_assoc();
        $id = $row['id'];
        $query = "insert into tbl_rating (staffid,startotal) values ($id,0)";
        $result = $GLOBALS['conn'] -> query($query);
        $query = "select * from tbl_staff";
        $resultSet = $GLOBALS['conn'] -> query($query) -> fetch_all(MYSQLI_ASSOC);
        $row['num'] = ceil(sizeof($resultSet)/5);
        echo json_encode($row);
    }
    else {
        echo "Error: " . $query . "<br>" . $GLOBALS['conn']->error;

    }
}
function delete() {
    $id = $_POST["id"];
    $query = "delete from tbl_staff where id = '$id'";
    if ($GLOBALS['conn']->query($query) == true) {
        $query = "select * from tbl_staff";
        $resultSet = $GLOBALS['conn'] -> query($query) -> fetch_all(MYSQLI_ASSOC);
        $data = array("num"=>ceil(sizeof($resultSet)/5));
        echo json_encode($data);
    }
    else {
        echo "Error deleting record: ".$GLOBALS['conn']->error;
    }
}
function edit() {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $img = $_POST["img"];
    $phone = $_POST["phone"];
    $dob = $_POST["dob"];
    $level = $_POST["level"];
    $pos = $_POST["pos"];
    if ($img != "")
        $query = "update tbl_staff set name='$name',img='$img',phone='$phone',dob=$dob,level='$level',position='$pos' where id='$id'";
    else {
        $query = "update tbl_staff set name='$name',phone='$phone',dob=$dob,level='$level',position='$pos' where id='$id'";
    }
    if ($GLOBALS['conn']->query($query) == true) {
        echo "Record updated successfully";

    }
    else {
        echo "Error updating record: " . $GLOBALS['conn']->error;
    }
}
if ($activity == 'insert') {
    insert();
}
else if ($activity == 'delete') {
    delete();
}
else if ($activity == 'edit') {
    edit();
}
$GLOBALS['conn'] -> close();
?>
