<?php
$urut = 0;
while ($data_model = mysqli_fetch_array($sql_model)) {
    $urut++;
    $model = $data_model['model'];

    // mencari total kabinet untuk model yang telah terpilih
    $sql_tisi = mysqli_query($con_pro, "SELECT SUM(qty) as total from ongoing_slip where model = '$model'");
    $data_tisi = mysqli_fetch_array($sql_tisi);

    // mencari data untuk isi tabel
    $sql_isi = mysqli_query($con_pro, "SELECT * from ongoing_slip where model = '$model' order by time_out desc");

?>

    <div class="accordion-item">
        <h2 class="accordion-header" id="model">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#m_<?= $urut ?>" aria-expanded="false" aria-controls="m_<?= $urut ?>">
                <span style="font-weight: bold;  text-align: right; width: 73px;"><?= $data_tisi['total'] ?> pcs </span> - <?= $model ?>
            </button>
        </h2>
        <div id="m_<?= $urut ?>" class="accordion-collapse collapse" aria-labelledby="model" data-bs-parent="#accord4">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-12 tableFixHead-3">

                        <table class="table table-bordered">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>Slip</th>
                                    <th>GMC</th>
                                    <th>Cabinet Name</th>
                                    <th>On Process / Finish</th>
                                    <th>Category</th>
                                    <th>Qty</th>
                                    <th>Settled Down</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($isi_m = mysqli_fetch_array($sql_isi)) {
                                    $awal = new DateTime($isi_m['time_in']);
                                    $akhir = new DateTime($now);
                                    $diff = $awal->diff($akhir);
                                    if ($isi_m['time_out'] >= $now) {
                                        $warna = '#9C0006';
                                        $bg = '#FFC7CE';
                                        $info = 'NOT READY';
                                    } elseif ($isi_m['time_out'] < $now && $diff->d < 3) {
                                        $warna = '#006100';
                                        $bg = '#C6EFCE';
                                        $info = 'READY';
                                    } else {
                                        $warna = '#9C5700';
                                        $bg = '#FFEB9C';
                                        $info = 'READY';
                                    }
                                ?>
                                    <tr>
                                        <td style="text-align: center; color: <?= $warna ?>; background-color: <?= $bg ?>; font-weight: bold;"><?= $isi_m['slip'] ?></td>
                                        <td style="text-align: center;"><?= $isi_m['kode'] ?></td>
                                        <td><?= $isi_m['nama_kabinet'] ?></td>
                                        <td style="text-align: center;"><?= $isi_m['muka'] ?></td>
                                        <td style="text-align: center;"><?= $isi_m['kategori'] ?></td>
                                        <td style="text-align: center;"><?= $isi_m['qty'] ?></td>
                                        <td>
                                            <?php
                                            echo $diff->d . ' hari ';
                                            echo $diff->h . ' jam ';
                                            echo $diff->i . ' menit ';
                                            ?>
                                        </td>
                                        <td style="text-align: center; color: <?= $warna ?>; background-color: <?= $bg ?>; font-weight: bold;"><?= $info ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>