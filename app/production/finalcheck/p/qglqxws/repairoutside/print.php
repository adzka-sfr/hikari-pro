<!doctype html>
<html lang="en">
<?php
session_start();
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Repair Outside</title>
    <!-- <link rel="icon" href="logo_icon.png"> -->
    <link href="../../source/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="../../source/js/jquery.min.js"></script>
    <script type="text/javascript" src="../../source/js/qrcode.js"></script>
    <script src="../../source/dropdown_search/jquery-3.4.1.js" crossorigin="anonymous"></script>
    <script src="../../source/dropdown_search/select2.min.js"></script>
    <style>
        /* =Pantoufle Thermal printer
 * v0.1
 * ---------------------------------------------------------------------------*/

        body {
            margin: 0;
            width: 55mm;
        }

        *,
        *::after,
        *::before {
            box-sizing: border-box;
        }

        img {
            display: block;
            height: auto;
            width: 55mm;
        }

        .page {
            padding-bottom: 5mm;
        }

        /*
 * Screen
 */
        @media screen {

            html {
                background-color: Gainsboro;
            }

            body {
                background-color: white;
                box-shadow: 2px 2px 0px 1px #000, 0px 0px 0px 1px #000;
                margin: 3em;
                width: 57mm;
                padding: 5mm 4.5mm 1pt 4.5mm;
                position: relative;
            }

            body::before {
                content: "";
                position: absolute;
                z-index: 1;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                border-top: 5mm solid white;
                border-right: 4.5mm solid white;
                border-left: 4.5mm solid white;
                pointer-events: none;
            }

        }

        /*
 * Print
 */
        @media print {

            .noPrint {
                display: none;
            }

            @page {
                margin: 0;
            }

            html,
            body {
                background-color: transparent;
            }

            body {
                padding: 1pt 0pt;
            }

            .page::before {
                content: "--";
                font-size: 6pt;
                line-height: 1pt;
                display: block;
                text-align: left;
                position: absolute;
                top: 0;
                left: 0;
            }

            body::after {
                display: block;
                content: "--";
                font-size: 6pt;
                line-height: 1pt;
                text-align: left;
            }

        }

        /* =Theme
 * Start your theme here
 * ---------------------------------------------------------------------------*/
    </style>
</head>

