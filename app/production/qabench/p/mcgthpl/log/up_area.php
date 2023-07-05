<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <h5>Stock Taking UP Area</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
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
                <input id="locationboy" type="hidden" value="packing up">
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
                    url: 'log/searchdata.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        "startdate": startdate,
                        "enddate": enddate,
                        "location": location
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
                            title: "Stock Taking UP <?= $date_now ?>",
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
                <th>Name</th>
                <th>System</th>
                <th>Actual</th>
                <th>Status</th>
                <th>PIC</th>
                <th>Time</th>
            </thead>
            <tbody>
                <?php
                $no = 0;
                $sql = mysqli_query($connect_pro, "SELECT * FROM qa_staking WHERE c_location = 'packing up' ORDER BY c_date DESC");
                while ($data = mysqli_fetch_array($sql)) {
                    $no++;
                ?>
                    <tr>
                        <td style="text-align: center;"><?= $no ?></td>
                        <td style="text-align: center;"><?= $data['c_gmc'] ?></td>
                        <td><?= $data['c_name'] ?></td>
                        <td style="text-align: center;"><?= $data['c_qtysystem'] ?></td>
                        <td style="text-align: center;"><?= $data['c_qtyactual'] ?></td>
                        <td style="text-align: center;"><?= $data['c_status'] ?></td>
                        <td style="text-align: center;"><?= $data['c_pic'] ?></td>
                        <td style="text-align: center;"><?= $data['c_date'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div> -->