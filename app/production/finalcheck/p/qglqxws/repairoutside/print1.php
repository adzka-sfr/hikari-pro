<!doctype html>
<html lang="en">
<?php
session_start();
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Repair Inside</title>
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
    $serialnumber = $_SESSION['serialinside'];

    // get list pic incheck
    $q1 = mysqli_query($connect, "SELECT nama FROM auth WHERE role = 'repair incheck'");

    // get pic cek and note
    $q2 = mysqli_query($connect_pro, "SELECT a.c_inside as pic_check, b.c_inside as note_check, c.c_inside_pic as pic_repair FROM finalcheck_pic a INNER JOIN finalcheck_note b ON a.c_serialnumber = b.c_serialnumber INNER JOIN finalcheck_repairtime c ON a.c_serialnumber = c.c_serialnumber WHERE a.c_serialnumber = '$serialnumber'");
    $d2 = mysqli_fetch_array($q2);

    ?>
    <div class="row noPrint">
        <div class="col-6" style="text-align: center;">
            <button id="back" class="btn btn-danger">Back</button>
        </div>
        <div class="col-6" style="text-align: center;">
            <button id="print" class="btn btn-primary">Print</button>
        </div>
    </div>
    <br>
    <div class="page">

        <!-- Content -->
        <h6 style="text-align: center;">Inside Check</h6>
        <input id="text" type="hidden" value="<?= "X-" . $serialnumber ?>" /><br />
        <div style="text-align: center;">
            <div style="padding-top: 0px; font-size:15px; "><b><?= $d2['pic_check'] ?></b></div>
            <div id="qrcode" style="width:25mm; height:25mm; margin-left: 27%;"></div>
            <div style="padding-top: 0px; font-size:15px; "><b><?= "X-" . $serialnumber ?></b></div>
        </div>
        <hr style="border-top: 3px solid black;">
        <div style="font-size: 12px; padding-left: 0px; margin-left: 0px;">
            <ul>
                <?php
                // get incheck
                // get ng


                $q3 = mysqli_query($connect_pro, "SELECT a.c_code_incheck, a.c_code_ng, b.c_detail FROM finalcheck_fetch_inside a INNER JOIN finalcheck_list_incheck b ON a.c_code_incheck = b.c_code_incheck WHERE a.c_result = 'NG' AND a.c_serialnumber ='$serialnumber'");
                while ($d3 = mysqli_fetch_array($q3)) {
                    $ng = array();

                    $d3a = explode('/', $d3['c_code_ng']);
                    foreach ($d3a as $value) {
                        $q3b = mysqli_query($connect_pro, "SELECT c_name FROM finalcheck_list_ng WHERE c_code_ng = '$value'");
                        $d3b = mysqli_fetch_array($q3b);
                        array_push($ng, $d3b['c_name']);
                    }
                    $ng = implode('//', $ng);
                ?>
                    <li><?= $d3['c_detail'] ?>.
                        <b><?= $ng ?></b>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
        <hr style="border-top: 3px solid black;">
        <div style="font-size: 12px; padding-left: 10px; margin-left: 0px; margin-bottom:0px;">
            <b>Note:</b>
            <br>

            <b>
                <pre><?= $d2['note_check'] ?></pre>
            </b>
        </div>
        <hr style="border-top: 3px solid black; margin-bottom: 0px; margin-top:0px;">
        <div style="font-size: 12px; padding-left: 10px; margin-left: 0px; margin-top: 0px;">
            pic repair: <span id="pic"><?= $d2['pic_repair'] ?></span>
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
        $('#print').click(function() {
            // ajax
            window.print()
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
    </script>
    <script src="../../source/js/bootstrap.bundle.min.js"></script>
</body>

</html>