<!doctype html>
<html lang="en">
<?php
session_start();
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Repair Outside</title>
    <link rel="icon" href="logo_icon.png">
    <link href="script/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="script/jquery.min.js"></script>
    <script type="text/javascript" src="script/qrcode.js"></script>
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
    $connect_pro = new mysqli("localhost", "root", "", "hikari_project");
    $serial = $_SESSION['in_serialprint'];

    //get data ng
    $sql = mysqli_query($connect_pro, "SELECT * FROM formng_resulto1 WHERE c_serialnumber = '$serial' AND c_ng1 != ''");
    $sql2 = mysqli_query($connect_pro, "SELECT * FROM formng_resultc WHERE c_serialnumber = '$serial' AND c_result1 = 'NO'");

    ?>

    <div class="row noPrint">
        <div class="col-6" style="text-align: center;">
            <button class="btn btn-danger" onclick="history.back()">Back</button>
        </div>
        <div class="col-6" style="text-align: center;">
            <button class="btn btn-primary" onclick="window.print();">Print</button>
        </div>
    </div>
    <br>
    <div class="page">

        <!-- Content -->
        <h6 style="text-align: center;">Outside Check <?= $_SESSION['outside'] ?></h6>
        <input id="text" type="hidden" value="<?= $serial ?>" /><br />
        <div style="text-align: center;">
            <div id="qrcode" style="width:25mm; height:25mm; margin-left: 27%;"></div>
            <div style="padding-top: 0px; font-size:15px; "><b><?= $serial ?></b></div>
        </div>
        <hr>
        <div style="font-size: 12px; padding-left: 0px; margin-left: 0px;">
            <h6 style="padding-left: 10px;">Outside NG</h6>
            <ul>
                <?php
                while ($data = mysqli_fetch_array($sql)) {
                ?>
                    <li><?= $data['c_cabinet'] ?><br><b><?= $data['c_ng1'] ?></b></li>
                <?php
                }
                ?>
            </ul>
        </div>
        <hr>

        <div style="font-size: 12px; padding-left: 0px; margin-left: 0px;">
            <h6 style="padding-left: 10px;">Completeness NG</h6>
            <ul>
                <?php
                while ($data = mysqli_fetch_array($sql2)) {
                ?>
                    <li><?= $data['c_partname'] ?></li>
                <?php
                }
                ?>
            </ul>
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

    <script src="script/script.js"></script>

    <script src="script/bootstrap.bundle.min.js"></script>
</body>

</html>