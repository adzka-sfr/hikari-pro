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
                while ($opff = mysqli_fetch_array($sql_opff)) {
                    $awal = new DateTime($opff['time_in']);
                    $akhir = new DateTime($now);
                    $diff = $awal->diff($akhir);
                    if ($opff['time_out'] >= $now) {
                        $warna = '#9C0006';
                        $bg = '#FFC7CE';
                        $info = 'NOT READY';
                    } elseif ($opff['time_out'] < $now && $diff->d < 3) {
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
                        <td style="text-align: center; color: <?= $warna ?>; background-color: <?= $bg ?>; font-weight: bold;"><?= $opff['slip'] ?></td>
                        <td style="text-align: center;"><?= $opff['kode'] ?></td>
                        <td><?= $opff['nama_kabinet'] ?></td>
                        <td style="text-align: center;"><?= $opff['muka'] ?></td>
                        <td style="text-align: center;"><?= $opff['kategori'] ?></td>
                        <td style="text-align: center;"><?= $opff['qty'] ?></td>
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