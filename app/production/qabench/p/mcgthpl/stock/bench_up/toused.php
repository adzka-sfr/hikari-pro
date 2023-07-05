<div class="row">
    <div class="col-12">
        <h5><a href="main.php?page=st-bench">Bench Stock</a> <i class="fa fa-chevron-right"></i> UP Today Used</h5>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12" style="padding-left:35px;">
                <button class="btn btn-success" type="button" onclick="all2o()"><i class="fa fa-file-excel-o"></i> Export</button>
                <script>
                    var myWindow;

                    function all2o() {
                        myWindow = window.open("stock/bench_up/export_toused.php", "_blank");
                    }
                </script>
            </div>
        </div>
        <?php
        $date_now = date('Y-m-d H.i.s');
        ?>
        <script>
            $(document).ready(function() {
                $('#infostock').DataTable({
                    paging: false,
                });
            });
        </script>
        <table class="table table-bordered" id="infostock">
            <thead style="text-align: center;">
                <th>No</th>
                <th>GMC</th>
                <th>Serial Number</th>
                <th>Bench Name</th>
                <th>Registered</th>
                <th>Packed</th>
            </thead>
            <tbody>
                <?php
                $no = 0;
                $nowtoused = date('Y-m-d', strtotime($now));
                $sql = mysqli_query($connect_pro, "SELECT * FROM qa_bench WHERE c_used IS NOT NULL AND c_packed IS NOT NULL AND c_packed LIKE '$nowtoused%' AND c_location = 'packing up' ORDER BY c_packed DESC");
                while ($data = mysqli_fetch_array($sql)) {
                    $no++;
                ?>
                    <tr>
                        <td style="text-align: center;"><?= $no ?></td>
                        <td style="text-align: center;"><?= $data['c_gmc'] ?></td>
                        <td style="text-align: center;"><?= $data['c_serialbench'] ?></td>
                        <td><?= $data['c_name'] ?></td>
                        <td style="text-align: center;"><?= $data['c_used'] ?></td>
                        <td style="text-align: center;"><?= $data['c_packed'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>