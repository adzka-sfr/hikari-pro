<div class="row">
    <div class="col-12">
        <h5>Email Control
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
                                <th style="width: 70%;">Email</th>
                                <th style="width: 10%;">ST</th>
                                <th style="width: 10%;">NG</th>
                                <th style="width: 20%;">Action</th>
                            </thead>
                            <tbody>
                                <?php
                                $q1 = mysqli_query($connect_pro, "SELECT * FROM qa_email WHERE c_area = 'packing up' ORDER BY c_email ASC");
                                while ($d1 = mysqli_fetch_array($q1)) {
                                    // cek on/off st
                                    if ($d1['c_st'] == 'deactive') {
                                        $status_st = "";
                                    } else {
                                        $status_st = "checked";
                                    }

                                    // cek on/off ng
                                    if ($d1['c_ng'] == 'deactive') {
                                        $status_ng = "";
                                    } else {
                                        $status_ng = "checked";
                                    }
                                ?>
                                    <tr>
                                        <td>
                                            <span style="cursor: pointer;"><?= $d1['c_email'] ?></span>
                                        </td>
                                        <td style="text-align: center;">
                                            <label class="switch mt-2" style="width: 30px; height: 14px;">
                                                <input disabled type="checkbox" <?= $status_st ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td style="text-align: center;">
                                            <label class="switch mt-2" style="width: 30px; height: 14px;">
                                                <input disabled type="checkbox" <?= $status_ng ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td style="text-align: center;">
                                            <button class="btn btn-sm btn-secondary mt-1" style="padding-top: 1px; padding-bottom: 1px;" data-bs-toggle="modal" data-bs-target="#b-<?= $d1['id'] ?>"><i class="fa fa-cogs"></i></button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="b-<?= $d1['id'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Email Control</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="row">
                                                                <div class="col-3 mb-3" style="text-align: left;">
                                                                    Email
                                                                </div>
                                                                <div class="col-1" style="text-align: center;">:</div>
                                                                <div class="col-8" style="text-align: left;">
                                                                    <?= $d1['c_email'] ?>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-3 mb-3" style="text-align: left;">
                                                                    ST Reminder
                                                                </div>
                                                                <div class="col-1" style="text-align: center;">:</div>
                                                                <div class="col-8" style="text-align: left; padding-top: 4px;">
                                                                    <label class="switch" style="width: 30px; height: 14px;">
                                                                        <input id="statusst-<?= $d1['id'] ?>" type="checkbox" <?= $status_st ?>>
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-3 mb-3" style="text-align: left;">
                                                                    NG Report
                                                                </div>
                                                                <div class="col-1" style="text-align: center;">:</div>
                                                                <div class="col-8" style="text-align: left; padding-top: 4px;">
                                                                    <label class="switch" style="width: 30px; height: 14px;">
                                                                        <input id="statusng-<?= $d1['id'] ?>" type="checkbox" <?= $status_ng ?>>
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12" style="text-align: left;">
                                                                    <button id="del-<?= $d1['id'] ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input id="idfitur-<?= $d1['id'] ?>" type="hidden" value="<?= $d1['id'] ?>">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button id="sc-<?= $d1['id'] ?>" type="button" class="btn btn-primary">Save changes</button>
                                                            <script>
                                                                $('#sc-<?= $d1['id'] ?>').click(function() {
                                                                    var id = $('#idfitur-<?= $d1['id'] ?>').val();
                                                                    if ($('#statusst-<?= $d1['id'] ?>').is(":checked")) {
                                                                        var statusst = 'active';
                                                                    } else {
                                                                        var statusst = 'deactive';
                                                                    }
                                                                    if ($('#statusng-<?= $d1['id'] ?>').is(":checked")) {
                                                                        var statusng = 'active';
                                                                    } else {
                                                                        var statusng = 'deactive';
                                                                    }

                                                                    $.ajax({
                                                                        url: 'email/edit.php',
                                                                        type: 'POST',
                                                                        data: {
                                                                            "id": id,
                                                                            "statusst": statusst,
                                                                            "statusng": statusng,
                                                                        },
                                                                        success: function(response) {
                                                                            if (response == 'sukses') {
                                                                                Swal.fire({
                                                                                    title: 'Success!',
                                                                                    text: 'Perubahan berhasil disimpan',
                                                                                    icon: 'success',
                                                                                    timer: 2000,
                                                                                    showCancelButton: false,
                                                                                    showConfirmButton: false
                                                                                }).then(function() {
                                                                                    window.location = 'main.php?page=emcon';
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
                                                                });

                                                                $('#del-<?= $d1['id'] ?>').click(function() {
                                                                    var id = $('#idfitur-<?= $d1['id'] ?>').val();

                                                                    $.ajax({
                                                                        url: 'email/hapus.php',
                                                                        type: 'POST',
                                                                        data: {
                                                                            "id": id,
                                                                        },
                                                                        success: function(response) {
                                                                            if (response == 'sukses') {
                                                                                Swal.fire({
                                                                                    title: 'Success!',
                                                                                    text: 'Data berhasil dihapus',
                                                                                    icon: 'success',
                                                                                    timer: 2000,
                                                                                    showCancelButton: false,
                                                                                    showConfirmButton: false
                                                                                }).then(function() {
                                                                                    window.location = 'main.php?page=emcon';
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
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropup" style="width: 100%;"><i class="fa fa-plus-circle"></i></button>

                        <div class="modal fade" id="staticBackdropup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Email Recipient</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-2 mt-2" style="text-align: left;">
                                                Email
                                            </div>
                                            <div class="col-1 mt-2" style="text-align: center;">:</div>
                                            <div class="col-9" style="text-align: left;">
                                                <!-- <input class="form-control" type="email" id="emailup" name="emailup"> -->
                                                <div class="input-group mb-3 input-group-sm">
                                                    <input type="text" id="emailup" name="emailup" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                    <span class="input-group-text" id="basic-addon2">@music.yamaha.com</span>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12" id="erroremailup" style="display: none;">
                                                        <span style="color: #D93025;">Email tidak boleh kosong</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2 mt-3" style="text-align: left;">
                                                ST Reminder
                                            </div>
                                            <div class="col-1 mt-3" style="text-align: center;">:</div>
                                            <div class="col-9 mt-3" style="text-align: left; padding-top: 4px;">
                                                <label class="switch" style="width: 30px; height: 14px;">
                                                    <input id="statusstup" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2 mt-3" style="text-align: left;">
                                                NG Report
                                            </div>
                                            <div class="col-1 mt-3" style="text-align: center;">:</div>
                                            <div class="col-9 mt-3" style="text-align: left; padding-top: 4px;">
                                                <label class="switch" style="width: 30px; height: 14px;">
                                                    <input id="statusngup" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="location" id="locationaddup" value="packing up">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button id="addup" type="button" class="btn btn-primary">Add</button>
                                    </div>
                                    <script>
                                        $('#addup').click(function() {
                                            var email = $('#emailup').val();
                                            var loc = $('#locationaddup').val();
                                            if ($('#statusstup').is(":checked")) {
                                                var statusstadd = 'active';
                                            } else {
                                                var statusstadd = 'deactive';
                                            }
                                            if ($('#statusngup').is(":checked")) {
                                                var statusngadd = 'active';
                                            } else {
                                                var statusngadd = 'deactive';
                                            }

                                            if (email == '') {
                                                $('#erroremailup').show();
                                                setTimeout(function() {
                                                    $('#erroremailup').hide()
                                                }, 3000);
                                            } else {
                                                $.ajax({
                                                    url: 'email/add.php',
                                                    type: 'POST',
                                                    data: {
                                                        "email": email,
                                                        "statusstadd": statusstadd,
                                                        "statusngadd": statusngadd,
                                                        "location": loc,
                                                    },
                                                    success: function(response) {
                                                        if (response == 'sukses') {
                                                            Swal.fire({
                                                                title: 'Success!',
                                                                text: 'Data berhasil ditambah',
                                                                icon: 'success',
                                                                timer: 2000,
                                                                showCancelButton: false,
                                                                showConfirmButton: false
                                                            }).then(function() {
                                                                window.location = 'main.php?page=emcon';
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


                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
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
                                <th style="width: 70%;">Email</th>
                                <th style="width: 10%;">ST</th>
                                <th style="width: 10%;">NG</th>
                                <th style="width: 20%;">Action</th>
                            </thead>
                            <tbody>
                                <?php
                                $q1 = mysqli_query($connect_pro, "SELECT * FROM qa_email WHERE c_area = 'packing gp' ORDER BY c_email ASC");
                                while ($d1 = mysqli_fetch_array($q1)) {
                                    // cek on/off st
                                    if ($d1['c_st'] == 'deactive') {
                                        $status_st = "";
                                    } else {
                                        $status_st = "checked";
                                    }

                                    // cek on/off ng
                                    if ($d1['c_ng'] == 'deactive') {
                                        $status_ng = "";
                                    } else {
                                        $status_ng = "checked";
                                    }
                                ?>
                                    <tr>
                                        <td>
                                            <span style="cursor: pointer;"><?= $d1['c_email'] ?></span>
                                        </td>
                                        <td style="text-align: center;">
                                            <label class="switch mt-2" style="width: 30px; height: 14px;">
                                                <input disabled type="checkbox" <?= $status_st ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td style="text-align: center;">
                                            <label class="switch mt-2" style="width: 30px; height: 14px;">
                                                <input disabled type="checkbox" <?= $status_ng ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td style="text-align: center;">
                                            <button class="btn btn-sm btn-secondary mt-1" style="padding-top: 1px; padding-bottom: 1px;" data-bs-toggle="modal" data-bs-target="#b-<?= $d1['id'] ?>"><i class="fa fa-cogs"></i></button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="b-<?= $d1['id'] ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Email Control</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="row">
                                                                <div class="col-3 mb-3" style="text-align: left;">
                                                                    Email
                                                                </div>
                                                                <div class="col-1" style="text-align: center;">:</div>
                                                                <div class="col-8" style="text-align: left;">
                                                                    <?= $d1['c_email'] ?>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-3 mb-3" style="text-align: left;">
                                                                    ST Reminder
                                                                </div>
                                                                <div class="col-1" style="text-align: center;">:</div>
                                                                <div class="col-8" style="text-align: left; padding-top: 4px;">
                                                                    <label class="switch" style="width: 30px; height: 14px;">
                                                                        <input id="statusst-<?= $d1['id'] ?>" type="checkbox" <?= $status_st ?>>
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-3 mb-3" style="text-align: left;">
                                                                    NG Report
                                                                </div>
                                                                <div class="col-1" style="text-align: center;">:</div>
                                                                <div class="col-8" style="text-align: left; padding-top: 4px;">
                                                                    <label class="switch" style="width: 30px; height: 14px;">
                                                                        <input id="statusng-<?= $d1['id'] ?>" type="checkbox" <?= $status_ng ?>>
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12" style="text-align: left;">
                                                                    <button id="del-<?= $d1['id'] ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input id="idfitur-<?= $d1['id'] ?>" type="hidden" value="<?= $d1['id'] ?>">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button id="sc-<?= $d1['id'] ?>" type="button" class="btn btn-primary">Save changes</button>
                                                            <script>
                                                                $('#sc-<?= $d1['id'] ?>').click(function() {
                                                                    var id = $('#idfitur-<?= $d1['id'] ?>').val();
                                                                    if ($('#statusst-<?= $d1['id'] ?>').is(":checked")) {
                                                                        var statusst = 'active';
                                                                    } else {
                                                                        var statusst = 'deactive';
                                                                    }
                                                                    if ($('#statusng-<?= $d1['id'] ?>').is(":checked")) {
                                                                        var statusng = 'active';
                                                                    } else {
                                                                        var statusng = 'deactive';
                                                                    }

                                                                    $.ajax({
                                                                        url: 'email/edit.php',
                                                                        type: 'POST',
                                                                        data: {
                                                                            "id": id,
                                                                            "statusst": statusst,
                                                                            "statusng": statusng,
                                                                        },
                                                                        success: function(response) {
                                                                            if (response == 'sukses') {
                                                                                Swal.fire({
                                                                                    title: 'Success!',
                                                                                    text: 'Perubahan berhasil disimpan',
                                                                                    icon: 'success',
                                                                                    timer: 2000,
                                                                                    showCancelButton: false,
                                                                                    showConfirmButton: false
                                                                                }).then(function() {
                                                                                    window.location = 'main.php?page=emcon';
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
                                                                });

                                                                $('#del-<?= $d1['id'] ?>').click(function() {
                                                                    var id = $('#idfitur-<?= $d1['id'] ?>').val();

                                                                    $.ajax({
                                                                        url: 'email/hapus.php',
                                                                        type: 'POST',
                                                                        data: {
                                                                            "id": id,
                                                                        },
                                                                        success: function(response) {
                                                                            if (response == 'sukses') {
                                                                                Swal.fire({
                                                                                    title: 'Success!',
                                                                                    text: 'Data berhasil dihapus',
                                                                                    icon: 'success',
                                                                                    timer: 2000,
                                                                                    showCancelButton: false,
                                                                                    showConfirmButton: false
                                                                                }).then(function() {
                                                                                    window.location = 'main.php?page=emcon';
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
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropgp" style="width: 100%;"><i class="fa fa-plus-circle"></i></button>

                        <div class="modal fade" id="staticBackdropgp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Email Recipient</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-3 mt-2" style="text-align: left;">
                                                Email
                                            </div>
                                            <div class="col-1 mt-2" style="text-align: center;">:</div>
                                            <div class="col-8" style="text-align: left;">
                                                <!-- <input style="width: 100%;" class="form-control" type="email" id="emailgp" name="email"> -->
                                                <div class="input-group mb-3 input-group-sm">
                                                    <input type="text" id="emailgp" name="emailgp" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                    <span class="input-group-text" id="basic-addon2">@music.yamaha.com</span>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12" id="erroremailgp" style="display: none;">
                                                        <span style="color: #D93025;">Email tidak boleh kosong</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3 mt-3" style="text-align: left;">
                                                ST Reminder
                                            </div>
                                            <div class="col-1 mt-3" style="text-align: center;">:</div>
                                            <div class="col-8 mt-3" style="text-align: left; padding-top: 4px;">
                                                <label class="switch" style="width: 30px; height: 14px;">
                                                    <input id="statusstgp" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3 mt-3" style="text-align: left;">
                                                NG Report
                                            </div>
                                            <div class="col-1 mt-3" style="text-align: center;">:</div>
                                            <div class="col-8 mt-3" style="text-align: left; padding-top: 4px;">
                                                <label class="switch" style="width: 30px; height: 14px;">
                                                    <input id="statusnggp" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="location" id="locationaddgp" value="packing gp">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button id="addgp" type="button" class="btn btn-primary">Add</button>
                                    </div>
                                    <script>
                                        $('#addgp').click(function() {
                                            var email = $('#emailgp').val();
                                            var loc = $('#locationaddgp').val();
                                            if ($('#statusstgp').is(":checked")) {
                                                var statusstadd = 'active';
                                            } else {
                                                var statusstadd = 'deactive';
                                            }
                                            if ($('#statusnggp').is(":checked")) {
                                                var statusngadd = 'active';
                                            } else {
                                                var statusngadd = 'deactive';
                                            }

                                            if (email == '') {
                                                $('#erroremailgp').show();
                                                setTimeout(function() {
                                                    $('#erroremailgp').hide()
                                                }, 3000);
                                            } else {
                                                $.ajax({
                                                    url: 'email/add.php',
                                                    type: 'POST',
                                                    data: {
                                                        "email": email,
                                                        "statusstadd": statusstadd,
                                                        "statusngadd": statusngadd,
                                                        "location": loc,
                                                    },
                                                    success: function(response) {
                                                        if (response == 'sukses') {
                                                            Swal.fire({
                                                                title: 'Success!',
                                                                text: 'Data berhasil ditambah',
                                                                icon: 'success',
                                                                timer: 2000,
                                                                showCancelButton: false,
                                                                showConfirmButton: false
                                                            }).then(function() {
                                                                window.location = 'main.php?page=emcon';
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


                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
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