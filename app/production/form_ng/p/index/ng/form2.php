<!-- isi hasil scan slip number -->
<div class="dashboard_graph" style="margin-top: 10px; padding-bottom: 50px;">

    <div class="row">
        <div class="col-12">
            <?php
            $sql = mysqli_query($connect_p, "SELECT * from piano limit 1");
            $data = mysqli_fetch_array($sql);
            ?>
            <h3><?= $data['no_slip'] ?> - <?= $data['piano_name'] ?> <?= $data['warna'] ?></h3>
            <div class="separator"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- isi gambar -->
            <!-- gambar 1 -->
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12">
                            <h2><u>Frontboard</u></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="padding-bottom: 5%;">
                            <!-- gambar -->
                            <center>
                                <div class="containere">
                                    <img src="../image/frontboard.jpg" style="width:100%">
                                    <button class="bton" style="top: 14%; left: 10%; background-color: #B92C3A;">NG</button>
                                    <button class="bton" style="top: 65%; left: 50%; background-color: #B92C3A;">NG</button>
                                    <button class="bton" style="top: 14%; left: 90%; background-color: #157347;">OK</button>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>

            <div class="separator"></div>

            <!-- gambar 2 -->
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12">
                            <h2><u>Topboard Outside</u></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="padding-bottom: 5%;">
                            <!-- gambar -->
                            <center>
                                <div class="containere">
                                    <img src="../image/topboard_outside.jpg" style="width:100%">
                                    <button class="bton" style="top: 14%; left: 10%; background-color: #B92C3A;">NG</button>
                                    <button class="bton" style="top: 65%; left: 50%; background-color: #B92C3A;">NG</button>
                                    <button class="bton" style="top: 14%; left: 90%; background-color: #157347;">OK</button>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>

            <div class="separator"></div>

            <!-- gambar 3 -->
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12">
                            <h2><u>Body</u></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="padding-bottom: 5%;">
                            <!-- gambar -->
                            <center>
                                <div class="containere">
                                    <img src="../image/body.jpg" style="width:100%">
                                    <button class="bton" style="top: 14%; left: 10%; background-color: #B92C3A;">NG</button>
                                    <button class="bton" style="top: 65%; left: 50%; background-color: #B92C3A;">NG</button>
                                    <button class="bton" style="top: 14%; left: 90%; background-color: #157347;">OK</button>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>

            <div class="separator"></div>

            <!-- gambar 4 -->
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12">
                            <h2><u>Body Back</u></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="padding-bottom: 5%;">
                            <!-- gambar -->
                            <center>
                                <div class="containere">
                                    <img src="../image/body_back.jpg" style="width:100%">
                                    <button class="bton" style="top: 14%; left: 10%; background-color: #B92C3A;">NG</button>
                                    <button class="bton" style="top: 65%; left: 50%; background-color: #B92C3A;">NG</button>
                                    <button class="bton" style="top: 14%; left: 90%; background-color: #157347;">OK</button>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <!-- table -->
            <div class="row">
                <div class="col-md-12">
                    <!-- tabel dengan judul -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- judul -->
                            <h2>
                                <u>Summary</u>
                            </h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Component</th>
                                        <th>Part</th>
                                        <th>Note</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql2 = mysqli_query($connect_p, "SELECT * from on_progress");
                                    while ($data2 = mysqli_fetch_array($sql2)) {
                                    ?>
                                        <tr>
                                            <td><?= $data2['komponen'] ?></td>
                                            <td><?= $data2['bagian'] ?></td>
                                            <td><?= $data2['note'] ?></td>
                                            <td><?= $data2['status'] ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- isi hasil scan slip number -->