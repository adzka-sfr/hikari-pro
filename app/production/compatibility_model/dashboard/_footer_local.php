<script>
    $(document).ready(function() {
        selesai();
    });

    function selesai() {
        setTimeout(function() {
            // update();
            totalstringing();
            totalfixing();
            selesai();
        }, 200);
    }

    function totalstringing() {
        $.getJSON("data/total_stringing.php", function(data) {
            $("#totngenstr").empty();
            var no = 1;

            $.each(data.result, function() {
                $("#totngenstr").append(this['jumlah']);
            });
        });
    }

    function totalfixing() {
        $.getJSON("data/total_fixing.php", function(data) {
            $("#totngenfix").empty();
            var no = 1;

            $.each(data.result, function() {
                $("#totngenfix").append(this['jumlah']);
            });
        });
    }

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

<script src="js/jquery-3.3.1.min.js"></script>