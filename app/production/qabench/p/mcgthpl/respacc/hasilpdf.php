<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="jquery.min.js"></script>
    <script src="jquery-3.4.1.js" crossorigin="anonymous"></script>
    <!-- html2pdf CDN link -->
    <script src="html2pdf.bundle.min.js" referrerpolicy="no-referrer"></script>

</head>

<body>
    <button id="download-button" style="border: none; height: 30px; background-color: #AA0A00; border-radius: 5px; color: #ffffff; font-weight: bold; cursor: pointer;">Download as PDF</button>

    <div id="invoice">
        <table border="1">
            <thead>
                <tr>
                    <th>Anjay</th>
                </tr>
            </thead>
        </table>
    </div>

    <script>
        // const button = document.getElementById("download-button");
        $(document).ready(function() {
            $('#download-button').trigger('click');
        })

        // function generatePDF() {
        $('#download-button').click(function() {
            const element = document.getElementById("invoice");
            // Choose the element and save the PDF for your user.
            html2pdf().from(element).save("anjay.pdf");
        })
        // Choose the element that your content will be rendered to.
        // const element = document.getElementById("invoice");
        // // Choose the element and save the PDF for your user.
        // html2pdf().from(element).save("anjay.pdf");
        // }

        // button.addEventListener("click", generatePDF);
        // $.ajax({
        //     url: "hasilpdf.php",
        //     success: function(dataResult) {
        //         window.close();
        //     }
        // });
    </script>
</body>

</html>