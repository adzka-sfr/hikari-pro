<!-- isi hasil scan slip number -->
<div class="dashboard_graph" style="margin-top: 10px;">

    <div class="row">
        <div class="col-12">
            <h5><u>Don't Forget to Validation, <?= $_SESSION['nama'] ?> !<button onclick="window.location.reload()" class="btn btn-primary ml-4"><i class="fa fa-refresh"></i></button></u></h5>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div style="display: flex; flex-wrap: wrap; align-content: flex-start; gap: 1em;">
                <?php
                $nama_checker = $_SESSION['nama'];
                $sql = mysqli_query($connect_pro, "SELECT DISTINCT res.c_serialnumber FROM formng_resulto1 res JOIN formng_register reg ON res.c_serialnumber = reg.c_serialnumber WHERE res.c_checker2= '$nama_checker' AND res.c_ng2 != '' AND res.c_repair2 != '' AND reg.c_outcheck2by = '';");
                while ($data = mysqli_fetch_array($sql)) {
                    $sql1 = mysqli_query($connect_pro, "SELECT id FROM formng_resultro WHERE c_serialnumber = '$data[c_serialnumber]' AND c_ng != '' AND c_picrepair = ''");
                    $data1 = mysqli_fetch_array($sql1);

                    if (empty($data1['id'])) {
                ?>
                        <button disabled style="background-color: #ffa700; border-color: #ffa700;" class="btn btn-primary"><?= $data['c_serialnumber'] ?></button>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

</div>
<!-- isi hasil scan slip number -->