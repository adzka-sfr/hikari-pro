<div class="row">
    <div class="col-12 tableFixHead-2">
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
                while ($sl = mysqli_fetch_array($sql_csl)) {
                    $awal = new DateTime($sl['time_in']);
                    $akhir = new DateTime($now);
                    $diff = $awal->diff($akhir);
                    if ($sl['time_out'] >= $now) {
                        $warna = '#ee6666';
                        $info = 'NOT READY';
                    } elseif ($sl['time_out'] < $now && $diff->d < 3) {
                        $warna = '#5DC87A';
                        $info = 'READY';
                    } else {
                        $warna = '#FAA545';
                        $info = 'READY';
                    }
                    $color = '#FAA545';
                ?>
                    <tr>
                        <td style="text-align: center; color: <?= $warna ?>; font-weight: bold;"><?= $sl['slip'] ?></td>
                        <td style="text-align: center;"><?= $sl['kode'] ?></td>
                        <td><?= $sl['nama_kabinet'] ?></td>
                        <td style="text-align: center;"><?= $sl['muka'] ?></td>
                        <td style="text-align: center;"><?= $sl['kategori'] ?></td>
                        <td style="text-align: center;"><?= $sl['qty'] ?></td>
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