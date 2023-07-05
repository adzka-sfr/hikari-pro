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
$items = $_POST['items'];

if ($items == 'bench') {
    $anjay = 'Bench';
} elseif ($items == 'userpackage') {
    $anjay = 'User Package';
}

$_SESSION['adjustlog_export_start'] = $startdate;
$_SESSION['adjustlog_export_end'] = $enddate;
$_SESSION['adjustlog_export_items'] = $items;

function fetch_data()
{
    global $connect_pro;
    global $startdate;
    global $enddate;
    global $items;
    $query = "SELECT * FROM qa_adjustlog WHERE c_date >= '$startdate' AND c_date <= '$enddate' AND c_type = '$items' ORDER BY c_date DESC";

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
                                            myWindow = window.open("stock/export_adjustlog.php", "_blank");
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
                <th>Action</th>
                <th>Location</th>
                <th>Serial Number</th>
                <th>PIC</th>
                <th>Note</th>
                <th>Time</th>
            </thead><tbody>';
    if (count($fetchData) > 0) {
        $sn = 1;
        foreach ($fetchData as $data) {
            echo "<tr>
          <td style='text-align:center'>" . $sn . "</td>
          <td style='text-align:center'>" . $data['c_action'] . "</td>
          <td style='text-align:center'>" . $data['c_location'] . "</td>
          <td style='text-align:center'>" . $data['c_serialnumber'] . "</td>
          <td style='text-align:center'>" . $data['c_pic'] . "</td>
          <td>" . $data['c_note'] . "</td>
          <td style='text-align:center'>" . $data['c_date'] . "</td>
   </tr>";

            $sn++;
        }
    } else {

        echo "</tbody>";
    }
    echo "</table>";
}
