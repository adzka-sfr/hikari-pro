<?php
include 'header.php';
?>

<body style="background-color: #ffffff; font-family: Brandon Grotesque;">
    <div class="row" style="background-color: #2679B5; box-shadow: 0px 1px 5px rgba(0,0,0,0.2);">
        <div class="col-8" style="padding-left: 50px; padding-top: 5px;">
            <img src="image/original-white.png" style="
        height:23px;
        margin-left: 50px;
        margin-top: 5px;
        margin-bottom: 10px;
        ">
        </div>
        <div class="col-4" style="padding-right: 55px; text-align: right; padding-top: 5px;">
            <b><a href="index_fx_frame.php" style="color: whitesmoke; ">Fixing Frame</a></b>
        </div>
    </div>
    <!-- box-shadow: 0px 1px 5px rgba(0,0,0,0.8); -->
    <div class="row" style="background-color: #F5F5F5; box-shadow: 0px 1px 5px rgba(0,0,0,0.2);">

        <div class="col-8" style="padding-left: 50px; padding-top: 5px;">
            <h3>
                ASSY UP MODEL COMPATIBILITY <b> - STRINGING UP <u>| <span style="color: #0DA90D;" id="totngenstr"></span> <span style="color: #0DA90D;">Unit</span> |</u></b></h3>
        </div>
        <div class="col-4" style="text-align: right; padding-right: 50px; padding-top: 5px;">
            <h4><?php echo date('l, d-m-Y') ?></h4>
        </div>
    </div>

    </div>
    <div class="row">
        <div class="col-6">
            <div class="card w-100">
                <div class="d-md-flex testimony-29101">
                    <div class="card-body">
                        <table class="table" style="font-size: 35px;">
                            <thead style="font-size: 35px; padding-top: 5px; padding-bottom: 5px; background-color: #FFA696; ">
                                <th>Model </th>
                                <th>Qty </th>
                            </thead>
                            <tbody id="myTable">
                                <tr>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-6">


            <div class="card w-100">
                <div class="d-md-flex testimony-29101">
                    <div class="card-body">
                        <table class="table" style="font-size: 35px;">
                            <thead style="font-size: 35px; padding-top: 5px; padding-bottom: 5px; background-color: #FFA696;">
                                <th>Model </th>
                                <th>Qty </th>
                            </thead>
                            <tbody id="myTable2">
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


    <?php include 'footer.php' ?>