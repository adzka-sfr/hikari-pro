<div class="row">
    <div class="col-12 tableFixHead-2">
        <table class=" table table-bordered">
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
                while ($dsa1 = mysqli_fetch_array($sa1)) {
                    $awal = new DateTime($dsa1['time_in']);
                    $akhir = new DateTime($now);
                    $diff = $awal->diff($akhir);
                    if ($dsa1['time_out'] >= $now) {
                        $warna = '#ee6666';
                        $info = 'NOT READY';
                    } elseif ($dsa1['time_out'] < $now && $diff->d < 3) {
                        $warna = '#5DC87A';
                        $info = 'READY';
                    } else {
                        $warna = '#FAA545';
                        $info = 'READY';
                    }
                    $color = '#FAA545';
                ?>
                    <tr>
                        <td style="text-align: center; color: <?= $warna ?>; font-weight: bold;"><?= $dsa1['slip'] ?></td>
                        <td style="text-align: center;"><?= $dsa1['kode'] ?></td>
                        <td><?= $dsa1['nama_kabinet'] ?></td>
                        <td style="text-align: center;"><?= $dsa1['muka'] ?></td>
                        <td style="text-align: center;"><?= $dsa1['kategori'] ?></td>
                        <td style="text-align: center;"><?= $dsa1['qty'] ?></td>
                        <td>
                            <?php
                            echo $diff->d . ' hari ';
                            echo $diff->h . ' jam ';
                            echo $diff->i . ' menit ';
                            ?>
                        </td>
                        <td style="text-align: center; color: <?= $warna ?>; font-weight: bold;"><?= $info ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>