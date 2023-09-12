<div class="col-12">
    <h6><u>Today Packing</u></h6>
    <script>
        $(document).ready(function() {
            $('#infopacking').DataTable({
                paging: false,
                "order": [],
                "dom": '<"wrapper"flipt>'
            });
        });
    </script>
    <table class="table table-bordered" id="infopacking">
        <thead style="text-align: center;">
            <th>GMC Piano</th>
            <th>Model</th>
            <th>Serial</th>
            <th>More Info</th>
            <!-- jika butuh dalam satu tampilan -->
            <!-- <th>ID Bench</th>
                        <th>Nama Bench</th>
                        <th>ID User P</th>
                        <th>Nama User P</th>
                        <th>Waktu Packing</th> -->
            <!-- jika butuh dalam satu tampilan -->
        </thead>
        <tbody>
            <?php
            $today = date('Y-m-d', strtotime($now));
            $tomonth = date('Y-m', strtotime($now));
            $sql = mysqli_query($connect_pro, "SELECT * FROM qa_log WHERE c_action = 'packing' AND c_location = '$_SESSION[role]' AND c_date LIKE '$today%' ORDER BY c_date desc");
            while ($data = mysqli_fetch_array($sql)) {
                // ambil gambar
                $sql1 = mysqli_query($connect_pro, "SELECT * FROM qa_packing_image WHERE imageSerialPiano = '$data[c_serialpiano]'");
                $data1 = mysqli_fetch_array($sql1);


            ?>
                <tr>
                    <td style="text-align: center;"><?= $data['c_gmcpiano'] ?></td>
                    <td><?= $data['c_namepiano'] ?></td>
                    <td style="text-align: center;"><?= $data['c_serialpiano'] ?>
                        <span style="display: none;"><?= $data['c_serialbench'] ?></span>
                        <span style="display: none;"><?= $data['c_serialuserp'] ?></span>
                        <span style="display: none;"><?= $data['c_date'] ?></span>
                    </td>
                    <td style="text-align: center;">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?= $data['c_serialpiano'] ?>"><i class="fa fa-search-plus"></i></button>

                        <!-- Modal -->
                        <div class="modal fade" id="<?= $data['c_serialpiano'] ?>" tabindex="-1" aria-labelledby="<?= $data['c_serialpiano'] ?>Label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="<?= $data['c_serialpiano'] ?>Label"><?= $data['c_serialpiano'] ?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table style="text-align: left; border: 0; width: 100%;">
                                            <tr>
                                                <td style="width: 40%;">Piano Name</td>
                                                <td style="text-align: center;">:</td>
                                                <td><b><?= $data['c_namepiano'] ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>Serial-Piano</td>
                                                <td style="text-align: center;">:</td>
                                                <td><?= $data['c_serialpiano'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Bench Name</td>
                                                <td style="text-align: center;">:</td>
                                                <td><?= $data['c_namebench'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Serial-Bench</td>
                                                <td style="text-align: center;">:</td>
                                                <td><?= $data['c_serialbench'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>User Package</td>
                                                <td style="text-align: center;">:</td>
                                                <td><?= $data['c_nameuserp'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Serial-User Package</td>
                                                <td style="text-align: center;">:</td>
                                                <td><?= $data['c_serialuserp'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Packing Time</td>
                                                <td style="text-align: center;">:</td>
                                                <td><?= $data['c_date'] ?></td>
                                            </tr>
                                        </table>

                                        <!-- nonaktifkan ini jika mau mengaktifkan ambil gambar -->
                                        <!-- <div class="card">
                                                                <div class="card-body">
                                                                    <img style="width: 100%;" src="data:<?= $data1['imageType'] ?>;base64,<?= base64_encode($data1['imageData']) ?>">
                                                                </div>
                                                            </div> -->
                                        <!-- nonaktifkan ini jika mau mengaktifkan ambil gambar -->

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                    </td>


                    <!-- jika butuh dalam satu tampilan -->
                    <!-- <td style="text-align: center;"><?= $data['c_serialbench'] ?></td>
                                <td><?= $data['c_namebench'] ?></td>
                                <td style="text-align: center;"><?= $data['c_serialuserp'] ?></td>
                                <td><?= $data['c_nameuserp'] ?></td>
                                <td style="text-align: center;"><?= $data['c_date'] ?></td> -->
                    <!-- jika butuh dalam satu tampilan -->
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>