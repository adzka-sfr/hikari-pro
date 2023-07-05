<?php
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();
$location = $_SESSION['role'];

?>
<?php
// Count total bench yang ada pada pre register berdasarkan lokasi
$sql4 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) as total_bench FROM qa_preregister WHERE c_location = '$location' AND c_type = 'bench'");
$data4 = mysqli_fetch_array($sql4);

// Count total user package yang ada pada pre register berdasarkan lokasi
$sql5 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) as total_userp FROM qa_preregister WHERE c_location = '$location' AND c_type = 'userpackage'");
$data5 = mysqli_fetch_array($sql5);
?>
<!-- untuk menampilkan nilai count -->
<table style="font-size: 15px;">
    <tr>
        <td>Total Pre-register Bench</td>
        <td style="padding-left: 10px;">:</td>
        <td><b><?= $data4['total_bench'] ?></b></td>
    </tr>
    <tr>
        <td>Total Pre-register User Package</td>
        <td style="padding-left: 10px;">:</td>
        <td><b><?= $data5['total_userp'] ?></b></td>
    </tr>
</table>
<table class="table table-bordered">
    <thead style="text-align: center;">
        <th>GMC</th>
        <th>Serial Number</th>
        <th>Item Name</th>
    </thead>
    <tbody>
        <?php
        $tanggal = date('Y-m-d', strtotime($now));
        $no = 0;
        // cek data
        $sql = mysqli_query($connect_pro, "SELECT *  FROM qa_preregister WHERE c_location = '$location' ORDER BY c_type ASC, c_gmc ASC");
        $data = mysqli_fetch_array($sql);
        if (!empty($data)) {
            $sql = mysqli_query($connect_pro, "SELECT *  FROM qa_preregister WHERE c_location = '$location' ORDER BY c_type ASC, c_gmc ASC");
            while ($data = mysqli_fetch_array($sql)) {
                $no++;
        ?>
                <tr>
                    <td style="text-align: center;"><?= $data['c_gmc'] ?></td>
                    <td style="text-align: center;"><?= $data['c_serialnumber'] ?></td>
                    <td><?= $data['c_name'] ?></td>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="3" style="text-align: center;">No Data</td>
            </tr>
        <?php
        }

        ?>
    </tbody>
</table>