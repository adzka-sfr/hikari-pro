<div class="row">
    <div class="col-12">
        <h5>Dashboard</h5>
        <div class="separator"></div>
        <div class="row">
            <div class="col-6">
                <div id="main" style="width: 100%; height:300px;"></div>
                <?php
                // menghitung total
                $sql = mysqli_query($connect_pro, "SELECT count(serial) as total from rfid_stock where location != ''");
                $data = mysqli_fetch_array($sql);
                $total = $data['total'];

                // menghitung per bagian
                $nama = array();
                $qty = array();
                $a = 0;
                $sql1 = mysqli_query($connect_pro, "SELECT distinct location from rfid_stock where location != '' order by location asc");
                while ($data1 = mysqli_fetch_array($sql1)) {
                    $nama[$a] = $data1['location'];

                    $sql3 = mysqli_query($connect_pro, "SELECT count(location) as toloc from rfid_stock where location = '$data1[location]'");
                    $data3 = mysqli_fetch_array($sql3);
                    $qty[$a] = $data3['toloc'];
                    $a++;
                }
                include 'byloc.php';
                include 'bystat.php';
                ?>

            </div>
            <div class="col-6 tableFixHead-3">
                <table class="table table-bordered">
                    <thead style="text-align: center;">
                        <th>Serial</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Location</th>
                        <th>Last Transaction</th>
                    </thead>
                    <tbody id="isi">

                    </tbody>
                </table>
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
                        $.getJSON("dashboard/data.php", function(data) {
                            $("#isi").empty();
                            var no = 1;
                            $.each(data.result, function() {
                                $("#isi").append("<tr><td style='text-align: center;'>" + this['serial'] + "</td><td>" + this['name'] + "</td><td style='text-align: center;'>" + this['status'] + "</td><td>" + this['location'] + "</td><td style='text-align: center;'>" + this['last_transaction'] + "</td></tr>");
                                no++;
                            });
                        });
                    }
                </script>
            </div>
        </div>
    </div>
</div>