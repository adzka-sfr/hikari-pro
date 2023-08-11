<?php require '../../../config.php'; ?>
<div class="row">
    <div class="col-12">
        <table class="table table-striped dothemagictotable">
            <thead>
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 10%;text-align: center;">GMC</th>
                <th>Piano Name (K-staff)</th>
                <th style="text-align: center; width: 20%;">Form Completeness</th>
                <th style="text-align: center; width: 20%;">Form Outside Check</th>
            </thead>
            <tbody>
                <?php
                $no = 0;
                // name ng
                $q3 = mysqli_query($connect_pro, "SELECT * FROM finalcheck_list_piano ORDER BY c_name ASC");
                while ($d3 = mysqli_fetch_array($q3)) {
                    $no++;
                    // outside
                    if ($d3['c_code_type'] == 'p') {
                        $outside_card = 'Polyester';
                    } elseif ($d3['c_code_type'] == 'f') {
                        $outside_card = 'Furniture';
                    } elseif ($d3['c_code_type'] == 's') {
                        $outside_card = 'Silent';
                    } else {
                        $outside_card = '?';
                    }
                ?>
                    <tr>
                        <td style="text-align: center;"><?= $no ?></td>
                        <td style="text-align: center;"><?= $d3['c_gmc'] ?></td>
                        <td><?= $d3['c_name'] ?></td>
                        <td style="text-align: center;"><?= $d3['c_code_model'] ?></td>
                        <td style="text-align: center;"><?= $outside_card ?></td>
                    </tr>
                <?php
                }

                ?>
            </tbody>
            <script>
                $('#lock').click(function() {
                    $('#lock').hide();
                    $('#unlock').show();
                    $('input[type=checkbox]').attr('disabled', false);
                })

                $('#unlock').click(function() {
                    $('#unlock').hide();
                    $('#lock').show();
                    $('input[type=checkbox]').attr('disabled', true);
                })

                function cekbok1(id) {
                    if ($('#' + id).is(':checked')) {
                        console.log($('#' + id).val() + ': cuscab - centang');
                        result = 'enable';
                    } else {
                        console.log($('#' + id).val() + ': cuscab - tidak centang');
                        result = 'disable';
                    }
                    var code_incheck = $('#' + id).val();

                    $.ajax({
                        url: "management/h_datainside/insidecheck/datachange.php",
                        type: "POST",
                        data: {
                            "code_incheck": code_incheck,
                            "result": result
                        },
                        success: function(data) {
                            var data = JSON.parse(data);
                            console.log(data.status);
                        },
                        error: function() {
                            lostconnection()
                        }
                    });
                }
            </script>
        </table>
        <script>
            $('.dothemagictotable').DataTable({
                // scrollY: '700px',
                // scrollCollapse: true,
                paging: false,
                "dom": '<"wrapper"flipt>'
            });
        </script>
    </div>
</div>