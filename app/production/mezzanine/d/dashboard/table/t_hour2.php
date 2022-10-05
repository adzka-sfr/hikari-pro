<!-- <div class="row">
    <div class="col-12">
        <button type="button" class="btn btn-outline-success btn-sm" onclick="all2o()">Export to Excel<i class="fa fa-file-excel-o" style="font-size: 25px; margin-left: 5px;"></i></button>
        <script>
            var myWindow;

            function all2o() {
                myWindow = window.open("export/b450.php", "_blank");
                setTimeout(all2c, 2000)
            }

            function all2c() {
                myWindow.close();
            }
        </script>
    </div>
</div> -->
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
                while ($dsb1 = mysqli_fetch_array($sb1)) {
                    $awal = new DateTime($dsb1['time_in']);
                    $akhir = new DateTime($now);
                    $diff = $awal->diff($akhir);
                    if ($dsb1['time_out'] >= $now) {
                        $warna = '#ee6666';
                        $info = 'NOT READY';
                    } elseif ($dsb1['time_out'] < $now && $diff->d < 1) {
                        $warna = '#5DC87A';
                        $info = 'READY';
                    } else {
                        $warna = '#FAA545';
                        $info = 'READY';
                    }
                    $color = '#FAA545';
                ?>
                    <tr>
                        <td style="text-align: center; color: <?= $warna ?>; font-weight: bold;"><?= $dsb1['slip'] ?></td>
                        <td style="text-align: center;"><?= $dsb1['kode'] ?></td>
                        <td><?= $dsb1['nama_kabinet'] ?></td>
                        <td style="text-align: center;"><?= $dsb1['muka'] ?></td>
                        <td style="text-align: center;"><?= $dsb1['kategori'] ?></td>
                        <td style="text-align: center;"><?= $dsb1['qty'] ?></td>
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