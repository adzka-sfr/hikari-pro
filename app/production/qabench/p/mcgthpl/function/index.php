<div class="row">
    <div class="col-12">
        <h5>Function Control
            <hr>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-12">
                        <h6><u>Packing UP</u></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <thead style="text-align: center;">
                                <th style="width: 20%;">Function</th>
                                <th style="width: 10%;">Status</th>
                                <th style="width: 60%;">Message</th>
                                <th style="width: 10%;">Config</th>
                            </thead>
                            <tbody>
                                <?php
                                $q1 = mysqli_query($connect_pro, "SELECT * FROM qa_fitur WHERE c_location = 'packing up' AND c_fitur != 'stock'");
                                while ($d1 = mysqli_fetch_array($q1)) {
                                    // cek on/off
                                    if ($d1['c_status'] == 0) {
                                        $status = "";
                                    } else {
                                        $status = "checked";
                                    }
                                ?>
                                    <tr>
                                        <td>
                                            <span style="cursor: pointer;"><?= ucfirst($d1['c_fitur']) ?></span>
                                        </td>
                                        <td style="text-align: center;">
                                            <label class="switch" style="width: 30px; height: 14px;">
                                                <input disabled type="checkbox" <?= $status ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td><?= $d1['c_message'] ?></td>
                                        <td style="text-align: center;">
                                            <button class="btn btn-sm btn-secondary" style="padding-top: 1px; padding-bottom: 1px;" data-bs-toggle="modal" data-bs-target="#b-<?= $d1['id'] ?>"><i class="fa fa-cogs"></i></button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="b-<?= $d1['id'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Function Control</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-3 mb-3" style="text-align: left;">
                                                                    Function
                                                                </div>
                                                                <div class="col-1" style="text-align: center;">:</div>
                                                                <div class="col-8" style="text-align: left;">
                                                                    <?= ucfirst($d1['c_fitur']) ?>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-3 mb-3" style="text-align: left;">
                                                                    Status
                                                                </div>
                                                                <div class="col-1" style="text-align: center;">:</div>
                                                                <div class="col-8" style="text-align: left; padding-top: 4px;">
                                                                    <label class="switch" style="width: 30px; height: 14px;">
                                                                        <input id="status-<?= $d1['id'] ?>" type="checkbox" <?= $status ?>>
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-3 mb-3" style="text-align: left; padding-top: 10px;">
                                                                    Message
                                                                </div>
                                                                <div class="col-1" style="text-align: center; padding-top: 10px;">:</div>
                                                                <div class="col-8" style="text-align: left; padding-top: 4px;">
                                                                    <input id="message-<?= $d1['id'] ?>" type="text" value="<?= $d1['c_message'] ?>" class="form-control form-control-sm">
                                                                    <div class="row">
                                                                        <div class="col-12 mt-1" id="errmess<?= $d1['id'] ?>" style="display: none;">
                                                                            <span style="color: red;">Message required</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input id="idfitur-<?= $d1['id'] ?>" type="hidden" value="<?= $d1['id'] ?>">
                                                            <input id="namafitur-<?= $d1['id'] ?>" type="hidden" value="<?= $d1['c_fitur'] ?>">
                                                            <input id="location-<?= $d1['id'] ?>" type="hidden" value="<?= $d1['c_location'] ?>">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button id="sc-<?= $d1['id'] ?>" type="button" class="btn btn-primary">Save changes</button>
                                                            <script>
                                                                $('#sc-<?= $d1['id'] ?>').click(function() {
                                                                    var id = $('#idfitur-<?= $d1['id'] ?>').val();
                                                                    var message = $('#message-<?= $d1['id'] ?>').val();
                                                                    var namafitur = $('#namafitur-<?= $d1['id'] ?>').val();
                                                                    var location = $('#location-<?= $d1['id'] ?>').val();
                                                                    if ($('#status-<?= $d1['id'] ?>').is(":checked")) {
                                                                        var status = 1;
                                                                    } else {
                                                                        var status = 0;
                                                                    }

                                                                    if (message == '') {
                                                                        $('#errmess<?= $d1['id'] ?>').show();
                                                                        setTimeout(function() {
                                                                            $('#errmess<?= $d1['id'] ?>').hide()
                                                                        }, 3000);
                                                                    } else {
                                                                        $.ajax({
                                                                            url: 'function/edit.php',
                                                                            type: 'POST',
                                                                            data: {
                                                                                "id": id,
                                                                                "status": status,
                                                                                "message": message,
                                                                                "namafitur": namafitur,
                                                                                "location": location
                                                                            },
                                                                            success: function(response) {
                                                                                if (response == 'sukses') {
                                                                                    Swal.fire({
                                                                                        title: 'Success!',
                                                                                        text: 'Status fitur berhasil diubah',
                                                                                        icon: 'success',
                                                                                        timer: 2000,
                                                                                        showCancelButton: false,
                                                                                        showConfirmButton: false
                                                                                    }).then(function() {
                                                                                        window.location = 'main.php?page=control';
                                                                                    });
                                                                                } else {
                                                                                    Swal.fire(
                                                                                        'Error!',
                                                                                        'Server busy',
                                                                                        'error'
                                                                                    );
                                                                                }
                                                                            }
                                                                        });
                                                                    }


                                                                })
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <tbody>
                                <?php
                                $q1a = mysqli_query($connect_pro, "SELECT * FROM qa_fitur WHERE c_fitur = 'stock' AND c_location = 'packing up'");
                                $d1a = mysqli_fetch_array($q1a);

                                // cek status
                                if ($d1a['c_status'] == 0) {
                                    $statusallup = "";
                                } else {
                                    $statusallup = "checked";
                                }
                                ?>
                                <tr>
                                    <td>All Function</td>
                                    <td style="text-align: center;">
                                        <label class="switch" style="width: 30px; height: 14px;">
                                            <input disabled type="checkbox" <?= $statusallup ?>>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <?= $d1a['c_message'] ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-sm btn-danger" style="padding-top: 1px; padding-bottom: 1px;" data-bs-toggle="modal" data-bs-target="#b-allup"><i class="fa fa-cogs"></i></button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="b-allup" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Function Control</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-3 mb-3" style="text-align: left;">
                                                                Function
                                                            </div>
                                                            <div class="col-1" style="text-align: center;">:</div>
                                                            <div class="col-8" style="text-align: left;">
                                                                All Function
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-3 mb-3" style="text-align: left;">
                                                                Status
                                                            </div>
                                                            <div class="col-1" style="text-align: center;">:</div>
                                                            <div class="col-8" style="text-align: left; padding-top: 4px;">
                                                                <label class="switch" style="width: 30px; height: 14px;">
                                                                    <input id="status-allup" type="checkbox" <?= $statusallup ?>>
                                                                    <span class="slider round"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-3 mb-3" style="text-align: left; padding-top: 10px;">
                                                                Message
                                                            </div>
                                                            <div class="col-1" style="text-align: center; padding-top: 10px;">:</div>
                                                            <div class="col-8" style="text-align: left; padding-top: 4px;">
                                                                <input id="message-allup" type="text" value="<?= $d1a['c_message'] ?>" class="form-control form-control-sm">
                                                                <div class="row">
                                                                    <div class="col-12 mt-1" id="errmess-allup" style="display: none;">
                                                                        <span style="color: red;">Message required</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!-- disini value id 9 didapat dari database qa_fitur untuk fitur stock dan lokasi up -->
                                                        <input id="idfitur-allup" type="hidden" value="9">
                                                        <input id="namafitur-allup" type="hidden" value="all function">
                                                        <input id="location-allup" type="hidden" value="packing up">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button id="sc-allup" type="button" class="btn btn-primary">Save changes</button>
                                                        <script>
                                                            $('#sc-allup').click(function() {
                                                                var id = $('#idfitur-allup').val();
                                                                var message = $('#message-allup').val();
                                                                var namafitur = $('#namafitur-allup').val();
                                                                var location = $('#location-allup').val();
                                                                if ($('#status-allup').is(":checked")) {
                                                                    var status = 1;
                                                                } else {
                                                                    var status = 0;
                                                                }

                                                                if (message == '') {
                                                                    $('#errmess-allup').show();
                                                                    setTimeout(function() {
                                                                        $('#errmess-allup').hide()
                                                                    }, 3000);
                                                                } else {
                                                                    $.ajax({
                                                                        url: 'function/edit.php',
                                                                        type: 'POST',
                                                                        data: {
                                                                            "id": id,
                                                                            "status": status,
                                                                            "message": message,
                                                                            "namafitur": namafitur,
                                                                            "location": location
                                                                        },
                                                                        success: function(response) {
                                                                            if (response == 'sukses') {
                                                                                Swal.fire({
                                                                                    title: 'Success!',
                                                                                    text: 'Status fitur berhasil diubah',
                                                                                    icon: 'success',
                                                                                    timer: 2000,
                                                                                    showCancelButton: false,
                                                                                    showConfirmButton: false
                                                                                }).then(function() {
                                                                                    window.location = 'main.php?page=control';
                                                                                });
                                                                            } else {
                                                                                Swal.fire(
                                                                                    'Error!',
                                                                                    'Server busy',
                                                                                    'error'
                                                                                );
                                                                            }
                                                                        }
                                                                    });
                                                                }

                                                            })
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot style="text-align: center;">
                                <th style="width: 20%;">Function</th>
                                <th style="width: 10%;">Status</th>
                                <th style="width: 60%;">Message</th>
                                <th style="width: 10%;">Config</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-12">
                        <h6><u>Packing GP</u></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <thead style="text-align: center;">
                                <th style="width: 20%;">Function</th>
                                <th style="width: 10%;">Status</th>
                                <th style="width: 60%;">Message</th>
                                <th style="width: 10%;">Config</th>
                            </thead>
                            <tbody>
                                <?php
                                $q1 = mysqli_query($connect_pro, "SELECT * FROM qa_fitur WHERE c_location = 'packing gp' AND c_fitur != 'stock'");
                                while ($d1 = mysqli_fetch_array($q1)) {
                                    // cek on/off
                                    if ($d1['c_status'] == 0) {
                                        $status = "";
                                    } else {
                                        $status = "checked";
                                    }
                                ?>
                                    <tr>
                                        <td>
                                            <span style="cursor: pointer;"><?= ucfirst($d1['c_fitur']) ?></span>
                                        </td>
                                        <td style="text-align: center;">
                                            <label class="switch" style="width: 30px; height: 14px;">
                                                <input disabled type="checkbox" <?= $status ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td><?= $d1['c_message'] ?></td>
                                        <td style="text-align: center;">
                                            <button class="btn btn-sm btn-secondary" style="padding-top: 1px; padding-bottom: 1px;" data-bs-toggle="modal" data-bs-target="#b-<?= $d1['id'] ?>"><i class="fa fa-cogs"></i></button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="b-<?= $d1['id'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Function Control</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-3 mb-3" style="text-align: left;">
                                                                    Function
                                                                </div>
                                                                <div class="col-1" style="text-align: center;">:</div>
                                                                <div class="col-8" style="text-align: left;">
                                                                    <?= ucfirst($d1['c_fitur']) ?>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-3 mb-3" style="text-align: left;">
                                                                    Status
                                                                </div>
                                                                <div class="col-1" style="text-align: center;">:</div>
                                                                <div class="col-8" style="text-align: left; padding-top: 4px;">
                                                                    <label class="switch" style="width: 30px; height: 14px;">
                                                                        <input id="status-<?= $d1['id'] ?>" type="checkbox" <?= $status ?>>
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-3 mb-3" style="text-align: left; padding-top: 10px;">
                                                                    Message
                                                                </div>
                                                                <div class="col-1" style="text-align: center; padding-top: 10px;">:</div>
                                                                <div class="col-8" style="text-align: left; padding-top: 4px;">
                                                                    <input id="message-<?= $d1['id'] ?>" type="text" value="<?= $d1['c_message'] ?>" class="form-control form-control-sm">
                                                                    <div class="row">
                                                                        <div class="col-12 mt-1" id="errmess-<?= $d1['id'] ?>" style="display: none;">
                                                                            <span style="color: red;">Message required</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input id="idfitur-<?= $d1['id'] ?>" type="hidden" value="<?= $d1['id'] ?>">
                                                            <input id="namafitur-<?= $d1['id'] ?>" type="hidden" value="<?= $d1['c_fitur'] ?>">
                                                            <input id="location-<?= $d1['id'] ?>" type="hidden" value="<?= $d1['c_location'] ?>">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button id="sc-<?= $d1['id'] ?>" type="button" class="btn btn-primary">Save changes</button>
                                                            <script>
                                                                $('#sc-<?= $d1['id'] ?>').click(function() {
                                                                    var id = $('#idfitur-<?= $d1['id'] ?>').val();
                                                                    var message = $('#message-<?= $d1['id'] ?>').val();
                                                                    var namafitur = $('#namafitur-<?= $d1['id'] ?>').val();
                                                                    var location = $('#location-<?= $d1['id'] ?>').val();
                                                                    if ($('#status-<?= $d1['id'] ?>').is(":checked")) {
                                                                        var status = 1;
                                                                    } else {
                                                                        var status = 0;
                                                                    }

                                                                    if (message == '') {
                                                                        $('#errmess-<?= $d1['id'] ?>').show();
                                                                        setTimeout(function() {
                                                                            $('#errmess-<?= $d1['id'] ?>').hide()
                                                                        }, 3000);
                                                                    } else {
                                                                        $.ajax({
                                                                            url: 'function/edit.php',
                                                                            type: 'POST',
                                                                            data: {
                                                                                "id": id,
                                                                                "status": status,
                                                                                "message": message,
                                                                                "namafitur": namafitur,
                                                                                "location": location
                                                                            },
                                                                            success: function(response) {
                                                                                if (response == 'sukses') {
                                                                                    Swal.fire({
                                                                                        title: 'Success!',
                                                                                        text: 'Status fitur berhasil diubah',
                                                                                        icon: 'success',
                                                                                        timer: 2000,
                                                                                        showCancelButton: false,
                                                                                        showConfirmButton: false
                                                                                    }).then(function() {
                                                                                        window.location = 'main.php?page=control';
                                                                                    });
                                                                                } else {
                                                                                    Swal.fire(
                                                                                        'Error!',
                                                                                        'Server busy',
                                                                                        'error'
                                                                                    );
                                                                                }
                                                                            }
                                                                        });
                                                                    }

                                                                })
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <tbody>
                                <?php
                                $q1a = mysqli_query($connect_pro, "SELECT * FROM qa_fitur WHERE c_fitur = 'stock' AND c_location = 'packing gp'");
                                $d1a = mysqli_fetch_array($q1a);

                                // cek status
                                if ($d1a['c_status'] == 0) {
                                    $statusallgp = "";
                                } else {
                                    $statusallgp = "checked";
                                }
                                ?>
                                <tr>
                                    <td>All Function</td>
                                    <td style="text-align: center;">
                                        <label class="switch" style="width: 30px; height: 14px;">
                                            <input disabled type="checkbox" <?= $statusallgp ?>>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <?= $d1a['c_message'] ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-sm btn-danger" style="padding-top: 1px; padding-bottom: 1px;" data-bs-toggle="modal" data-bs-target="#b-allgp"><i class="fa fa-cogs"></i></button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="b-allgp" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Function Control</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-3 mb-3" style="text-align: left;">
                                                                Function
                                                            </div>
                                                            <div class="col-1" style="text-align: center;">:</div>
                                                            <div class="col-8" style="text-align: left;">
                                                                All Function
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-3 mb-3" style="text-align: left;">
                                                                Status
                                                            </div>
                                                            <div class="col-1" style="text-align: center;">:</div>
                                                            <div class="col-8" style="text-align: left; padding-top: 4px;">
                                                                <label class="switch" style="width: 30px; height: 14px;">
                                                                    <input id="status-allgp" type="checkbox" <?= $statusallgp ?>>
                                                                    <span class="slider round"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-3 mb-3" style="text-align: left; padding-top: 10px;">
                                                                Message
                                                            </div>
                                                            <div class="col-1" style="text-align: center; padding-top: 10px;">:</div>
                                                            <div class="col-8" style="text-align: left; padding-top: 4px;">
                                                                <input id="message-allgp" type="text" value="<?= $d1a['c_message'] ?>" class="form-control form-control-sm">
                                                                <div class="row">
                                                                    <div class="col-12 mt-1" id="errmess-allgp" style="display: none;">
                                                                        <span style="color: red;">Message required</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!-- disini value id 9 didapat dari database qa_fitur untuk fitur stock dan lokasi gp -->
                                                        <input id="idfitur-allgp" type="hidden" value="10">
                                                        <input id="namafitur-allgp" type="hidden" value="all function">
                                                        <input id="location-allgp" type="hidden" value="packing gp">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button id="sc-allgp" type="button" class="btn btn-primary">Save changes</button>
                                                        <script>
                                                            $('#sc-allgp').click(function() {
                                                                var id = $('#idfitur-allgp').val();
                                                                var message = $('#message-allgp').val();
                                                                var namafitur = $('#namafitur-allgp').val();
                                                                var location = $('#location-allgp').val();
                                                                if ($('#status-allgp').is(":checked")) {
                                                                    var status = 1;
                                                                } else {
                                                                    var status = 0;
                                                                }

                                                                if (message == '') {
                                                                    $('#errmess-allgp').show();
                                                                    setTimeout(function() {
                                                                        $('#errmess-allgp').hide()
                                                                    }, 3000);
                                                                } else {
                                                                    $.ajax({
                                                                        url: 'function/edit.php',
                                                                        type: 'POST',
                                                                        data: {
                                                                            "id": id,
                                                                            "status": status,
                                                                            "message": message,
                                                                            "namafitur": namafitur,
                                                                            "location": location
                                                                        },
                                                                        success: function(response) {
                                                                            if (response == 'sukses') {
                                                                                Swal.fire({
                                                                                    title: 'Success!',
                                                                                    text: 'Status fitur berhasil diubah',
                                                                                    icon: 'success',
                                                                                    timer: 2000,
                                                                                    showCancelButton: false,
                                                                                    showConfirmButton: false
                                                                                }).then(function() {
                                                                                    window.location = 'main.php?page=control';
                                                                                });
                                                                            } else {
                                                                                Swal.fire(
                                                                                    'Error!',
                                                                                    'Server busy',
                                                                                    'error'
                                                                                );
                                                                            }
                                                                        }
                                                                    });
                                                                }

                                                            })
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot style="text-align: center;">
                                <th style="width: 20%;">Function</th>
                                <th style="width: 10%;">Status</th>
                                <th style="width: 60%;">Message</th>
                                <th style="width: 10%;">Config</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
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
    <div class="col-12 mb-5">
        <div class="row">
            <div class="col-12">
                <h6><u>Log</u></h6>
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
                            url: 'function/searchdata.php',
                            type: 'POST',
                            dataType: 'html',
                            data: {
                                "startdate": startdate,
                                "enddate": enddate,
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
                <script>
                    $(document).ready(function() {
                        $('#infolog').DataTable({
                            paging: false,
                            "order": [],
                            "dom": '<"wrapper"flipt>'
                        });
                    });
                </script>
                <table class="table table-bordered" id="infolog">
                    <thead style="text-align: center;">
                        <th>No</th>
                        <th>Location</th>
                        <th>Function</th>
                        <th>Status</th>
                        <th>Reason</th>
                        <th>Time</th>
                        <th>Approval</th>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $slog = mysqli_query($connect_pro, "SELECT * FROM qa_fitur_log ORDER BY c_time DESC");
                        while ($dlog = mysqli_fetch_array($slog)) {
                            $no++;
                        ?>
                            <tr>
                                <td style="text-align: center;"><?= $no ?></td>
                                <td><?= $dlog['c_location'] ?></td>
                                <td><?= $dlog['c_fitur'] ?></td>
                                <td style="text-align: center;"><?= $dlog['c_status'] ?></td>
                                <td><?= $dlog['c_message'] ?></td>
                                <td style="text-align: center;"><?= $dlog['c_time'] ?></td>
                                <td><?= $dlog['c_approval'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div> -->
    </div>
</div>