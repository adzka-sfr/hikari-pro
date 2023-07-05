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

$_SESSION['logerror_export_start'] = $startdate;
$_SESSION['logerror_export_end'] = $enddate;

function fetch_data()
{
    global $connect_pro;
    global $startdate;
    global $enddate;
    global $location;
    $query = "SELECT * from qa_errorlog WHERE c_datetime > '$startdate' AND c_datetime < '$enddate' ORDER BY id DESC";
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
                                            myWindow = window.open("errorlog/export.php", "_blank");
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
            <th>Process</th>
            <th>Error Info</th>
            <th>Serial</th>
            <th>Type</th>
            <th>Time</th>
            <th>PIC</th>
            </thead><tbody>';
    if (count($fetchData) > 0) {
        $sn = 1;
        foreach ($fetchData as $data) {
            echo "<tr>
          <td style='text-align:center'>" . $sn . "</td>
          <td>" . $data['c_process'] . "</td>
          <td>" . $data['c_error'] . "</td>
          <td style='text-align:center'>" . $data['c_serial'] . "</td>
          <td style='text-align:center'>" . $data['c_type'] . "</td>
          <td style='text-align:center'>" . $data['c_datetime'] . "</td>
          <td style='text-align:center'>" . $data['c_pic'] . "</td>
   </tr>";

            $sn++;
        }
    } else {

        echo "</tbody>";
    }
    echo "</table>";
}
