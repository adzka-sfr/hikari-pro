<?php
session_start();
$connect_pro = new mysqli("localhost", "root", "", "hikari_project");


// get type (furniture or polyester)
$sql2 = mysqli_query($connect_pro, "SELECT c_category FROM formng_category WHERE c_gmc = '$_SESSION[gmcpdf]'");
$data2 = mysqli_fetch_array($sql2);

$serial = "J40509714";
$namepiano = "B3E SC3 PE//EP";
$type = "f";

?>

<style>
    @font-face {
        font-family: "Isi";
        src: url("management/l_export/export-content/font/Inter-Regular.ttf") format("truetype");
        font-weight: 400;
        font-style: normal;
    }

    @font-face {
        font-family: "Judul";
        src: url("management/l_export/export-content/font/SpaceMono-Regular.ttf") format("truetype");
        font-weight: 400;
        font-style: normal;
    }

    /*
    @font-face {
        font-family: "Inter";
        src: url("font/Inter-Medium.ttf") format("truetype");
        font-weight: 500;
        font-style: normal;
    }

    @font-face {
        font-family: "Inter";
        src: url("font/Inter-Bold.ttf") format("truetype");
        font-weight: 700;
        font-style: normal;
    }



    @font-face {
        font-family: "Typewrite Bold";
        src: url("font/Typewriter-Bold.ttf");
    }

    @font-face {
        font-family: "Typewrite Thin";
        src: url("font/Typewriter-Thin.ttf");
    } */

    /* body {
        font-size: 0.75rem;
        font-family: "Inter", sans-serif;
        font-weight: 400;
        color: #000000;
        margin: 0 auto;
        position: relative;
    } */



    .pagercok {
        padding-left: 5rem;
        padding-right: 5rem;
    }
</style>

<!-- style untuk koordinat -->
<style>
    /* Container diperlukan untuk memosisikan tombol. Sesuaikan lebarnya sesuai dengan kebutuhan*/
    .containere {
        position: relative;
        width: 100%;
        max-width: 400px;
    }

    /* Buat gambar menjadi responsif */
    .containere img {
        width: 100%;
        height: auto;
    }

    /* Style tombol dan letakkan di tengah container / gambar */
    .containere .bton {
        position: absolute;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        background-color: #0000FF;
        color: white;
        font-size: 12px;
        /* padding: 12px 24px; */
        border: none;
        cursor: pointer;
        border-radius: 5px;
        text-align: center;
    }

    .containere .ingpo {
        position: absolute;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        background-color: transparent;
        opacity: 100%;
        padding: 0px;
        font-size: 8px;
        font-weight: bold;
        border: solid 1px;
        border-radius: 5px;
        border-color: #DC3545;
        cursor: pointer;
        text-align: center;
    }
</style>
<!-- style untuk koordinat -->

<!-- html2pdf CDN link -->
<script src="management/l_export/export-content/html2pdf.bundle.min.js" referrerpolicy="no-referrer"></script>

<?php

// get checker
$sql99 = mysqli_query($connect_pro, "SELECT * FROM formng_register WHERE c_serialnumber = '$serial'");
$data99 = mysqli_fetch_array($sql99);
?>

<div class="row">
    <div class="col-12">
        <button id="download-button" style="border: none; width:100%; height: 30px; background-color: #AA0A00; border-radius: 5px; color: #ffffff; font-weight: bold; cursor: pointer;">Download as PDF</button>
    </div>
</div>

<div id="invoice">
    <div class="row">
        <div class="col-12 pagercok">
            <h2 style="font-family: Judul; padding-top: 0px; padding-bottom: 0px;"><?= $serial ?> #<?= $namepiano ?></h2>
            <table class="table" style="font-family: Isi; font-size: 0.625rem;">
                <thead>
                    <th>No</th>
                    <th>Item</th>
                    <th>Check</th>
                    <th>Repair</th>
                </thead>
                <tbody>
                    <?php
                    for ($a = 0; $a < 43; $a++) {
                    ?>
                        <tr>
                            <td><?= $a ?></td>
                            <td>item <?= $a ?></td>
                            <td>PASS</td>
                            <td>-</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const button = document.getElementById("download-button");

    function generatePDF() {
        // Choose the element that your content will be rendered to.
        const element = document.getElementById("invoice");
        // Choose the element and save the PDF for your user.
        html2pdf().from(element).save("<?= $serial ?>.pdf");
    }

    button.addEventListener("click", generatePDF);
</script>