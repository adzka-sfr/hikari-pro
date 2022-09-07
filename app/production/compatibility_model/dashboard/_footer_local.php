<script src="js/jquery-3.5.1.js"></script>
<script>
    $(document).ready(function() {
        selesai();
    });

    function selesai() {
        setTimeout(function() {
            totalfixing();
            totalstringing();
            st1();
            st2();
            fx1();
            fx2();
            fxall();
            stall();
            fxall_d();
            stall_d();
            selesai();
        }, 200);
    }

    // menyatu
    // DARK ================================================================
    function fxall_d() {
        $.getJSON("data/menyatu/fixing_d.php", function(data) {
            $("#fxall_d").empty();
            $.each(data.result, function() {
                // $("#fxall_d").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px;'><b>" + this['nama_model'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #3169A6 ;font-weight:bold; text-align: center; '>" + this['stock'] + "</h1></td></tr>");
                // $("#fxall_d").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px;'><b>" + this['nama_model'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #3169A6 ;font-weight:bold; text-align: center; '>" + this['stock'] + "</h1></td><td ><h1 style='border-radius: 20px; background-color: #3169A6; font-weight:bold; text-align: center; '>" + this['plan'] + "</h1></td></tr>");
                // $("#fxall_d").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px;'><b>" + this['nama_model'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #3169A6 ;font-weight:bold; text-align: center; '>" + this['stock'] + "</h1></td><td ><h1 style='border-radius: 20px; background-color: #3169A6; font-weight:bold; text-align: center; '>" + this['actual'] + "/" + this['plan'] + "</h1></td></tr>");
                $("#fxall_d").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px;'><b>" + this['nama_model'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #3169A6; font-weight:bold; text-align: center; '>" + this['actual'] + "/" + this['plan'] + "</h1></td></tr>");
            });
        });
    }

    function stall_d() {
        $.getJSON("data/menyatu/stringing_d.php", function(data) {
            $("#stall_d").empty();
            $.each(data.result, function() {
                // $("#stall_d").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px; '><b>" + this['nama_model'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #AA4541; font-weight:bold; text-align: center; '>" + this['stock'] + "</h1></td></tr>");
                // $("#stall_d").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px; '><b>" + this['nama_model'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #AA4541; font-weight:bold; text-align: center; '>" + this['stock'] + "</h1></td><td ><h1 style='border-radius: 20px; background-color: #AA4541; font-weight:bold; text-align: center; '>" + this['plan'] + "</h1></td></tr>");
                $("#stall_d").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px; '><b>" + this['nama_model'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #3169A6; font-weight:bold; text-align: center; '>" + this['wip'] + "</h1></td><td><h1 style='border-radius: 20px; background-color: #AA4541; font-weight:bold; text-align: center; '>" + this['actual'] + "/" + this['plan'] + "</h1></td><td ><h1 style='border-radius: 20px; background-color: #AA4541; font-weight:bold; text-align: center; '>" + this['stock'] + "</h1></td></tr>");
            });
        });
    }

    // LIGHT ==============================================================
    function fxall() {
        $.getJSON("data/menyatu/fixing.php", function(data) {
            $("#fxall").empty();
            $.each(data.result, function() {
                // $("#fxall").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px;'><b>" + this['nama_model'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #DEEDFF ;font-weight:bold; text-align: center; '>" + this['stock'] + "</h1></td></tr>");
                // $("#fxall").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px;'><b>" + this['nama_model'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #DEEDFF ;font-weight:bold; text-align: center; '>" + this['stock'] + "</h1></td><td ><h1 style='border-radius: 20px; background-color: #DEEDFF; font-weight:bold; text-align: center; '>" + this['actual'] + "/" + this['plan'] + "</h1></td></tr>");
                $("#fxall").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px;'><b>" + this['nama_model'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #DEEDFF; font-weight:bold; text-align: center; '>" + this['actual'] + "/" + this['plan'] + "</h1></td></tr>");
            });
        });
    }

    function stall() {
        $.getJSON("data/menyatu/stringing.php", function(data) {
            $("#stall").empty();
            $.each(data.result, function() {
                // $("#stall").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px; '><b>" + this['nama_model'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #FFA696; font-weight:bold; text-align: center; '>" + this['stock'] + "</h1></td></tr>");
                // $("#stall").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px; '><b>" + this['nama_model'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #FFA696; font-weight:bold; text-align: center; '>" + this['stock'] + "</h1></td><td><h1 style='border-radius: 20px; background-color: #FFA696; font-weight:bold; text-align: center; '>" + this['actual'] + "/" + this['plan'] + "</h1></td></tr>");
                $("#stall").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px; '><b>" + this['nama_model'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #DEEDFF; font-weight:bold; text-align: center; '>" + this['wip'] + "</h1></td><td><h1 style='border-radius: 20px; background-color: #FFA696; font-weight:bold; text-align: center; '>" + this['actual'] + "/" + this['plan'] + "</h1></td><td ><h1 style='border-radius: 20px; background-color: #FFA696; font-weight:bold; text-align: center; '>" + this['stock'] + "</h1></td></tr>");

            });
        });
    }
    // menyatu

    function totalfixing() {
        $.getJSON("data/total_fixing.php", function(data) {
            $("#hmbfixing").empty();
            $.each(data.result, function() {
                $("#hmbfixing").append(this['jumlah']);
            });
        });
    }

    function totalstringing() {
        $.getJSON("data/total_stringing.php", function(data) {
            $("#hmbstring").empty();
            $.each(data.result, function() {
                $("#hmbstring").append(this['jumlah']);
            });
        });
    }

    function st1() {
        $.getJSON("data/st1.php", function(data) {
            $("#st1").empty();
            $.each(data.result, function() {
                $("#st1").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px; '><b>" + this['nama_item'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #FFA696; font-weight:bold; text-align: center; '>" + this['qty'] + "</h1></td></tr>");
            });
        });
    }

    function st2() {
        $.getJSON("data/st2.php", function(data) {
            $("#st2").empty();
            $.each(data.result, function() {
                $("#st2").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px; '><b>" + this['nama_item'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #FFA696; font-weight:bold; text-align: center; '>" + this['qty'] + "</h1></td></tr>");
            });
        });
    }

    function fx1() {
        $.getJSON("data/fx1.php", function(data) {
            $("#fx1").empty();
            $.each(data.result, function() {
                $("#fx1").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px; '><b>" + this['nama_item'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #DEEDFF; font-weight:bold; text-align: center; '>" + this['qty'] + "</h1></td></tr>");
            });
        });
    }

    function fx2() {
        $.getJSON("data/fx2.php", function(data) {
            $("#fx2").empty();
            $.each(data.result, function() {
                $("#fx2").append("<tr style ='padding-bottom : 0px;'><td style='padding-right:10px; width: 450px; '><b>" + this['nama_item'] + "</b></td><td ><h1 style='border-radius: 20px; background-color: #DEEDFF; font-weight:bold; text-align: center; '>" + this['qty'] + "</h1></td></tr>");
            });
        });
    }
</script>