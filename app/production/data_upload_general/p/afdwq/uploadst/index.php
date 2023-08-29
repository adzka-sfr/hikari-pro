<div class="row">
    <div class="col-12">
        <h5>Data Upload General</h5>
        <hr>
    </div>
</div>
<!-- modal untuk cek koneksi -->
<div class="modal fade" id="lostmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="col-12 modal-title fs-5 text-center" style="color: red;" id="staticBackdropLabel"><img src="<?= base_url('_assets/production/gif/heart.gif') ?>" width="100px"> Koneksi Terputus! <img src="<?= base_url('_assets/production/gif/heart.gif') ?>" width="100px"></h1>
            </div>
            <div class="modal-body" style="font-size: 15px; ">
                Yang harus dilakukan:
                <ol>
                    <li>Pastikan laptop tersambung dengan jaringan Yamaha</li>
                    <li>Tunggu hingga jaringan kembali stabil</li>
                    <li>Jika sudah terhubung kembali, ulangi kegiatan terakhir anda pada sistem</li>
                </ol>
                Silahkan menghubungi ICTM jika poin 1-2 sudah dilakukan namun tidak kunjung tersambung
            </div>
            <div class="modal-footer">
                <!-- <button type="button" style="display: none;" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                <span class="col-12 text-center">
                    <button type="button" disabled class="btn btn-primary">Mencoba terubung kembali...</button>
                </span>
            </div>
        </div>
    </div>
</div>
<script>
    function calltry() {
        var check_con = "connect";
        $.ajax({
            url: '../source/connection_check.php',
            type: 'POST',
            data: {
                "check_con": check_con
            },
            success: function(response) {
                successconnection();
            },
        });
    }

    function lostconnection() {
        $('#lostmodal').modal('toggle');
        setInterval(calltry, 1000);
    }

    function successconnection() {
        clearInterval();
        $('#lostmodal').modal('hide');
    }
</script>
<!-- modal untuk cek koneksi -->
<div class="row">
    <div class="col-8">
        <div class="row">
            <div class="col-12">
                <input name="filestock" type="file" class="form-control" id="file" required>
            </div>
        </div>
        <div class="row">
            <div class="col-9 mt-2">
                <h6 id="alertinfo" style="color: red; font-size: 0.8rem; display: none;">Harap jangan meninggalkan halaman saat proses upload sedang berlangsung!</h6>
                <h6 id="nullinfo" style="color: red; font-size: 0.8rem; display: none;">Silahkan pilih file dengan ekstensi .xls atau .xlsx terlebih dahulu</h6>
            </div>
            <div class="col-3 mt-2 text-right">
                <button id="go" class="btn btn-primary btn-sm" style="width: 100%;"><span id="text-button">Upload</span> <i id="spinner-go" class="fa fa-spin fa-spinner" style="display: none;"></i></button>
            </div>
        </div>
    </div>
    <div class="col-4">
        <table class="table">
            <thead style="text-align: center;">
                <tr>
                    <th colspan="2">
                        <time id="timer">0:00:00.00</time>
                        <button style="display: none;" id="togglestp">start</button>
                        <button style="display: none;" id="clear">clear</button>
                    </th>
                </tr>
                <tr>
                    <th style="width: 50%;">Progress</th>
                    <th style="width: 50%;">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">
                        <div id="progresstable">0</div>
                    </td>
                    <td style="text-align: center; font-weight: bold;">
                        <div id="totaltable">0</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div id="loadingplace" class="progress" role="progressbar" aria-label="Animated striped example">
            <div id="loading" class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%"><span id="textloading">0%</span></div>
        </div>
    </div>
</div>

