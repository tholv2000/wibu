<?php
include "../dao/dbConnect.php";
$p = $_GET['page'];
$start = 5 * ($p - 1);
$recordsPerPage = 5;
$query = "select * from tbl_staff limit $start,$recordsPerPage";
$result = $GLOBALS['conn'] -> query($query);
if ($result == true) {
    $resultSet = $result -> fetch_all(MYSQLI_ASSOC);
    $data = "";
    foreach ($resultSet as $row) {
        $data .= "
            <tr>
                <td style='width: 7%'>".$row['id']."</td>
                
                <td style='width: 5%'><img src='../../Assets/Backend/images/".$row['img']."'></td>
                <td>".$row['name']."</td>
                <td>".$row['dob']."</td>
                <td>".$row['phone']."</td>
                <td>".$row['position']."</td>
                <td>".$row['level']."</td>
                <td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#staffModal' onclick='preEdit(this)'><span class='fa fa-pencil'></span></button>&nbsp;&nbsp;
                <button type='button' class='btn btn-danger' onclick='del(this);'><span class='fa fa-trash'></span></button></a></td>
            </tr>";
    }
    echo $data;
}
else {
    echo 'Something error';
}

?>

