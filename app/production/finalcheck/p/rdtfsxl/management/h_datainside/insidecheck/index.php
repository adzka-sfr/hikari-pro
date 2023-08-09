<?php require '../../../config.php'; ?>
<div class="row">
    <div class="col-12">
        <table class="table dothemagictotable">
            <thead>
                <th style="width: 5%; text-align: center;">No</th>
                <th>Cabinet Name</th>
                <th style="text-align: center; width: 20%;">Enable/Disable</th>
            </thead>
            <tbody>
                <?php
                $no = 0;
                // name ng
                $q3 = mysqli_query($connect_pro, "SELECT c_detail, c_code_incheck, c_status FROM finalcheck_list_incheck ORDER BY c_seq ASC");
                while ($d3 = mysqli_fetch_array($q3)) {
                    $no++;
                    // get enable/disable
                    if ($d3['c_status'] == 'enable') {
                        $cheklis_default = 'checked';
                    } else {
                        $cheklis_default = '';
                    }
                ?>
                    <tr>
                        <td style="text-align: center;"><?= $no ?></td>
                        <td><?= $d3['c_detail'] ?></td>
                        <td style="text-align: center;"><input disabled <?= $cheklis_default ?> id="inside<?= $d3['c_code_incheck'] ?>" onchange="cekbok1(this.id)" value="<?= $d3['c_code_incheck'] ?>" type="checkbox" style="transform: scale(2);"></td>
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
            });
        </script>
    </div>
</div>