<!-- isi hasil scan slip number -->
<div class="dashboard_graph" style="margin-top: 10px;">

    <div class="row">
        <div class="col-12">
            <h5><u>Don't Forget to Validation, <?= $_SESSION['nama'] ?> !<button onclick="window.location.reload()" class="btn btn-primary ml-4"><i class="fa fa-refresh"></i></button></u></h5>
            <!-- <br> -->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div style="display: flex; flex-wrap: wrap; align-content: flex-start; gap: 1em;">
                <?php
                $nama_checker = $_SESSION['nama'];
                # get aktif serial dan belum finish incheck
                # SELECT DISTINCT res.c_serialnumber FROM formng_resulti res JOIN formng_register reg ON res.c_serialnumber = reg.c_serialnumber WHERE res.c_checker = 'Hardi' AND res.c_status = 'NG' AND reg.c_incheckby = '';
                # cek status repair
                # SELECT COUNT FROM formng_resulti WHERE c_serialnumber = 'J40505224' AND c_repair != '';

                $sql = mysqli_query($connect_pro, "SELECT DISTINCT res.c_serialnumber FROM formng_resulti res JOIN formng_register reg ON res.c_serialnumber = reg.c_serialnumber WHERE res.c_checker = '$nama_checker' AND res.c_status = 'NG' AND reg.c_incheckby = ''");
                while ($data = mysqli_fetch_array($sql)) {
                    $sql1 = mysqli_query($connect_pro, "SELECT id as jumlah FROM formng_resulti WHERE c_serialnumber = '$data[c_serialnumber]' AND c_status = 'NG' AND c_repair = ''");
                    $data1 = mysqli_fetch_array($sql1);

                    if (empty($data1['jumlah'])) {
                ?>
                        <button style="background-color: #ffa700; border-color: #ffa700;" class="btn btn-primary"><?= $data['c_serialnumber'] ?></button>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

</div>
<!-- isi hasil scan slip number -->