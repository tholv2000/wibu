<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quản lý nhân viên</title>
    <link href="../../Assets/Backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../Assets/Backend/css/sb-admin.css" rel="stylesheet">
</head>

<body>
<?php
//    header("location:http://localhost/staffmanagement/util/sessionUtil.php");
include "../../util/sessionUtil.php";
?>
<div id="wrapper">

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php">Quản lý nhân viên</a>
        </div>
        <!-- navbar-header -->
        <div class="navbar-default navbar-static-side">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="home.php"><span class="glyphicon glyphicon-home"></span> Trang chủ</a>
                    </li>
                    <li>
                        <a href="position.php">Chức vụ</a>
                    </li>
                    <li>
                        <a href="staff.php">Nhân viên </a>
                    </li>
                    <li>
                        <a href="bestRatingStaff.php">Top 5 nhân viên được yêu thích nhất</a>
                    </li>
                    <li>
                        <a href="chart.php">Thống kê</a>
                    </li>
                    <li>
                        <a href="user.html">Tài khoản</a>
                    </li>
                    <li>
                        <a href="../../util/logoutUtil.php">Đăng xuất</a>
                    </li>
                </ul>
                <!-- side-menu -->
            </div>
            <!-- sidebar-collapse -->
        </div>
        <!-- navbar-static-side -->
    </nav>

    <div id="page-wrapper" style="padding-top: 20px;">
        <div class="row">
            <div class="col-lg-12">
                <!-- content here -->
                <p id="piechart" style="width: 900px; height: 500px"></p>
                <!-- end content -->
            </div>
            <!-- col-lg-12 -->
        </div>
        <!-- row -->
    </div>
    <!-- page-wrapper -->

</div>
<!-- wrapper -->

<script src="../../Assets/Backend/js/jquery-1.10.2.js"></script>
<script src="../../Assets/Backend/js/bootstrap.min.js"></script>
<script src="../../Assets/Backend/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="../../Assets/Backend/js/sb-admin.js"></script>
<script lang="javascript">var __vnp = {code : 5729,key:'', secret : '054acab78a785343c74937f71d68e97d'};(function() {var ga = document.createElement('script');ga.type = 'text/javascript';ga.async=true; ga.defer=true;ga.src = '//core.vchat.vn/code/tracking.js';var s = document.getElementsByTagName('script');s[0].parentNode.insertBefore(ga, s[0]);})();</script>
</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php
    include "../../dao/dbConnect.php";
    $query = "select * from tbl_pos";
    $resultSet = $GLOBALS['conn'] -> query($query) -> fetch_all(MYSQLI_ASSOC);
    $arr = array();
    foreach ($resultSet as $row) {
        $pos = $row['name'];
        $query = "select * from tbl_staff where position = '$pos'";
        $count = sizeof($GLOBALS['conn'] -> query($query) -> fetch_all(MYSQLI_ASSOC));
        $arr[$row['name']] = $count;
    }
?>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Chức vụ', 'Số nhân viên'],
            <?php foreach ($arr as $key=>$val) {
                echo '["'.$key.'", '.$val.'],';
             }

            ?>
        ]);

        var options = {
            title: 'Thống kê số nhân viên trong chức vụ'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        console.log(data);
        chart.draw(data, options);
    }
</script>
</html>
