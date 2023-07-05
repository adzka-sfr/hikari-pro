<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();
$today = date('Y-m-d', strtotime($now));

$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];
$startdate = date('Y-m-d H:i:s', strtotime($startdate));
$enddate = date('Y-m-d H:i:s', strtotime($enddate));
$location = $_SESSION['role'];

if ($location == 'packing up') {
    $anjay = 'UP';
} elseif ($location == 'packing gp') {
    $anjay = 'GP';
} else {
    $anjay = 'tidak ada lokasi';
}

$_SESSION['dashboard_export_start'] = $startdate;
$_SESSION['dashboard_export_end'] = $enddate;
$_SESSION['dashboard_export_loc'] = $anjay;

function fetch_data()
{
    global $connect_pro;
    global $startdate;
    global $enddate;
    global $location;
    $query = "SELECT * from qa_log WHERE c_date > '$startdate' AND c_date < '$enddate' AND c_location = '$location'  AND c_action = 'packing' OR c_date > '$startdate' AND c_date < '$enddate' AND c_location = '$location'  AND c_action = 'reset' ORDER BY id DESC";
    $exec = mysqli_query($connect_pro, $query);
    if (mysqli_num_rows($exec) > 0) {
        $row = mysqli_fetch_all($exec, MYSQLI_ASSOC);
        return $row;
    } else {
        return $row = [];
    }
}

$fetchData = fetch_data();
show_data($fetchData);

function show_data($fetchData)
{
    global $startdate;
    global $enddate;
    global $anjay;
    $startdate = date('Y-m-d H.i.s', strtotime($startdate));
    $enddate = date('Y-m-d H.i.s', strtotime($enddate));

    echo '
    <div class="row"><div class="col-12" style="padding-left:35px;">
    <button class="btn btn-success" type="button" onclick="all2o()"><i class="fa fa-file-excel-o"></i> Export</button>
    </div></div>
    <script>
                                        var myWindow;

                                        function all2o() {
                                            myWindow = window.open("history/export.php", "_blank");
                                        }

                                    </script>
    <script>
            $(document).ready(function() {
                $("#tabeldataup").DataTable({
                    paging: false,
                    scrollX: true,
                });
            });
        </script>
    <table class="table table-bordered" id="tabeldataup">
        
        <thead style="text-align:center">
            <th>No</th>
            <th style="width:100px">Piano Serial</th>
            <th style="width:100px">Piano GMC</th>
            <th style="width:200px">Piano Name</th>
            <th style="width:100px">Bench Serial</th>
            <th style="width:100px">Bench GMC</th>
            <th style="width:200px">Bench Name</th>
            <th style="width:100px">User Package Serial</th>
            <th style="width:100px">User Package GMC</th>
            <th style="width:200px">User Package Name</th>
            <th style="width:150px">Packing Time</th>
            <th style="width:50px">PIC</th>
            <th style="width:70px">Location</th>
            <th style="width:70px">Status</th>
            </thead><tbody>';
    if (count($fetchData) > 0) {
        $sn = 1;
        foreach ($fetchData as $data) {
            $date = date('Y/m/d', strtotime($data['c_date']));
            echo "<tr>
          <td style='text-align:center'>" . $sn . "</td>
          <td style='text-align:center'>" . $data['c_serialpiano'] . "</td>
          <td style='text-align:center'>" . $data['c_gmcpiano'] . "</td>
          <td>" . $data['c_namepiano'] . "</td>
          <td style='text-align:center'>" . $data['c_serialbench'] . "</td>
          <td style='text-align:center'>" . $data['c_gmcbench'] . "</td>
          <td>" . $data['c_namebench'] . "</td>
          <td style='text-align:center'>" . $data['c_serialuserp'] . "</td>
          <td style='text-align:center'>" . $data['c_gmcuserp'] . "</td>
          <td>" . $data['c_nameuserp'] . "</td>
          <td style='text-align:center'>" . $date . "</td>
          <td style='text-align:center'>" . $data['c_pic'] . "</td>
          <td style='text-align:center'>" . $data['c_location'] . "</td>
          <td style='text-align:center'>" . $data['c_action'] . "</td>
   </tr>";

            $sn++;
        }
    } else {

        echo "</tbody>";
    }
    echo "</table>";
}