<body>
    <?php
    $connect = new mysqli("localhost", "root", "", "hikari");
    $connect_pro = new mysqli("localhost", "root", "", "hikari_project");
    //get data ng
    $serialnumber = $_SESSION['serialoutside'];

    // get list pic incheck
    $q1 = mysqli_query($connect, "SELECT nama FROM auth WHERE role = 'repair outcheck'");

    // get pic cek and note + cek proses ke berapa
    $q2 = mysqli_query($connect_pro, "SELECT a.c_outsidesatu as pic_check1,a.c_outsidedua as pic_check2,a.c_outsidetiga as pic_check3, b.c_outsidesatu as note_check1,b.c_outsidedua as note_check2,b.c_outsidetiga as note_check3, b.c_completenesssatu as note_com1, b.c_completenessdua as note_com2, b.c_completenesstiga as note_com3 FROM finalcheck_pic a INNER JOIN finalcheck_note b ON a.c_serialnumber = b.c_serialnumber WHERE a.c_serialnumber = '$serialnumber'");
    $d2 = mysqli_fetch_array($q2);

    if (!empty($d2['pic_check3'])) {
        $pic_check = $d2['pic_check3'];
        $serialnumbershow = "S-" . $serialnumber;
        $location = "3";
        $process = "oc3";
        $note_check = $d2['note_check3'];
        $note_com = $d2['note_com3'];
    } else {
        if (!empty($d2['pic_check2'])) {
            $pic_check = $d2['pic_check2'];
            $serialnumbershow = "H-" . $serialnumber;
            $location = "2";
            $process = "oc2";
            $note_check = $d2['note_check2'];
            $note_com = $d2['note_com2'];
        } else {
            if (!empty($d2['pic_check1'])) {
                $pic_check = $d2['pic_check1'];
                $serialnumbershow = "V-" . $serialnumber;
                $location = "1";
                $process = "oc1";
                $note_check = $d2['note_check1'];
                $note_com = $d2['note_com1'];
            } else {
                $pic_check = '-';
                $serialnumbershow = "?-" . $serialnumber;
                $location = "0";
                $process = "oc0";
                $note_check = "-";
                $note_com = "-";
            }
        }
    }
    ?>
    <div class="row noPrint">
        <div class="col-12 mb-3">
            <input type="hidden" value="<?= $serialnumber ?>" id="serialnumber">
            <select style="width: 100%;" id="ngcode" onchange="selectcek(this.id)" required>
                <option selected disabled>Pilih PIC Repair</option>
                <?php
                while ($d1 = mysqli_fetch_array($q1)) {
                ?>
                    <option value="<?= $d1['nama'] ?>"><?= $d1['nama'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row noPrint">
        <div class="col-6" style="text-align: center;">
            <button id="back" class="btn btn-danger">Back</button>
        </div>
        <div class="col-6" style="text-align: center;">
            <button id="print" class="btn btn-primary" disabled>Print</button>
        </div>
    </div>
    <br>
    <div class="page">

        <!-- Content -->
        <h6 style="text-align: center;">Outside Check <?= $location ?></h6>
        <input id="text" type="hidden" value="<?= $serialnumbershow ?>" /><br />
        <div style="text-align: center;">
            <div style="padding-top: 0px; font-size:15px; "><b><?= $pic_check ?></b></div>
            <div id="qrcode" style="width:25mm; height:25mm; margin-left: 27%;"></div>
            <div style="padding-top: 0px; font-size:15px; "><b><?= $serialnumbershow ?></b></div>
        </div>
        <hr style="border-top: 3px solid black;">
        <div style="font-size: 12px; padding-left: 0px; margin-left: 0px;">
            <?php
            $q4 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_outside WHERE c_serialnumber = '$serialnumber' AND c_process = '$process'");
            $d4 = mysqli_fetch_array($q4);
            if ($d4['total'] == 0) {
            ?>
                <b>Outside is Good !</b>
            <?php
            } else {
            ?>
                <b>Outside NG:</b>
                <ul>
                    <?php
                    $q3 = mysqli_query($connect_pro, "SELECT DISTINCT a.c_code_cabinet, b.c_name FROM finalcheck_fetch_outside a INNER JOIN finalcheck_list_cabinet b ON a.c_code_cabinet = b.c_code_cabinet WHERE a.c_process = '$process' AND a.c_serialnumber ='$serialnumber'");
                    while ($d3 = mysqli_fetch_array($q3)) {
                        $ng = array();
                        $q3b = mysqli_query($connect_pro, "SELECT a.c_code_ng, a.c_number_ng, b.c_name FROM finalcheck_fetch_outside a INNER JOIN finalcheck_list_ng b ON a.c_code_ng = b.c_code_ng WHERE a.c_serialnumber ='$serialnumber' AND a.c_code_cabinet = '$d3[c_code_cabinet]'");
                        while ($d3b = mysqli_fetch_array($q3b)) {
                            $inject = "(" . $d3b['c_number_ng'] . ") " . $d3b['c_name'];
                            array_push($ng, $inject);
                        }
                        $ng = implode('</br>', $ng);
                    ?>
                        <li><b><?= $d3['c_name'] ?></b><br>
                            <?= $ng ?>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            <?php
            }
            ?>
        </div>

        <?php
        // jika ada note outside
        if ($note_check != '') {
        ?>
            <hr style="border-top: 3px solid black;">
            <div style="font-size: 12px; padding-left: 0px; margin-left: 0px;">
                <b>Outside Note:</b>
                <b>
                    <pre><?= $note_check ?></pre>
                </b>
            </div>
        <?php
        }
        ?>

        <hr style="border-top: 3px solid black;">
        <div style="font-size: 12px; padding-left: 0px; margin-left: 0px;">
            <?php
            if ($process == 'oc3') {
                $q4 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_completeness WHERE c_serialnumber = '$serialnumber' AND c_resulttiga = 'N'");
                $q3 = mysqli_query($connect_pro, "SELECT a.c_code_completeness, b.c_detail FROM finalcheck_fetch_completeness a INNER JOIN finalcheck_list_completeness b ON a.c_code_completeness = b.c_code_completeness WHERE a.c_resulttiga = 'N' AND a.c_serialnumber ='$serialnumber'");
            } elseif ($process == 'oc2') {
                $q4 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_completeness WHERE c_serialnumber = '$serialnumber' AND c_resultdua = 'N'");
                $q3 = mysqli_query($connect_pro, "SELECT a.c_code_completeness, b.c_detail FROM finalcheck_fetch_completeness a INNER JOIN finalcheck_list_completeness b ON a.c_code_completeness = b.c_code_completeness WHERE a.c_resultdua = 'N' AND a.c_serialnumber ='$serialnumber'");
            } elseif ($process == 'oc1') {
                $q4 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_completeness WHERE c_serialnumber = '$serialnumber' AND c_resultsatu = 'N'");
                $q3 = mysqli_query($connect_pro, "SELECT a.c_code_completeness, b.c_detail FROM finalcheck_fetch_completeness a INNER JOIN finalcheck_list_completeness b ON a.c_code_completeness = b.c_code_completeness WHERE a.c_resultsatu = 'N' AND a.c_serialnumber ='$serialnumber'");
            } else {
                $q4 = mysqli_query($connect_pro, "SELECT COUNT(c_serialnumber) as total FROM finalcheck_fetch_completeness WHERE c_serialnumber = 'kosong'");
                $q3 = mysqli_query($connect_pro, "SELECT a.c_code_completeness, b.c_detail FROM finalcheck_fetch_completeness a INNER JOIN finalcheck_list_completeness b ON a.c_code_completeness = b.c_code_completeness WHERE a.c_serialnumber ='kosong'");
            }
            $d4 = mysqli_fetch_array($q4);
            if ($d4['total'] == 0) {
            ?>
                <b>Completeness is Good !</b>
            <?php
            } else {
            ?>
                <b>Completeness NG:</b>
                <ul>
                    <?php
                    while ($d3 = mysqli_fetch_array($q3)) {
                    ?>
                        <li><?= $d3['c_detail'] ?></li>
                    <?php
                    }
                    ?>
                </ul>
            <?php
            }
            ?>
        </div>

        <?php
        // jika ada note completeness
        if ($note_com != '') {
        ?>
            <hr style="border-top: 3px solid black;">
            <div style="font-size: 12px; padding-left: 0px; margin-left: 0px;">
                <b>Completeness Note:</b>
                <b>
                    <pre><?= $note_com ?></pre>
                </b>
            </div>
        <?php
        }
        ?>





        <hr style="border-top: 3px solid black; margin-bottom: 0px; margin-top:0px;">
        <div style="font-size: 12px; padding-left: 10px; margin-left: 0px; margin-top: 0px;">
            pic repair: <span id="pic">-</span>
            <input type="hidden" id="picsend" value="-">
            <input type="hidden" id="process" value="<?= $process ?>">
        </div>
    </div>


    <script type="text/javascript">
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            width: 100,
            height: 100,
            useSVG: true
        });

        function makeCode() {
            var elText = document.getElementById("text");

            if (!elText.value) {
                alert("Input a text");
                elText.focus();
                return;
            }

            qrcode.makeCode(elText.value);
        }

        makeCode();

        $("#text").
        on("blur", function() {
            makeCode();
        }).
        on("keydown", function(e) {
            if (e.keyCode == 13) {
                makeCode();
            }
        });
    </script>
    <script>
        function selectcek(id) {
            var pic = $('#' + id).val();
            // console.log($('#' + id).val())
            $('#pic').html($('#' + id).val());
            $('#picsend').val(pic);
            $('#print').attr("disabled", false);
        }

        $('#print').click(function() {
            // ajax
            var pic = $('#picsend').val();
            var process = $('#process').val();
            var serialnumber = $('#serialnumber').val();
            // console.log(pic);
            $.ajax({
                url: 'data3.php',
                type: 'POST',
                data: {
                    "serialnumber": serialnumber,
                    "pic": pic,
                    "process": process

                },
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 'OK') {
                        window.print()
                        // console.log('oke print');
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            icon: 'error',
                            html: 'Silahkan coba lagi nanti',
                            showCancelButton: false,
                            showConfirmButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Oke',
                            cancelButtonText: 'Tidak'
                        })
                    }

                }
            });
        })

        $('#back').click(function() {
            // ajax
            $.ajax({
                url: 'data2.php',
                type: 'POST',
                success: function(response) {
                    var response = JSON.parse(response);
                    if (response.status == 'OK') {
                        history.back()
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            icon: 'error',
                            html: 'Silahkan coba lagi nanti',
                            showCancelButton: false,
                            showConfirmButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Oke',
                            cancelButtonText: 'Tidak'
                        })
                    }

                }
            });
        })

        $('.halodecktot').select2({
            placeholder: " Pilih Nama",
            language: "id",
            allowClear: true,

        });
    </script>
    <script src="../../source/js/bootstrap.bundle.min.js"></script>
</body>

</html>