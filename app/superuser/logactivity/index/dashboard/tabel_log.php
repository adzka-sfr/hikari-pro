<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");

date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
$now = date('Y-m-d', strtotime($now));
if (empty($_POST['isia'])) {
    $tgl = date('Y-m-d', strtotime($now));
} else {
    $tgl = $_POST['isia'];
}
?>
<table class="table table-bordered">
    <thead style="text-align: center;">
        <th>No</th>
        <th>ID</th>
        <th>Name</th>
        <th>Dept</th>
        <th>Log Time</th>
    </thead>
    <tbody>
        <?php
        $no = 0;
        $today = date('Y-m-d', strtotime($tgl));
        //cek
        $sql = mysqli_query($connect_log, "SELECT id FROM activity_log WHERE log_time LIKE '$today%'");
        $data = mysqli_fetch_array($sql);
        if (!empty($data['id'])) {
            $sql = mysqli_query($connect_log, "SELECT DISTINCT employee_name, employee_id from activity_log WHERE log_time LIKE '$today%'");
            while ($data = mysqli_fetch_array($sql)) {
                $no++;
                $sql1 = mysqli_query($connect_log, "SELECT log_time from activity_log WHERE employee_id = '$data[employee_id]' order by log_time desc limit 1");
                $data1 = mysqli_fetch_array($sql1);

                $sql2 = mysqli_query($connect, "SELECT dept, id FROM auth WHERE id = '$data[employee_id]'");
                $data2 = mysqli_fetch_array($sql2);
                if (!empty($data2['dept'])) {
                    $sql2 = mysqli_query($connect, "SELECT dept, id FROM auth WHERE id = '$data[employee_id]'");
                    $data2 = mysqli_fetch_array($sql2);
                    $dept = $data2['dept'];
                    $id  = $data2['id'];
                } else {
                    $dept = 'User deleted';
                    $id = '-';
                }
        ?>
                <tr style="text-align: center;">
                    <td><?= $no ?></td>
                    <td><?= $id ?></td>
                    <td style="text-align: left;"><?= $data['employee_name'] ?></td>
                    <td><?= $dept ?></td>
                    <td><?= $data1['log_time'] ?></td>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr>
                <td style="text-align: center;" colspan="4">No Data</td>
            </tr>
        <?php
        }

        ?>
    </tbody>
</table>