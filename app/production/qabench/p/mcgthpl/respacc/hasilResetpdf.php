<!DOCTYPE html>
<html lang="en">
<?php
$connect = new mysqli("localhost", "root", "", "hikari");
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");
$connect_log = new mysqli("localhost", "root", "", "hikari_log");
session_start();
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
$approval  = $_SESSION['nama'];
$approval_id = $_SESSION['id'];
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="source_code/jquery.min.js"></script>
    <script src="source_code/jquery-3.4.1.js" crossorigin="anonymous"></script>
    <!-- html2pdf CDN link -->
    <script src="source_code/html2pdf.bundle.min.js" referrerpolicy="no-referrer"></script>
    <link href="source_code/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
            outline: 0;
            border: 0;
        }

        div {
            margin-top: 30px;
            text-align: center;
        }

        .countdown {
            margin-top: 10px;
        }

        .countdown span.time {
            padding: 12px;
            display: inline-block;
            font-family: verdana;
            font-size: 36px;
            line-height: 1.5;
            font-weight: 900;
            color: #fff;
            background: #008080;
            border-radius: 10px;
        }

        button {
            padding: 0 16px;
            margin-right: 4px;
            font-size: 15px;
            line-height: 2;
            color: #FFF;
            background: #3E62AD;
            border-radius: 5px;
        }

        .page {
            margin-left: 5rem;
            margin-right: 5rem;
        }
    </style>
</head>

