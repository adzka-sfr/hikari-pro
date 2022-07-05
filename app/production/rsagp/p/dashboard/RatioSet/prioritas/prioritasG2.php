<?php
include 'header.php';
?>

<body style="background-color: #ffffff;">

    <div class="row" style="background-color: #2679B5; box-shadow: 0px 1px 5px rgba(0,0,0,0.2);">
        <div class="col-8" style=" padding-top: 5px;">
            <img src="image/original-white.png" style="
        height:23px;
        margin-left: 20px;
        margin-top: 5px;
        margin-bottom: 10px;
        ">
        </div>
        <div class="col-4" style="padding-right: 40px; text-align: right; margin-top: 5px ">
            <b><a href="prioritasG0.php" style="color: black; background-color : #DEEDFF; padding: 5px; border-radius: 0.25rem">Cabinet G 130 Dest</a></b>
            <b><a href="prioritasG1.php" style="color: black; background-color : #DEEDFF; padding: 5px; border-radius: 0.25rem">Cabinet G 150 Dest</a></b>
            <a href="../index.php" class="btn btn-success mb-1 ml-3"><i class="fa fa-sign-in"></i></a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body" style="text-align: center; padding-top: 5px; padding-bottom: 5px;">
                    <b style="font-size: 30px; text-align: center; padding-top: 5px; padding-bottom: 5px;">CABINET G 200 DESTINATION</b>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card w-100">
                <div class="card-body" style="font-size: 30px; padding-top: 5px; padding-bottom: 5px; background-color: #e2ece9;">
                    <div class="row">
                        <div class="col-2">
                            <b>No</b>
                        </div>
                        <div class="col-5">
                            <b>Cabinet Name</b>
                        </div>
                        <div class="col-3" style="text-align: right;">
                            <b>Model</b>
                        </div>
                        <div class="col-2" style="text-align: center;">
                            <b>Qty</b>
                        </div>
                    </div>
                </div>
            </div>
            <div id="contain">
                <div class="card w-100">
                    <div class="d-md-flex testimony-29101">
                        <div class="card-body">
                            <table class="table" style="font-size: 30px;">
                                <tbody>
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- .item -->
    <script>
        var my_time;
        $(document).ready(function() {
            pageScroll();
            $("#contain").mouseover(function() {
                clearTimeout(my_time);
            }).mouseout(function() {
                pageScroll();
            }).ajax.reload();
        });

        function pageScroll() {
            var objDiv = document.getElementById("contain");
            objDiv.scrollTop = objDiv.scrollTop + 1;
            $('p:nth-of-type(1)').html('scrollTop : ' + objDiv.scrollTop);
            $('p:nth-of-type(2)').html('scrollHeight : ' + objDiv.scrollHeight);
            if (objDiv.scrollTop == (objDiv.scrollHeight - 380)) {
                objDiv.scrollTop = 0;
            }
            my_time = setTimeout('pageScroll()', 30);
        }
    </script>
    <script>
        $(document).ready(function() {
            selesai();
        });

        function selesai() {
            setTimeout(function() {
                update();
                selesai();
            }, 200);
        }

        function update() {
            $.getJSON("G2.php", function(data) {
                $("table").empty();
                var no = 1;
                $.each(data.result, function() {
                    $("table").append("<tr><td>" + (no++) + "</td><td>" + this['name_cabinet'] + "</td><td style='text-align:left'>" + this['name_piano'] + "</td><td ><h1 style='border-radius: 0.25rem; background-color: #DEEDFF; text-align: center; margin-right: 20px '>" + this['pcs_prioritas'] + "</h1></td></tr>");
                });
            });
        }
    </script>


    <?php include 'footer.php' ?>