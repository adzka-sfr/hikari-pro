<div class="dashboard_graph" style="padding-top: 10px;">
    <div class="row">
        <div class="col-6">
            <h2>Dashboard</h2>
        </div>
        <div class="col-6" style="text-align: right; position: relative;">
            <span style="position: absolute; bottom: 0; right: 0; font-style: italic; padding-right: 5px;">Data show updated: <?= $datashowtime ?></span>
        </div>
        <div class="separator"></div>
    </div>

    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    Seasoning 2 Hours
                </div>
                <div class="card-body" style="padding-left: 0px; padding-right: 0px;">
                    <div id="hour2" style="height:200px; padding-top: 0px;"></div>
                    <?php include 'chart/hours2.php' ?>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    Seasoning 16 Hours
                </div>
                <div class="card-body" style="padding-left: 0px; padding-right: 0px;">
                    <div id="hour16" style="height:200px; padding-top: 0px;"></div>
                    <?php include 'chart/hours16.php' ?>
                </div>
            </div>
        </div>
        <div class="col-2" style="text-align: center ;">
            <button onclick="refresh(this)" class="btn btn-primary" style="width: 100%;">Refresh</button>
            <a href="main.php?p=csn"><button class="btn btn-success" style="width: 100%;">Add Slip</button></a>
        </div>
    </div>

    <div class="row" style="margin-top: 20px;">
        <?php
        $warna1 = '#006100';
        $bg1 = '#C6EFCE';

        $warna2 = '#9C0006';
        $bg2 = '#FFC7CE';

        $warna3 = '#9C5700';
        $bg3 = '#FFEB9C';
        ?>
        <div class="col-5 tableFixHead-2">
            <table class="table table-bordered" style="text-align: center;">
                <thead>
                    <tr>
                        <th style="width: 40%;">Slip in 2 Hours</th>
                        <th style="width: 50%;">Ready in</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($data_all2 = mysqli_fetch_array($sql_all2)) {
                        if ($data_all2['time_out'] >= $now) {
                            $warna = '#9C0006';
                            $bg = '#FFC7CE';
                        } else {
                            $warna = '#006100';
                            $bg = '#C6EFCE';
                        }
                    ?>
                        <tr>
                            <td style="padding-left: 0px; padding-right: 0px;"><?= $data_all2['slip'] ?></td>
                            <td style="padding-left: 0px; padding-right: 0px; color: <?= $warna ?>; background-color: <?= $bg ?>;"><?= $data_all2['time_out'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="col-5 tableFixHead-2">
            <table class="table table-bordered" style="text-align: center;">
                <thead>
                    <tr>
                        <th style="width: 40%;">Slip in 16 Hours</th>
                        <th style="width: 50%;">Ready in</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($data_all16 = mysqli_fetch_array($sql_all16)) {
                        $awal = new DateTime($data_all16['time_in']);
                        $akhir = new DateTime($now);
                        $diff = $awal->diff($akhir);
                        if ($data_all16['time_out'] >= $now) {
                            $warna = '#9C0006';
                            $bg = '#FFC7CE';
                        } elseif ($data_all16['time_out'] < $now && $diff->d < 3) {
                            $warna = '#006100';
                            $bg = '#C6EFCE';
                        } else {
                            $warna = '#9C5700';
                            $bg = '#FFEB9C';
                        }
                    ?>
                        <tr>
                            <td style="padding-left: 0px; padding-right: 0px;"><?= $data_all16['slip'] ?></td>
                            <td style="padding-left: 0px; padding-right: 0px; color: <?= $warna ?>; background-color: <?= $bg ?>;"><?= $data_all16['time_out'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>