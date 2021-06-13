<?php
    include  "dbConnect.php";
    $activity = $_GET['action'];
    function insert() {
        $name = $_POST["name"];
        $query = "insert into tbl_pos (name) value ('$name')";
        if ($GLOBALS['conn']->query($query) == true) {
            $query = "select * from tbl_pos where name = '$name' order by id DESC";
            $result = $GLOBALS['conn'] -> query($query);
            $row = $result -> fetch_assoc();

            $query = "select * from tbl_pos";
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
        $query = "delete from tbl_pos where id = '$id'";
        if ($GLOBALS['conn']->query($query) == true) {
            $query = "select * from tbl_pos";
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
        $query = "update tbl_pos set name='$name' where id='$id'";
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
