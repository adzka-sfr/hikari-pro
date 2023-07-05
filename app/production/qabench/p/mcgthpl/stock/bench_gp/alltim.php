<div class="row">
    <div class="col-12">
        <h5><a href="main.php?page=st-bench">Bench Stock</a> <i class="fa fa-chevron-right"></i> GP All Time Used</h5>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-5 mb-3">
                <input type="radio" class="flat" name="datestatus" id="sd" value="sd" checked="" required /> Stocked Date
            </div>
            <div class="col-5">
                <input type="radio" class="flat" name="datestatus" id="pd" value="pd" /> Packed Date
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <div class="mb-3">
                    <label class="form-label">Start Date</label>
                    <input id="startdate" type="date" class="form-control">
                    <div class="row">
                        <div class="col-12 mt-2" id="errstart" style="display: none;">
                            <span style="color: red;">Silahkan memasukkan start date</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="mb-3">
                    <label class="form-label">End Date</label>
                    <input id="enddate" type="date" class="form-control">
                    <div class="row">
                        <div class="col-12 mt-2" id="errend" style="display: none;">
                            <span style="color: red;">Silahkan memasukkan end date</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <input id="locationboy" type="hidden" value="packing gp">
                <button id="searchboy" class="btn btn-primary" style="height: 100%; width: 100%;">Search</button>
            </div>
        </div>
        <hr>
    </div>

    <script>
        $('#searchboy').click(function() {
            // cek apakah sudah keisi semua
            var startdate = $('#startdate').val();
            var enddate = $('#enddate').val();
            var location = $('#locationboy').val();
            var datestatus = document.getElementsByName('datestatus');
            for (i = 0; i < datestatus.length; i++) {
                if (datestatus[i].checked)
                    var datestatusisi = datestatus[i].value;
            }
            if (startdate == '' && enddate == '') {
                $('#errstart').show();
                setTimeout(function() {
                    $('#errstart').hide()
                }, 2000);

                $('#errend').show();
                setTimeout(function() {
                    $('#errend').hide()
                }, 2000);
            } else if (startdate == '') {
                $('#errstart').show();
                setTimeout(function() {
                    $('#errstart').hide()
                }, 2000);
            } else if (enddate == '') {
                $('#errend').show();
                setTimeout(function() {
                    $('#errend').hide()
                }, 2000);
            } else {
                // sudah keisi lanjut tampil loading + ajax
                $('#loadingacard').show();
                $.ajax({
                    url: 'stock/bench_up/searchdata.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        "startdate": startdate,
                        "enddate": enddate,
                        "location": location,
                        "datestatus": datestatusisi
                    },
                    success: function(response) {
                        $("#table-container").html(response);
                        $('#loadingacard').hide();
                    }
                });
            }

        })
    </script>
</div>
<div class="row">
    <div class="col-12 mb-5">
        <div id="table-container"></div>
    </div>
</div>
<!-- <div class="row">
    <div class="col-12">
        <?php
        $date_now = date('Y-m-d H.i.s');
        ?>
        <script>
            $(document).ready(function() {
                $('#infostock').DataTable({
                    paging: false,
                    "dom": "Bfrtip",
                    "buttons": [{
                            extend: "excel",
                            text: "Export to Excel",
                            title: "GP All Time Used (Bench) <?= $date_now ?>",
                            className: "btn-success"
                        },
                        {
                            extend: "print",
                            text: "Print",
                            className: "btn-outline-primary"
                        }
                    ]
                });
            });
        </script>
        <table class="table table-bordered" id="infostock">
            <thead style="text-align: center;">
                <th>No</th>
                <th>GMC</th>
                <th>Serial Number</th>
                <th>Bench Name</th>
                <th>Stocked</th>
                <th>Packed</th>
            </thead>
            <tbody>
                <?php
                $no = 0;
                $sql = mysqli_query($connect_pro, "SELECT * FROM qa_bench WHERE c_used IS NOT NULL AND c_packed IS NOT NULL AND c_location = 'packing gp' ORDER BY c_packed DESC");
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
</div> -->