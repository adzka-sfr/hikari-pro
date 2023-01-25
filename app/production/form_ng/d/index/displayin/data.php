<table class="table table-bordered">
    <thead style="text-align: center; font-size: 20px;">
        <th style="width: 5%;">No</th>
        <th>Item</th>
        <th style="width: 40%;">NG</th>
    </thead>
    <tbody style="font-size: 20px;">
        <?php
        $no = 0;
        $sql = mysqli_query($connect_pro, "SELECT res.c_repair, chec.c_code, chec.c_item, res.c_detail FROM formng_resulti res JOIN formng_checkinside_pdf chec ON res.c_item = chec.c_code WHERE c_serialnumber = '$_SESSION[cardnumber]' AND c_status = 'NG' ");
        while ($data = mysqli_fetch_array($sql)) {
            $no++;
        ?>
            <tr">
                <td style="text-align: center;"><?= $no ?></td>
                <td><?= $data['c_item'] ?></td>
                <td>
                    <?php
                    if (!empty($data['c_repair'])) {
                    ?>
                        <div class="containere">
                            <button class="bton retro" style="width: 150px; border-radius: 0px; rotate: -2deg; font-size: 20px; opacity: 30%; top: 10px; left: 100%; background-color: #F3750F; "><?= $data['c_repair'] ?></button>
                        </div>
                    <?php
                    }
                    ?>
                    <?= $data['c_detail'] ?>
                </td>
                </tr>
            <?php
        }

        $sql = mysqli_query($connect_pro, "SELECT res.c_repair, chec.c_code, chec.c_item, res.c_detail FROM formng_resulti res JOIN formng_checkinside_pdf chec ON res.c_item = chec.c_code WHERE c_serialnumber = '$_SESSION[cardnumber]' AND c_status = 'NG' ");
        $data = mysqli_fetch_array($sql);
        if (empty($data['c_code'])) {
            ?>
                <tr>
                    <td colspan="3" style="text-align: center;">Congratulations, no defect found ! </td>
                </tr>
            <?php
        }
            ?>
    </tbody>
</table>