<div class="row">
    <div class="col-12">
        <h5>Dashboard</h5>
        <div class="separator"></div>
        <div class="row">
            <div class="col-6">
                <div id="main" style="width: 100%; height:300px;"></div>
                <?php
                // menghitung total
                $sql = mysqli_query($connect, "SELECT count(id) as total from auth");
                $data = mysqli_fetch_array($sql);
                $total = $data['total'];

                // menghitung per bagian
                $nama = array();
                $qty = array();
                $a = 0;
                $sql1 = mysqli_query($connect, "SELECT distinct dept from auth order by dept asc");
                while ($data1 = mysqli_fetch_array($sql1)) {
                    $nama[$a] = $data1['dept'];

                    $sql3 = mysqli_query($connect, "SELECT count(dept) as todep from auth where dept = '$data1[dept]'");
                    $data3 = mysqli_fetch_array($sql3);
                    $qty[$a] = $data3['todep'];
                    $a++;
                }
                ?>
                <script type="text/javascript">
                    var chartDom = document.getElementById('main');
                    var myChart = echarts.init(chartDom);
                    var option;

                    option = {
                        tooltip: {
                            trigger: 'item'
                        },
                        legend: {
                            top: '5%',
                            left: 'center'
                        },
                        // untuk tulisan di tengah
                        graphic: {
                            elements: [{
                                type: 'text',
                                left: 'center',
                                top: 'middle',
                                z: 999,
                                style: {
                                    text: `Total <?= $total ?>`,
                                    textAlign: 'center',
                                    fontSize: 26
                                }
                            }]
                        },
                        // untuk tulisan di tengah
                        series: [{
                            name: 'User',
                            type: 'pie',
                            radius: ['40%', '70%'],
                            avoidLabelOverlap: false,
                            itemStyle: {
                                borderRadius: 10,
                                borderColor: '#fff',
                                borderWidth: 2
                            },
                            label: {
                                show: false,
                                position: 'center'
                            },
                            labelLine: {
                                show: false
                            },
                            data: [<?php for ($i = 0; $i < count($nama); $i++) {
                                        echo "{value:" . $qty[$i] . ", name:'" . $nama[$i] . "'},";
                                    } ?>]
                        }]
                    };

                    option && myChart.setOption(option);
                </script>
            </div>
            <div class="col-6 tableFixHead-3">
                <table class="table table-bordered">
                    <thead>
                        <th>Id</th>
                        <th>Pass</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Dept</th>
                        <th>Role</th>
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
                                $("#isi").append("<tr><td>" + this['id'] + "</td><td>" + this['pass'] + "</td><td>" + this['nama'] + "</td><td>" + this['jabatan'] + "</td><td>" + this['dept'] + "</td><td>" + this['role'] + "</td></tr>");
                                no++;
                            });
                        });
                    }
                </script>
            </div>
        </div>
    </div>
</div>