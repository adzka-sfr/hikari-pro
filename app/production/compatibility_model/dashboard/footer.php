<script>
    $(document).ready(function() {
        selesai();
    });

    function selesai() {
        setTimeout(function() {
            update();
            totalstringing();
            totalfixing();
            selesai();
        }, 200);
    }

    function update() {
        $.getJSON("data.php", function(data) {
            $("#myTable").empty();
            var no = 1;

            $.each(data.result, function() {
                $("#myTable").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px; '><b>" + this['nama_item'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #FFA696; text-align: center; '>" + this['qty'] + "</h1></td></tr>");
            });
        });
    }

    function totalstringing() {
        $.getJSON("totalstringing.php", function(data) {
            $("#totngenstr").empty();
            var no = 1;

            $.each(data.result, function() {
                $("#totngenstr").append(this['jumlah']);
            });
        });
    }

    function totalfixing() {
        $.getJSON("totalfixing.php", function(data) {
            $("#totngenfix").empty();
            var no = 1;

            $.each(data.result, function() {
                $("#totngenfix").append(this['jumlah']);
            });
        });
    }
</script>


<script>
    $(document).ready(function() {
        selesai2();
    });

    function selesai2() {
        setTimeout(function() {
            update2();
            selesai2();
        }, 200);
    }

    function update2() {
        $.getJSON("data_akhir.php", function(data2) {
            $("#myTable2").empty();
            var no = 1;
            $.each(data2.result2, function() {
                $("#myTable2").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px; '><b>" + this['nama_item'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #FFA696; text-align: center; '>" + this['qty'] + "</h1></td></tr>");
            });
        });
    }
</script>
<script>
    $(document).ready(function() {
        selesai3();
    });

    function selesai3() {
        setTimeout(function() {
            update3();
            selesai3();
        }, 200);
    }

    function update3() {
        $.getJSON("data_fx.php", function(data3) {
            $("#myTable3").empty();
            var no = 1;
            $.each(data3.result3, function() {
                $("#myTable3").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px; '><b>" + this['nama_item'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #DEEDFF; text-align: center; '>" + this['qty'] + "</h1></td></tr>");
            });
        });
    }
</script>
<script>
    $(document).ready(function() {
        selesai4();
    });

    function selesai4() {
        setTimeout(function() {
            update4();
            selesai4();
        }, 200);
    }

    function update4() {
        $.getJSON("data_akhir_fx.php", function(data4) {
            $("#myTable4").empty();
            var no = 1;
            $.each(data4.result4, function() {
                $("#myTable4").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px; '><b>" + this['nama_item'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #DEEDFF; text-align: center; '>" + this['qty'] + "</h1></td></tr>");
            });
        });
    }
</script>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.3.1.min.js "></script>
<script src="js/bootstrap.min.js "></script>
<script src="js/owl.carousel.min.js "></script>
<script src="js/main.js "></script>

</body>

</html>