<body>
    <div style="text-align: center;">
        <button id="download-button" style="border: none; height: 30px; background-color: #AA0A00; border-radius: 5px; color: #ffffff; font-weight: bold; cursor: pointer;">Klik disini jika tidak ter-download otomatis</button>
        <!-- <button id="close-button" style="border: none; height: 30px; background-color: #AA0A00; border-radius: 5px; color: #ffffff; font-weight: bold; cursor: pointer;">Close</button> -->
    </div>


    <div>
        <span style="font-family: Verdana">Akan tertutup otomatis dalam:</span>
        <div class="countdown">
            <span id="time" class="time">00:00:00</span>
        </div>
        <div class="btn-wrap">
            <button style="display: none;" id="start">Start</button>
            <button style="display: none;" id="stop">Stop</button>
            <button style="display: none;" id="reset">Reset</button>
        </div>
        <?php
        $nomor = 0;

        // get max date in one section
        $mq = mysqli_query($connect_pro, "SELECT MAX(c_date) AS maksimal FROM qa_reset WHERE c_section = '$approval_id'");
        $md = mysqli_fetch_array($mq);
        $max = $md['maksimal'];

        // get total data
        $aq = mysqli_query($connect_pro, "SELECT COUNT(id) AS total FROM qa_reset WHERE c_section = '$approval_id' AND c_date = '$max'");
        $ad = mysqli_fetch_array($aq);
        $a = $ad['total']; // total data
        $b = 12; // data per page
        $c = 1; // page

        // hitung dulu modulusnya, apakah 0 atau tidak (jika tidak 0 maka akan di tambah 1 pagenya)
        $d = $a % $b;

        if ($d == 0) {
            $c = $a / $b;
        } else {
            $c = $a / $b;
            $c = $c + 1;
            $c = floor($c);
        }
        // echo $c . " page";
        ?>

    </div>

    <div id="invoice">
        <!-- download disini -->
        <div class="container">
            <?php
            $data_awal = 0;
            $data_limit = $b;
            for ($i = 0; $i < $c; $i++) {

            ?>
                <div class="row" class="page" style="page-break-after: always">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-7 mb-0" style="text-align: left;">
                                <h4>Data hasil reset piano <span style="font-size: small;">(PIC: <?= $approval ?>)</span></h4>
                            </div>
                            <div class="col-5 mb-0" style="text-align: right; padding-bottom: 0px;">
                                <h6><?= date('H:i:s d-m-Y', strtotime($now)) ?></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-0 mb-0" style="padding-top: 0px; padding-bottom: 0px; text-align: right;">
                                <span style="font-size: small;">Page <?= $i + 1 ?>/<?= $c ?></span>
                            </div>
                        </div>
                        <hr class="mt-0 mb-0">
                        <table class="table table-bordered">
                            <thead>
                                <th>No</th>
                                <th>Serial Number</th>
                                <th>A-Card</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                <?php
                                require 'source_code/vendor/autoload.php';
                                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                ?>
                                <?php

                                $sql = mysqli_query($connect_pro, "SELECT * FROM qa_reset WHERE c_section = '$approval_id' AND c_date = '$max' ORDER BY c_serial ASC LIMIT $data_awal,$data_limit ");
                                while ($data = mysqli_fetch_array($sql)) {
                                    $nomor++;
                                ?>
                                    <tr>
                                        <td><?= $nomor ?></td>
                                        <td><?= $data['c_serial'] ?></td>
                                        <?php
                                        if ($data['c_acard'] == '-') {
                                        ?>
                                            <td style="font-weight: bold;"><?= $data['c_acard'] ?></td>
                                        <?php
                                        } else {
                                        ?>
                                            <td style="font-weight: bold;"><?php echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($data['c_acard'], $generator::TYPE_CODE_128)) . '">'; ?><br><?= $data['c_acard'] ?></td>
                                        <?php
                                        }
                                        ?>
                                        <td><?= $data['c_status'] ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php
                $data_limit = $data_limit + $b;
                $data_awal = $data_awal + $b;
            }
            ?>

        </div>
    </div>

    <script>
        function Countdown(elem, seconds) {
            var that = {};

            that.elem = elem;
            that.seconds = seconds;
            that.totalTime = seconds * 100;
            that.usedTime = 0;
            that.startTime = +new Date();
            that.timer = null;

            that.count = function() {
                that.usedTime = Math.floor((+new Date() - that.startTime) / 10);

                var tt = that.totalTime - that.usedTime;
                if (tt <= 0) {
                    that.elem.innerHTML = '00:00:00';
                    clearInterval(that.timer);
                    // console.log("anjay");
                    window.close();
                } else {
                    var mi = Math.floor(tt / (60 * 100));
                    var ss = Math.floor((tt - mi * 60 * 100) / 100);
                    var ms = tt - Math.floor(tt / 100) * 100;

                    that.elem.innerHTML = that.fillZero(mi) + ":" + that.fillZero(ss) + ":" + that.fillZero(ms);
                }
            };

            that.init = function() {
                if (that.timer) {
                    clearInterval(that.timer);
                    that.elem.innerHTML = '00:00:00';
                    that.totalTime = seconds * 100;
                    that.usedTime = 0;
                    that.startTime = +new Date();
                    that.timer = null;
                }
            };

            that.start = function() {
                if (!that.timer) {
                    that.timer = setInterval(that.count, 1);
                }
            };

            that.stop = function() {
                console.log('usedTime = ' + countdown.usedTime);
                if (that.timer) clearInterval(that.timer);
            };

            that.fillZero = function(num) {
                return num < 10 ? '0' + num : num;
            };

            return that;
        }

        var span = document.getElementById('time');
        var countdown = new Countdown(span, 12);

        $('#start').on('click', function() {
            countdown.start();
        });

        $('#stop').on('click', function() {
            countdown.stop();
        });

        $('#reset').on('click', function() {
            countdown.init();
        });
    </script>
    <script>
        const d = new Date();
        var f = d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear();
        // const button = document.getElementById("download-button");
        $(document).ready(function() {
            $('#start').trigger('click');
            $('#download-button').trigger('click');
        })

        // function generatePDF() {
        $('#download-button').click(function() {
            const element = document.getElementById("invoice");
            // Choose the element and save the PDF for your user.
            html2pdf().from(element).save("Data reset - " + f + ".pdf");
        })
    </script>
</body>

</html>