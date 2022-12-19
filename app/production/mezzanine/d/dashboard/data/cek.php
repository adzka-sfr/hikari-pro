<?php
include '../koneksi.php';
$day3 = date('Y-m-d H:i:s', strtotime('-3 days'));
$now = date('Y-m-d H:i:s');

?>

<table border="1">
    <tr>
        <td>Slip</td>
        <td>Time in</td>
        <td>Time out</td>
        <td>Lapse Time</td>
    </tr>
    <?php
    $total = 0;
$sql = mysqli_query($con_pro, "SELECT * from ongoing_slip where  time_out <= '$now' and kategori = 'panel'");
while($data = mysqli_fetch_array($sql)){
    // $total = $total + $data['qty'];
    $awal = new DateTime($data['time_in']);
    $akhir = new DateTime($now);
    $diff = $awal->diff($akhir);
    if($diff->d < 3){
    $total = $total + $data['qty'];
    ?>
    <tr>
        <td><?= $data['slip'] ?></td>
        <td><?= $data['time_in'] ?></td>
        <td><?= $data['time_out'] ?></td>
        <td><?= $diff->d." hari ".$diff->h." jam ". $diff->i ."menit"?></td>
    </tr>
    <?php
    }
}
    ?>
</table>
<p><?= $total ?></p>