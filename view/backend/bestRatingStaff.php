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
<?php
include "../../dao/dbConnect.php";
include "../../util/sessionUtil.php";
$queryString = "select * from tbl_rating order by startotal desc limit 5";
$result = $GLOBALS['conn'] -> query($queryString);
$resultSet = $result -> fetch_all(MYSQLI_ASSOC);
$arrayRes = array();
foreach ($resultSet as $item) {
    $arrayRes[$item['staffid']] = $item['startotal'];
}


?>
<body>

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
                        <a href="home.php"><span class="fa fa-home"></span> Trang chủ</a>
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
                <div class="col-md-12">
                    <div class="search">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                            <input id="searchId" type="text" class="form-control" name="search" placeholder="Search..">
                        </div>
                    </div>
                    <div class="panel panel-primary" style="margin-top:20px">
                        <div class="panel-heading">Danh sách nhân viên</div>
                        <div class="panel-body">
                            <div class="table-wrapper-scroll-y">
                                <table class="table table-bordered table-hover table-responsive">
                                    <thead>
                                    <tr>
                                        <th>Mã nhân viên</th>
                                        <th>Ảnh</th>
                                        <th>Họ tên</th>
                                        <th>Tổng số sao</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                    <?php foreach($resultSet as $item):?>
                                        <?php
                                        $newId = $item['staffid'];
                                        $query = "select * from tbl_staff where id ='$newId'";
                                        $row = $GLOBALS['conn'] -> query($query) -> fetch_assoc();
                                        ?>
                                        <tr>
                                            <td style="width: 7%"><?php echo $row['id']; ?></td>

                                            <td style="width:5%"><img src="../../Assets/Backend/images/<?php echo $row['img'];?>"></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $arrayRes[$row['id']]; ?></td>
                                        </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
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
<script>
    $(document).ready(function(){
        $("#searchId").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tableBody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $("#insertButton").on('click',function (){
            let name = $("#name").val();
            let img = $("#img").val().replace("C:\\fakepath\\","");
            let phone = $("#phone").val();
            let level = $("#level").val();
            let dob = $("#dob").val();
            let pos = $("#positionId").val();
            let length = $("#tableBody tr").size();
            console.log(img);
            $.ajax({
                url: "https://wibuweb.herokuapp.com/dao/staffDAO.php?action=insert",
                method: "POST",
                data: {name:name,img:img,phone:phone,level:level,dob:dob,pos:pos},
                dataType: "json",
                // beforeSend: function (data) {
                //     console.log(data);
                // }
                beforeSend: function (data) {
                    console.log(data)
                },
                success:function (data) {
                    console.log("data is " + data);
                    console.log(data['num']);
                    $("#staffForm")[0].reset();
                    if (length < 5) {
                        $("#tableBody").append("<tr>" +
                            "<td style='width: 7%'>" + data['id'] + "</td>" +
                            "<td style='width: 5%'><img src='../../Assets/Backend/images/" + data['img'] + "'></td>" +
                            "<td>" + data['name'] + "</td>" +
                            "<td>" + data['phone'] + "</td>" +
                            "<td>" + data['dob'] + "</td>" +
                            "<td>" + data['level'] + "</td>" +
                            "<td>" + data['position'] + "</td>" +

                            "<td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#staffModal' onclick='preEdit(this)'><span class='fa fa-pencil'></span></button>&nbsp;&nbsp;&nbsp;<button type='button' class='btn btn-danger' onclick='del(this);'><span class='fa fa-trash'></span></button> </td>");
                        // alert("Insert success");
                    }
                    if (Math.ceil(data['num']) > $(".pagination li").size() - 2) {
                        let newRow = '<li class = "page-item" onclick="pagination('.concat(String(Math.ceil(data['num']))).concat(')" id="page').concat(String(Math.ceil(data['num']))).concat('"><a class="page-link">').concat(String(Math.ceil(data['num']))).concat('</a></li>');
                        console.log(newRow);
                        $(".pagination li:last-child").remove();
                        $(".pagination").append(newRow);
                        newRow = '<li class = "page-item" onclick="nextt();"><a class="page-link">Next</a></li>'
                        $(".pagination").append(newRow);
                    }
                },
                error: function (request, error) {

                    console.log(" Can't do because: " + error);
                },
            });
        });

    });
    function del(e) {
        var confirm = window.confirm("Are you sure ?");
        if (confirm == true) {
            $(e).parents("tr").remove();
            let row = $(e).parents("tr");
            let cols = $(row).children("td");
            let id = $(cols[0]).text();
            console.log(typeof id);
            console.log(id);
            $.ajax({
                url: "https://wibuweb.herokuapp.com/dao/staffDAO.php?action=delete",
                method: "POST",
                data: {id:id},
                dataType: "json",
                success: function (data) {
                    console.log(data['num']);
                    let p = parseInt($(".active").text());
                    let currentPage = parseInt($(".active").text());
                    let pageNums = $(".pagination li").size() - 2;
                    if (data['num'] < $(".pagination li").size() - 2) {
                        $(".pagination li:last-child").remove();
                        $(".pagination li:last-child").remove();
                        if (currentPage == pageNums) {
                            $(".pagination li:last-child").addClass("active");
                            p = parseInt($(".active").text());
                        }
                        let newRow = '<li class = "page-item" onclick="nextt();"><a class="page-link">Next</a></li>'
                        $(".pagination").append(newRow);

                    }
                    pagination(p);
                },
                error: function (request, error) {

                    console.log(" Can't do because: " + error);
                },
            });

        }
    }
    function preEdit(e) {
        let row = $(e).parents("tr");
        let cols = row.children("td");


        $("#idModal").val($(cols[0]).text());

        $("#nameModal").val($(cols[2]).text());
        $("#dobModal").val($(cols[3]).text());
        $("#phoneModal").val($(cols[4]).text());
        $("#positionModal").val($(cols[5]).text());
        $("#levelModal").val($(cols[6]).text());
    }
    function edit(e) {

        let idFirst = $("#idModal").val();
        let name = $("#nameModal").val();
        let img = $("#imgModal").val().replace("C:\\fakepath\\","");
        let dob = $("#dobModal").val();
        let phone = $("#phoneModal").val();
        let pos = $("#positionModal").val();
        let level = $("#levelModal").val();
        console.log(name);
        console.log(idFirst);
        $.ajax({
            url: "https://wibuweb.herokuapp.com/dao/staffDAO.php?action=edit",
            method: "POST",
            data: {id:idFirst, name: name, img: img, dob: dob, phone: phone, pos: pos, level: level},

            success: function (data) {
                console.log(data);
                $("#tableBody tr").each(function (){
                    let row = $(this);
                    let idSecond = row.find("td:eq(0)").text().trim();

                    if (idFirst == idSecond) {
                        if (img != "") {
                            row.find("td:eq(1)").html("<img src='../../Assets/Backend/images/" + img + "'>");
                        }
                        row.find("td:eq(2)").html(name);
                        row.find("td:eq(3)").html(dob);
                        row.find("td:eq(4)").html(phone);
                        row.find("td:eq(5)").html(pos);
                        row.find("td:eq(6)").html(level);
                        return false;
                    }
                });
            },
            error: function (request, error) {

                console.log(" Can't do because: " + error);
            }
        })
    }
    function pagination(p) {
        let activePage = "#page".concat(p);
        console.log(activePage);
        $.ajax({
            url: "https://wibuweb.herokuapp.com/util/paginationStaffUtil.php?page=".concat(p),
            method: "GET",
            success: function (data) {
                $("#tableBody").html(data);
                $(".pagination li").each(function (){
                    let row = $(this);
                    row.removeClass("active");
                })
                $(activePage).addClass("active");
            },
            error: function (request, error) {

                console.log(" Can't do because: " + error);
            }
        });
    }
    function previouss() {
        let currentPage = parseInt($(".active").text());
        let num = $(".pagination li").size() - 2;
        let futurePage;
        if (num == 1) {
            futurePage = 1;
        }
        else {
            futurePage = currentPage == 1 ? num : currentPage - 1;
        }
        pagination(futurePage);
    }
    function nextt() {
        let currentPage = parseInt($(".active").text());
        let num = $(".pagination li").size() - 2;
        let futurePage;
        if (num == 1) {
            futurePage = 1;
        }
        else {
            futurePage = currentPage == num ? 1 : currentPage + 1;
        }
        pagination(futurePage);
    }
</script>



</body>
<style>
    .modal {
    }
    td {
        text-align: center;
    }
    th {
        text-align: center;
    }
    .vertical-alignment-helper {
        display:table;
        height: 100%;
        width: 100%;
    }
    .vertical-align-center {
        display: table-cell;
        vertical-align: middle;
    }
    .modal-content {
        width:inherit;
        height:inherit;
        margin: 0 auto;
    }
</style>
</html>
