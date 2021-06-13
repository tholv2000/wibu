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
    $queryString = "select * from tbl_pos";
    $result = $GLOBALS['conn'] -> query($queryString);
    $resultSet = $result -> fetch_all(MYSQLI_ASSOC);
    $rowCount = sizeof($resultSet);
    $recordPerPage = 5;
    $pageNums = ceil($rowCount/$recordPerPage);

    $queryStringDis = "select * from tbl_pos limit 5";
    $result = $GLOBALS['conn'] -> query($queryStringDis);
    $resultSet = $result -> fetch_all(MYSQLI_ASSOC);
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
                        <div class="panel-heading">Danh sách chức vụ</div>
                        <div class="panel-body">
                            <table class="table table-bordered table-hover" id="posTable">
                                <thead>
                                    <tr>
                                        <th>Mã chức vụ</th>
                                        <th>Tên chức vụ</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <?php foreach ($resultSet as $row): ?>
                                    <tr>
                                        <td><?php echo $row['id'];?></td>
                                        <td><?php echo $row['name'];?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#posModal" onclick="preEdit(this)"><span class="fa fa-pencil"></span></button>&nbsp;&nbsp;
                                            <button type="button" class="btn btn-danger" onclick="del(this);"><span class="fa fa-trash"></span></button></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <ul class="pagination">

                                <li class = "page-item" onclick="previouss();"><a class="page-link">Previous</a></li>
                                <?php for ($i = 1; $i <= $pageNums; $i++): ?>
                                    <?php if ($i==1): ?>
                                        <li class = "page-item active" onclick="pagination(<?php echo $i?>)" id="page<?php echo $i ?>"><a class="page-link"><?php echo $i ?></a></li>
                                    <?php endif; ?>
                                    <?php if ($i!=1): ?>
                                        <li class = "page-item" onclick="pagination(<?php echo $i?>)" id="page<?php echo $i ?>"><a class="page-link"><?php echo $i ?></a></li>
                                    <?php endif; ?>
                                <?php endfor;?>

                                <li class = "page-item" onclick="nextt();"><a class="page-link">Next</a></li>

                            </ul>
                        </div>
                    </div>
                    <form id = "formPos">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Tên đơn vị:</label>
                                    <input type="text" class="form-control" placeholder="Nhập tên chức vụ" id="namePos" name="name" required>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" id="insertButton"">Thêm</button>
                    </form>
                </div>
                <!-- end content -->
            </div>
            <!-- col-lg-12 -->
        </div>
        <!-- row -->
    </div>
    <!-- page-wrapper -->
    <div class="modal fade" id="posModal">
        <div class="vertical-alignment-helper">
            <div class="modal-dialog vertical-align-center" style="width:60%">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Sửa chức vụ</h4>
<!--                        <button type="button" class="close" data-dismiss="modal" style="margin-top:-20px">&times;</button>-->
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mã chức vụ:</label>
                                    <input type="text" class="form-control" placeholder="Nhập mã chức vụ" id="idPosModal" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Tên chức vụ:</label>
                                    <input type="text" class="form-control" placeholder="Nhập tên chức vụ" id="namePosModal" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="edit(this)">Lưu</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
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
      let name = $("#namePos").val();
      let length = $("#tableBody tr").size();

      $.ajax({
          url: "http://localhost/staffmanagement/dao/positionDAO.php?action=insert",
          method: "POST",
          data: {name:name},
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
              $("#formPos")[0].reset();
              if (length < 5) {
                  $("#tableBody").append("<tr>" +
                      "<td>" + data['id'] + "</td>" +
                      "<td>" + data['name'] + "</td>" +
                      "<td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#posModal' onclick='preEdit(this)'><span class='fa fa-pencil'></span></button>&nbsp;&nbsp;&nbsp;<button type='button' class='btn btn-danger' onclick='del(this);'><span class='fa fa-trash'></span></button> </td>");
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
            url: "http://localhost/staffmanagement/dao/positionDAO.php?action=delete",
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
    $("#idPosModal").val($(cols[0]).text());
    $("#namePosModal").val($(cols[1]).text());
}
function edit(e) {

    let idFirst = $("#idPosModal").val();
    let name = $("#namePosModal").val();
    console.log(name);
    console.log(idFirst);
    $.ajax({
        url: "http://localhost/staffmanagement/dao/positionDAO.php?action=edit",
        method: "POST",
        data: {id:idFirst, name: name},

        success: function (data) {
            console.log(data);
            $("#tableBody tr").each(function (){
                let row = $(this);
                let idSecond = row.find("td:eq(0)").text().trim();

                if (idFirst == idSecond) {
                    row.find("td:eq(1)").html(name);
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
       url: "http://localhost/staffmanagement/util/paginationPosUtil.php?page=".concat(p),
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
    /*table.dataTable thead .sorting:after,*/
    /*table.dataTable thead .sorting:before,*/
    /*table.dataTable thead .sorting_asc:after,*/
    /*table.dataTable thead .sorting_asc:before,*/
    /*table.dataTable thead .sorting_asc_disabled:after,*/
    /*table.dataTable thead .sorting_asc_disabled:before,*/
    /*table.dataTable thead .sorting_desc:after,*/
    /*table.dataTable thead .sorting_desc:before,*/
    /*table.dataTable thead .sorting_desc_disabled:after,*/
    /*table.dataTable thead .sorting_desc_disabled:before {*/
    /*    bottom: .5em;*/
    /*}*/
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
