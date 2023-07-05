<?php
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
session_start();
$location = $_SESSION['role'];
?>
<table class="table table-bordered">
    <thead style="text-align: center;">
        <th>GMC</th>
        <th>Nama Item</th>
        <th>Hasil Stock Taking</th>
        <th>Status</th>
    </thead>
    <tbody>
        <?php
        $tanggal = date('Y-m-d', strtotime($now));
        $no = 0;

        // ambil data bench
        $sql = mysqli_query($connect_pro, "SELECT DISTINCT c_gmc, c_name FROM qa_bench WHERE c_location = '$location' AND c_used IS NOT NULL AND c_packed IS NULL");
        $data = mysqli_fetch_array($sql);

        // cek apakah ada data stok taking atau tidak
        // $sql = mysqli_query($connect_pro, "SELECT id FROM qa_count_staking WHERE c_location = '$location' ORDER BY c_name ASC");
        // $data = mysqli_fetch_array($sql);
        if (!empty($data['c_gmc'])) {
            $sql = mysqli_query($connect_pro, "SELECT DISTINCT c_gmc, c_name FROM qa_bench WHERE c_location = '$location' AND c_used IS NOT NULL AND c_packed IS NULL");
            while ($data = mysqli_fetch_array($sql)) {
                $no++;
                // hitung hasil scan stock taking
                $sql3 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) as hasil_staking FROM qa_count_staking WHERE c_gmc = '$data[c_gmc]' AND c_location = '$location'");
                $data3 = mysqli_fetch_array($sql3);
                $qty_actual = $data3['hasil_staking'];
        ?>
                <tr>
                    <td style="text-align: center;"><?= $data['c_gmc'] ?></td>
                    <td><?= $data['c_name'] ?></td>
                    <td style="text-align: center; font-size: 18px; font-weight: bold;"><?= $qty_actual ?></td>
                    <td style="text-align: center;">
                        <button type="button" class="btn btn-outline-primary" style="padding-top: 0px;padding-bottom: 0px; width:100px">counting...</button>
                    </td>
                </tr>
            <?php
            }
        }

        // ambil data user pacakage
        $sql2 = mysqli_query($connect_pro, "SELECT DISTINCT c_gmc, c_name FROM qa_userp WHERE c_location = '$location' AND c_used IS NOT NULL AND c_packed IS NULL");
        $data2 = mysqli_fetch_array($sql2);

        if (!empty($data2['c_gmc'])) {
            $sql2 = mysqli_query($connect_pro, "SELECT DISTINCT c_gmc, c_name FROM qa_userp WHERE c_location = '$location' AND c_used IS NOT NULL AND c_packed IS NULL");
            while ($data2 = mysqli_fetch_array($sql2)) {
                // hitung hasil scan stock taking
                $sql4 = mysqli_query($connect_pro, "SELECT COUNT(c_gmc) as hasil_staking FROM qa_count_staking WHERE c_gmc = '$data2[c_gmc]' AND c_location = '$location'");
                $data4 = mysqli_fetch_array($sql4);
                $qty_actual2 = $data4['hasil_staking'];
            ?>
                <tr>
                    <td style="text-align: center;"><?= $data2['c_gmc'] ?></td>
                    <td><?= $data2['c_name'] ?></td>
                    <td style="text-align: center; font-size: 18px; font-weight: bold;"><?= $qty_actual2 ?></td>
                    <td style="text-align: center;">
                        <button type="button" class="btn btn-outline-primary" style="padding-top: 0px;padding-bottom: 0px; width:100px">counting...</button>
                    </td>
                </tr>
        <?php
            }
        }

        ?>
    </tbody>
</table>