<!-- isi hasil scan slip number -->
<div class="dashboard_graph" style="margin-top: 10px;">

    <div class="row">
        <div class="col-12">
            <h5><u>Jangan lupa untuk validasi, <?= $_SESSION['nama'] ?> !<button onclick="window.location.reload()" class="btn btn-primary ml-4"><i class="fa fa-refresh"></i></button></u></h5>
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
                        <!-- <button style="background-color: #ffa700; border-color: #ffa700;" class="btn btn-primary"><?= $data['c_serialnumber'] ?></button> -->
                        <input style="width:130px ;border-radius: 5px;background-color: #ffa700; border-color: #ffa700; text-align: center; font-weight: bold; font-size: larger; color: #ffffff;" type="text" value="<?= $data['c_serialnumber'] ?>" readonly>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mt-5">
            <h5><u>Sedang proses perbaikan</u> <i class="fa fa-gear fa-spin"></i></h5>
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

                    if (!empty($data1['jumlah'])) {
                ?>
                        <!-- <button style="background-color: #ffa700; border-color: #ffa700;" class="btn btn-primary"><?= $data['c_serialnumber'] ?></button> -->
                        <input style="width:130px ; border-radius: 5px; background-color: #81604A; border-color: #81604A; text-align: center; font-weight: bold; font-size: larger; color: #ffffff;" type="text" value="<?= $data['c_serialnumber'] ?>" readonly>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mt-5">
            <h5><u>Proses inside check selesai hari ini <span style="font-size: 12px;">oleh <?= $_SESSION['nama'] ?></span></u></h5>
            <!-- <br> -->
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-5">
            <script>
                $(document).ready(function() {
                    $('#fin_ser').DataTable({
                        paging: false,
                        "dom": '<"wrapper"flipt>',
                        searching: false
                    });
                });
            </script>
            <table id="fin_ser" class="table table-bordered">
                <thead style="text-align: center;">
                    <th>No</th>
                    <th>Serial Number</th>
                    <th>A Card</th>
                    <th>Piano Name</th>
                    <th>Finish</th>
                </thead>
                <tbody>
                    <?php
                    $today_finish = date('Y-m-d', strtotime($now));
                    $no = 0;
                    $sql_finish = mysqli_query($connect_pro, "SELECT * FROM formng_register WHERE c_incheckby = '$_SESSION[nama]' AND c_finishincheck LIKE '$today_finish%' ORDER BY c_finishincheck ASC ");
                    while ($data_finish = mysqli_fetch_array($sql_finish)) {
                        $no++;
                    ?>
                        <tr>
                            <td style="text-align: center;"><?= $no ?></td>
                            <td style="text-align: center;"><?= $data_finish['c_serialnumber'] ?></td>
                            <td style="text-align: center;"><?= $data_finish['c_ctrlnumber'] ?></td>
                            <td><?= $data_finish['c_pianoname'] ?></td>
                            <td style="text-align: center;"><?= $data_finish['c_finishincheck'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- isi hasil scan slip number -->