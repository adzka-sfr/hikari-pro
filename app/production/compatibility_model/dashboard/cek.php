<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include('koneksi.php') ?>
    <h1>jumlahnya</h1>
    <span id="hmbstring"></span>

    <!-- <script src="js/popper.min.js" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" crossorigin="anonymous"></script> -->
    <script src="js/jquery-3.5.1.js"></script>
    <script>
        $(document).ready(function() {
            selesai();
        });

        function selesai() {
            setTimeout(function() {
                // update();
                totalstringing();
                // totalfixing();
                selesai();
            }, 200);
        }

        function totalstringing() {
            $.getJSON("data/total_stringing.php", function(data) {
                $("#hmbstring").empty();
                var no = 1;

                $.each(data.result, function() {
                    $("#hmbstring").append(this['jumlah']);
                });
            });
        }

        // function totalfixing() {
        //   $.getJSON("data/total_fixing.php", function(data) {
        //     $("#totngenfix").empty();
        //     var no = 1;

        //     $.each(data.result, function() {
        //       $("#totngenfix").append(this['jumlah']);
        //     });
        //   });
        // }

        // function update() {
        //     $.getJSON("data.php", function(data) {
        //         $("#myTable").empty();
        //         var no = 1;

        //         $.each(data.result, function() {
        //             $("#myTable").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px; '><b>" + this['nama_item'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #FFA696; text-align: center; '>" + this['qty'] + "</h1></td></tr>");
        //         });
        //     });
        // }
    </script>


</body>

</html>