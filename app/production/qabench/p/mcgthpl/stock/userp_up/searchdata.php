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
$location = $_POST['location'];
$datestatus = $_POST['datestatus'];

if ($location == 'packing up') {
    $anjay = 'UP';
} elseif ($location == 'packing gp') {
    $anjay = 'GP';
}

$_SESSION['alltim_export_start'] = $startdate;
$_SESSION['alltim_export_end'] = $enddate;
$_SESSION['alltim_export_status'] = $datestatus;
$_SESSION['alltim_export_loc'] = $location;

function fetch_data()
{
    global $connect_pro;
    global $startdate;
    global $enddate;
    global $location;
    global $datestatus;
    if ($datestatus == 'sd') {
        $query = "SELECT * FROM qa_userp WHERE c_used >= '$startdate' AND c_used <= '$enddate' AND c_used IS NOT NULL AND c_packed IS NOT NULL AND c_location = '$location' ORDER BY c_packed DESC";
    } else {
        $query = "SELECT * FROM qa_userp WHERE c_packed >= '$startdate' AND c_packed <= '$enddate' AND c_used IS NOT NULL AND c_packed IS NOT NULL AND c_location = '$location' ORDER BY c_packed DESC";
    }

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
                                            myWindow = window.open("stock/userp_up/export_alltim.php", "_blank");
                                        }

                                    </script>
    <script>
            $(document).ready(function() {
                $("#tabeldataup").DataTable({
                    paging: false,
                });
            });
        </script>
    <table class="table table-bordered" id="tabeldataup">
        
        <thead style="text-align:center">
            <th>No</th>
                <th>GMC</th>
                <th>Serial Number</th>
                <th>Name</th>
                <th>Registered</th>
                <th>Packed</th>
            </thead><tbody>';
    if (count($fetchData) > 0) {
        $sn = 1;
        foreach ($fetchData as $data) {
            echo "<tr>
          <td style='text-align:center'>" . $sn . "</td>
          <td style='text-align:center'>" . $data['c_gmc'] . "</td>
          <td style='text-align:center'>" . $data['c_serialuserp'] . "</td>
          <td>" . $data['c_name'] . "</td>
          <td style='text-align:center'>" . $data['c_used'] . "</td>
          <td style='text-align:center'>" . $data['c_packed'] . "</td>
   </tr>";

            $sn++;
        }
    } else {

        echo "</tbody>";
    }
    echo "</table>";
}