<script>
    // stopwatch
    (function timer() {
        'use strict';

        //declare
        var output = document.getElementById('timer');
        var toggle = document.getElementById('togglestp');
        var clear = document.getElementById('clear');
        var running = false;
        var paused = false;
        var timer;

        // timer start time
        var then;
        // pause duration
        var delay;
        // pause start time
        var delayThen;


        // start timer
        var start = function() {
            delay = 0;
            running = true;
            then = Date.now();
            timer = setInterval(run, 51);
            toggle.innerHTML = 'stop';
        };


        // parse time in ms for output
        var parseTime = function(elapsed) {
            // array of time multiples [hours, min, sec, decimal]
            var d = [3600000, 60000, 1000, 10];
            var time = [];
            var i = 0;

            while (i < d.length) {
                var t = Math.floor(elapsed / d[i]);

                // remove parsed time for next iteration
                elapsed -= t * d[i];

                // add '0' prefix to m,s,d when needed
                t = (i > 0 && t < 10) ? '0' + t : t;
                time.push(t);
                i++;
            }

            return time;
        };


        // run
        var run = function() {
            // get output array and print
            var time = parseTime(Date.now() - then - delay);
            output.innerHTML = time[0] + ':' + time[1] + ':' + time[2] + '.' + time[3];
        };


        // stop
        var stop = function() {
            paused = true;
            delayThen = Date.now();
            toggle.innerHTML = 'resume';
            clear.dataset.state = 'visible';
            clearInterval(timer);

            // call one last time to print exact time
            run();
        };


        // resume
        var resume = function() {
            paused = false;
            delay += Date.now() - delayThen;
            timer = setInterval(run, 51);
            toggle.innerHTML = 'stop';
            clear.dataset.state = '';
        };


        // clear
        var reset = function() {
            running = false;
            paused = false;
            toggle.innerHTML = 'start';
            output.innerHTML = '0:00:00.00';
            clear.dataset.state = '';
        };


        // evaluate and route
        var router = function() {
            if (!running) start();
            else if (paused) resume();
            else stop();
        };

        toggle.addEventListener('click', router);
        clear.addEventListener('click', reset);

    })();

    // GENERASI 3
    $('#go').click(function() {
        if ($('#file').val() == '') {
            $('#nullinfo').show();
            setTimeout(function() {
                $('#nullinfo').hide()
            }, 3000);
        } else {
            // agar data bisa dilempar menggunakan ajax
            var datafile = new FormData();
            jQuery.each(jQuery('#file')[0].files, function(i, file) {
                datafile.append('file-' + i, file);
            });

            // disabled field, sambil menunggu proses hitung jumlah data yang akan di upload beserta estimasi waktunya
            $('#file').prop('disabled', true);
            $('#text-button').html("Calculating");
            $('#spinner-go').show();
            $('#go').prop('disabled', true);

            // run ajax validation.php
            $.ajax({
                url: 'uploadst/validation.php',
                data: datafile,
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST', // For jQuery < 1.9
                success: function(data) {
                    var data = JSON.parse(data);
                    // console.log(data.status);
                    // console.log(data.total_row);
                    // console.log(data.estimasi);
                    Swal.fire({
                        title: 'Apakah anda yakin ?',
                        icon: 'question',
                        html: 'Data yang akan diupload adalah sebanyak <b>' + data.total_row + '</b><br>waktu yang dibutuhkan kurang lebih adalah</br><b>' + data.estimasi + '</b></br><span style="font-size:0.7rem; color:red;">Waktu aktual bisa saja berubah sesuai dengan kondisi jaringan</span>',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, do it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            console.log('gas upload karena dah acc');
                            // start timer
                            $('#togglestp').click();
                            // change calculating to uploading
                            $('#text-button').html("Uploading");

                            // jalankan proses upload_progress.php
                            $.ajax({
                                url: 'uploadst/update_progress.php',
                                data: datafile,
                                cache: false,
                                contentType: false,
                                processData: false,
                                method: 'POST',
                                success: function(data) {
                                    var data = JSON.parse(data);
                                    if (data.status == "berhasil") {
                                        // jalankan function getprogress()
                                        getprogress();

                                        // jalankan proses upload.php
                                        $.ajax({
                                            url: 'uploadst/upload.php',
                                            data: datafile,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            method: 'POST',
                                            success: function(data) {
                                                var data = JSON.parse(data);
                                                console.log("data sedang di upload");
                                                $('#togglestp').click();
                                            }
                                        });
                                    } else {
                                        // alert jika gagal melakukan update progress
                                        console.log("gagal update progress");
                                    }
                                }
                            });
                        } else {
                            $('#file').prop('disabled', false);
                            $('#text-button').html("Upload");
                            $('#spinner-go').hide();
                            $('#go').prop('disabled', false);
                        }
                    })
                },
                error: function() {
                    lostconnection();
                    // buka kembali ketika jaringan tersambung kembali
                    $('#file').prop('disabled', false);
                    $('#text-button').html("Upload");
                    $('#spinner-go').hide();
                    $('#go').prop('disabled', false);
                }
            });
        }
    })

    function getprogress() {
        const loading = setInterval(function() {
            $.ajax({
                url: 'uploadst/get_progress.php',
                method: 'POST',
                success: function(data) {
                    var data = JSON.parse(data);
                    $("#loading").attr('style', 'width:' + data.persen + '%');
                    $("#textloading").html(data.persen + "%")

                    // table
                    $('#progresstable').html(data.progress);
                    $('#totaltable').html(data.total);
                    console.log(data.waktu + " time");

                    if (data.total != 0) {
                        if (data.total == data.progress) {
                            console.log("dah sama");
                            // stop interval
                            clearInterval(loading);
                            // buka kembali field
                            $('#file').val('');
                            $('#file').prop('disabled', false);
                            $('#text-button').html("Upload");
                            $('#spinner-go').hide();
                            $('#go').prop('disabled', false);
                        }
                    }

                    if (data.total == 0 && data.progress == 0) {
                        console.log("gada data yang uploading");
                        // stop interval
                        clearInterval(loading);
                        // buka kembali field
                        $('#file').val('');
                        $('#file').prop('disabled', false);
                        $('#text-button').html("Upload");
                        $('#spinner-go').hide();
                        $('#go').prop('disabled', false);
                    }
                }
            });
        }, 1000);
    }

    // buka kembali field
    $('#file').val('');
    $('#file').prop('disabled', true);
    $('#text-button').html("Uploading");
    $('#spinner-go').show();
    $('#go').prop('disabled', true);
    getprogress();

    // GENERASI 2
    // $('#go').click(function() {
    //     if ($('#file').val() == '') {
    //         $('#nullinfo').show();
    //         setTimeout(function() {
    //             $('#nullinfo').hide()
    //         }, 3000);
    //     } else {
    //         $('#togglestp').click();
    //         $('#file').prop('readonly', true);
    //         $('#alertinfo').show();
    //         $('#go').prop('disabled', true);
    //         $('#loadingplace').show();

    //         // agar data dapat dilempar menggunakan ajax
    //         var data = new FormData();
    //         jQuery.each(jQuery('#file')[0].files, function(i, file) {
    //             data.append('file-' + i, file);
    //         });

    //         // function ini akan dijalanlan ketika proses upload selesai
    //         // function myStop() {
    //         //     $('#file').prop('readonly', false);
    //         //     $('#alertinfo').hide();
    //         //     $('#go').prop('disabled', false);
    //         //     clearInterval(loading);
    //         // }

    //         // ini akan jalan bareng dengan proses upload data
    //         const loading = setInterval(function() {
    //             // console.log("jalan");
    //             $.ajax({
    //                 url: 'uploadst/get_num.php',
    //                 data: data,
    //                 cache: false,
    //                 contentType: false,
    //                 processData: false,
    //                 method: 'POST',
    //                 type: 'POST', // For jQuery < 1.9
    //                 success: function(data) {
    //                     var data = JSON.parse(data);
    //                     $("#loading").attr('style', 'width:' + data.persen + '%');
    //                     $("#textloading").html(data.persen + "%")

    //                     // table
    //                     $('#progresstable').html(data.progress);
    //                     $('#totaltable').html(data.total);

    //                     if (data.total != 0) {
    //                         if (data.total == data.progress) {

    //                             console.log("dah sama");
    //                             $('#file').prop('readonly', false);
    //                             $('#alertinfo').hide();
    //                             $('#go').prop('disabled', false);
    //                             clearInterval(loading);
    //                         }
    //                     }

    //                 }
    //             });
    //         }, 1000);

    //         // ini adalah proses upload data
    //         $.ajax({
    //             url: 'uploadst/upload.php',
    //             data: data,
    //             cache: false,
    //             contentType: false,
    //             processData: false,
    //             method: 'POST',
    //             type: 'POST', // For jQuery < 1.9
    //             success: function(data) {
    //                 var data = JSON.parse(data);
    //                 console.log(data.status);
    //                 $('#file').val('');
    //                 $('#togglestp').click(); // untuk stop stopwatch
    //             }
    //         });


    //     }


    // })
    // ambil data yang sedang berjalan
    // function getprocess() {
    // const loading2 = setInterval(function() {
    //     // console.log("jalan");
    //     $.ajax({
    //         url: 'uploadst/get_num2.php',
    //         method: 'POST',
    //         success: function(data) {
    //             var data = JSON.parse(data);
    //             $("#loading").attr('style', 'width:' + data.persen + '%');
    //             $("#textloading").html(data.persen + "%")

    //             // table
    //             $('#progresstable').html(data.progress);
    //             $('#totaltable').html(data.total);

    //             if (data.total != 0) {
    //                 if (data.total == data.progress) {
    //                     myStop();
    //                     console.log("dah sama");
    //                 }
    //             }

    //         }
    //     });
    // }, 1000);
    // }


    // GENERASI 1
    // $('#go').click(function() {

    //     // agar data dapat dilempar menggunakan ajax
    //     var data = new FormData();
    //     jQuery.each(jQuery('#file')[0].files, function(i, file) {
    //         data.append('file-' + i, file);
    //     });

    //     // ini adalah proses upload data
    //     $.ajax({
    //         url: 'uploadst/upload.php',
    //         data: data,
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         method: 'POST',
    //         type: 'POST', // For jQuery < 1.9
    //         success: function(data) {
    //             var data = JSON.parse(data);
    //             console.log(data.status);
    //             console.log(data.isi);
    //         }
    //     });

    //     // ini akan jalan bareng dengan proses upload data
    //     const loading = setInterval(function() {
    //         $.ajax({
    //             url: 'uploadst/get_num.php',
    //             data: data,
    //             cache: false,
    //             contentType: false,
    //             processData: false,
    //             method: 'POST',
    //             type: 'POST', // For jQuery < 1.9
    //             success: function(data) {
    //                 var data = JSON.parse(data);
    //                 // $('#loading').attr();
    //                 $("#loading").attr('style', 'width:' + data.persen + '%');
    //                 $("#textloading").html(data.persen + "%")
    //                 console.log(data.progress);
    //                 console.log(data.baris);
    //                 console.log('-------------');
    //                 if (data.baris != 0) {
    //                     if (data.baris == data.progress) {
    //                         myStop();
    //                     }
    //                 }

    //             }
    //         });
    //     }, 500);

    //     // function ini akan dijalanlan ketika proses upload selesai
    //     function myStop() {
    //         clearInterval(loading);
    //     }
    // })
</script>