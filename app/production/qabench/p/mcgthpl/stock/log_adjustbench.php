<div class="row">
    <div class="col-12">
        <h5><a href="main.php?page=st-bench">Bench Stock</a> <i class="fa fa-chevron-right"></i> <a href="main.php?page=adjust-bench">Adjust Stock</a> <i class="fa fa-chevron-right"></i> Log</h5>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <!-- <div class="row">
            <div class="col-5 mb-3">
                <input type="radio" class="flat" name="datestatus" id="sd" value="sd" checked="" required /> Stocked Date
            </div>
            <div class="col-5">
                <input type="radio" class="flat" name="datestatus" id="pd" value="pd" /> Packed Date
            </div>
        </div> -->
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
                <input id="items" type="hidden" value="bench">
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
            var items = $('#items').val();
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
                    url: 'stock/searchdata.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        "startdate": startdate,
                        "enddate": enddate,
                        "items": items,
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
    <div class="col-12 mb-5">
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
                            title: "UP Log Adjust (Bench) <?= $date_now ?>",
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
                <th>Action</th>
                <th>Location</th>
                <th>Serial Number</th>
                <th>PIC</th>
                <th>Note</th>
                <th>Time</th>
            </thead>
            <tbody>
                <?php
                $no = 0;
                $sql = mysqli_query($connect_pro, "SELECT * FROM qa_adjustlog WHERE c_type = 'bench' ORDER BY c_date DESC");
                while ($data = mysqli_fetch_array($sql)) {
                    $no++;

                    // get location
                    if ($data['c_location'] == 'packing up') {
                        $loc = "UP";
                    } elseif ($data['c_location'] == 'packing gp') {
                        $loc = "GP";
                    } else {
                        $loc = "";
                    }
                ?>
                    <tr>
                        <td style="text-align: center;"><?= $no ?></td>
                        <td style="text-align: center;"><?= ucfirst($data['c_action']) ?></td>
                        <td style="text-align: center;"><?= $loc ?></td>
                        <td style="text-align: center;"><?= $data['c_serialnumber'] ?></td>
                        <td style="text-align: left;"><?= $data['c_pic'] ?></td>
                        <td style="text-align: left;"><?= $data['c_note'] ?></td>
                        <td style="text-align: center;"><?= $data['c_date'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div> -->