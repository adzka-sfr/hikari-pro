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
                while ($opfp = mysqli_fetch_array($sql_opfp)) {
                    $awal = new DateTime($opfp['time_in']);
                    $akhir = new DateTime($now);
                    $diff = $awal->diff($akhir);
                    if ($opfp['time_out'] >= $now) {
                        $warna = '#9C0006';
                        $bg = '#FFC7CE';
                        $info = 'NOT READY';
                    } elseif ($opfp['time_out'] < $now && $diff->d < 3) {
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
                        <td style="text-align: center; color: <?= $warna ?>; background-color: <?= $bg ?>; font-weight: bold;"><?= $opfp['slip'] ?></td>
                        <td style="text-align: center;"><?= $opfp['kode'] ?></td>
                        <td><?= $opfp['nama_kabinet'] ?></td>
                        <td style="text-align: center;"><?= $opfp['muka'] ?></td>
                        <td style="text-align: center;"><?= $opfp['kategori'] ?></td>
                        <td style="text-align: center;"><?= $opfp['qty'] ?></td>
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